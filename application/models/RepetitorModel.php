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
			$this->email->from('test@dvn125.xyz', 'Сайт репетитор');
			$this->email->to($email);
			$this->email->subject('Регистрация');
			$mess = "Вы зарегистроровались на сайте 'Репетиторы'\r\n";
			$mess += "Ваш e-mail: ".$email."\r\n";
			$mess += "Ваш пароль: ".$pass;
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
}
