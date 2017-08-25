<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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
		 $this->load->model('StudentModel');
		 $this->load->model('MainModel');
	 }

	public function newStudent()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Password', 'required|min_length[4]');
		  if ($this->form_validation->run() == FALSE){
			  exit('некорректные данные');
		  } else {
			  try {
			  	$this->StudentModel->addNew($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
				$login = $this->StudentModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
			  } catch (Exception $e) {
				  exit($e->getMessage());
			  }
			  $this->session->set_userdata('student_id', $login);
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
			  	$this->StudentModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
			  } catch (Exception $e) {
				  exit($e->getMessage());
			  }
			  exit("0");
		  }
	}

	public function index()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$student = $this->StudentModel->findOne($this->session->student_id);
			if ($student->student['status'] == 0){
				redirect('/student/profile');
			} else{
				echo ' student main page';
			}
		}
	}

	public function profile(){
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'tzones'=>$this->MainModel->getAll('timezones'),
			);
			$this->load->view('student/profile', $data);
		}
	}

}
