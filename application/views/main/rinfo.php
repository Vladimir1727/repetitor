
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker-ru.js"></script>
<title>Репетиторы Real Language Club. Информация о репетиторе.</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<form class="hidden" id="step_form" action="<?php echo base_url(); ?>index.php/student/step2?subject=<?php echo $subject_id; ?>" method="post">
	<input type="hidden" value="<?php echo $repetitor['id']; ?>" id="repetitor_id" name="repetitor_id">
	<input type="hidden" value="<?php echo ($student) ? $student['id'] : 0; ?>" id="student_id">
	<input type="hidden" value="<?php echo $zone; ?>" id="student_zone">
	<input type="hidden" value="<?php echo $ztype; ?>" id="zone_type">
	<input type="hidden" value="<?php echo ($student) ? $student['first_name'] : ''; ?>" id="student">
	<input type="hidden" value="<?php echo $subject_id; ?>" id="subject_id" name="subject_id">
</form>
<main class="rep-info">
	<section class="result">
		<aside>
			<div class="avatar">
				<div class="img">
					<?php
					if (!is_null($repetitor['avatar']) && $repetitor['avatar']!=''){
						$d = strrpos($repetitor['avatar'],'.');
						$av = substr($repetitor['avatar'], 0 , $d).'_thumb'.substr($repetitor['avatar'], $d);
						echo '<img src="'.base_url().'images/'.$av.'" alt="avatar">';
					} else{
						echo '<img src="'.base_url().'img/avatar3.png" alt="avatar">';
					}

					?>
				</div>
				<div class="rzone">
					<?php echo $repetitor['zone_name']; ?>
				</div>
			</div>
			<div class="info">
				<h2>
					<?php if ($repetitor['online']){
						echo '<span class="active">';
					} else{
						echo '<span>';
					}
					echo '</span>';
					echo $repetitor['first_name'].' '.$repetitor['father_name'];
					?>
				</h2>
				<p><strong>Преподаёт:</strong><span>
					<?php
						echo $repetitor['subject'];
					 ?>
					</span>
				</p>
				<p><strong>Родной язык:</strong><span>
					<?php echo $repetitor['lang'] ?>
					</span>
				</p>
				<div class="stars">
					<?php
					$rating = $repetitor['reight'];
					for ($i=1; $i <= $rating ; $i++) {
						echo '<span class="star1"></span>';
					}
					for ($i=5; $i > $rating ; $i--) {
						echo '<span class="star0"></span>';
					}
					 ?>
				</div>
				<p>
					<strong>Специализация:</strong>
					<span>
					<?php
					$first = true;
					for ($k=0; $k < count($repetitor['spec']) ; $k++) {
						if ($first == false){
							echo ' / ';
						} else{
							$first = false;
						}
						echo $repetitor['spec'][$k];
					}
					 ?>
					</span>
				</p>
				<p><strong>Возрастные группы:</strong><span>
					<?php
				  $first = true;
				  for ($k=0; $k < count($repetitor['ages']) ; $k++) {
					  if ($first == false){
						  echo ' / ';
					  } else{
						  $first = false;
					  }
					  echo $repetitor['ages'][$k];
				  }
				   ?>
				  	</span>
				</p>
				<p><strong>Презентация:</strong>
					<span>
					<?php echo $repetitor['about']; ?>
					</span>
				</p>
				<?php
				if ($student){
					echo '<a href="'.base_url().'index.php/student/addrepetitor/'.$repetitor['id'].'?subject_id='.$subject_id.'" class="favorites"><span></span> В избранное</a>';
				} else{
					echo '<a href="'.base_url().'index.php/main/remember?link=student/addrepetitor/'.$repetitor['id'].'?subject_id='.$subject_id.'" class="favorites"><span></span> В избранное</a>';
				}
				 ?>
				<div class="price">
					<span>
					<?php
						echo round($repetitor['cost']);
					 ?>
					</span>$ <small>за час</small>
				</div>
				<?php
				if ($student){
					echo '<a href="'.base_url().'index.php/student/step1/'.$repetitor['id'].'?subject='.$subject_id.'" class="lesson"  id="step_one">Записаться на урок</a>';
					echo '<a href="'.base_url().'index.php/student/chat?id='.$repetitor['id'].'" class="message">Написать сообщение</a>';
				} else{
					echo '<a href="'.base_url().'index.php/main/remember?link=student/step1/'.$repetitor['id'].'?subject='.$subject_id.'" class="lesson" id="step_one">Записаться на урок</a>';
					echo '<a href="'.base_url().'index.php/main/remember?link=student/chat?id='.$repetitor['id'].'" class="message">Написать сообщение</a>';
				}
				 ?>
			</div>
		</aside>
		<aside class="sh">
			<header>
				<h2>Расписание</h2>
				<div class="tzone" id="s_zone">
				<?php
				if ($student){
					echo $student['zone_name'];
				}
				 ?>
				</div>
				<div class="pagg">
					<a href="#" id="prev"><</a>
						<!-- 31.07.2017 - 06.08.2017 -->
						<span  id="weeks">неделя</span>
					<a href="#" id="next">></a>
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
				<tbody id="table">
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
		<?php
		if(!is_null($repetitor['link']) && $repetitor['link']!=''){
			echo '<aside class="video" id="video"><iframe	src="';
			echo $repetitor['link'];
			echo '"></iframe></aside>';
		}
		 ?>

		<aside class="exp">
			<h2>Опыт работы</h2>
			<p><strong>Опыт работы:</strong> <span>
			<?php echo $repetitor['experience'] ?> лет
			</span></p>
			<p><strong>Опыт преподавания:</strong> <span><?php echo $repetitor['exp_comment']; ?></span></p>
			<p><strong>Образование:</strong> <span><?php echo $repetitor['university'].' '.$repetitor['specialty']; ?></span></p>
		</aside>
		<aside class="docs">
			<h2>Документы <span class="switch switch-down pull-right"></span></h2>
			<div>
			<?php
			if (!is_null($repetitor['doc1'])){
				$d = strrpos($repetitor['doc1'],'.');
				$av = substr($repetitor['doc1'], 0 , $d).'_thumb'.substr($repetitor['doc1'], $d);
				echo '<a href="'.base_url().'images/'.$repetitor['doc1'].'"><img src="'.base_url().'images/'.$av.'"></a>';
			}
			if (!is_null($repetitor['doc2'])){
				$d = strrpos($repetitor['doc2'],'.');
				$av = substr($repetitor['doc2'], 0 , $d).'_thumb'.substr($repetitor['doc2'], $d);
				echo '<a href="'.base_url().'images/'.$repetitor['doc2'].'"><img src="'.base_url().'images/'.$av.'"></a>';
			}
			 ?>
			</div>
		</aside>
		<aside class="feeds">
			<h2>Отзывы<span class="switch pull-right switch-down"></span></h2>
			<div>
				<?php if ($student && $can_feed): ?>
			<div class="form">
				<form action="../sendfeed" method="post">
					<div>
						<label>
							<input type="radio" name="rating" value="1">
							<span class="switch"></span>
							<span class="star1"></span>
							<span class="star0"></span>
							<span class="star0"></span>
							<span class="star0"></span>
							<span class="star0"></span>
						</label>
						<label>
							<input type="radio" name="rating" value="2">
							<span class="switch"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star0"></span>
							<span class="star0"></span>
							<span class="star0"></span>
						</label>
						<label>
							<input type="radio" name="rating" value="3">
							<span class="switch"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star0"></span>
							<span class="star0"></span>
						</label>
						<label>
							<input type="radio" name="rating" value="4">
							<span class="switch"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star0"></span>
						</label>
						<label>
							<input type="radio" name="rating" value="5" checked="checked">
							<span class="switch"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
							<span class="star1"></span>
						</label>
					</div>
					<div>
						<textarea id="about" name="about"></textarea>
						<button type="submit" id="send_feed">Оставить отзыв</button>
						<input type="hidden" name="repetitor_id" value="<?php echo $repetitor['id']; ?>">
						<input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
						<input type="hidden" name="back" value="<?php echo '/main/rinfo/'.$repetitor['id'].'?subject='.$subject_id; ?>">
					</div>
				</form>
			</div>
		<?php endif; ?>
				<!-- <div class="feed">
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
				</div> -->
				<?php
				foreach ($feeds as $feed) {
					echo '<div class="feed">';
					echo '<h3>';
					if (is_null($feed['first_name'])){
						echo 'Без имени';
					} else{
						echo $feed['first_name'];
					}
					if (!is_null($feed['father_name'])){
						echo ' '.$feed['father_name'];
					}
					echo '</h3>';
					echo '<p>'.$feed['about'].'</p>';
					echo '<div class="stars">';
					for ($i=1; $i <= $feed['rating'] ; $i++) {
						echo '<span class="star1"></span>';
					}
					for ($i=5; $i > $feed['rating'] ; $i--) {
						echo '<span class="star0"></span>';
					}
					echo '</div>';
					echo '</div>';
				}
				 ?>
			</div>
		</aside>
		<?php
		if ($student){
			echo '<a href="'.base_url().'index.php/student/step1/'.$repetitor['id'].'?subject='.$subject_id.'" class="lesson" id="next_step">Записаться на урок</a>';
		} else{
			echo '<a href="'.base_url().'index.php/main/remember?link=student/step1/'.$repetitor['id'].'?subject='.$subject_id.'" class="lesson">Записаться на урок</a>';
		}

		?>
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
