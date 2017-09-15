
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker-ru.js"></script>
<title>Репетиторы по разным языкам. Информация о репетиторе.</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<input type="hidden" value="<?php echo $repetitor['id']; ?>" id="repetitor_id">
<input type="hidden" value="<?php echo ($student) ? $student['id'] : 0; ?>" id="student_id">
<input type="hidden" value="<?php echo ($student) ? $student['zone_time'] : 0; ?>" id="student_zone">
<main class="rep-info">
	<section class="result">
		<aside>
			<div class="avatar">
				<div class="img">
					<?php
					$d = strrpos($repetitor['avatar'],'.');
					$av = substr($repetitor['avatar'], 0 , $d).'_thumb'.substr($repetitor['avatar'], $d);
					echo '<img src="'.base_url().'images/'.$av.'" alt="avatar">';
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
					$first = true;
					for ($k=1; $k <= $repetitor['sub_num']; $k++) {
						if ($first == false){
							echo ' / ';
						} else{
							$first = false;
						}
						echo $repetitor['sub'.$k.'_name'];
					}
					 ?>
					</span>
				</p>
				<p><strong>Родной язык:</strong><span>
					<?php echo $repetitor['lang'] ?>
					</span>
				</p>
				<div class="stars">
					<span class="star1"></span>
					<span class="star1"></span>
					<span class="star1"></span>
					<span class="star0"></span>
					<span class="star0"></span>
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
				<a href="#" class="favorites"><span></span> В избранное</a>

				<div class="price">
					<span>
					<?php
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
					 ?>
					</span>$ <small>за час</small>
				</div>
				<a href="#" class="lesson">Записаться на урок</a>
				<a href="#" class="message">Написать сообщение</a>
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
		<aside class="video">
			<iframe	src="<?php echo $repetitor['link'];?>">
			</iframe>
		</aside>
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
			</div>
		</aside>
		<?php
		if ($student){
			echo '<a href="#" class="lesson">Записаться на урок</a>';
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
