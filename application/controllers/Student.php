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
			$student = $this->StudentModel->findOne($this->session->student_id);
			if ($student->student['status'] == 0){
				redirect('/student/profile');
			} else{
				redirect('/student/profile');
			}
		}
	}

	public function profile(){
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$student = $this->StudentModel->findOne($this->session->student_id);
			//var_dump($student->student);
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
		$rep = $this->StudentModel->findOne($this->session->student_id);
		$arr = json_decode($this->input->post('data'), true);
		echo $rep->update($arr);
	}

	function addavatar()
	{
		$id = $this->session->student_id;
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
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/balance', $data);
		}
	}

	public function lessonsrequest()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
				'tzones'=>$this->MainModel->getAll('timezones'),
			);
			$this->load->view('student/lessonsrequests', $data);
		}
	}

	public function favorites()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/favorites', $data);
		}
	}

	public function history()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
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
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/lessons', $data);
		}
	}

	public function freerequests()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		} else{
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
			$student = $this->StudentModel->findOne($this->session->student_id);
			$data=array(
				'student'=> $student->student,
			);
			$this->load->view('student/pay', $data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('student_id');
		redirect('/');
	}

	public function chat()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,
		);
		$this->load->view('student/chat', $data);
	}

	public function step1()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,

		);
		$this->load->view('student/step1', $data);
	}

	public function step2()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,
			'spec'=> $this->MainModel->getAll('specializations'),
		);
		$this->load->view('student/step2', $data);
	}

	public function step3()
	{
		if (!$this->session->has_userdata('student_id')){
			 redirect('/main/slogin');
		}
		$student = $this->StudentModel->findOne($this->session->student_id);
		$data=array(
			'student'=> $student->student,
		);
		$this->load->view('student/step3', $data);
	}
}
