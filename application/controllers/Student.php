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
				$mess = 'Здравствуйте! Рады видеть Вас на платформе Real Language Club. Рекомендуем в первую очередь внимательно изучить Инструкцию по работе с платформой. Ссылку на Инструкцию Вы сможете найти в дополнительном меню личного кабинета. Если у Вас возникают вопросы – пишите нам в чат. Мы всегда рады ответить на них. Спасибо, что Вы с нами! Удачи!';
				$dat = array(
					'created_at' => date('Y-m-d H:i:s', time()),
					'from_role' => 3,
					'from_id' => 0,
					'to_role' => 2,
					'to_id' => $this->session->student_id,
					'message' =>$mess,
				);
				$chat =$this->MainModel->sendChat($dat);
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
				'lessons'=> $this->sort($lessons, 'created_at'),
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
				'lessons'=> $this->sort($this->StudentModel->history($this->session->student_id), 'date_from'),
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
				'requests'=>$this->sort($this->StudentModel->getFreeRequests($this->session->student_id), 'created_at'),
			);
			//var_dump($data['requests']);
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

	public function pay2()
	{
		if (!$this->session->has_userdata('student_id')){
			redirect('/main/slogin');
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/pay2', $data);
		}
	}

	public function satPay()
	{
		$ex_id = $this->input->post('id');
		$sum = $this->input->post('sum');
		$student_id = $this->StudentModel->acceptPayHistory($ex_id);
		if ($student_id>0){
			echo $this->StudentModel->addBallance($student_id, $sum);
		} else{
			echo 'уже оплачено';
		}

	}

	public function saveExercises()
	{
		if (!$this->session->has_userdata('student_id')){
			 echo 'студент не вошел';
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$data = array(
				'student_id' => $this->session->student_id,
				'repetitor_id' => $this->input->post('repetitor_id'),
				'specialization_id' => $this->input->post('specialization_id'),
				'subject_id' => $this->input->post('subject_id'),
				'about' => $this->input->post('about'),
				'dates' => $this->input->post('date[]'),
				'created_at' => date('Y-m-d H:i:s',time()),
			);
			$this->StudentModel->setExercises($data);
			$this->StudentModel->addPayHistory($this->session->student_id, $sum, $this->input->post('pay_type'));

			$sum = $this->input->post('sum');
			$student_id = $this->session->student_id;
			$pay_type = $this->input->post('pay_type');
			echo $this->StudentModel->addPayHistory($student_id, $sum, $pay_type);
		}
	}

	public function savePay()
	{
		if (!$this->session->has_userdata('student_id')){
			 echo 'студент не вошел';
		} else{
			$sum = $this->input->post('sum');
			$student_id = $this->session->student_id;
			$pay_type = $this->input->post('pay_type');
			echo $this->StudentModel->addPayHistory($student_id, $sum, $pay_type);
		}
	}

	public function makePay()
	{
		if (!$this->session->has_userdata('student_id')){
			 //redirect('/main/slogin');
			 echo 'студент не вошел';
		} else{
			$this->StudentModel->visit($this->session->student_id);
			$data = array(
				'student_id' => $this->session->student_id,
   			 	'repetitor_id' => $this->input->post('repetitor_id'),
   			 	'specialization_id' => $this->input->post('specialization_id'),
   			 	'subject_id' => $this->input->post('subject_id'),
   			 	'about' => $this->input->post('about'),
   			 	'dates' => $this->input->post('date[]'),
   			 	'created_at' => date('Y-m-d H:i:s',time()),
			);
			$this->StudentModel->setExercises($data);
			if ($this->input->post('pay_type') == 'paypal'){
				// $postdata = http_build_query(
				//     array(
				//         'cmd' => '_xclick',
				//         'business' => 'info@reallanguage.club',
				// 		'amount' => $this->input->post('sum'),
				// 		'return' => 'https://tutor.reallanguage.club/index.php/student/stepend',
				// 		'currency_code' => 'USD',
				// 		'lc' => 'US',
				// 		'bn' => 'PP-BuyNowBF',
				// 		'custom' => $this->session->student_id,
				//     )
				// );
				// $opts = array('http' =>
				//     array(
				//         'method'  => 'POST',
				//         'header'  => 'Content-type: application/x-www-form-urlencoded',
				//         'content' => $postdata
				//     )
				// );
				// $context  = stream_context_create($opts);
				// $result = file_get_contents('https://www.sandbox.paypal.com/cgi-bin/websc', false, $context);
			}
			//

			//
			//redirect($this->input->post('go_to'));
			echo 0;
		}
	}

	public function logout()
	{

		if ($this->session->has_userdata('student_id')){
			//$this->StudentModel->setStudentStatus($this->session->student_id, 0);
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
			'subject_id' => $this->input->get('subject'),
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
			'subject_id'=> $this->input->get('subject'),
		);
		$this->load->view('student/step2', $data);
	}

	public function step3()
	{
		if (!$this->session->has_userdata('student_id') || count($_POST)==0){
			 redirect('/main/slogin');
		}
		$this->StudentModel->visit($this->session->student_id);
		$zone = $this->StudentModel->getStudentZone($this->session->student_id);
		$data1 = array(
			 'student_id' => $this->input->post('student_id'),
			 'repetitor_id' => $this->input->post('repetitor_id'),
			 'specialization_id' => $this->input->post('specialization_id'),
			 'subject_id' => $this->input->post('subject_id'),
			 'about' => $this->input->post('about'),
			 'dates' => $this->input->post('date[]'),
			 'created_at' => date('Y-m-d H:i:s',time() - $zone*60*60),
		);
		$student = $this->StudentModel->findOne($this->session->student_id);
		$pay = $this->StudentModel->checkExPay($data1);
		if ($pay === false){
			$this->StudentModel->setExercises($data1);
			redirect('/student/stepend');
		} else{
			$data1['student'] = $student->student;
			$data1['sum'] = $pay;
			$this->load->view('student/step3', $data1);
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
			 'date_from' => gmdate('Y-m-d H:00:00', $this->input->post('date') / 1000),
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
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$ids = $this->input->post('ids');
		$this->StudentModel->payLessons($ids);
		redirect('/student/lessonsrequest');
	}

	public function payLesson()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$ids = $this->input->post('ids');
		$this->StudentModel->payLesson($ids[0]);
		redirect('/student/lessonsrequest');
	}

	public function delLessons()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$ids = $this->input->post('ids');
		$this->StudentModel->delLessons($ids);
		redirect('/student/lessonsrequest');
	}

	public function delLesson()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$ids = $this->input->post('ids');
		$this->StudentModel->delLesson($ids[0]);
		redirect('/student/lessonsrequest');
	}

	public function test()
	{
		$arr= array('id'=>4, 'sum'=>33);
		log_message('error','POST='.json_encode($arr));
	}

	public function addfreerequest()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$data = array(
			'created_at'=> date('Y-m-d H:i:s', time()),
			'subject_id'=> $this->input->post('subject_id'),
			'about'=> $this->input->post('about'),
			'about_time'=> $this->input->post('about_time'),
			'student_id'=>  $this->session->student_id,
		);
		$this->StudentModel->addFreeRequest($data);
		redirect('/student/freerequests');
	}

	public function getFreeRepetitors()
	{
		if (!$this->session->has_userdata('student_id')){
			 exit('ученик на вошёл');
		} else{
			$free_id = $this->input->post('free_id');
			//echo $free_id;
			$data = $this->StudentModel->getFreeRepetitors($free_id);
			echo json_encode($data);
		}
	}

	public function sort($array, $key)
	{
		for ($i=0; $i < count($array); $i++) {
			for ($j=0; $j < count($array); $j++) {
				if (strtotime($array[$i][$key]) > strtotime($array[$j][$key])){
					$temp = $array[$i];
					$array[$i] = $array[$j];
					$array[$j] = $temp;
				}
			}
		}
		return $array;
	}

	public function getpaypal()
	{
		if (count($_POST)>0){
			log_message('error','POST PAYPAL='.json_encode($_POST));
			# getting POST from paypal
			$ipn = new PaypalIPN();
			// Use the sandbox endpoint during testing.
			$ipn->useSandbox();
			$verified = $ipn->verifyIPN();
			if ($verified) {
				$ex_id = $this->input->post('custom');
				$sum = round($this->input->post('mc_gross'));
	 			$student_id = $this->StudentModel->acceptPayHistory($ex_id);
				$this->StudentModel->addBallance($student_id, $sum);
				header("HTTP 200 OK");
			} else{
				//error
				log_message('error','ERROR POST='.json_encode($_POST));
			}
		} else{
			redirect('main/filter');
		}
	}

	public function getpaypal_old()
	{
		if (count($_POST)>0){
				$ex_id = $this->input->post('custom');
				$sum = round($this->input->post('mc_gross'));
	 			$student_id = $this->StudentModel->acceptPayHistory($ex_id);
				$this->StudentModel->addBallance($student_id, $sum);
				header("HTTP 200 OK");
		} else{
			redirect('main/filter');
		}
	}

	public function getYandex()
	{
		if (count($_POST)>0){
			$secret = 'yYdgxWJ/SwWNm93bv5q3fOhu';
			log_message('error','POST YANDEX='.json_encode($_POST));
			$sum = $this->input->post('mc_gross');
			$ex_id = $this->input->post('label');
			$student_id = $this->StudentModel->acceptPayHistory($ex_id);
			$this->StudentModel->addBallance($student_id, $sum);
			header("HTTP 200 OK");
		} else{
			redirect('main/filter');
		}
	}

	public function forgot()
	{
		$email = $this->input->post('email');
		echo $this->StudentModel->forgot($email);
	}
}
