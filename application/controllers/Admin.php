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
	 }

	public function index()
	{
		$data = array();
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
	  try {
	  	$this->AdminModel->login($this->input->post('pass', TRUE));
		//echo $this->input->post('pass', TRUE);
	  } catch (Exception $e) {
		  exit($e->getMessage());
	  }
	  exit("0");
	}

	public function main()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
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
		$data = array();
		$this->load->view('admin/repetitors', $data);
	}

	public function students()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array();
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
}
