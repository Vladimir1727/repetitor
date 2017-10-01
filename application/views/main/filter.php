
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker-ru.js"></script>
<title>Репетиторы по разным языкам. Найти репетитора</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<input type="hidden" value="<?php echo ($filter) ? 1:0; ?>" id="filter">
<input type="hidden" value="<?php echo ($student) ? $student['id'] : 0; ?>" id="student_id">
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
						if ($filter && $filter['lang']){
							$find = false;
							switch ($filter['lang']) {
								case 'eng':
									if ($subject['subject']=="Английский язык"){
										$find = true;
									}
									break;
								case 'nem':
									if ($subject['subject']=="Немецкий язык"){
										$find = true;
									}
									break;
								case 'rus':
									if ($subject['subject']=="Русский язык"){
										$find = true;
									}
									break;
								case 'fra':
									if ($subject['subject']=="Французский язык"){
										$find = true;
									}
									break;
								case 'ita':
									if ($subject['subject']=="Итальянский язык"){
										$find = true;
									}
									break;
								case 'isp':
									if ($subject['subject']=="Испанский язык"){
										$find = true;
									}
									break;
								default:
									echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
									break;
							}
							if ($find){
								echo '<option value="'.$subject['id'].'" selected="selected">'.$subject['subject'].'</option>';
							} else{
								echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
							}
						} else{
							echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
						}
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
				<?php if ($filter){
					if ($filter['online']==1){
						echo '<input type="checkbox" id="online" checked="checked">';
					} else{
						echo '<input type="checkbox" id="online">';
					}
				} else{
					echo '<input type="checkbox" id="online">';
				}?>
				<span></span>
			</label>
		</div>
		<div class="col-lg-2 col-md-6 col-sx-12">
			<label><br><br>
				Профили с видео
				<input type="checkbox" id="video">
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
	<button id="show_filter">Показать Репетиторов</button>
</section>
<main class="filter">
	<section class="result" id="result">
		<?php
		if (count($repetitors) == 0){
			echo '<h2>Активые репетиторы отсутствуют</h2>';
		}
		foreach ($repetitors as $repetitor) {
			echo '<aside>';
			echo '<div class="avatar">';
			echo '<div class="img">';
			if (is_null($repetitor['avatar'])){
				echo '<img src="'.base_url().'img/avatar3.png" alt="empty avatar">';
			}
			$d = strrpos($repetitor['avatar'],'.');
			$av = substr($repetitor['avatar'], 0 , $d).'_thumb'.substr($repetitor['avatar'], $d);
			echo '<img src="'.base_url().'images/'.$av.'" alt="avatar">';
			echo '</div>';
			if (!is_null($repetitor['link']) && $repetitor['link']!=''){
				echo '<a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'#video"><span></span> Видео</a>';
			}
			echo '</div>';
			echo '<div class="info">';
			echo '<h2>';
			if ($repetitor['online']){
				echo '<span class="active">';
			} else{
				echo '<span>';
			}

			echo '</span><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'">'.$repetitor['first_name'].'</a></h2>';
			echo '<p><strong>Преподаёт: </strong><span>';
			$first = true;
			for ($k=0; $k < count($repetitor['subjects']) ; $k++) {
				if ($first == false){
					echo ' / ';
				} else{
					$first = false;
				}
				echo $repetitor['subjects'][$k];
			}
			echo '</span></p>';
			echo '<p class="lang_block"><strong>Родной язык:</strong> <span>'.$repetitor['language'].'</span></p>';
			echo '<div class="stars">';
			echo '<span class="star1"></span>';
			echo '<span class="star1"></span>';
			echo '<span class="star1"></span>';
			echo '<span class="star0"></span>';
			echo '<span class="star0"></span>';
			echo '</div>';
			echo '<p>';
			echo '<strong>Специализация: </strong>';
			echo '<span>';
			$first = true;
			for ($k=0; $k < count($repetitor['spec']) ; $k++) {
				if ($first == false){
					echo ' / ';
				} else{
					$first = false;
				}
				echo $repetitor['spec'][$k];
			}
			echo '</span>';
			echo '</p>';
			echo '<p><strong>Возрастные группы: </strong><span>';
			$first = true;
			for ($k=0; $k < count($repetitor['ages']) ; $k++) {
				if ($first == false){
					echo ' / ';
				} else{
					$first = false;
				}
				echo $repetitor['ages'][$k];
			}
			echo '</span></p><p><strong>Презентация: </strong>';
			echo '<span>';
			echo $repetitor['about'];
			echo '</span></p>';
			if ($student){
				echo '<a href="'.base_url().'index.php/student/addrepetitor/'.$repetitor['id'].'" class="favorites"><span></span> В избранное</a>';
			} else{
				echo '<a href="'.base_url().'index.php/main/remember?link=student/addrepetitor/'.$repetitor['id'].'" class="favorites"><span></span> В избранное</a>';
			}
			echo '<div class="price">';
			echo '<span>';
			if (count($repetitor['cost'])==1){
				echo $repetitor['cost'][0];
			} elseif($repetitor['cost'][0] == $repetitor['cost'][1]){
				echo $repetitor['cost'][0];
			} else{
				if ($repetitor['cost'][0]>$repetitor['cost'][1]){
					echo $repetitor['cost'][1].'-'.$repetitor['cost'][0];
				}else{
					echo $repetitor['cost'][0].'-'.$repetitor['cost'][1];
				}
			}
			echo '</span>$ <small>за час</small>';
			echo '</div>';
			if ($student){
				echo '<a href="'.base_url().'index.php/student/step1/'.$repetitor['id'].'" class="lesson">Записаться на урок</a>';
				echo '<a href="'.base_url().'index.php/student/chat?id='.$repetitor['id'].'" class="message">Написать сообщение</a>';
			} else{
				echo '<a href="'.base_url().'index.php/main/remember?link=student/step1/'.$repetitor['id'].'" class="lesson">Записаться на урок</a>';
				echo '<a href="'.base_url().'index.php/main/remember?link=student/chat?id='.$repetitor['id'].'" class="message">Написать сообщение</a>';
			}
			echo '<a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'#table" class="sh">Расписание</a>';
			echo '</div>';
			echo '</aside>';
		}
		 ?>
		<ul class="pagg" id="pagg">
			<li><a href="<?php echo base_url().'index.php/main/filter?page='.$pagg[0]; ?>"><</a></li>
			<?php
				for ($i=1; $i <count($pagg)-1 ; $i++) {
					echo '<li><a href="'.base_url().'index.php/main/filter?page='.$pagg[$i].'">'.$pagg[$i].'</a></li>';
				}
			 ?>
			<li><a href="<?php echo base_url().'index.php/main/filter?page='.$pagg[count($pagg)-1]; ?>">></a></li>
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
