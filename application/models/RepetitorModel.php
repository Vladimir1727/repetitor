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
				'password'=>$pass
			);
			$this->db->insert('repetitors', $rep);
			//sending e-mail
			$this->load->library('email');
			$this->email->from('test@dvn125.xyz', 'RealLanguage.Club');
			$this->email->to($email);
			$this->email->subject('Успешная регистрация на RealLanguage.Club');
			$mess = "Поздравляем!\r\n";
			$mess += "Вы успешно создали аккаунт на RealLanguage.Club(с активной ссылкой на сайт) и у Вас есть личный кабинет. \r\n";
			$mess += "Вам осталось всего несколько шагов: \r\n";
			$mess += " - Зайдите в личный кабинет;\r\n";
			$mess += " - Заполните все формы Профиля;\r\n";
			$mess += " - Отправьте запрос на активацию.\r\n";
			$mess += "Для входа используйте: \r\n";
			$mess += "Логин: ".$email."\r\n";
			$mess += "Пароль: ".$pass."\r\n";
			$mess += "Желаем Вам успехов! \r\n";
			$mess += "С уважением, \r\n \r\n";
			$mess += "команда RealLanguage.Club \r\n";
			$this->email->message($mess);
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
		$this->repetitor = $r[0];
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
			$this->repetitor[$k] = $v;
		}
		$this->db->where('id', $this->repetitor['id']);
		$this->db->update('repetitors', $this->repetitor);
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

}
