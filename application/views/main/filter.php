
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker-ru.js"></script>
<title>Репетиторы по разным языкам. Найти репетитора</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<section class="wellcome">
	<h1>Добро пожаловать на платформу «Репетиторы» Real Language Club!</h1>
	<ul>
		<li>Изучайте иностранный язык по скайпу с лучшими учителями, которых мы отобрали для Вас!</li>
		<li>Вы можете выбрать репетитора  по критериям, исходя из Ваших потребностей.</li>
		<li>Или  Вы можете оставить свободную заявку со своими пожеланиями, и репетитор сам свяжется с Вами.</li>
		<li>Вы можете заказать срочный урок.</li>
		<li>Наши репетиторы к Вашим услугам 24/7.</li>
	</ul>
	<h5>Подробнее о преимуществах обучения на нашей платформе Вы можете <a href="<?php echo base_url();?>index.php/main/about">прочитать здесь >>></a></h5>
</section>
<section class="filter">
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sx-12">
			<h5>Предмет</h5>
			<select id="subject_select">
				<option value="0">Выберите</option>
				<?php
					foreach ($subjects as $subject) {
						echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<h5>Возраст ученика</h5>
			<select id="age_select">
				<option>Выберите</option>
				<?php
					foreach ($ages as $option) {
						echo '<option value="'.$option['id'].'">'.$option['age'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<h5>Специализация</h5>
			<select id="spec_select">
				<option>Выберите</option>
				<?php
				//var_dump($specializations);
					foreach ($specializations as $option) {
						echo '<option value="'.$option['id'].'">'.$option['specialization'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="col-lg-2  col-md-6 col-sx-12">
			<h5>Дата</h5>
			<input type="text" id="lesson-date">
		</div>
		<div class="col-lg-3 col-md-12 col-sx-12">
			<h5>Время*</h5>
			<div id="time-slider"></div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sx-4 text-left">
					0
				</div>
				<div class="col-lg-4 col-md-4 col-sx-4 text-center">
					<span id="time-range">10-18</span>
				</div>
				<div class="col-lg-4  col-md-4 col-sx-4 text-right">
					24
				</div>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-lg-3 col-md-6 col-sx-12">
			<h5>Родной язык репетитора</h5>
			<select id="lang_select">
				<option>Выберите</option>
				<?php
					foreach ($languages as $option) {
						echo '<option value="'.$option['id'].'">'.$option['language'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<h5>Уровень Ученика</h5>
			<select id="level_select">
				<option>Выберите</option>
				<?php
					foreach ($levels as $option) {
						echo '<option value="'.$option['id'].'">'.$option['level'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<label><br><br>
				Сейчас онлайн
				<input type="checkbox">
				<span></span>
			</label>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<label><br><br>
				Профили с видео
				<input type="checkbox">
				<span></span>
			</label>
		</div>
		<div class="col-lg-3 col-md-12 col-sm-12">
			<h5>Стоимость часа</h5>
			<div id="cost-slider"></div>
			<div class="row">
				<div class="col-md-4 text-left">
					0
				</div>
				<div class="col-md-4 text-center">
					<span id="cost-range">1-11</span>
				</div>
				<div class="col-md-4 text-right">
					50
				</div>
			</div>
		</div>
	</div>
	<p>
		*Система автоматически определяет часовой пояс пользователя и в графе «Время» показывает время пользователя
	</p>
	<button>Показать Репетиторов</button>
</section>
<main class="filter">
	<section class="result">
		<aside>
			<div class="avatar">
				<div class="img">
					<img src="<?php echo base_url(); ?>img/avatar.png" alt="avatar">
				</div>
				<a href="#"><span></span> Видео</a>
			</div>
			<div class="info">
				<h2><span class="active"></span><a href="#">Анна</a></h2>
				<p><strong>Преподаёт:</strong><span>английский язык</span></p>
				<p class="lang_block"><strong>Родной язык:</strong><span>русский</span></p>
				<div class="stars">
					<span class="star1"></span>
					<span class="star1"></span>
					<span class="star1"></span>
					<span class="star0"></span>
					<span class="star0"></span>
				</div>
				<p>
					<strong>Специализация:</strong>
					<span>Разговорный язык / ГИА, ОГЭ / ЕГЭ / Подготовка к экзаменам / Язык с нуля /
Деловой язык / Туризм / Для учёбы за рубежом / Грамматика / Повышение успеваемости /
Помощь при выполнении домашнего задания / Подготовка к Международным экзаменам /
Подготовка к олимпиаде</span>
				</p>
				<p><strong>Возрастные группы:</strong><span>  Начальная школа (1-4 класс) / Средняя школа (5-9 класс)</span></p>
				<p><strong>Презентация:</strong>
					<span>Говорить по английски легко! Это вы увидите уже на первом занятии. Моя цель научить вас говорить и быть уверенным, не бояться ошибаться. Я использую как хорошо зарекомендовавшие себя методики, так и собственные наработки.
Мы смотрим фильмы, обсуждаем интересные для вас темы и постепенно вы научаетесь свободно использовать английский язык в любых ситуациях - на работе, в путешествиях...
</span></p>
				<a href="#" class="favorites"><span></span> В избранное</a>

				<div class="price">
					<span>10</span>$ <small>за час</small>
				</div>
				<a href="#" class="lesson">Записаться на урок</a>
				<a href="#" class="message">Написать сообщение</a>
				<a href="#" class="sh">Расписание</a>
			</div>
		</aside>
		<ul class="pagg">
			<li><a href="#"><</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">></a></li>
		</ul>
	</section>
	<section class="info">
		<h3>Советы</h3>
		<ol>
			<li>
				<span>
				Если Вам необходим срочный урок – поставьте напротив фильтра «Сейчас онлайн» галочку,  выберите подходящего Вам репетитора и начинайте урок!
				</span>
			</li>
			<li><span>
				Если Вам нужно запланировать первый урок на определенное время, воспользуйтесь фильтрами «Дата» и «Время». Однако в данном случае выбор репетиторов заметно сузится. Наш совет: без крайней необходимости не используйте данные фильтры.
				</span>
			</li>
			<li><span>
				Если у Вас есть вопросы, Вы можете задать их в личном кабинете администратору в чате. Мы всегда рады помочь Вам! Наши администраторы готовы ответить на Ваши вопросы 24/7.
				</span>
			</li>
		</ol>
	</section>
</main>
<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/filter.js"></script>
