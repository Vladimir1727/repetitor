<div class="student-header">
	<section>
		<div class="logo">
			<a href="https://reallanguage.club">
				<img src="<?php echo base_url(); ?>img/main_logo.png" alt="logo">
			</a>
		</div>
		<div class="avatar">
			<div class="img" id="avatar-main">
				<?php
					if (is_null($student['avatar'])){
						echo '<img src="'.base_url().'img/avatar3.png" alt="empty avarat">';
					} else{
						$d = strrpos($student['avatar'],'.');
                        $av = substr($student['avatar'], 0 , $d).'_thumb'.substr($student['avatar'], $d);
                        echo '<img src="../../images/'.$av.'" alt="avarat">';
					}
				?>
			</div>
			<div class="switch on" id="student-online"></div>
			<h3>
				<?php
				if ($student['first_name'] != ''){
					echo $student['first_name'];
				} else {
					echo $student['email'];
				}
				 ?>
			</h3>
			<h4>
				<?php
				$len = strlen(strval($student['id']));
				for($i = 0; $i < (7-$len); $i++){
					echo '0';
				}
				echo $student['id'];
				 ?>
			</h4>
		</div>
		<div class="balance">
			<p>Баланс <span>0</span> $</p>
			<a href="#" id="add_balance">Пополнить</a>
		</div>
		<div class="menu">
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/student/lessonsrequest">Запросы на уроки</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/student/lessons">Уроки</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/main/filter?lang=all">Найти репетитора</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/student/freerequests">Свободные заявки</a></li>
				<li class="mail"><a href="<?php echo base_url(); ?>index.php/student/chat">почта</a></li>
				<li id="slide">
					<a href="#">
						<span class="s"></span>
						<span class="s"></span>
						<span class="s"></span>
					</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>index.php/student/lessonsrequest">Запросы на уроки</a></li>
						<li><a href="#">Уроки</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/main/filter?lang=all">Найти репетитора</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/freerequests">Свободные заявки</a></li>
						<li class="mail"><a href="<?php echo base_url(); ?>index.php/student/chat">почта</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/main/filter?lang=all&free=1">Репетиторы сейчас онлайн</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/favorites">Избранные Репетиторы</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/history">История уроков</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/balance">Баланс кошелька</a></li>
						<li><a href="https://reallanguage.club/instrukciya-dlya-uchenika-po-rabote-s-platformoj-repetitory-real-language-club/">Инструкция для ученика</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/chat">Связаться с администратором</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/profile">Настройки Профиля</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/student/logout">Выйти</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</section>
</div>
