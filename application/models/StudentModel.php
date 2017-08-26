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
				'password'=>$pass
			);
			$this->db->insert('students', $ins);
			//sending e-mail
			$this->load->library('email');
			$this->email->from('test@dvn125.xyz', 'RealLanguage.Club');
			$this->email->to($email);
			$this->email->subject('Успешная регистрация на RealLanguage.Club');
			$mess = "Поздравляем!\r\n";
			$mess += "Вы успешно создали аккаунт на RealLanguage.Club(с активной ссылкой на сайт) и у Вас есть личный кабинет. \r\n";
			$mess += "Для входа используйте: \r\n";
			$mess += "Логин: ".$email."\r\n";
			$mess += "Пароль: ".$pass."\r\n";
			$mess += "Желаем Вам успехов в учебе! \r\n";
			$mess += "С уважением, \r\n \r\n";
			$mess += "команда RealLanguage.Club \r\n";
			$this->email->message($mess);
			$this->email->send();
			return '0';
		}
    }

	public function login($email, $pass)
	{
		$q = $this->db->query('select * from students where email="'.$email.'" and password="'.$pass.'"');
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('неправильный логин/пароль');
		} else{
			$this->session->set_userdata('student_id', $r[0]['id']);
			return '0';
		}
	}

	public function findOne($id){
		$q = $this->db->query('select * from students where id='.$id);
		$r = $q->result_array();
		if (count($r)==0){
			throw new Exception('нет такого id='.$id);
		}
		$this->student = $r[0];
		return $this;
	}

	public function update($arr){
		foreach ($arr as $k => $v) {
			$this->student[$k] = trim($v);
		}
		$this->db->where('id', $this->student['id']);
		$this->db->update('students', $this->student);
		return 0;
	}
}
