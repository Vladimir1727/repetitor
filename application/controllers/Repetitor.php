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
		 $this->load->library('image_lib');
	 }

	public function index()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		redirect('repetitor/lessonsrequests');
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
				$this->RepetitorModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
				/////
				$mess = 'Здравствуйте! Рады видеть Вас на платформе Real Language Club. Рекомендуем в первую очередь внимательно изучить Инструкцию по работе с платформой. Ссылку на Инструкцию Вы сможете найти в дополнительном меню личного кабинета. Если у Вас возникают вопросы – пишите нам в чат. Мы всегда рады ответить на них. Спасибо, что Вы с нами! Удачи!';
				$dat = array(
					'created_at' => date('Y-m-d H:i:s', time()),
					'from_role' => 3,
					'from_id' => 0,
					'to_role' => 1,
					'to_id' => $this->session->repetitor_id,
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
			  	$login = $this->RepetitorModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
			  } catch (Exception $e) {
				  exit($e->getMessage());
			  }
			  exit("0");
		  }
	}

	public function profile(){
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		} else{
			$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
			$this->RepetitorModel->visit($this->session->repetitor_id);
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
		//echo 'update';
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$arr = json_decode($this->input->post('data'), true);
		try {
			$r = $rep->update($arr);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		//var_dump($r);
		echo $r;
	}

	public function updateSubject()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$age_id = $this->input->post('age_id[]');
		$spez_id = $this->input->post('specialization_id[]');
		$level_id = $this->input->post('level_id[]');
		$price = $this->input->post('price');
		$lang_id = $this->input->post('lang_id');
		$subject_id = $this->input->post('subject_id');
		$pos = $this->input->post('position');
		try {
		  $this->RepetitorModel->saveSubject($this->session->repetitor_id, $age_id, $spez_id, $level_id, $price, $lang_id, $subject_id, $pos);
		} catch (Exception $e) {
			exit($e->getMessage());
		}
		exit('0');
	}

	public function loadSubject()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$pos = $this->input->post('subject');
		try {
		  $data = $this->RepetitorModel->loadSubject($this->session->repetitor_id, $pos);
		} catch (Exception $e) {
			exit($e->getMessage());
		}
		echo json_encode($data);
	}

	function addavatar()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		if ($handle = opendir('images')) {
		    while (false !== ($file = readdir($handle))) {
				$s = strpos($file, 'avatar_r'.$this->session->repetitor_id.'_');
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
		$config['file_name']             = 'avatar_r'.$this->session->repetitor_id.'_';
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
				$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
				$arr = array('avatar'=>$data['raw_name'].$data['file_ext']);
				$rep->update($arr);
				exit($f);
			}
	}

	function adddoc()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$pos = $this->input->post('pos');
		$rid = $this->session->repetitor_id;
		if ($handle = opendir('images')) {
		    while (false !== ($file = readdir($handle))) {
				$s = strpos($file, 'doc_r'.$rid.'_'.$pos.'_');
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
		$config['file_name']             = 'doc_r'.$rid.'_'.$pos.'_';
		$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload(0))
			{
				throw new Exception($this->upload->display_errors());
			}
			else
			{
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
				$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
				$arr = array('doc'.$pos => $data['raw_name'].$data['file_ext']);
				$rep->update($arr);
				exit($f);
			}
	}

	public function chat()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
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
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
			'start_id'=> $start_id,
			'role'=> $role,
		);
		$this->load->view('repetitor/chat', $data);
	}

	public function lessonsrequests()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$lessons = $this->RepetitorModel->lessonsrequests($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
			'lessons'=> $lessons,
		);
		$this->load->view('repetitor/lessonsrequests', $data);
		// echo '<pre>';
		// var_dump($lessons);
		// echo '</pre>';
	}

	public function history()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/history', $data);
	}

	public function timetable()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/timetable', $data);
	}

	public function freerequests()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/freerequests', $data);
	}

	public function lessons()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/lessons', $data);
	}

	public function balance()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/balance', $data);
	}

	public function plan()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$student_id = $this->input->get('id');
		$data=array(
			'repetitor'=> $rep->repetitor,
			'student'=> $this->RepetitorModel->getStudent($student_id),
		);
		$this->load->view('repetitor/plan', $data);
	}

	public function getmoney()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 redirect('/main/rlogin');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$rep = $this->RepetitorModel->findOne($this->session->repetitor_id);
		$data=array(
			'repetitor'=> $rep->repetitor,
		);
		$this->load->view('repetitor/getmoney', $data);
	}

	public function logout()
	{
		if ($this->session->has_userdata('repetitor_id')){
			$this->RepetitorModel->setRepetitorStatus($this->session->repetitor_id, 0);
			$this->session->unset_userdata('repetitor_id');
		}
		redirect('/');
	}

	public function getTimeTable()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		}
		$this->RepetitorModel->visit($this->session->repetitor_id);
		$data = $this->RepetitorModel->getTimeTable($this->session->repetitor_id);
		echo json_encode($data);
	}

	public function saveTimeTable()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		}else{
			$this->RepetitorModel->visit($this->session->repetitor_id);
			$table = json_decode($this->input->post('table'));
			echo $this->RepetitorModel->saveTimeTable($table, $this->session->repetitor_id, $this->input->post('subject_id'));
		}
	}

	public function getStudents()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		} else{
			$this->RepetitorModel->visit($this->session->repetitor_id);
			$data = $this->RepetitorModel->getStudents();
			echo json_encode($data);
		}
	}

	public function setStatus()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		} else{
			$this->RepetitorModel->visit($this->session->repetitor_id);
			$status = $this->input->post('status');
			echo $this->RepetitorModel->setRepetitorStatus($this->session->repetitor_id, $status);
		}
	}

	public function sendChat()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		} else{
			$data = array(
				'created_at' => date('Y-m-d H:i:s', time()),
				'from_role' => 1,
				'from_id' => $this->session->repetitor_id,
				'to_role' => $this->input->post('to_role'),
				'to_id' => $this->input->post('to_id'),
				'message' => $this->input->post('message'),
			);
			echo $this->MainModel->sendChat($data);
		}
	}

	public function getChat()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		} else{
			$zone= $this->RepetitorModel->getRepZone($this->session->repetitor_id);
			$data = array(
				'from_role' => 1,
				'from_id' => $this->session->repetitor_id,
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
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор на вошёл');
		} else{
			$list = $this->MainModel->getChatList(1, $this->session->repetitor_id);
			echo json_encode($list);
		}
	}

	public function getOneChatUser()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 exit('репетитор не вошёл');
		} else{
			$list = $this->MainModel->getOneChatUser(1, $this->session->repetitor_id, $this->input->post('role'), $this->input->post('id'));
			echo json_encode($list);
		}
	}

	public function test(){
		$repetitor = 3;
		$data = $this->RepetitorModel->newChats($repetitor);
		var_dump($data);
	}
}
