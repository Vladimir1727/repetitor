<?php

class AjaxController extends Controller
{
	public $json = array();

	protected function beforeAction($action)
	{
		// отключаем web-логи для ajax запросов
		foreach (Yii::app()->log->routes as $route) {
			if ($route instanceof CWebLogRoute || $route instanceof CProfileLogRoute) {
				$route->enabled = false;
			}
		}

		return parent::beforeAction($action);
	}

	public function init() {
		parent::init();
		Yii::app()->errorHandler->errorAction = 'ajax/error';
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// block direct access to ajax.php
		throw new CHttpException(403, 'Access denied.');
	}

	public function actionTypograph()
	{
		$text = Yii::app()->request->getPost('text', null);
		$this->json['text'] = '';

		if (!empty($text)) {
			// import remote typograf library
			Yii::import('application.vendor.RemoteTypograf.RemoteTypograf');

			$typograf = new RemoteTypograf('UTF-8');

			// no entities for utf-8
			$typograf->noEntities();
			// $typograf->htmlEntities();

			$typograf->br(false);
			$typograf->p(false);
			$typograf->nobr(3);
			$typograf->quotA('laquo raquo');
			$typograf->quotB('bdquo ldquo');

			$text = preg_replace('#<span style="white\-space: nowrap;"[^>]*>([^<]*)</span>#u', '$1', $text);

			$text = $typograf->processText($text);
			$this->json['text'] = preg_replace('#<nobr[^>]*>([^<]*)</nobr>#u', '<span style="white-space: nowrap;">$1</span>', $text);
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	public function actionUploadImage()
	{
		$save_result = false;
		$message = '';

		$image = CUploadedFile::getInstanceByName('file');

		if (!empty($image)) {
			$model = new AddFileForm('photo');
			$model->photo = $image;

			if ($model->validate()) {
				// import URLify library
				Yii::import('application.vendor.URLify.URLify');

				$photo_id = uniqid();
				$photo_name = strtolower(str_replace('-', '_', URLify::filter($model->photo->getName(), 60, 'ru', true)));

				$photo_dir = Yii::app()->getAssetManager()->getBasePath() . DS . 'images' . DS . $photo_id . DS;
				$photo_path = $photo_dir . $photo_name;

				$dir_rs = CFileHelper::createDirectory($photo_dir, 0777, true);

				if ($dir_rs) {
					$save_photo_rs = $model->photo->saveAs($photo_path);

					if ($save_photo_rs) {
						$save_result = true;
					}
				}
			}
			else {
				$errors = $model->jsonErrors();
				$message = implode("<br>\n", $errors['msg']);
			}
		}

		if ($save_result) {
			$this->json = array(
				'filelink' => Yii::app()->getAssetManager()->getBaseUrl() . '/images/' . $photo_id . '/' . $photo_name,
			);
		}
		else {
			$this->json = array(
				'error' => true,
				'message' => !empty($message) ? $message : 'Произошла ошибка во время загрузки файла',
			);
		}
	}

	public function actionRegistration()
	{
		$registration = Yii::app()->request->getPost('registration', null);
		$rc = Yii::app()->request->getPost('g-recaptcha-response', null);
		$secret = "6Le11CgUAAAAAD1LKFzO0Or25EACrU8n4BH9W4HZ";
		//$secret = "6Lf9zSgUAAAAAElA_NxMCxmCbDeeF0uNDrB7H0oR";
		$google_url="https://www.google.com/recaptcha/api/siteverify";
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$secret."&response=".$rc."&remoteip=".$ip;
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	    $curlData = curl_exec($curl);
	    curl_close($curl);
	    $res= $curlData;
        $res= json_decode($res, true);
		$response = false;
        if($res['success']){
			$response = true;
		}

		if (!empty($registration) && Yii::app()->request->isAjaxRequest && $response) {
			$model = new RequestForm('registration');
			$model->attributes = $registration;

			if (!preg_match('/^\+7 \d{3} \d{7}$/i' , $model->phone)){
				 throw new CHttpException(400, 'Bad request!');
			 }



			if ($model->validate()) {
				$emails = explode(',', Yii::app()->params->settings['mail']);

				// save registration
				Registration::model()->add($model);

				// get program
				$program_title = '';

				if (!empty($model->program_id)) {
					$program = Program::model()->getProgramById($model->program_id);

					if (!empty($program)) {
						$program_title = '<strong>Программа:</strong> ' . CHtml::encode($program['program_title']) . '<br><br>';
					}
				}

				$mailer = Yii::createComponent('ext.Mailer.EMailer', true);
				// $mailer->setPathViews('application.views.mail');

				try {
					$mailer->IsMail();

					$from = 'noreply@' . Yii::app()->request->getServerName();
					$from_name = Yii::app()->name;

					$mailer->Sender = $from;
					$mailer->SetFrom($from, $from_name);
					$mailer->AddReplyTo($from, $from_name);

					foreach ($emails as $email) {
						$email = trim($email);

						if (!empty($email)) {
							$mailer->AddAddress($email);
						}
					}

					$mailer->CharSet = 'UTF-8';
					$mailer->ContentType = 'text/html';

					$mailer->Subject = 'Регистрация на сайте';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Посетитель зарегистрировался на сайте SmartCalories.</p>
<p>
Детали:<br><br>
{$program_title}
<strong>Имя:</strong> {$model->firstname}<br>
<strong>Email:</strong> {$model->mail}<br>
<strong>Телефон:</strong> {$model->phone}<br>
<strong>Комментарий:</strong> {$model->comment}
</p>
HTML;

					$mailer->Send();

					$texts = Text::model()->getTexts();

					// send mail to client
					$mailer->ClearAllRecipients();
					$mailer->AddAddress($model->mail);

					$mailer->Subject = 'Регистрация на сайте';

					if (!empty($texts['success_msg'])) {
						$mailer->Body = str_replace(array(
							'{program}',
							'{firstname}',
							'{mail}',
							'{phone}',
						), array(
							$program_title,
							$model->firstname,
							$model->mail,
							$model->phone,
						), $texts['success_msg']);
					}
					else {
						$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Вы успешно зарегистрировались на сайте SmartCalories.</p>
<p>
{$program_title}
Ваши данные:<br/><br/>
<strong>Имя:</strong> {$model->firstname}<br>
<strong>E-mail:</strong> {$model->mail}<br>
<strong>Телефон:</strong> {$model->phone}
</p>
HTML;
					}

					$mailer->Send();
				}
				catch (phpmailerException $e) {
					//echo $e->errorMessage();
					//$this->json = array('error' => 'Y', 'errorCode' => 'Ошибка при отправке письма! Попробуйте позже или свяжитесь с менеджером по телефону указанному на сайте');
				}

				$json_result = <<<HTML
Спасибо за регистрацию! Мы с Вами вскоре свяжемся!
HTML;

				$this->json = array(
					'msg' => $json_result,
				);

			}
			else {
				$errors = $model->jsonErrors();
				$this->json = array(
					'error' => true,
					'errorCode' => '', // implode("<br>\n", $errors['messages']),
					'errorFields' => $errors['fields'],
				);
			}
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	public function actionSeminar()
	{
		$seminar = Yii::app()->request->getPost('seminar', null);

		if (!empty($seminar) && Yii::app()->request->isAjaxRequest) {
			$model = new RequestForm('seminar');
			$model->attributes = $seminar;

			if ($model->validate()) {
				$emails = explode(',', Yii::app()->params->settings['mail']);

				// save registration
				Registration::model()->add($model);

				// get seminar
				$seminar_title_text = '';
				$seminar_title = '';

				if (!empty($model->seminar_id)) {
					$seminar = Seminar::model()->getSeminarById($model->seminar_id);

					if (!empty($seminar)) {
						$seminar_title_text = CHtml::encode($seminar['seminar_title']);
						$seminar_title = '<strong>Семинар:</strong> ' . CHtml::encode($seminar['seminar_title']) . '<br><br>';
					}
				}

				$mailer = Yii::createComponent('ext.Mailer.EMailer', true);
				// $mailer->setPathViews('application.views.mail');

				try {
					$mailer->IsMail();

					$from = 'noreply@' . Yii::app()->request->getServerName();
					$from_name = Yii::app()->name;

					$mailer->Sender = $from;
					$mailer->SetFrom($from, $from_name);
					$mailer->AddReplyTo($from, $from_name);

					foreach ($emails as $email) {
						$email = trim($email);

						if (!empty($email)) {
							$mailer->AddAddress($email);
						}
					}

					$mailer->CharSet = 'UTF-8';
					$mailer->ContentType = 'text/html';

					$mailer->Subject = 'Запись на семинар «' . $seminar_title_text . '»';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Посетитель зарегистрировался на семинар на сайте theBody school.</p>
<p>
Детали:<br><br>
{$seminar_title}
<strong>Имя:</strong> {$model->firstname}<br>
<strong>Email:</strong> {$model->mail}<br>
<strong>Телефон:</strong> {$model->phone}
</p>
HTML;

					$mailer->Send();

					// send mail to client
					$mailer->ClearAllRecipients();
					$mailer->AddAddress($model->mail);

					$mailer->Subject = 'Запись на семинар «' . $seminar_title_text . '»';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Вы успешно зарегистрировались на семинар на сайте theBody school.</p>
<p>
{$seminar_title}
Ваши данные:<br/><br/>
<strong>Имя:</strong> {$model->firstname}<br>
<strong>E-mail:</strong> {$model->mail}<br>
<strong>Телефон:</strong> {$model->phone}
</p>
HTML;

					$mailer->Send();
				}
				catch (phpmailerException $e) {
					//echo $e->errorMessage();
					//$this->json = array('error' => 'Y', 'errorCode' => 'Ошибка при отправке письма! Попробуйте позже или свяжитесь с менеджером по телефону указанному на сайте');
				}

				$texts = Text::model()->getTexts();

				if (false && !empty($texts['success_msg'])) {
					$json_result = $texts['success_msg'];
				}
				else {
					$json_result = <<<HTML
Спасибо за регистрацию! Мы с Вами вскоре свяжемся!
HTML;
				}

				$this->json = array(
					'msg' => $json_result,
				);
			}
			else {
				$errors = $model->jsonErrors();
				$this->json = array(
					'error' => true,
					'errorCode' => '', // implode("<br>\n", $errors['messages']),
					'errorFields' => $errors['fields'],
				);
			}
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	public function actionReview()
	{
		$review = Yii::app()->request->getPost('review', null);

		if (!empty($review) && Yii::app()->request->isAjaxRequest) {
			$model = new RequestForm('review');
			$model->attributes = $review;

			if ($model->validate()) {
				$emails = explode(',', Yii::app()->params->settings['mail']);

				$review = nl2br($model->comment);
				$model->comment = '';

				// save registration
				Registration::model()->add($model);

				$mailer = Yii::createComponent('ext.Mailer.EMailer', true);
				// $mailer->setPathViews('application.views.mail');

				try {
					$mailer->IsMail();

					$from = 'noreply@' . Yii::app()->request->getServerName();
					$from_name = Yii::app()->name;

					$mailer->Sender = $from;
					$mailer->SetFrom($from, $from_name);
					$mailer->AddReplyTo($from, $from_name);

					foreach ($emails as $email) {
						$email = trim($email);

						if (!empty($email)) {
							$mailer->AddAddress($email);
						}
					}

					$mailer->CharSet = 'UTF-8';
					$mailer->ContentType = 'text/html';

					$mailer->Subject = 'Новый отзыв';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Посетитель оставил свой отзыв на сайте theBody school.</p>
<p>
Детали:<br /><br />
<strong>Имя:</strong> {$model->firstname}<br>
<strong>Email:</strong> {$model->mail}<br>
<strong>Отзыв:</strong> {$review}
</p>
HTML;

					$mailer->Send();

					// send mail to client
					$mailer->ClearAllRecipients();
					$mailer->AddAddress($model->mail);

					$mailer->Subject = 'Регистрация на сайте';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Вы успешно оставили отзыв на сайте theBody school.</p>
<p>
Детали:<br /><br />
<strong>Имя:</strong> {$model->firstname}<br>
<strong>Email:</strong> {$model->mail}<br>
<strong>Отзыв:</strong> {$review}
</p>
HTML;

					$mailer->Send();
				}
				catch (phpmailerException $e) {
					//echo $e->errorMessage();
					//$this->json = array('error' => 'Y', 'errorCode' => 'Ошибка при отправке письма! Попробуйте позже или свяжитесь с менеджером по телефону указанному на сайте');
				}

				$texts = Text::model()->getTexts();

				if (false && !empty($texts['success_msg'])) {
					$json_result = $texts['success_msg'];
				}
				else {
					$json_result = <<<HTML
Спасибо за отзыв! Вскоре он будет проверен администрацией сайта и опубликован!
HTML;
				}

				$this->json = array(
					'msg' => $json_result,
				);
			}
			else {
				$errors = $model->jsonErrors();
				$this->json = array(
					'error' => true,
					'errorCode' => '', // implode("<br>\n", $errors['messages']),
					'errorFields' => $errors['fields'],
				);
			}
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	public function actionBook()
	{
		$book = Yii::app()->request->getPost('book', null);

		if (!empty($book) && Yii::app()->request->isAjaxRequest) {
			$model = new RequestForm('book');
			$model->attributes = $book;

			if ($model->validate()) {
				$emails = explode(',', Yii::app()->params->settings['mail']);

				// save registration
				Registration::model()->add($model);

				$texts = Text::model()->getTexts();

				$mailer = Yii::createComponent('ext.Mailer.EMailer', true);
				// $mailer->setPathViews('application.views.mail');

				try {
					$mailer->IsMail();

					$from = 'noreply@' . Yii::app()->request->getServerName();
					$from_name = Yii::app()->name;

					$mailer->Sender = $from;
					$mailer->SetFrom($from, $from_name);
					$mailer->AddReplyTo($from, $from_name);

					$mailer->AddAddress($model->mail);

					$book_file = Yii::app()->getBaseUrl(true) . Yii::app()->assetManager->getBaseUrl() . '/files/' . $texts['book_file'];

					$mailer->Subject = 'Скачать книгу «' . CHtml::encode(str_replace(array("\n", "\r"), ' ', $texts['book_title'])) . '»';
					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Ссылка для скачивания книги: <a href="{$book_file}" target="_blank">скачать</a></p>
HTML;

					$mailer->Send();
				}
				catch (phpmailerException $e) {
					//echo $e->errorMessage();
					//$this->json = array('error' => 'Y', 'errorCode' => 'Ошибка при отправке письма! Попробуйте позже или свяжитесь с менеджером по телефону указанному на сайте');
				}

				if (false && !empty($texts['success_msg'])) {
					$json_result = $texts['success_msg'];
				}
				else {
					$json_result = <<<HTML
Спасибо! Ссылка для скачивания книги была отправлена вам на email
HTML;
				}

				$this->json = array(
					'msg' => $json_result,
				);
			}
			else {
				$errors = $model->jsonErrors();
				$this->json = array(
					'error' => true,
					'errorCode' => '', // implode("<br>\n", $errors['messages']),
					'errorFields' => $errors['fields'],
				);
			}
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	public function actionSubscribe()
	{
		$subscribe = Yii::app()->request->getPost('subscribe', null);
        $rc = Yii::app()->request->getPost('g-recaptcha-response', null);
		$secret = "6Le11CgUAAAAAD1LKFzO0Or25EACrU8n4BH9W4HZ";
		//$secret = "6Lf9zSgUAAAAAElA_NxMCxmCbDeeF0uNDrB7H0oR";
		$google_url="https://www.google.com/recaptcha/api/siteverify";
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$secret."&response=".$rc."&remoteip=".$ip;
		$curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	    $curlData = curl_exec($curl);
	    curl_close($curl);
	    $res= $curlData;
        $res= json_decode($res, true);
		$response = false;
        if($res['success']){
			$response = true;
		}


		if (!empty($subscribe) && Yii::app()->request->isAjaxRequest && $response) {
			$model = new RequestForm('subscribe');
			$model->attributes = $subscribe;

			if ($model->validate()) {
				$emails = explode(',', Yii::app()->params->settings['mail']);

				// add registration
				Registration::model()->add($model);

				$mailer = Yii::createComponent('ext.Mailer.EMailer', true);
				// $mailer->setPathViews('application.views.mail');

				try {
					$mailer->IsMail();

					$from = 'noreply@' . Yii::app()->request->getServerName();
					$from_name = Yii::app()->name;

					$mailer->Sender = $from;
					$mailer->SetFrom($from, $from_name);
					$mailer->AddReplyTo($from, $from_name);

					foreach ($emails as $email) {
						$email = trim($email);

						if (!empty($email)) {
							$mailer->AddAddress($email);
						}
					}

					$mailer->CharSet = 'UTF-8';
					$mailer->ContentType = 'text/html';

					$mailer->Subject = 'Подписка на рассылку';

					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Посетитель подписался на рассылку.</p>
<p><strong>E-mail:</strong> {$model->mail}</p>
HTML;

					$mailer->Send();

					// send mail to client
					$mailer->ClearAllRecipients();
					$mailer->AddAddress($model->mail);

					$mailer->Subject = 'Подписка на рассылку';

					$mailer->Body = <<<HTML
<p>Добрый день!</p>
<p>Вы успешно подписались на рассылку!</p>
HTML;
					$mailer->Send();
				}
				catch (phpmailerException $e) {
					//echo $e->errorMessage();
					//$this->json = array('error' => 'Y', 'errorCode' => 'Ошибка при отправке письма! Попробуйте позже или свяжитесь с менеджером по телефону указанному на сайте');
				}

				$json_result = <<<HTML
Вы успешно подписались на рассылку!
HTML;

				$this->json = array(
					'msg' => $json_result,
				);
			}
			else {
				$errors = $model->jsonErrors();
				$this->json = array(
					'error' => true,
					'errorCode' => '', // implode("<br>\n", $errors['messages']),
					'errorFields' => $errors['fields'],
				);
			}
		}
		else {
			throw new CHttpException(400, 'Bad request!');
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			//echo $error['message'];
			$this->json = array('error' => 'Y', 'errorCode' => $error['message'], 'errorFields' => array());
		}
	}

	protected function afterAction($action)
	{
		header('Vary: Accept');

		if (strpos(Yii::app()->request->getAcceptTypes(), 'application/json') !== false) {
			header('Content-type: application/json; charset=utf-8');
		}

		echo json_encode($this->json);
		Yii::app()->end();
	}
}
