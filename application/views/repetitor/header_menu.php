<div class="rep-header">
	<section>
		<div class="logo">
			<img src="<?php echo base_url(); ?>img/main_logo.png" alt="logo">
		</div>
		<div class="avatar">
			<div class="img" id="avatar-main">
				<?php
					if (is_null($repetitor['avatar'])){
						echo '<img src="'.base_url().'img/avatar3.png" alt="empty avarat" style="padding-top: 30px">';
					} else{
						echo '<img src="../../images/'.$repetitor['avatar'].'" alt="avarat">';
					}
				?>
			</div>
			<div class="switch on" id="rep-online"></div>
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
			<p>Баланс <span>0</span> $</p>
		</div>
		<div class="menu">
			<ul>
				<li><a href="#">Запросы на уроки</a></li>
				<li><a href="#">Уроки</a></li>
				<li><a href="#">Расписание</a></li>
				<li><a href="#">Свободные заявки</a></li>
				<li class="mail"><a href="#">почта</a></li>
				<li id="slide">
					<a href="#">
						<span class="s"></span>
						<span class="s"></span>
						<span class="s"></span>
					</a>
					<ul>
						<li><a href="#">Запросы на уроки</a></li>
						<li><a href="#">Уроки</a></li>
						<li><a href="#">Расписание</a></li>
						<li><a href="#">Свободные заявки</a></li>
						<li class="mail"><a href="#">почта</a></li>
						<li><a href="#">История уроков</a></li>
						<li><a href="#">Баланс</a></li>
						<li><a href="#">Настройки Профиля</a></li>
						<li><a href="#">Инструкция для репетитора</a></li>
						<li><a href="#">Связаться с администратором</a></li>
						<li><a href="#">Выйти</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</section>
</div>
