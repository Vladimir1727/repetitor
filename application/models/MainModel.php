<?php
class MainModel extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

    public function getAll($type)
    {
		$q = $this->db->query('select * from '.$type);
		return $q->result_array();
    }


}
