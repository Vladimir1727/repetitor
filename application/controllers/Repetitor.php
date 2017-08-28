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
				$this->RepetitorModel->login($this->input->post('email', TRUE), $this->input->post('pass', TRUE));
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
		echo $rep->update($arr);
	}

	public function updateSubject()
	{
		if (!$this->session->has_userdata('repetitor_id')){
			 throw new Exception('репетитор не вошёл');
		}
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
				$img = $this->upload->data();
				$path = 'images/'.$img["file_name"];
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 200;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data =  $this->upload->data();
				$f = $data['raw_name'].'_thumb'.$data['file_ext'];
				$rep = $this->RepetitorModel->findOne($rid);
				$arr = array('doc'.$pos => $data['raw_name'].$data['file_ext']);
				$rep->update($arr);
				exit($f);
			}
	}
}
