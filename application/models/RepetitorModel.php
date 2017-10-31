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
				'status'=>0,
				'activity'=>1,
			);
			$this->db->insert('repetitors', $rep);
			//sending e-mail
			$this->load->library('email');
			$this->email->from('info@reallanguage.club', 'RealLanguage.Club');
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
		} elseif ($r[0]['status'] == 3) {
			throw new Exception('профиль удалён');
		}
		else{
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
		if ( (time() < (strtotime($rep['visit_at'])+60*5)) && ($rep['activity'] >0)){
			$rep['online'] = true;
		} else{
			$rep['online'] = false;
		}
		$sel = 'select count(id) as c from chats where to_role=1 and to_id='.$id.' and read_at is null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)>0){
			$rep['new'] = $r[0]['c'];
		} else{
			$rep['new'] = 0;
		}
		$rep['tzone'] = $this->getRepZone($id);
		if (!is_null($rep['avatar'])){
			$filename = 'images/'.$rep['avatar'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('avatar' => NULL));
				$rep['avatar'] = NULL;
			}
		}
		if (!is_null($rep['doc1'])){
			$filename = 'images/'.$rep['doc1'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('doc1' => NULL));
				$rep['doc1'] = NULL;
			}
		}
		if (!is_null($rep['doc2'])){
			$filename = 'images/'.$rep['doc2'];
			if (file_exists($filename)==false){
				$this->db->where('id', $rep['id']);
				$this->db->update('repetitors', array('doc2' => NULL));
				$rep['doc2'] = NULL;
			}
		}
		$this->repetitor = $rep;
		return $this;
	}

	public function getRepZone($repetitor_id)
	{
		$sel = 'select t.zone_time from timezones t, repetitors r where t.id=r.tzone_id and r.id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			return 0;
		} else{
			return $r[0]['zone_time'];
		}
	}

	public function save()
	{
		$this->db->where('id', $this->repetitor['id']);
		$this->db->update('repetitors', $this->repetitor);
		return 0;
	}

	public function update($arr){
		/*$q = $this->db->query('SHOW COLUMNS FROM repetitors');
		$r = $q->result_array();
		$fields =array();
		foreach ($r as $val) {
			$fields[] = $val['Field'];
		}
		return $fields;*/
		foreach ($arr as $k => $v) {
			$arr[$k] = trim($v);
		}
		$this->db->where('id', $this->repetitor['id']);
		try {
			$this->db->update('repetitors', $arr);
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return 0;
	}

	public function saveSubject($repetitor_id, $age_id, $spez_id, $level_id, $price, $lang_id, $subject_id, $pos)
	{
		$q = $this->db->query('select subject1, subject2 from repetitors where id='.$repetitor_id);
		$r = $q->result_array();
		$sub1 = $r[0]['subject1'];
		$sub2 = $r[0]['subject2'];
		// if (is_null($sub1) && $pos = 2){
		// 	throw new Exception('Сначала необходимо выбрать предмет №1');
		// }
		if (!is_null($sub1) && $sub1 == $subject_id && $pos == 2){
			throw new Exception('Этот предмет уже был выбран как предмет №1');
		}
		if (!is_null($sub2) && $sub2 == $subject_id && $pos == 1){
			throw new Exception('Этот предмет уже был выбран как предмет №2');
		}
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
		if (count($res)==0){
			$data['price'] = 0;
		} else{
			$data['price'] = $res[0]['cost'];
		}
		//lang
		$q = $this->db->query('select lang_id from repetitors where id='.$repetitor_id);
		$res = $q->result_array();
		$data['lang_id'] = $res[0]['lang_id'];
		return $data;
	}

	public function getTimeTable($repetitor_id)
	{
		$szone = date('H',time())-gmdate('H', time());
		//log_message('error','SERVER ZONE='.$szone);
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
			$table[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($table[$i]['date_from'])+($z)*60*60);
		}
		return $table;
	}

	public function saveFreeTable($table, $repetitor_id)
	{
		$z= $this->getRepZone($repetitor_id);
		foreach ($table as $tab) {
			if ($tab->id == 0){
				$tab->date_from = date('Y-m-d H:i:s', strtotime($tab->date_from)-$z*60*60);
				$del = 'delete from exercises where repetitor_id='.$tab->repetitor_id.' and date_from="'.$tab->date_from.'"';
				$q = $this->db->query($del);
				$ins = 'insert into exercises(repetitor_id, date_from, created_at)
				values('.$repetitor_id.',"'.$tab->date_from.'","'.date('Y-m-d H:i:s',time()).'")';
				$q = $this->db->query($ins);
			} elseif($tab->date_from==''){
				$q = $this->db->query('delete from exercises where id='.$tab->id);
			}
		}
		return 0;
	}

	public function saveTimeTable($table, $repetitor_id, $subject_id=0)
	{
		$z= $this->getRepZone($repetitor_id);
		$sel = 'select cost from rsp where subject_id='.$subject_id.' and repetitor_id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$cost = $r[0]['cost'];
		foreach ($table as $tab) {
			if ($tab->id == 0){
				$tab->date_from = date('Y-m-d H:i:s', strtotime($tab->date_from)-$z*60*60);
				if ($tab->student_id >0){
					$del = 'delete from exercises where repetitor_id='.$tab->repetitor_id.' and student_id='.$tab->student_id.' and date_from="'.$tab->date_from.'"';
					$q = $this->db->query($del);
					$ins = 'insert into exercises(repetitor_id, date_from, created_at, student_id, subject_id, cost)
					values('.$repetitor_id.',"'.$tab->date_from.'","'.date('Y-m-d H:i:s',time()).'", '.$tab->student_id.', '.$tab->subject_id.', '.$cost.')';
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

	public function setRepetitorStatus($repetitor_id, $status)
	{
		$sel = 'update repetitors set activity='.$status.' where id='.$repetitor_id;
		$q = $this->db->query($sel);
		return $sel;
	}

	public function visit($repetitor_id)
	{
		$this->db->where('id', $repetitor_id);
		$this->db->update('repetitors', array('visit_at'=>date('Y-m-d H:i:s',time())));
	}

	public function newChats($repetitor_id)
	{
		$sel = 'select count(id) as c from chats where to_role=1 and to_id='.$repetitor_id.' and read_at is null';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		return $r[0]['c'];
	}

	public function lessonsrequests($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$ndate = date('Y-m-d H:i:s', time() - ($zone+1)*60*60);
		$sel = 'select * from exercises where deleted_at is null and date_from>"'.$ndate.'" and date_accept is null and cost>0 and cancel_at is null and repetitor_id='.$repetitor_id.' and student_id is not null order by created_at';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$lessons = array();
		$i = -1;
		$cr = '';
		$szone = date('H',time())-gmdate('H', time());
		foreach ($row as $r) {
			$i++;
			$lessons[$i] = $r;
			$lessons[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['created_at']) + ($zone -$szone)*60*60);
			$lessons[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['date_from']) + ($zone)*60*60);
		}
		for ($i=0; $i < count($lessons); $i++) {
			$sel = 'select s.first_name, s.father_name, sub.subject, (select specialization from specializations where id=ex.specialization_id) as specialization from exercises ex, students s, subjects sub, specializations spe where ex.student_id=s.id and ex.subject_id=sub.id and ex.id='.$lessons[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$lessons[$i]['student'] = $r[0]['first_name'];
			if (!is_null($r[0]['father_name'])){
				$lessons[$i]['student'] .= ' '.$r[0]['father_name'];
			}
			$lessons[$i]['subject'] = $r[0]['subject'];
			$lessons[$i]['specialization'] = $r[0]['specialization'];
			$lessons[$i]['sel']=$sel;
		}
		return $lessons;
	}

	public function lessons($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$date = date('Y-m-d H:i:s', time()-($zone+1)*60*60);
		$sel = 'select * from exercises where deleted_at is null and date_accept is not null and date_from>"'.$date.'" and cost>0 and cancel_at is null and repetitor_id='.$repetitor_id.' and student_id is not null order by created_at';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$lessons = array();
		$i = -1;
		$cr = '';
		$szone= date('H', time()) - gmdate('H', time());
		foreach ($row as $r) {
			$i++;
			$lessons[$i] = $r;
			/////
			$s_date = date('Y-m-d H:i:s', strtotime($lessons[$i]['date_from']) + $szone*60*60);
			$actual = (time() - strtotime($s_date))/60/60;
			////
			//$actual = (time() - strtotime($lessons[$i]['date_from'])+ $szone*60*60)/60;
			$lessons[$i]['actual'] = $actual*60;
			$lessons[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['date_from']) + $zone*60*60);
			if ($actual > -15 && $actual < 60 && !is_null($r['pay_at'])){
				$lessons[$i]['active'] = true;
			} else{
				$lessons[$i]['active'] = false;
			}
			if ($actual <= -30){
				$lessons[$i]['calcel'] = true;
			} else{
				$lessons[$i]['calcel'] = false;
			}
			$lessons[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['created_at']) + $zone*60*60);
		}
		for ($i=0; $i < count($lessons); $i++) {
			$sel = 'select s.first_name, s.father_name, sub.subject, s.skype, (select specialization from specializations where id=ex.specialization_id) as specialization from exercises ex, students s, subjects sub, specializations spe where ex.student_id=s.id and ex.subject_id=sub.id and ex.id='.$lessons[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$lessons[$i]['student'] = $r[0]['first_name'];
			$lessons[$i]['skype'] = $r[0]['skype'];
			if (!is_null($r[0]['father_name'])){
				$lessons[$i]['student'] .= ' '.$r[0]['father_name'];
			}
			$lessons[$i]['subject'] = $r[0]['subject'];
			$lessons[$i]['specialization'] = $r[0]['specialization'];
			$lessons[$i]['sel']=$sel;
		}
		return $lessons;
	}

	public function cancelLesson($lesson_id)
	{
		$sel = 'update exercises set cancel_at="'.date('Y-m-d H:i:s', time()).'" where id='.$lesson_id;
		$q = $this->db->query($sel);
		return 0;
	}

	public function cancelLesson2($lesson_id)
	{
		$sel = 'select date_from, cost, student_id, repetitor_id from exercises where id='.$lesson_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$actual = (time() - strtotime($r[0]['date_from']))/60;
		$cost = (is_null($r[0]['cost'])) ? 0 : $r[0]['cost'];
		$student_id = $r[0]['student_id'];
		$repetitor_id = $r[0]['repetitor_id'];
		if ($actual < -15){
			$sel = 'update exercises set date_accept=NULL, deleted_at=NULL, pay_at=NULL, cancel_at=NULL, cost=0, student_id=NULL, subject_id=NULL, specialization_id=NULL, about=NULL, deleted=0 where id='.$lesson_id;
			$q = $this->db->query($sel);
			$sel = 'select balance from students where id='.$student_id;
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$student_balance = $r[0]['balance'] + round($cost*1.3);
			$sel = 'update students set balance='.$student_balance.' where id='.$student_id;
			$q = $this->db->query($sel);
			$sel = 'select balance from repetitors where id='.$repetitor_id;
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitor_balance = $r[0]['balance'] - $cost;
			$sel = 'update repetitors set balance='.$repetitor_balance.' where id='.$repetitor_id;
			$q = $this->db->query($sel);
			//$this->addTotalBalance(-round($cost*1.3));
		}
		return 0;
	}

	public function acceptLesson($lesson_id)
	{
		$sel = 'update exercises set date_accept="'.date('Y-m-d H:i:s', time()).'" where id='.$lesson_id;
		$q = $this->db->query($sel);
		$sel = 'select student_id, repetitor_id from exercises where id='.$lesson_id;
		$q = $this->db->query($sel);
		$r = $r = $q->result_array();
		$student_id = $r[0]['student_id'];
		$repetitor_id = $r[0]['repetitor_id'];
		$sel = 'select balance from students where id='.$student_id;
		//log_message('debug', $sel);
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$student_balance = $r[0]['balance'];
		$sel = 'select cost from exercises where id='.$lesson_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$cost = $r[0]['cost'];
		if ($student_balance >= $cost*1.3){
			$sel = 'update exercises set pay_at="'.date('Y-m-d H:i:s', time()).'" where id='.$lesson_id;
			$q = $this->db->query($sel);
			$sel = 'update students set balance='.round($student_balance-$cost*1.3).' where id='.$student_id;
			$q = $this->db->query($sel);
			$sel = 'select balance from repetitors where id='.$repetitor_id;
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$repetitor_balance = round($r[0]['balance'] + $cost);
			$sel = 'update repetitors set balance='.$repetitor_balance.' where id='.$repetitor_id;
			//log_message('error', $sel);
			$q = $this->db->query($sel);
			$sel = 'insert into rep_pays(created_at,student_id,lessons,cost, repetitor_id) values("'.date('Y-m-d H:i:s', time()).'",'.$student_id.',1,'.$cost.','.$repetitor_id.')';
			$q = $this->db->query($sel);
		}
		return 0;
	}

	public function startLesson_old($lesson_id)
	{
		$sel = 'select date_from, student_id, repetitor_id, cost from exercises where id='.$lesson_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$actual = (time() - strtotime($r[0]['date_from']))/60;
		$cost = $r[0]['cost'];
		$student_id = $r[0]['student_id'];
		$repetitor_id = $r[0]['repetitor_id'];
		if ($actual > -15 && $actual < 60){
			$sel = 'update exercises set rstart_at="'.date('Y-m-d H:i:s', time()).'" where id='.$lesson_id;
			$q = $this->db->query($sel);
			$this->addTotalBalance($cost*0.3);
		}
		return 0;
	}

	public function startLesson($lesson_id)
	{
		$sel = 'select date_from, student_id, repetitor_id, pay_at, rstart_at, cost from exercises where id='.$lesson_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r) == 0){
			return 'Урок не найден.';
		}
		if (is_null($r[0]['pay_at'])){
			return 'Урок не оплачен. Свяжитесь с учеником через чат.';
		}
		if (!is_null($r[0]['rstart_at'])){
			return 0;
		}
		$szone= date('H', time()) - gmdate('H', time());
		$s_date = date('Y-m-d H:i:s', strtotime($r[0]['date_from']) + $szone*60*60);
		$actual = (time() - strtotime($s_date))/60/60;
		if ($actual > -15 && $actual < 60){
			$cost = $r[0]['cost'];
			$sel = 'update exercises set rstart_at="'.date('Y-m-d H:i:s', time()).'" where id='.$lesson_id;
			$q = $this->db->query($sel);
			$this->addTotalBalance($cost*0.3);
			return 0;
		} else{
			return 'Урок можно начать за 15 минут до начала и в течение времени урока '.$s_date;
		}
	}

	public function history($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$date = date('Y-m-d H:i:s', time()+60*60);
		$sel = 'select * from exercises where  date_from<"'.$date.'" and repetitor_id='.$repetitor_id.' and student_id is not null order by created_at';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$lessons = array();
		$i = -1;
		$cr = '';
		foreach ($row as $r) {
			$i++;
			$lessons[$i] = $r;
			$lessons[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['created_at']) + $zone*60*60);
			$lessons[$i]['date_from'] = date('Y-m-d H:i:s', strtotime($lessons[$i]['date_from']) + $zone*60*60);
		}
		for ($i=0; $i < count($lessons); $i++) {
			$sel = 'select s.first_name, s.father_name, sub.subject, s.skype, (select specialization from specializations where id=ex.specialization_id) as specialization from exercises ex, students s, subjects sub, specializations spe where ex.student_id=s.id and ex.subject_id=sub.id and ex.id='.$lessons[$i]['id'];
			$q = $this->db->query($sel);
			$r = $q->result_array();
			$lessons[$i]['student'] = $r[0]['first_name'];
			if (!is_null($r[0]['father_name'])){
				$lessons[$i]['student'] .= ' '.$r[0]['father_name'];
			}
			$lessons[$i]['subject'] = $r[0]['subject'];
			$lessons[$i]['specialization'] = $r[0]['specialization'];
		}
		return $lessons;
	}

	public function getTotalBalance()
	{
		$sel = 'select balance from balance limit 1';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		return $r[0]['balance'];
	}

	public function addTotalBalance($sum)
	{
		$sel = 'select id,balance from balance limit 1';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$balance = $r[0]['balance'] + $sum;
		$id = $r[0]['id'];
		$this->db->where('id', $id);
		$this->db->update('balance', array('balance'=>$balance));
		return 0;
	}

	public function getStudentPays_old($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$sel = 'select *,(select first_name from students where id=rp.student_id) as student_name from rep_pays as rp where rp.repetitor_id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		for($i = 0; $i < count($r); $i++){
			$r[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($r[$i]['created_at'])+$zone*60*60);
		}
		return $r;
	}

	public function getStudentPays($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$sel = 'select rp.created_at, r.first_name as rname, r.father_name as rfname, rp.cost, s.first_name as sname, s.father_name as sfname, s.id as sid, r.id as rid from repetitors r, rep_pays rp, students s where rp.repetitor_id = r.id and rp.repetitor_id ='.$repetitor_id.' and rp.student_id=s.id order by rp.created_at DESC';
		$q = $this->db->query($sel);
		$row = $q->result_array();
		$data = array();
		$cr = '';
		$i = -1;
		foreach ($row as $r) {
				$i++;
				$data[$i] = array();
				$data[$i]['pay_at'] = date('Y-m-d H:i:s', strtotime($r['created_at']) + $zone*60*60);
				$data[$i]['count'] = 1;
				$data[$i]['sum'] = $r['cost'];
				$data[$i]['repetitor'] = '';
				if (!is_null($r['rname'])){
					$data[$i]['repetitor'] .= $r['rname'];
				} else{
					$data[$i]['repetitor'] .= 'Без имени';
				}
				if (!is_null($r['rname'])){
					$data[$i]['repetitor'] .= ' '.$r['rfname'];
				}
				$data[$i]['student'] = '';
				if (!is_null($r['sname'])){
					$data[$i]['student'] .= $r['sname'];
				}  else{
					$data[$i]['student'] .= 'Без имени';
				}
				if (!is_null($r['sfname'])){
					$data[$i]['student'] .= ' '.$r['sfname'];
				}
				$data[$i]['student_id'] = $r['sid'];
				$data[$i]['repetitor_id'] = $r['rid'];
		}
		return $data;
	}

	public function getNewFreeRequests($repetitor_id, $subject_id = 0)
	{
		if ($subject_id>0){
			$sub = ' and f.subject_id='.$subject_id;
		} else{
			$sub = '';
		}
		$zone = $this->getRepZone($repetitor_id);
		$sel = 'select *, (select first_name from students where id=f.student_id) as student_name, (select subject from subjects where id=f.subject_id) as subject, (select count(id) from free_rs where free_id=f.id) as req from free_apps as f where not f.id in (select free_id from free_rs where repetitor_id='.$repetitor_id.') and admin=1  and deleted_at is null'.$sub;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		for ($i=0; $i < count($r); $i++) {
			$r[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($r[$i]['created_at']) + $zone * 60 * 60);
			if (is_null($r[$i]['student_name'])){
				$r[$i]['student_name'] = 'Без имени';
			}
		}
		return $r;
	}

	public function getAcceptedFreeRequests($repetitor_id, $subject_id = 0)
	{
		if ($subject_id>0){
			$sub = ' and f.subject_id='.$subject_id;
		} else{
			$sub = '';
		}
		$zone = $this->getRepZone($repetitor_id);
		$sel = 'select * , (select first_name from students where id=f.student_id) as student_name, (select subject from subjects where id=f.subject_id) as subject, (select count(id) from free_rs where free_id=f.id) as req from free_apps as f where f.id in (select free_id from free_rs where repetitor_id='.$repetitor_id.' and accepted=1) and admin=1 and deleted_at is null'.$sub;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		for ($i=0; $i < count($r); $i++) {
			$r[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($r[$i]['created_at'])+$zone*60*60);
		}
		return $r;
	}

	public function delFree($id, $repetitor_id)
	{
		$sel = 'select id from free_rs where free_id='.$id.' and repetitor_id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		if (count($r)==0){
			$ins = array(
				'created_at' => date('Y-m-d H:i:s', time()),
				'repetitor_id' => $repetitor_id,
				'free_id'=> $id,
				'accepted'=>0
			);
			$this->db->insert('free_rs',$ins);
		} else{
			$up = array('accepted'=>0);
			$this->db->where('id', $r[0]['id']);
			$this->db->update('free_rs',$up);
		}
		return 0;
	}

	public function acceptFree($id, $repetitor_id)
	{
		$ins = array(
			'created_at' => date('Y-m-d H:i:s', time()),
			'repetitor_id' => $repetitor_id,
			'free_id'=> $id,
			'accepted'=>1
		);
		$this->db->insert('free_rs',$ins);
		return 0;
	}

	public function sendMoneyRequest($ins)
	{
		$this->db->insert('salaries', $ins);
		return 0;
	}

	public function getSalaries($repetitor_id)
	{
		$zone = $this->getRepZone($repetitor_id);
		$sel = 'select * from salaries where repetitor_id='.$repetitor_id;
		$q = $this->db->query($sel);
		$r = $q->result_array();
		for ($i=0; $i < count($r); $i++) {
			$r[$i]['created_at'] = date('Y-m-d H:i:s', strtotime($r[$i]['created_at'])+$zone*60*60);
		}
		return $r;
	}

	public function forgot($email)
	{
		$q = $this->db->query('select password from repetitors where email="'.$email.'"');
		$r = $q ->result_array();
		if (count($r)==0){
			return 'Репетитора с таким e-mail нет в базе';
		} else{
			$pass = $r[0]['password'];
			$this->load->library('email');
			$this->email->from('info@reallanguage.club', 'RealLanguage.Club');
			$this->email->to($email);
			$this->email->subject('Восстановление пароля');
			$mess = "Для входа используйте: <br>";
			$mess .= "Логин: ".$email."<br>";
			$mess .= "Пароль: ".$pass."<br><br>";
			$mess .= "Желаем Вам успехов! <br><br>";
			$mess .= "С уважением, <br><br>";
			$mess .= "команда RealLanguage.Club <br>";
			$this->email->message($mess)->set_mailtype('html');
			$this->email->send();
			return 0;
		}
	}

	public function deleteRepetitor($id)
	{
		$this->db->where('id', $id);
		$this->db->update('repetitors', array('status'=>3));
		return 0;
	}
}
