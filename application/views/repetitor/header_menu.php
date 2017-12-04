<div class="rep-header">

	<section>
		<div class="logo">
			<a href="https://reallanguage.club">
				<img src="<?php echo base_url(); ?>img/main_logo.png" alt="logo">
			</a>
		</div>
		<div class="avatar">
			<div class="img" id="avatar-main">

				<?php
					if (is_null($repetitor['avatar'])){
						echo '<img src="'.base_url().'img/avatar3.png" alt="empty avarat">';
					} else{
						$d = strrpos($repetitor['avatar'],'.');
						$av = substr($repetitor['avatar'], 0 , $d).'_thumb'.substr($repetitor['avatar'], $d);
						echo '<img src="../../images/'.$av.'" alt="avarat">';
					}
				?>
			</div>

			<?php
			if ($repetitor['online']){
				echo '<div class="switch on" id="rep-online"></div>';
			} else{
				echo '<div class="switch off" id="rep-online"></div>';
			}
			 ?>
			<h3>
				<?php
				if ($repetitor['first_name'] != ''){
					echo $repetitor['first_name'];
				} else {
					echo $repetitor['email'];
				}
				 ?>
			</h3>
			<h4>
				<?php
				$len = strlen(strval($repetitor['id']));
				for($i = 0; $i < (7-$len); $i++){
					echo '0';
				}
				echo $repetitor['id'];
				 ?>
			</h4>
		</div>
		<div class="balance">
			<p>Баланс <span><?php echo $repetitor['balance']; ?></span> $</p>
		</div>
		<div class="menu">
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/repetitor/lessonsrequests">Запросы на уроки</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/repetitor/lessons">Уроки</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/repetitor/timetable">Расписание</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/repetitor/freerequests">Свободные заявки</a></li>
				<li class="mail"><a href="<?php echo base_url(); ?>index.php/repetitor/chat">почта</a>
					<?php if ($repetitor['new'] > 0) {
						echo '<span>';
						echo $repetitor['new'];
						echo '</span>';
					} ?>
				</li>
				<li id="slide">
					<a href="#">
						<span class="s"></span>
						<span class="s"></span>
						<span class="s"></span>
					</a>
					<ul>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/lessonsrequests">Запросы на уроки</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/lessons">Уроки</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/timetable">Расписание</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/freerequests">Свободные заявки</a></li>
						<li class="mail"><a href="<?php echo base_url(); ?>index.php/repetitor/chat">почта</a>
							<?php if ($repetitor['new'] > 0) {
								echo '<span>';
								echo $repetitor['new'];
								echo '</span>';
							} ?>
						</li>
						<?php
						$rpage = 0;
						if (!is_null($repetitor['subject1'])){
							$rpage ++;
							echo '<li><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'?subject='.$repetitor['subject1'].'">Моя страница '.$rpage.'</a></li>';
						}
						if (!is_null($repetitor['subject2'])){
							$rpage ++;
							echo '<li><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'?subject='.$repetitor['subject2'].'">Моя страница '.$rpage.'</a></li>';
						}
						 ?>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/history">История уроков</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/balance">Баланс</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/profile">Настройки Профиля</a></li>
						<li><a href="https://reallanguage.club/instrukciya-dlya-repetitora-po-rabote-s-platformoj-repetitory-real-language-club/">Инструкция для репетитора</a></li>
						<li><a href="https://reallanguage.club/video-instrukcii-dlya-repetitora/">Видеоинструкции</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/chat?id=0">Связаться с администратором</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/repetitor/logout">Выйти</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</section>
</div>
