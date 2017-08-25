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
}
