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
		$q = $this->db->query('select * from students where email="'.$email.'" and password="'.$pass.'"');
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
