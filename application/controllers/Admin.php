<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		 $this->load->helper('url');
		 $this->load->model('AdminModel');
		 $this->load->model('MainModel');
	 }

	public function index()
	{
		$data = array('error'=>'');
		$this->load->view('admin/login', $data);
	}

	public function createDB()
	{
		echo $this->AdminModel->createDB();
	}

	public function createTable()
	{
		echo $this->AdminModel->createTable();
	}

	public function seed()
	{
		echo $this->AdminModel->seed();
	}

	public function logout()
	{
		$this->session->unset_userdata('admin');
		redirect('/');
	}

	public function trylogin()
	{
	$enter = 1;
	  try {
	  	$enter = $this->AdminModel->login($this->input->post('pass', TRUE));
	  } catch (Exception $e) {
		  $err=$e->getMessage();
		  $data = array('error'=>$err);
		  $this->load->view('admin/login', $data);
	  }
	  if ($enter == 0){
		  redirect('admin/repetitors');
	  }
	  //echo $this->AdminModel->login($this->input->post('pass', TRUE));
	}

	public function main()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$repetitors = $this->AdminModel->getAllRepetitors();
		$data = array(
			'repetitors' => $repetitors,
		);
		$this->load->view('admin/repetitors', $data);
	}

	public function payback()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
		$this->load->view('admin/payback', $data);
	}

	public function chathistory()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
		$this->load->view('admin/chathistory', $data);
	}

	public function lessonshistory()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
		$this->load->view('admin/lessonshistory', $data);
	}

	public function repetitors()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$repetitors = $this->AdminModel->getAllRepetitors();
		$data = array(
			'repetitors' => $repetitors,
		);
		$this->load->view('admin/repetitors', $data);
	}

	public function students()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$students = $this->AdminModel->getAllStudents();
		$data = array(
			'students' => $students,
		);
		$this->load->view('admin/students', $data);
	}

	public function freerequests()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
		$this->load->view('admin/freerequests', $data);
	}

	public function chat()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
		$this->load->view('admin/chat', $data);
	}

	public function changeRepetitor()
	{
		if (!is_null($this->input->post('view'))){
			redirect('main/rinfo/'.$this->input->post('id'));
		}
		if (!is_null($this->input->post('ok'))){
			$this->AdminModel->setRepetitorStatus($this->input->post('id'), 2);
			redirect('admin/repetitors');
		}
		if (!is_null($this->input->post('off'))){
			$this->AdminModel->setRepetitorStatus($this->input->post('id'), 1);
			redirect('admin/repetitors');
		}
		if (!is_null($this->input->post('del'))){
			$this->AdminModel->setRepetitorStatus($this->input->post('id'), 3);
			redirect('admin/repetitors');
		}
		if (!is_null($this->input->post('mess'))){
			redirect('admin/chat');
		}
	}

	public function changeStudent()
	{
		if (!is_null($this->input->post('mess'))){
			redirect('admin/chat');
		}
		if (!is_null($this->input->post('ok'))){
			$this->AdminModel->setStudentStatus($this->input->post('id'), 1);
			redirect('admin/students');
		}
		if (!is_null($this->input->post('off'))){
			$this->AdminModel->setStudentStatus($this->input->post('id'), 0);
			redirect('admin/students');
		}
		if (!is_null($this->input->post('del'))){
			$this->AdminModel->setStudentStatus($this->input->post('id'), 3);
			redirect('admin/students');
		}
	}
}
