<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repetitor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct(){
		 parent::__construct();
		 $this->load->helper(array('form', 'url'));
		 $this->load->model('RepetitorModel');
		 $this->load->model('MainModel');
	 }

	public function newRepetitor()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[4]');
		  if ($this->form_validation->run() == FALSE){
			  exit('некорректные данные');
		  } else {
			  try {
			  	$this->RepetitorModel->addNewRep($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
			  } catch (Exception $e) {
				  exit($e->getMessage());
			  }
			  exit("0");
		  }
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[4]');
		  if ($this->form_validation->run() == FALSE){
			  exit('некорректные данные');
		  } else {
			  try {
			  	$login = $this->RepetitorModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
			  } catch (Exception $e) {
				  exit($e->getMessage());
			  }
			  exit("0");
		  }
	}

	public function profile(){
		$this->session->set_userdata('repetitor_id', 1);//будет задаваться при авторизации / регистрации //позже удалить
		$data=array(
			'subjects'=>$this->MainModel->getAll('subjects'),
			'ages'=>$this->MainModel->getAll('ages'),
			'specializations'=>$this->MainModel->getAll('specializations'),
			'languages'=>$this->MainModel->getAll('languages'),
			'levels'=>$this->MainModel->getAll('levels'),
			'tzones'=>$this->MainModel->getAll('timezones'),
			'uni_degrees'=>$this->MainModel->getAll('uni_degrees'),
		);
		//echo 'rep profile';
		$this->load->view('repetitor/profile', $data);
	}

}
