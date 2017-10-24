<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Main.php";
//use PaypalIPN;
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
		//$str = '%7B%22user_id%22%3A314%2C%22service_provider%22%3A%22twilio%22%2C%22service_name%22%3A%22textMessages%22%7D';
		//$data = json_decode(urldecode($str));
		//var_dump($data);
		//АЛГОРИТМ проверки ключа от ЯндексДеньги
		$post = array(
			'notification_type' => 'p2p-incoming',
			'operation_id' => 1234567,
			'amount' => '300.00',
			'currency' => 643,
			'datetime'=>'2011-07-01T09:00:00.000+04:00',
			'sender' => '41001XXXXXXXX',
			'codepro' => 'false',
			'notification_secret' => '01234567890ABCDEF01234567890',
			'label' => 'YM.label.12345',
		);
		$str1 = $post['notification_type'].'&'.$post['operation_id'].'&'.$post['amount'].'&'.$post['currency'].'&'.$post['datetime'].'&'.$post['sender'].'&'.$post['codepro'].'&'.$post['notification_secret'].'&'.$post['label'];
		$str2 = 'p2p-incoming&1234567&300.00&643&2011-07-01T09:00:00.000+04:00&41001XXXXXXXX&false&01234567890ABCDEF01234567890&YM.label.12345';
		$str3 = hash('sha1', $str2, false);
		echo $str1.'<br>';
		echo $str2.'<br>';
		echo $str3.'<br>';
		echo '<p>END OF 1<p>';
		$post = array(
			"notification_type" => "p2p-incoming",
			"amount" => "995.19",
			"datetime" => "2017-10-18T06:17:09Z",
			"codepro" => "false",
			"sender" => "41001000040",
			"sha1_hash" => "2a8aa5dcd590855a4bc0627de18a9d417297976b",
			"test_notification" => "true",
			"operation_label" => "",
			"operation_id" => "test-notification",
			"currency" => "643",
			"label" => "",
			'notification_secret' => '',
		);
		$str1 = $post['notification_type'].'&'.$post['operation_id'].'&'.$post['amount'].'&'.$post['currency'].'&'.$post['datetime'].'&'.$post['sender'].'&'.$post['codepro'];
		$str2 = $post['sha1_hash'];
		$str3 = hash('sha1', $str1, false);
		echo $str1.'<br>';
		echo $str2.'<br>';
		echo $str3.'<br>';
		echo '<p>END OF 1<p>';
		$post1 = array(
			'operation_id' => '904035776918098009',
			'notification_type' => 'p2p-incoming',
			'datetime' => '2014-04-28T16:31:28Z',
			'sha1_hash' => '8693ddf402fe5dcc4c4744d466cabada2628148c',
			'sender' => '41003188981230',
			'codepro' => 'false',
			'currency' => '643',
			'amount' => '0.99',
			'withdraw_amount' => '1.00',
			'label' => 'YM.label.12345',
		);
		$post2 =array(
			'operation_id' => '904035776918098009',
			'notification_type' => 'p2p-incoming',
			'datetime' => '2014-04-28T16:31:28Z',
			'sha1_hash' => '8693ddf402fe5dcc4c4744d466cabada2628148c',
			'sender' => '41003188981230',
			'codepro' => 'false',
			'currency' => '643',
			'amount' => '0.99',
			'withdraw_amount' => '1.00',
			'label' => 'YM.label.12345',
			'lastname' => 'Иванов',
			'firstname' => 'Иван',
			'fathersname' => 'Иванович',
			'zip' => '125075',
			'city' => 'Москва',
			'street' => 'Тверская',
			'building' => '12',
			'suite' => '10',
			'flat' => '10',
			'phone' => '+79253332211',
			'email' => 'adress@yandex.ru',
		);
		$str1 = $post['notification_type'];
		if ($post['operation_id']!=''){
			$str1 .= '&'.$post['operation_id'];
		}
		if (isset($post['amount']) && $post['amount']!=''){
			$str1 .= '&'.$post['amount'];
		}
		if (isset($post['currency']) && $post['currency']!=''){
			$str1 .= '&'.$post['currency'];
		}
		if (isset($post['datetime']) && $post['datetime']!=''){
			$str1 .= '&'.$post['datetime'];
		}
		if (isset($post['sender']) && $post['sender']!=''){
			$str1 .= '&'.$post['sender'];
		}
		if (isset($post['codepro']) && $post['codepro']!=''){
			$str1 .= '&'.$post['codepro'];
		}
		if (isset($post['notification_secret']) && $post['notification_secret']!=''){
			$str1 .= '&'.$post['notification_secret'];
		}
		if (isset($post['label']) && $post['label']!=''){
			$str1 .= '&'.$post['label'];
		}
		echo 'str='.$str1.'<br>';
		$str3 = hash('sha1', $str1, false);
		echo 'hashC='.$str3.'<br>';
		echo 'hashP='.$post['sha1_hash'].'<br>';

	}

	public function test2()
	{
		$this->load->view('test');
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
