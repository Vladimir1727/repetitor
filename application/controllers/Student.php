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
		 $this->load->library('image_lib');
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
				/////
				$mess = 'Приветствуем Вас на платформе «Репетиторы» Real Language Club!
У нас есть отличная новость! Открытие платформы для учеников состоится 3 октября. Уже очень скоро Вы сможете выбрать для себя лучшего репетитора и заниматься с ним онлайн в удобное для Вас время.
Будем рады видеть Вас среди наших учеников!
Добро пожаловать к нам с 3 октября!';
				$dat = array(
					'created_at' => date('Y-m-d H:i:s', time()),
					'from_role' => 3,
					'from_id' => 0,
					'to_role' => 2,
					'to_id' => $this->session->student_id,
					'message' =>$mess,
				);
				$this->MainModel->sendChat($dat);
				////
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
			$this->StudentModel->visit($this->session->student_id);
			$this->load->helper('cookie');
			$link = get_cookie('link');
			if (is_null($link)){
				$student = $this->StudentModel->findOne($this->session->student_id);
				if ($student->student['status'] == 0){
					redirect('/student/profile');
				} else{
					redirect('/student/lessonsrequest');
				}
			} else{
				redirect($link);
			}
		}
	}

	public function profile(){
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'tzones'=>$this->MainModel->getAll('timezones'),
			);
			$this->load->view('student/profile', $data);
		}
	}

	public function update()
	{
		if (!$this->session->has_userdata('student_id')){
			 throw new Exception('студент не вошёл');
		}
		$this->StudentModel->visit($this->session->student_id);
		$rep = $this->StudentModel->findOne($this->session->student_id);
		$arr = json_decode($this->input->post('data'), true);
		echo $rep->update($arr);
	}

	function addavatar()
	{
		$id = $this->session->student_id;
		$this->StudentModel->visit($this->session->student_id);
		if ($handle = opendir('images')) {
		    while (false !== ($file = readdir($handle))) {
				$s = strpos($file, 'avatar_s'.$id.'_');
				if ($s !== false){
					unlink('images/'.$file);
				}
		    }
		    closedir($handle);
		}
		$config['upload_path']          = './images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 6000;
		$config['max_width']            = 6024;
		$config['min_width']            = 200;
		$config['min_height']            = 200;
		$config['max_height']           = 6024;
		$config['file_name']             = 'avatar_s'.$id.'_';
		$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload(0))
			{
				throw new Exception($this->upload->display_errors());
			}
			else
			{
				$img = $this->upload->data();
				$data =  $this->upload->data();
				$f = $data['raw_name'].'_thumb'.$data['file_ext'];
				$path = 'images/'.$img["file_name"];
				$image = $data['raw_name'].$data['file_ext'];
				$size = getimagesize('images/'.$image);
				$w = $size[0];
				$h = $size[1];
				$path = 'images/'.$image;
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['y_axis'] = 0;
				$config['x_axis'] = 0;
				if ($h > $w){
				    $config['width']         = 200;
				    $config['master_dim']         = 'width';
				} else{
				    $config['height']         = 200;
				    $config['master_dim']         = 'height';
				}
				if (!$this->image_lib->initialize($config)){
				    exit($this->image_lib->display_errors());
				}
				$this->image_lib->resize();
				if (!$this->image_lib->resize()){
				    exit($this->image_lib->display_errors());
				}
				//crop
				$image = $f;
				$size = getimagesize('images/'.$image);
				$w = $size[0];
				$h = $size[1];
				$path = 'images/'.$image;
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path;
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				if ($w> $h){
				    $config['x_axis'] = ($w-200)/2;
				    $config['y_axis'] = 0;
				} else{
				    $config['x_axis'] = 0;
				    $config['y_axis'] = ($h-200)/2;
				}
				$config['width']         = 200;
				$config['height']         = 200;
				$this->image_lib->initialize($config);
				if (!$this->image_lib->crop()){
				    exit($this->image_lib->display_errors());
				}
				$student = $this->StudentModel->findOne($id);
				$arr = array('avatar'=>$data['raw_name'].$data['file_ext']);
				$student->update($arr);
				exit($f);
			}
	}

	public function balance()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student' => $student->student,
				'lessons' => $this->StudentModel->payedlessons($this->session->student_id),
				'pays' => $this->StudentModel->getpays($this->session->student_id),
			);
			$this->load->view('student/balance', $data);
			//var_dump($data['pays']);

		}
	}

	public function lessonsrequest()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$lessons = $this->StudentModel->lessonsRequests($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'tzones'=> $this->MainModel->getAll('timezones'),
				'lessons'=> $lessons,
			);
			$this->load->view('student/lessonsrequests', $data);
		}
	}

	public function favorites()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$repetitors = $this->StudentModel->getfavorites($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'repetitors' => $repetitors,
			);
			$this->load->view('student/favorites', $data);
		}
	}

	public function history()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/history', $data);
		}
	}

	public function lessons()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'lessons'=> $this->StudentModel->lessons($this->session->student_id),
			);
			$this->load->view('student/lessons', $data);
		}
	}

	public function freerequests()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'subjects'=>$this->MainModel->getAll('subjects'),
			);
			$this->load->view('student/freerequests', $data);
		}
	}

	public function pay()
	{
		if (!$this->session->has_userdata('student_id')){
			redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/pay', $data);
		}
	}

	public function makePay()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$this->StudentModel->addBallance($this->session->student_id, $this->input->post('sum'));
			$this->StudentModel->addPayHistory($this->session->student_id, $this->input->post('sum'), $this->input->post('pay_type'));
			redirect($this->input->post('go_to'));
		}
	}

	public function logout()
	{

		if ($this->session->has_userdata('student_id')){
			$this->StudentModel->setStudentStatus($this->session->student_id, 0);
			$this->session->unset_userdata('student_id');
		}
		redirect('/');
	}

	public function chat()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
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
				$role = 1;
			}
		}
		$this->StudentModel->visit($this->session->student_id);
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,
			'start_id'=> $start_id,
			'role'=> $role,
		);
		$this->load->view('student/chat', $data);
	}

	public function step1($repetitor_id)
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$student = $this->StudentModel->findOne($this->session->student_id);
		$repetitor = $this->StudentModel->getRepetitor($repetitor_id);
		$data=array(
			'student' => $student->student,
			'repetitor' => $repetitor,
		);
		$this->load->view('student/step1', $data);
	}

	public function step2()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$student = $this->StudentModel->findOne($this->session->student_id);
		$repetitor = $this->StudentModel->getRepetitor($this->input->post('repetitor_id'));
		$data=array(
			'student'=> $student->student,
			'spec'=> $this->StudentModel->getRepetitorSpec($this->input->post('repetitor_id'),$repetitor['subjects'][0]['id']),
			'subjects'=> $repetitor['subjects'],
			'repetitor' => $repetitor,
			'dates' => $this->input->post('date[]'),
		);
		$this->load->view('student/step2', $data);
	}

	public function step3()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$data = array(
			 'student_id' => $this->input->post('student_id'),
			 'repetitor_id' => $this->input->post('repetitor_id'),
			 'specialization_id' => $this->input->post('specialization_id'),
			 'subject_id' => $this->input->post('subject_id'),
			 'about' => $this->input->post('about'),
			 'dates' => $this->input->post('date[]'),
			 'created_at' => date('Y-m-d H:i:s',time()),
		);
		//date('Y-m-d H:00:00', $this->input->post('date') / 1000),
		$student = $this->StudentModel->findOne($this->session->student_id);
		$pay = $this->StudentModel->setExercises($data);
		if ($pay === false){
			redirect('/student/stepend');
		} else{
			$data=array(
				'student'=> $student->student,
				'sum'=> $pay,
			);
			$this->load->view('student/step3', $data);
		}
	}

	public function stepend()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,
		);
		$this->load->view('student/step_end', $data);
	}

	public function addrepetitor($id)
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$repetitor_id = $id;
		$student_id = $this->session->student_id;
		$this->StudentModel->addfavorite($repetitor_id, $student_id);
		redirect('/student/favorites');
	}

	public function getRepetitorSpec()
	{
		$sp = $this->StudentModel->getRepetitorSpec($this->input->post('repetitor_id'),$this->input->post('subject_id'));
		echo json_encode($sp);
	}

	public function setExercise()
	{
		$this->StudentModel->visit($this->session->student_id);
		$data = array(
			 'student_id' => $this->input->post('student_id'),
			 'repetitor_id' => $this->input->post('repetitor_id'),
			 'specialization_id' => $this->input->post('specialization_id'),
			 'subject_id' => $this->input->post('subject_id'),
			 'about' => $this->input->post('about'),
			 'date_from' => date('Y-m-d H:00:00', $this->input->post('date') / 1000),
			 'created_at' => date('Y-m-d H:i:s',time()),
		);
		$ex_id = $this->StudentModel->setExercise($data);
		echo $ex_id;
	}

	public function setStatus()
	{
		$this->StudentModel->visit($this->session->student_id);
		$status = $this->input->post('status');
		echo $this->StudentModel->setStudentStatus($this->session->student_id, $status);
	}

	public function sendChat()
	{
		if (!$this->session->has_userdata('student_id')){
			 exit('ученик на вошёл');
		} else{
			$data = array(
				'created_at' => date('Y-m-d H:i:s', time()),
				'from_role' => 2,
				'from_id' => $this->session->student_id,
				'to_role' => $this->input->post('to_role'),
				'to_id' => $this->input->post('to_id'),
				'message' => $this->input->post('message'),
			);
			echo $this->MainModel->sendChat($data);
		}
	}

	public function getChat()
	{
		if (!$this->session->has_userdata('student_id')){
			 exit('ученик на вошёл');
		} else{
			$zone= $this->StudentModel->getStudentZone($this->session->student_id);
			$data = array(
				'from_role' => 2,
				'from_id' => $this->session->student_id,
				'to_role' => $this->input->post('to_role'),
				'to_id' => $this->input->post('to_id'),
				'read_at' => date('Y-m-d H:i:s', time()),
			);
			$chat = $this->MainModel->getChat($data);
			for($i=0;$i<count($chat['chat']);$i++){
				$chat['chat'][$i]['created_at'] = date('Y-m-d H:i:s', strtotime($chat['chat'][$i]['created_at']) + $zone*60*60);
			}
			echo json_encode($chat);
		}
	}

	public function getChatList()
	{
		if (!$this->session->has_userdata('student_id')){
			 exit('ученик на вошёл');
		} else{
			$list = $this->MainModel->getChatList(2, $this->session->student_id);
			echo json_encode($list);
		}
	}

	public function getOneChatUser()
	{
		if (!$this->session->has_userdata('student_id')){
			 exit('ученик на вошёл');
		} else{
			$list = $this->MainModel->getOneChatUser(2, $this->session->student_id, $this->input->post('role'), $this->input->post('id'));
			echo json_encode($list);
		}
	}

	public function payLessons()
	{
		$ids = $this->input->post('ids');
		$str = implode(",", $ids);
		$sel = 'select sum(cost) as s from exercises where id in ('.$str.')';
		$q = $this->db->query($sel);
		$r = $q->result_array();
		$sum = $r[0]['s'];
		$student = $this->StudentModel->findOne($this->session->student_id);
		if ($student->student['balance'] >= $sum){
			$balance = $student->student['balance'] - $sum;
			$sel = 'update students set balance='.$balance.' where id='.$student->student['id'];
			$q = $this->db->query($sel);
			$sel = 'update exercises set pay_at="'.date('Y-m-d H:i:s',time()).'" where id in('.$str.')';
			$q = $this->db->query($sel);
		}
		redirect('/student/lessonsrequest');

	}

	public function delLessons()
	{
		$ids = $this->input->post('ids');
		$str = implode(",", $ids);
		$sel = 'update exercises set deleted_at="'.date('Y-m-d H:i:s',time()).'" where id in('.$str.')';
		$q = $this->db->query($sel);
		redirect('/student/lessonsrequest');
	}

}
