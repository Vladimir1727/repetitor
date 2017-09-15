<?php
class RepetitorModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->repetitor = array();
	}

    public function addNewRep($email, $pass)
    {
		$q = $this->db->query('select * from repetitors where email="'.$email.'"');
		$r = $q->result_array();
		if (count($r)>0){
			throw new Exception('такой e-mail уже существует');
		} else{
			$rep = array(
				'email'=>$email,
				'password'=>$pass,
				'created_at'=>date('Y-m-d H:i:s',time()),
			);
			$this->db->insert('repetitors', $rep);
			//sending e-mail
			$this->load->library('email');
			$this->email->from('test@dvn125.xyz', 'RealLanguage.Club');
			$this->email->to($email);
			$this->email->subject('Успешная регистрация на RealLanguage.Club');
			$mess = "Поздравляем!<br><br>";
			$mess .= "Вы успешно создали аккаунт на <a href='https://reallanguage.club'>RealLanguage.Club</a> и у Вас есть личный кабинет. <br><br>";
			$mess .= "Вам осталось всего несколько шагов:<br>";
			$mess .= "<ul><li>Зайдите в личный кабинет;</li>";
			$mess .= "<li>Заполните все формы Профиля;</li>";
			$mess .= "<li>Отправьте запрос на активацию.</li></ul>";
			$mess .= "Для входа используйте: <br>";
			$mess .= "Логин: ".$email."<br>";
			$mess .= "Пароль: ".$pass."<br><br>";
			$mess .= "Желаем Вам успехов! <br><br>";
			$mess .= "С уважением, <br><br>";
			$mess .= "команда RealLanguage.Club <br>";
			$this->email->message($mess)->set_mailtype('html');
			$this->email->send();

			return '0';
		}
    }

	public function login($email, $pass)
	{
		$q = $this->db->query('select * from repetitors where email="'.$email.'" and password="'.$pass.'"');
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('неправильный логин/пароль');
		} else{
			$this->db->where('id', $r[0]['id']);
			$this->db->update('repetitors', array('visit_at'=>date('Y-m-d H:i:s',time())));
			$this->session->set_userdata('repetitor_id', $r[0]['id']);
			return $r[0]['id'];
		}
	}

	public function findOne($id){
		$q = $this->db->query('select * from repetitors where id='.$id);
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('нет такого id');
		}
		$rep = $r[0];
		$sub = 0;
		for ($i=1; $i <=2 ; $i++) {
			if (!is_null($rep['subject'.$i])){
				$q = $this->db->query('select subject from subjects where id='.$rep['subject'.$i]);
				$r = $q->result_array();
				$rep['sub'.$i.'_name'] = $r['0']['subject'];
				$sub++;
			}
		}
		$rep['sub_num'] = $sub;

		$this->repetitor = $rep;
		return $this;
	}

	public function save()
	{
		$this->db->where('id', $this->repetitor['id']);
		$this->db->update('repetitors', $this->repetitor);
		return 0;
	}

	public function update($arr){
		foreach ($arr as $k => $v) {
			$this->repetitor[$k] = trim($v);
		}
		$this->db->where('id', $this->repetitor['id']);
		try {
			$this->db->update('repetitors', $this->repetitor);
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return 0;
	}

	public function saveSubject($repetitor_id, $age_id, $spez_id, $level_id, $price, $lang_id, $subject_id, $pos)
	{
		$this->db->query('update repetitors set lang_id='.$lang_id.' where id='.$repetitor_id);
		$q = $this->db->query('select subject'.$pos.' from repetitors where id='.$repetitor_id);
		$res = $q->result_array();
		$s = $res[0]['subject'.$pos];
		if ($s > 0){
			$this->db->query('delete from rsa where subject_id='.$s.' and repetitor_id='.$repetitor_id);
			$this->db->query('delete from rsl where subject_id='.$s.' and repetitor_id='.$repetitor_id);
			$this->db->query('delete from rss where subject_id='.$s.' and repetitor_id='.$repetitor_id);
			$this->db->query('delete from rsp where subject_id='.$s.' and repetitor_id='.$repetitor_id);
		}
		$this->db->query('update repetitors set subject'.$pos.'='.$subject_id.' where id='.$repetitor_id);
		foreach ($age_id as $id) {
			$this->db->query('insert into rsa (subject_id, repetitor_id, age_id)
			 values ('.$subject_id.','.$repetitor_id.','.$id.')');
		}
		foreach ($level_id as $id) {
			$this->db->query('insert into rsl (subject_id, repetitor_id, level_id)
			 values ('.$subject_id.','.$repetitor_id.','.$id.')');
		}
		foreach ($spez_id as $id) {
			$this->db->query('insert into rss (subject_id, repetitor_id, specialization_id)
			 values ('.$subject_id.','.$repetitor_id.','.$id.')');
		}
		$this->db->query('insert into rsp (subject_id, repetitor_id, cost)
		 values ('.$subject_id.','.$repetitor_id.','.$price.')');
		 return 0;
	}

	public function loadSubject($repetitor_id, $pos)
	{
		$data = array();
		$q = $this->db->query('select subject'.$pos.' from repetitors where id='.$repetitor_id);
		$res = $q->result_array();
		if (count($res)==0){
			return false;
		}
		$s = $res[0]['subject'.$pos];
		if (!$s){
			return false;
		}
		$data['subject_id'] = $s;
		//ages
		$q = $this->db->query('select age_id from rsa where subject_id='.$s.' and repetitor_id='.$repetitor_id);
		$res = $q->result_array();
		$data['ages'] = array();
		$i = 0;
		foreach ($res as $r) {
			$data['ages'][$i] = $r['age_id'];
			$i++;
		}
		//levels
		$q = $this->db->query('select level_id from rsl where subject_id='.$s.' and repetitor_id='.$repetitor_id);
		$res = $q->result_array();
		$data['levels'] = array();
		$i = 0;
		foreach ($res as $r) {
			$data['levels'][$i] = $r['level_id'];
			$i++;
		}
		//spesializations
		$q = $this->db->query('select specialization_id from rss where subject_id='.$s.' and repetitor_id='.$repetitor_id);
		$res = $q->result_array();
		$data['spec'] = array();
		$i = 0;
		foreach ($res as $r) {
			$data['spec'][$i] = $r['specialization_id'];
			$i++;
		}
		//price
		$q = $this->db->query('select cost from rsp where subject_id='.$s.' and repetitor_id='.$repetitor_id);
		$res = $q->result_array();
		$data['price'] = $res[0]['cost'];
		//lang
		$q = $this->db->query('select lang_id from repetitors where id='.$repetitor_id);
		$res = $q->result_array();
		$data['lang_id'] = $res[0]['lang_id'];
		return $data;
	}

	public function getTimeTable($repetitor_id)
	{
		$q = $this->db->query('select z.zone_time from repetitors r, timezones z where r.tzone_id=z.id and r.id='.$repetitor_id);
		$r = $q->result_array();
		$z = $r[0]['zone_time'];
		$q = $this->db->query('select * from exercises where repetitor_id='.$repetitor_id);
		$table = $q->result_array();
		for ($i=0; $i < count($table); $i++) {
			if (!is_null($table[$i]['student_id'])){
				$q = $this->db->query('select first_name from students where id='.$table[$i]['student_id']);
				$r = $q->result_array();
				$table[$i]['student'] = $r[0]['first_name'];
			}
			$table[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($table[$i]['date_from'])+$z*60*60);
		}
		return $table;
	}

	public function saveTimeTable($table, $repetitor_id)
	{
		$q = $this->db->query('select z.zone_time from repetitors r, timezones z where r.tzone_id=z.id and r.id='.$repetitor_id);
		$r = $q->result_array();
		$z = $r[0]['zone_time'];
		foreach ($table as $tab) {
			if ($tab->id == 0){
				$tab->date_from = date('Y-m-d H:i:s', strtotime($tab->date_from)-$z*60*60);
				if ($tab->student_id >0){
					$ins = 'insert into exercises(repetitor_id, date_from, created_at, student_id, subject_id)
					values('.$repetitor_id.',"'.$tab->date_from.'","'.date('Y-m-d H:i:s',time()).'", '.$tab->student_id.', '.$tab->subject_id.')';
					$q = $this->db->query($ins);
				}else{
					$ins = 'insert into exercises(repetitor_id, date_from, created_at)
					values('.$repetitor_id.',"'.$tab->date_from.'","'.date('Y-m-d H:i:s',time()).'")';
					$q = $this->db->query($ins);
				}
			} elseif($tab->date_from==''){
				$q = $this->db->query('delete from exercises where id='.$tab->id);
			}
		}
		return 0;
	}

	public function getStudents()
	{
		$q = $this->db->query('select * from students');
		$students = $q->result_array();
		return $students;
	}

	public function getStudent($student_id)
	{
		$q = $this->db->query('select * from students where id='.$student_id);
		$r = $q->result_array();
		$student = $r[0];
		if ($student['tzone_id']>0){
			$q = $this->db->query('select zone_time from timezones where id='.$student['tzone_id']);
			$r = $q->result_array();
			$student['tzone'] = $r[0]['zone_time'];
		}
		return $student;
	}
}
