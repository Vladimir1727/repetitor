
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/rinfo.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker-ru.js"></script>
<title>Репетиторы по разным языкам. Найти репетитора</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<main>
	<section class="result">
		<aside>
			<div class="avatar">
				<div class="img">
					<img src="<?php echo base_url(); ?>img/avatar.png" alt="avatar">
				</div>
				<div class="rzone">
					Москва UTC +01:00
				</div>
			</div>
			<div class="info">
				<h2><span class="active"></span>Анна</h2>
				<p><strong>Преподаёт:</strong><span>английский язык</span></p>
				<p><strong>Родной язык:</strong><span>русский</span></p>
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
			</div>
		</aside>
		<aside class="sh">
			<header>
				<h2>Расписание</h2>
				<div class="tzone">
					Москва UTC+01:00
				</div>
				<div class="pagg">
					<a href="#"><</a>
						31.07.2017 - 06.08.2017
					<a href="#">></a>
				</div>
			</header>
			<table>
				<thead>
					<tr>
						<th>Время</th>
						<th>П<span class="hide">о</span>н<span class="hide">едельник</span></th>
						<th>Вт<span class="hide">орник</span></th>
						<th>Ср<span class="hide">еда</span></th>
						<th>Ч<span class="hide">е</span>т<span class="hide">верг</span></th>
						<th>П<span class="hide">я</span>т<span class="hide">ница</span></th>
						<th>С<span class="hide">у</span>б<span class="hide">бота</span></th>
						<th>В<span class="hide">о</span>с<span class="hide">кресенье</span></th>
					</tr>
				</thead>
				<tbody>
					<tr> <td>0:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>1:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>2:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>3:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>4:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>5:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>6:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>7:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>8:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>9:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>10:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>11:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
					<tr> <td>12:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
					<tr> <td>13:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
					<tr> <td>14:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>15:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>16:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>17:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>18:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>19:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>20:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>21:00</td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>22:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
					<tr> <td>23:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>

				</tbody>
			</table>
		</aside>
		<aside class="video">
			<iframe	src="https://www.youtube.com/embed/P5EcDas4BZM">
			</iframe>
		</aside>
		<aside class="exp">
			<h2>Опыт работы</h2>
			<p><strong>Опыт работы:</strong> <span>11 лет</span></p>
			<p><strong>Опыт преподавания:</strong> <span>Опыт преподавания английского языка 9 лет</span></p>
			<p><strong>Образование:</strong> <span>Агинский колледж</span></p>
		</aside>
		<aside class="docs">
			<h2>Документы <span class="switch switch-down pull-right"></span></h2>
			<div>
				<a href="<?php echo base_url(); ?>img/doc1.png"><img src="<?php echo base_url(); ?>img/doc1.png" alt="document 1"></a>
				<a href="<?php echo base_url(); ?>img/doc2.png"><img src="<?php echo base_url(); ?>img/doc2.png" alt="document 2"></a>
			</div>
		</aside>
		<aside class="feeds">
			<h2>Отзывы<span class="switch pull-right switch-down"></span></h2>
			<div>
				<div class="feed">
					<h3>Anna</h3>
					<p>
						Нужно было быстро подготовиться к поездке за границу, переживала насчет “трудностей понимания”. За короткий период с Натальей прошли основные темы по теме - вообщем поездка прошла отлично. Главное не было шока и ступора, когда нужно было спросить или ответить.
					</p>
					<div class="stars">
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star0"></span>
						<span class="star0"></span>
					</div>
				</div>
				<div class="feed">
					<h3>Igor</h3>
					<p>
						Спасибо за помощь в победе над языковым барьером, очень долго самостоятельно не мог преодолеть этот порог, стеснялся говорить. Благодаря Наталье достаточно быстро разговорился. Спасибо за помощь.
					</p>
					<div class="stars">
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star0"></span>
						<span class="star0"></span>
					</div>
				</div>
				<div class="feed">
					<h3>Anna</h3>
					<p>
						Нужно было быстро подготовиться к поездке за границу, переживала насчет “трудностей понимания”. За короткий период с Натальей прошли основные темы по теме - вообщем поездка прошла отлично. Главное не было шока и ступора, когда нужно было спросить или ответить.
					</p>
					<div class="stars">
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star0"></span>
						<span class="star0"></span>
					</div>
				</div>
				<div class="feed">
					<h3>Igor</h3>
					<p>
						Спасибо за помощь в победе над языковым барьером, очень долго самостоятельно не мог преодолеть этот порог, стеснялся говорить. Благодаря Наталье достаточно быстро разговорился. Спасибо за помощь.
					</p>
					<div class="stars">
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star0"></span>
						<span class="star0"></span>
					</div>
				</div>
				<div class="feed">
					<h3>Igor</h3>
					<p>
						Спасибо за помощь в победе над языковым барьером, очень долго самостоятельно не мог преодолеть этот порог, стеснялся говорить. Благодаря Наталье достаточно быстро разговорился. Спасибо за помощь.
					</p>
					<div class="stars">
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star1"></span>
						<span class="star0"></span>
						<span class="star0"></span>
					</div>
				</div>
			</div>
		</aside>
		<a href="#" class="lesson">Записаться на урок</a>
	</section>
	<section class="info">
		<h3>Советы</h3>
		<ol>
			<li>
				<span>
				Если Вам понравился профиль репетитора, но остались какие-либо вопросы, Вы можете задать их репетитору, отправив сообщение в чате.
				</span>
			</li>
			<li><span>
				Если Вы планируете заниматься более одного урока с данным репетитором, запланируйте сразу несколько ближайших уроков, т. к. расписание доступно в режиме онлайн всем ученикам, и позже удобное для вас время может быть занято.
				</span>
			</li>
			<li><span>
				Оставляйте отзывы о репетиторах, чтобы помочь другим ученикам сделать правильный выбор.
				</span>
			</li>
		</ol>
	</section>
</main>
<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/rinfo.js"></script>
