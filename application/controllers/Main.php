<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		 $this->load->model('MainModel');
		 $this->load->library('session');
	 }

	public function index()
	{
		$this->load->view('main/start');
	}

	public function about()
	{
		$this->load->view('main/about');
	}

	public function filter()
	{
		$data=array(
			'subjects'=>$this->MainModel->getAll('subjects'),
			'ages'=>$this->MainModel->getAll('ages'),
			'specializations'=>$this->MainModel->getAll('specializations'),
			'languages'=>$this->MainModel->getAll('languages'),
			'levels'=>$this->MainModel->getAll('levels'),
		);
		$this->load->view('main/filter', $data);
	}

	public function repetitorregistration(){
		$this->load->view('main/repreg');
	}

	public function studentregistration(){
		$this->load->view('main/studentreg');
	}

	public function rlogin(){
		$this->load->view('main/replogin');
	}

	public function slogin(){
		$this->load->view('main/studentlogin');
	}

	public function rinfo()
	{
		$this->load->view('main/rinfo');
	}

	public function test(){
		$this->load->library('unit_test');
		echo 'run test <br>';
		$test = 1 + 1;
		$expected_result = 2;
		$test_name = 'Adds one plus one';
		$t = $this->unit->run($test, $expected_result, $test_name);
		echo $t;
		//$this->load->view('test');
	}

	public function upload()
	{
		echo 'start upload <br>';
		$config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo 'upload ERROR '.$this->upload->display_errors();
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                echo 'upload complite';
            }
	}

	public function upload2()
	{
		//echo 'start upload 2 <br>';
		$config['upload_path']          = './images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());
                echo 'upload ERROR '.$this->upload->display_errors();
            }
            else
            {
				$img = $this->upload->data();
				$path = 'images/'.$img["file_name"];
				echo ' pass= '.$path.'<br>';
				$config['image_library'] = 'gd2';
				$config['source_image'] = $path;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 75;
				$config['height']       = 50;

				$this->load->library('image_lib', $config);

				$this->image_lib->resize();
				echo $this->image_lib->display_errors();
                $data = array('upload_data' => $this->upload->data());
				var_dump($this->upload->data());
                //echo 'upload complite';
            }
	}

	public function formtest()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Username', 'trim|required|min_length[5]|max_length[12]');
		  if ($this->form_validation->run() == FALSE){
			  echo $this->form_validation->error_string();
			  echo 'form false';
		  } else {
			  echo 'form OK ';
			  echo $this->input->post('name', TRUE);
			  echo $this->input->ip_address();
		  }
	}

	public function mail()
	{
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		//$config['smtp_host'] = 'mail.adm.tools';
		$config['smtp_host'] = 'mail.ukraine.com.ua';
		$config['smtp_port'] = 2525;
		$config['smtp_user'] = 'test@dvn125.xyz';
		//$config['smtp_user'] = 'svityaz@dvn125.xyz';
		$config['smtp_pass'] = 'Zx1290as';
		$config['smtp_crypto'] = 'tls';
		$config['mailtype'] = 'html';

		$this->email->initialize($config);

		$this->email->from('test@dvn125.xyz', 'Владимир');
		//$this->email->from('svityaz@dvn125.xyz', 'Владимир');
		$this->email->to('dvn125@gmail.com');
		$this->email->subject('тема письма');
		$this->email->message('<h1>Тестирование отправки писем <strong>SMTP</strong> 2</h1>');

		if ($this->email->send()) {
			echo ' mail sended';
		} else {
			echo 'ERROR <br>';
			echo $this->email->print_debugger();
		}
	}

	public function testajax()
	{
		echo "test AJAX";
	}
}
