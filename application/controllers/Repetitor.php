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
		 $this->load->library('session');
	 }

	public function index()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		} else{
			$repetitor = $this->RepetitorModel->findOne($this->session->repetitor_id);
			if ($repetitor->repetitor['status'] == 0){
				redirect('/repetitor/profile');
			} else{
				echo ' repetitor main page';
			}
		}
	}

	public function newrepetitor()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[4]');
		  if ($this->form_validation->run() == FALSE){
			  exit('некорректные данные');
		  } else {
			  try {
			  	$this->RepetitorModel->addNewRep($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
				$login = $this->RepetitorModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
				$this->session->set_userdata('repetitor_id', $login);
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
			  $this->session->set_userdata('repetitor_id', $login);
			  exit("0");
		  }
	}

	public function profile(){
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		} else{
			$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
			$data=array(
				'repetitor'=> $rep->repetitor,
				'subjects'=>$this->MainModel->getAll('subjects'),
				'ages'=>$this->MainModel->getAll('ages'),
				'specializations'=>$this->MainModel->getAll('specializations'),
				'languages'=>$this->MainModel->getAll('languages'),
				'levels'=>$this->MainModel->getAll('levels'),
				'tzones'=>$this->MainModel->getAll('timezones'),
				'uni_degrees'=>$this->MainModel->getAll('uni_degrees'),
			);
			$this->load->view('repetitor/profile', $data);
		}
	}

	public function update()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$arr = json_decode($this->input->post('data'), true);
		//var_dump($arr);
		echo $rep->update($arr);
	}
}
