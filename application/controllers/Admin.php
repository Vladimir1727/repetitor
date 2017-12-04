<?php defined('BASEPATH') OR exit('No direct script access allowed');
//use PaypalIPN;

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
		$data = array(
			'error'=>'',
			'new'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/login', $data);
	}

	public function createDB()
	{
		//echo $this->AdminModel->createDB();
	}

	public function createTable()
	{
		echo $this->AdminModel->createTable();
	}

	public function seed()
	{
		//echo $this->AdminModel->seed();
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
			'new_chat'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/repetitors', $data);
	}

	public function payback()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array(
			'requests'=> $this->AdminModel->getSalaryRequests(),
			'new_chat'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/payback', $data);
	}

	public function chathistory()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array(
			'chats'=>$this->AdminModel->chathistory(),
			'new_chat'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/chathistory', $data);
	}

	public function lessonshistory()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array(
			'lessons' => $this->AdminModel->history(),
			'new_chat'=>$this->AdminModel->newChats(),
		);
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
			'new_chat'=>$this->AdminModel->newChats(),
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
			'new_chat'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/students', $data);
	}

	public function freerequests()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('/');
		}
		$data = array(
			'requests'=>$this->AdminModel->getNewFreeRequests(),
			'accepted'=>$this->AdminModel->getAcceptedFreeRequests(),
			'new_chat'=>$this->AdminModel->newChats(),
		);
		$this->load->view('admin/freerequests', $data);
		//echo '<pre>';
		//var_dump($data);
		//echo '</pre>';
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
			'new_chat'=>$this->AdminModel->newChats(),
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
		if (!is_null($this->input->post('back'))){
			$this->AdminModel->setRepetitorStatus($this->input->post('id'), 0);
			redirect('admin/repetitors');
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
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$users = $this->AdminModel->getUsers();
			echo json_encode($users);
		}
	}

	public function delFree()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$id = $this->input->post('id');
			$this->AdminModel->delFree($id);
			redirect('admin/freerequests');
		}
	}

	public function acceptFree()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$id = $this->input->post('id');
			$this->AdminModel->acceptFree($id);
			redirect('admin/freerequests');
		}
	}

	public function editFree()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$id = $this->input->post('id');
			$about = $this->input->post('about');
			$about_time = $this->input->post('about_time');
			$this->AdminModel->editFree($id, $about, $about_time);
			redirect('admin/freerequests');
		}
	}

	public function getFreeRepetitors()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$free_id = $this->input->post('free_id');
			$data = $this->AdminModel->getFreeRepetitors($free_id);
			echo json_encode($data);
		}
	}

	public function delSalary()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$this->AdminModel->delSalary($this->input->post('id'));
			redirect('admin/payback');
		}
	}

	public function acceptSalary()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$this->AdminModel->acceptSalary($this->input->post('id'));
			redirect('admin/payback');
		}
	}

	public function delChat()
	{
		if (!$this->session->has_userdata('admin')){
			 exit('Админ не вошёл');
		} else{
			$this->AdminModel->delChat($this->input->post('id'));
			redirect('admin/chathistory');
		}
	}

	public function feeds()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$data = array(
				'feeds' => $this->AdminModel-> getFeeds(),
				'new_chat'=>$this->AdminModel->newChats(),
			);
			$this->load->view('admin/feeds', $data);
			//var_dump($data['feeds']);
		}
	}

	public function clearFeed()
	{
		$this->AdminModel->clearFeed($this->input->post('id'));
		redirect('admin/feeds');
	}

	public function prerep($value='')
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$data = array(
				'repetitors' => $this->AdminModel->getPreRepetitors(),
				'new_chat'=>$this->AdminModel->newChats(),
			);
			$this->load->view('admin/prerep', $data);
			//var_dump($data['repetitors']);
		}
	}

	public function requests()
	{
		if (!$this->session->has_userdata('admin')){
			 redirect('main');
		} else{
			$data = array(
				'requests' => $this->AdminModel->getRequests(),
				'new_chat'=>$this->AdminModel->newChats(),
			);
			$this->load->view('admin/requests', $data);
			// echo '<pre>';
			// var_dump($data['requests'][0]);
			// echo '</pre>';
		}
	}
}
