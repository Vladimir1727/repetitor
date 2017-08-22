<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";

class Test extends CI_Controller {

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
		 $this->load->library('session');
		 $this->load->model('RepetitorModel');
	 }

	public function test()
	{
		//$this->session->set_userdata('repetitor_id', 1);
		//$this->load->view('test');
		//$rep = $this->RepetitorModel->findOne(1);
		//var_dump($rep->repetitor);
		//echo $rep->repetitor['email'];
		//$rep->repetitor['first_name'] = 'Vova';
		//echo $rep->update(array('first_name'=>'Vova', 'last_name'=>'D'));
		$this->load->library('email');
		$this->email->from('test@dvn125.xyz', 'Сайт репетитор');
		$this->email->to('dvn125@gmail.com');
		$this->email->subject('Регистрация');
		$mess = "Вы зарегистроровались на сайте 'Репетиторы' \r\n";
		$mess .= "Ваш e-mail: \r\n";
		$mess .= "Ваш пароль: ";
		$this->email->message($mess);
		echo $this->email->send();
	}

	public function single()
	{
		$this->load->library('unit_test');
		//echo 'run test <br>';
		$main = new Main;
		$main->index();
	}

	public function AjaxTest()
	{
		echo 'ajax test OK';
	}

	function upload()
	{
		$config['upload_path']          = './images/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload(0))
			{
				//$error = $this->upload->display_errors();
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
				$config['width']         = 75;
				$config['height']       = 50;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$data =  $this->upload->data();
				$f = $data['file_path'].$data['raw_name'].'_thumb'.$data['file_ext'];
				exit($f);
			}
	}

	public function adddoc()
	{
		try {
			$this->upload();
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}

	}
}
