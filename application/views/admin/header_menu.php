<div class="admin-header">
	<section>
		<div class="logo">
			<a href="https://reallanguage.club">
				<img src="<?php echo base_url(); ?>img/main_logo.png" alt="logo">
			</a>
		</div>
		<div class="menu">
			<ul>
				<li><a href="<?php echo base_url(); ?>index.php/admin/repetitors">Репетиторы</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/admin/students">Ученики</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/admin/requests">Запросы на уроки</a></li>
				<li><a href="<?php echo base_url(); ?>index.php/admin/lessonshistory">История уроков</a></li>
								<li><a href="<?php echo base_url(); ?>index.php/admin/freerequests">Свободные заявки</a></li>
				<li class="mail"><a href="<?php echo base_url(); ?>index.php/admin/chat">почта</a>
				<?php if ($new_chat > 0) {
					echo '<span>';
					echo $new_chat;
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
						<li><a href="<?php echo base_url(); ?>index.php/admin/repetitors">Репетиторы</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/students">Ученики</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/requests">Запросы на уроки</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/lessonshistory">История уроков</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/freerequests">Свободные заявки</a></li>
						<li class="mail"><a href="<?php echo base_url(); ?>index.php/admin/chat">почта</a>
						<?php if ($new_chat > 0) {
							echo '<span>';
							echo $new_chat;
							echo '</span>';
						} ?></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/payback">Запросы <br>на вывод $</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/chathistory">История чатов</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/feeds">Отзывы</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/prerep">Кандидаты в репетиторы</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/admin/logout">Выйти</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</section>
</div>
