<?php
class StudentModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

    public function addNew($email, $pass)
    {
		$q = $this->db->query('select * from students where email="'.$email.'"');
		$r = $q->result_array();
		if (count($r)>0){
			throw new Exception('такой e-mail уже существует');
		} else{
			$ins = array(
				'email'=>$email,
				'password'=>$pass,
				'created_at'=>date('Y-m-d H:i:s',time()),
				'status'=>1,
			);
			$this->db->insert('students', $ins);
			//sending e-mail
			$this->load->library('email');
			$this->email->from('test@dvn125.xyz', 'RealLanguage.Club');
			$this->email->to($email);
			$this->email->subject('Успешная регистрация на RealLanguage.Club');
			$mess = "Поздравляем!<br><br>";
			$mess .= "Вы успешно создали аккаунт на <a href='https://reallanguage.club'>RealLanguage.Club</a> и у Вас есть личный кабинет. <br>";
			$mess .= "Для входа используйте: <br>";
			$mess .= "Логин: ".$email."<br>";
			$mess .= "Пароль: ".$pass."<br><br>";
			$mess .= "Желаем Вам успехов в учебе! <br><br>";
			$mess .= "С уважением, <br><br>";
			$mess .= "команда RealLanguage.Club <br>";
			$this->email->message($mess)->set_mailtype('html');

			$this->email->send();
			return '0';
		}
    }

	public function login($email, $pass)
	{
		$q = $this->db->query('select * from students where email="'.$email.'" and password="'.$pass.'" and status<3');
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('неправильный логин/пароль');
		} else{
			$this->db->where('id', $r[0]['id']);
			$this->db->update('students', array('visit_at'=>date('Y-m-d H:i:s',time())));
			$this->session->set_userdata('student_id', $r[0]['id']);
			return '0';
		}
	}

	public function findOne($id)
	{
		$q = $this->db->query('select * from students where id='.$id);
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('нет такого id='.$id);
		}
		$student = $r[0];
		if (is_null($student['tzone_id'])){
				$student['tzone'] = 0;
		} else{
			$q = $this->db->query('select zone_time from timezones where id='.$student['tzone_id']);
			$r = $q->result_array();
			if (count($r) == 0){
				$student['tzone'] = 0;
			} else{
				$student['tzone'] = $r[0]['zone_time'];
			}
		}
		if ( (time() < (strtotime($student['visit_at'])+60*5)) && ($student['status'] >0)){
			$student['online'] = true;
		} else{
			$student['online'] = false;
		}
		///
		$sel = 'select count(id) as c from chats where to_role=2 and to_id='.$id.' and read_at is null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)>0){
			$student['new'] = $r[0]['c'];
		} else{
			$student['new'] = 0;
		}
		///
		$this->student = $student;
		return $this;
	}

	public function update($arr)
	{
		foreach ($arr as $k => $v) {
			$this->student[$k] = trim($v);
		}
		$this->db->where('id', $this->student['id']);
		$this->db->update('students', $arr);
		return 0;
	}

	public function addfavorite($repetitor_id, $student_id)
	{
		$q = $this->db->query('select id from favorites where repetitor_id='.$repetitor_id.' and student_id='.$student_id);
		$r = $q->result_array();
		if (count($r)==0){
			$ins = array(
				'repetitor_id' => $repetitor_id,
				'student_id' => $student_id,
				'created_at'=>date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('favorites', $ins);
		} else{
			return 1;
		}
		return 0;
	}

	public function getfavorites($student_id)
	{
		$q = $this->db->query('select r.id, r.first_name, r.father_name, (select subject from subjects where id = r.subject1) as sub1, (select subject from subjects where id = r.subject2) as sub2 from favorites as f, repetitors as r where f.repetitor_id=r.id and student_id='.$student_id);
		$r = $q->result_array();
		return $r;
	}

	public function getRepetitor($repetitor_id)
	{
		$q = $this->db->query('select * from repetitors where id='.$repetitor_id);
		$r = $q->result_array();
		$repetitor = $r[0];
		$repetitor['subjects'] = array();
		$k = 0;
		for ($i=1; $i <=2 ; $i++) {
			$q = $this->db->query('select s.id,s.subject from subjects s, repetitors r where r.subject'.$i.'=s.id and r.id='.$repetitor_id);
			$r = $q->result_array();
			if (count($r)>0){
				$repetitor['subjects'][$k] = $r[0];
				$k++;
			}
		}
		if ( (time() < (strtotime($repetitor['visit_at'])+60*5)) && ($repetitor['activity'] >0)){
			$repetitor['online'] = true;
		} else{
			$repetitor['online'] = false;
		}
		return $repetitor;
	}

	public function getRepetitorSpec($repetitor_id, $subject_id)
	{
		$q = $this->db->query('select s.id, s.specialization from rss, specializations s where rss.specialization_id=s.id and rss.subject_id='.$subject_id.' and rss.repetitor_id='.$repetitor_id);
		$r = $q->result_array();
		return $r;
	}

	public function setExercises($data)
	{
		//find cost of exersize
		$sel = 'select cost from rsp where repetitor_id='.$data['repetitor_id'].' and subject_id='.$data['subject_id'];
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$price = $r[0]['cost'];
		$cost = $price  * 1.3 * count($data['dates']);
		//find balance of student
		$sel = 'select balance from students where id='.$data['student_id'];
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$student_balance = $r[0]['balance'];
		//save exersizes to DB
		foreach ($data['dates'] as $date) {
			$d = date('Y-m-d H:i:s', $date/1000);
			$sel = 'select id from exercises where date_from="'.$d.'"';
			$q = $this->db->query($sel);
			$r = $q->result_array();
			if (count($r) == 0){
				return 'did no find date='.$d.' in exersize';
			}
			$id = $r[0]['id'];
			$ins =  array(
				'student_id' => $data['student_id'],
   			 	'repetitor_id' => $data['repetitor_id'],
   			 	'specialization_id' => $data['specialization_id'],
   			 	'subject_id' => $data['subject_id'],
   			 	'about' => $data['about'],
   			 	'created_at' => $data['created_at'],
				'cost' => $price,
			);
			$this->db->where('id', $id);
			$this->db->update('exercises', $ins);
		}
		//check if student cn pay
		if ($student_balance-$cost>=0){
			return false;
		} else{
			return ceil($cost);
		}
	}

	public function canPayEx($student_id, $ex_id)
	{
		$sel = 'select balance from students where id='.$student_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$student_balance = $r[0]['balance'];
		$sel = 'select cost from exercises where id='.$ex_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$cost = $r[0]['cost'];
		if ($student_balance-$cost>=0){
			return false;
		} else{
			return $cost;
		}
	}

	public function addBallance($student_id, $sum)
	{
		$sel = 'select balance from students where id='.$student_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$student_balance = $r[0]['balance'] + $sum;
		$this->db->where('id', $student_id);
		$this->db->update('students', array('balance'=>$student_balance));
		return 0;
	}

	public function addPayHistory($student_id, $sum, $type)
	{
		$ins = 'insert into balance_adds (created_at, student_id, cost, type)
		values ("'.date('Y-m-d H:i:s',time()).'",'.$student_id.','.$sum.',"'.$type.'")';
		$this->db->query($ins);
		return 0;
	}

	public function setStudentStatus($student_id, $status)
	{
		$sel = 'update students set status='.$status.' where id='.$student_id;
		$q = $this->db->query($sel);
		return $sel;
	}

	public function visit($student_id)
	{
		$this->db->where('id', $student_id);
		$this->db->update('students', array('visit_at'=>date('Y-m-d H:i:s',time())));
	}

	public function getStudentZone($student_id)
	{
		$sel = 'select t.zone_time from timezones t, students s where t.id=s.tzone_id and s.id='.$student_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			return 0;
		} else{
			return $r[0]['zone_time'];
		}
	}

	public function lessonsRequests($student_id)
	{
		$zone = $this->getStudentZone($student_id);
		$sel = 'select * from exercises where deleted_at is null and cost>0 and cancel_at is null and student_id='.$student_id.' order by created_at';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$lessons = array();
		$i = -1;
		$cr = '';
		foreach ($row as $r) {
			if ($r['created_at'] == $cr){
				$lessons[$i]['count']++;
				$lessons[$i]['sum'] += $r['cost'];
				$lessons[$i]['dates'][] = date('Y-m-d H:i:s', strtotime($r['date_from']) + $zone*60*60);
				$lessons[$i]['ids'][] = $r['id'];
			} else{
				$i++;
				$cr = $r['created_at'];
				$lessons[$i] = $r;
				$lessons[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['created_at']) + $zone*60*60);
				$lessons[$i]['count'] = 1;
				$lessons[$i]['sum'] = $lessons[$i]['cost'];
				$lessons[$i]['dates'] = array();
				$lessons[$i]['dates'][0] = date('Y-m-d H:i:s', strtotime($r['date_from']) + $zone*60*60);
				$lessons[$i]['ids'][0] = $r['id'];
			}
		}
		for ($i=0; $i < count($lessons); $i++) {
			//$sel = 'select r.first_name, r.father_name, sub.subject, spe.specialization from exercises ex, repetitors r, subjects sub, specializations spe where ex.repetitor_id=r.id and ex.subject_id=sub.id and ex.specialization_id=spe.id and ex.id='.$lessons[$i]['id'];
			$sel = 'select r.first_name, r.father_name, sub.subject, (select specialization from specializations where id=ex.specialization_id) as specialization from exercises ex, repetitors r, subjects sub, specializations spe where ex.repetitor_id=r.id and ex.subject_id=sub.id and ex.id='.$lessons[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$lessons[$i]['repetitor'] = $r[0]['first_name'];
			if (!is_null($r[0]['father_name'])){
				$lessons[$i]['repetitor'] .= ' '.$r[0]['father_name'];
			}
			$lessons[$i]['subject'] = $r[0]['subject'];
			$lessons[$i]['specialization'] = $r[0]['specialization'];
		}
		return $lessons;
	}

	public function lessons($student_id)
	{
		$sel = 'select * from exercises where student_id='.$student_id.' and date_accept is not null and pay_at is not null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$lessons = $r;
		$zone = $this->getStudentZone($student_id);
		for ($i=0; $i < count($lessons); $i++) {
			$lessons[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['date_from']) + $zone*60*60);
			$sel = 'select r.first_name, r.father_name, r.skype, sub.subject, spe.specialization from exercises ex, repetitors r, subjects sub, specializations spe where ex.repetitor_id=r.id and ex.subject_id=subject_id and ex.specialization_id=spe.id and ex.id='.$lessons[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$lessons[$i]['repetitor'] = $r[0]['first_name'];
			if (!is_null($r[0]['father_name'])){
				$lessons[$i]['repetitor'] .= ' '.$r[0]['father_name'];
			}
			$lessons[$i]['subject'] = $r[0]['subject'];
			$lessons[$i]['specialization'] = $r[0]['specialization'];
			$lessons[$i]['skype'] = $r[0]['skype'];
		}
		return $lessons;
	}

	public function payedlessons($student_id)
	{
		$zone = $this->getStudentZone($student_id);
		$sel = 'select ex.created_at, ex.repetitor_id, ex.pay_at, r.first_name, r.father_name, ex.cost, ex.id, ex.about from repetitors r, exercises ex where ex.repetitor_id = r.id and pay_at is not null and ex.student_id ='.$student_id.' order by ex.created_at';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$data = array();
		$cr = '';
		$i = -1;
		foreach ($row as $r) {
			if ($r['created_at'] == $cr){
				$data[$i]['count']++;
				$data[$i]['sum'] += $r['cost'];
			} else{
				$i++;
				$cr = $r['created_at'];
				$data[$i] = $r;
				$data[$i]['pay_at'] = date('Y-m-d H:i:s', strtotime($data[$i]['pay_at']) + $zone*60*60);
				$data[$i]['count'] = 1;
				$data[$i]['sum'] = $data[$i]['cost'];
				$data[$i]['repetitor'] = $r['first_name'];
				if (!is_null($r['father_name'])){
					$data[$i]['repetitor'] .= ' '.$r['father_name'];
				}
			}
		}
		return $data;
	}

	public function getpays($student_id)
	{
		$sel = 'select * from balance_adds where student_id='.$student_id;
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$zone = $this->getStudentZone($student_id);
		$data = array();
		foreach ($row as $r) {
			$data[] = array(
				'created_at'=> date('Y-m-d H:i:s', strtotime($r['created_at']) + $zone*60*60),
				'cost'=> $r['cost'],
				'type'=>$r['type'],
			);
		}
		return $data;
	}
}
