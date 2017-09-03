
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. О нас</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<section class="one-rep">
	<h1>НАШИ ПРЕИМУЩЕСТВА - ВАШ УСПЕХ</h1>
	<h2>Платформа  Real Language Club - лучшее место <br> для встречи Ученика и Репетитора!</h2>
	<h2>
		Мы ищем преподавателей иностранных языков. Мы ценим профессионализм, честность, ответственность и ожидаем от Вас внимательное и отзывчивое  отношение к каждому ученику. Если Вы разделяете наши ценности, добро пожаловать в команду репетиторов Real Language Club!
	</h2>
	<br>
	<h2>Регистрируйтесь на сайте, планируйте свое расписание и начинайте зарабатывать!</h2>
</section>
<section class="reg up">
	<form class="registration" action="<?php echo base_url(); ?>index.php/repetitor/login" method="post" id="f1">
		<input type="text" name="email" placeholder="Введите e-mail">
		<input type="password" name="pass" placeholder="Введите пароль">
		<input type="submit" value="Создать Профиль" id="but1">
	</form>
</section>
<section class="work">
	<h2>Работать с нами выгодно и удобно</h2>
	<ul>
		<li>Вы сами планируете свое расписание.</li>
		<li>Вы сами формируете цену урока.</li>
		<li>Вы сами определяете методику преподавания иностранного языка.</li>
		<li>Вам гарантирована оплата проведённых уроков.</li>
		<li>Вы получаете компенсацию уроков, отменённых менее чем за 12 часов.</li>
	</ul>
</section>
<section class="stream">
	<h2>
		А мы обеспечим Вас постоянным потоком потенциальных учеников!
	</h2>
</section>
<section  class="start-rep">
	<h2>НАЧАТЬ РАБОТАТЬ С НАМИ БЫСТРО И ПРОСТО</h2>
	<h3>3 простых шага</h3>
	<aside>
		<div class="step">
			<img src="<?php echo base_url(); ?>img/regok.png" alt="repetitor">
			<h4>Зарегистрируйтесь на сайте</h4>
			<p>
				Получите удобный личный кабинет для работы с учениками.
			</p>
		</div>
		<div class="arrow">
			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
		</div>
		<div class="step">
			<img src="<?php echo base_url(); ?>img/step1.png" alt="calendar">
			<h4>Создайте профиль</h4>
			<p>
				Наполните свой профиль интересной и полезной информацией, чтобы привлечь внимание учеников.
			</p>
		</div>
		<div class="arrow">
			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
		</div>
		<div class="step">
			<img src="<?php echo base_url(); ?>img/step2.png" alt="wallet">
			<h4>Откройте расписание</h4>
			<p>
			В расписании укажите свободные часы, когда Вы готовы проводить уроки.
			</p>
		</div>
	</aside>
</section>
<section class="popular">
	<h2>Популярные вопросы:</h2>
</section>
<section class="instruction">
	<aside>
		<div>
			<h3>Сколько я могу заработать?</h3>
			<p>
				Все зависит от выбранной почасовой оплаты, качества профиля и вашей занятости.
				Наша комиссия составляет 30%. Вы формируете вашу цену с учётом нашей комиссии.
			</p>
		</div>
		<div>
			<h3>Как я смогу получить деньги?</h3>
			<p>
				Поступившие на ваш баланс средства могут быть выведены с Real Language Club в любой момент, через платежные системы Яндекс.Деньги, Paypal или на карт-счёт.
			</p>
		</div>
		<div>
			<h3>Это бесплатно?</h3>
			<p>
				Да, бесплатно. Нет никаких сборов. Платформа получает 30% от фактически проведённых вами занятий.
			</p>
		</div>
		<div>
			<h3>Обязательно ли иметь диплом преподавателя?</h3>
			<p>
				Нет, не обязательно. Хотя опыт преподавания, безусловно, увеличит ваши шансы на привлечение учеников через платформу. Однако, если вы просто обладаете должными знаниями и умениями, вы также можете зарегистрироваться на Real Language Club в качестве репетитора.
			</p>
		</div>
	</aside>
	<aside>
		<div>
			<h3>Как зарегистрироваться в качестве репетитора на Real Language Club?</h3>
			<p>
				Быстро и легко. Создайте профиль, используя форму ниже.
			</p>
		</div>
		<div>
			<h3>Когда я получу ответ от Real Language Club?</h3>
			<p>
				В течении 24 часов. В связи с большим количеством заявок от репетиторов, которые мы получаем, от нас будут получать ответ только принятые преподаватели. Обратите внимание, что профили без реальной фотографии и не заполненной анкеты не пройдут отбор.
			</p>
		</div>
		<div>
			<h3>Как платформа помогает найти учеников?</h3>
			<p>
				Мы показываем ваш профиль в поисковых выдачах на платформе. Позиция профиля репетитора в поиске зависит от следующих факторов: наличие расписания в профиле; качество и наполненность вашего профиля; среднее время ответа на заявки и сообщения учеников. Ученики видят ваш профиль и делают вам запрос.<br>
				Кроме того, в разделе «Свободные заявки» вы можете сами отвечать на заявки учеников.
			</p>
		</div>
	</aside>
</section>
<section class="more">
	<h2>Больше информации Вы найдете  <a href="https://reallanguage.club/voprosy-i-otvety-po-rabote-s-platformoj-repetitory-real-language-club/">здесь >></a></h2>
</section>
<section class="berep">
	<h2>Станьте репетитором на real language club</h2>
</section>
<section class="reg down">
	<form class="registration" action="index.html" method="post">
		<input type="text" name="email" placeholder="Введите e-mail">
		<input type="password" name="pass" placeholder="Введите пароль">
		<input type="submit" value="Создать Профиль">
	</form>
</section>
<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/repreg.js"></script>
