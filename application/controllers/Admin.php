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
		$start_id = $this->input->get('id');
		if (is_null($start_id)){
			$start_id = -1;
		}
		$role = $this->input->get('role');
		if (is_null($role)){
			if ($start_id==0){
				$role = 3;
			} else{
				$role = 2;
			}
		}
		$data = array(
			'start_id'=> $start_id,
			'role'=> $role,
		);
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

	public function sendChat()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$data = array(
				'created_at' => date('Y-m-d H:i:s', time()),
				'from_role' => 3,
				'from_id' => 0,
				'to_role' => $this->input->post('to_role'),
				'to_id' => $this->input->post('to_id'),
				'message' => $this->input->post('message'),
			);
			echo $this->MainModel->sendChat($data);
		}
	}

	public function getChat()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			//$zone= $this->RepetitorModel->getRepZone($this->session->repetitor_id);
			$zone = 0;
			$data = array(
				'from_role' => 3,
				'from_id' => 0,
				'to_role' => $this->input->post('to_role'),
				'to_id' => $this->input->post('to_id'),
				'read_at' => date('Y-m-d H:i:s', time()),
			);
			$chat = $this->MainModel->getChat($data);
			for($i=0;$i<count($chat['chat']);$i++){
				$chat['chat'][$i]['created_at'] = date('Y-m-d H:i:s', strtotime($chat['chat'][$i]['created_at']) + $zone);
			}
			echo json_encode($chat);
		}
	}

	public function getChatList()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$list = $this->MainModel->getChatList(3, 0);
			echo json_encode($list);
		}
	}

	public function getOneChatUser()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$list = $this->MainModel->getOneChatUser(3, 0, $this->input->post('role'), $this->input->post('id'));
			echo json_encode($list);
		}
	}

	public function getUsers()
	{
		$users = $this->AdminModel->getUsers();
		echo json_encode($users);
	}

}
