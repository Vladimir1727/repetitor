<?php
/* @var $this SiteController */
?>
<?php
$assetsUrl = Yii::app()->assetManager->getBaseUrl();
$staticUrl = $assetsUrl . '/static/' . Yii::app()->params->settings['REV'];
?>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<div class="layout-header">
	<div class="layout-container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="left-header">
					<div class="logo">
						<a href="<?=Yii::app()->homeUrl?>" class="logo-link">
							<img class="lazy" data-original="<?=$staticUrl?>/images/logo.png" alt="">
						</a>
					</div>
				</div>
				<ul class="nav">
					<a type="button" class="close close-menu"><span aria-hidden="true">×</span></a>
					<li><a class="spy-link" href="#who-we">Кто мы</a></li>
					<li><a class="spy-link" href="#programs">Программы</a></li>
					<li><a class="spy-link" href="#how-it-works">Как это работает</a></li>
					<li><a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLScmA_Qc1ke6IuaoB5dqFIT7tDtlZetxzerDgcOpZENTI9JA_Q/viewform">Анкета</a></li>
					<li><a class="spy-link" href="#contacts">Контакты</a></li>
				</ul>
				<div class="social-header">
					<div class="facebook">
						<?php if (!empty(Yii::app()->params->settings['vk'])) { ?>
							<a target="_blank" href="<?=CHtml::encode(Yii::app()->params->settings['vk'])?>" class="aw-instagram"></a>
							<?php } ?>
							<?php if (!empty(Yii::app()->params->settings['facebook'])) { ?>
								<a target="_blank"  href="<?=CHtml::encode(Yii::app()->params->settings['facebook'])?>" class="fr-fb"></a>
								<?php } ?>
							</div>
							<div class="vk"></div>
						</div>
						<div class="right-header">
							<div class="order-btn-cont">
								<span class="h-phone-wrap">
									<span class="h-phone"><?=CHtml::encode($texts['phone'])?></span>
									<button class="btn order-btn invert-btn" onclick="yaCounter38015400.reachGoal('ORDERCALL'); return true;" data-toggle="modal" data-target="#order-modal"><?=CHtml::encode($texts['button_title1'])?></button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="menu-icon"><div class="hamb"></div></div>
		</div>

		<?php if (!empty($slides)) { $total_slides = count($slides); ?>
			<section class="head-section">
				<div class="head-wrap">
					<div id="myCarousel" data-original="<?=$staticUrl?>/images/bg_1.jpg" class="lazy carousel slide carousel-top" data-ride="carousel" data-interval="8000" data-pause="" style="background-image: url('img/grey.gif');">
						<div class="carousel-inner" role="listbox">
							<?php foreach ($slides as $index => $slide) { ?>
								<?php
								if (!empty($slide['slide_photo'])) {
									$photo = json_decode($slide['slide_photo'], true);
									$photo = $assetsUrl . '/slide/' . $photo['file'];
								}
								else {
								$photo = ''; // $staticUrl . '/images/bg_1.jpg';
							}
							?>
							<div class="item"<?php if (!empty($photo)) { ?> style="background-image: url(<?=$photo?>)"<?php } ?>>
								<div class="container">
									<div class="layout-container">
										<div class="head-content">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<h2><?=CHtml::encode($slide['slide_name'])?></h2>
													<div class="row">
														<div class="col-lg-2 -col-md-2 col-sm-2"></div>
														<div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
															<p class="h3"><?=CHtml::encode($slide['slide_text'])?></p>
														</div>
													</div>
												</div>
											</div>
											<div class="slide-btn">
												<button class="btn head-order-btn big-btn" onclick="yaCounter38015400.reachGoal('ORDERPROG'); return true;" data-toggle="modal" data-target="#order-modal"><?=CHtml::encode($texts['button_title2'])?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					<?php if ($total_slides > 1) { ?>
					<div class="carousel-control-wrap">
						<div class="layout-container carousel-controllers-container">
							<div class="row hidden"><div class="col-lg-12 col-md-12">
								<ol class="carousel-indicators">
									<?php for ($i = 0; $i < $total_slides; $i++) { ?>
										<li data-target="#myCarousel" data-slide-to="<?=$i?>"<?php if ($i == 0) { ?> class="active"<?php } ?>></li>
										<?php } ?>
									</ol>
								</div></div>
								<div class="row hidden">
									<div class="col-lg-12 col-md-12">
										<div class="counter">
											<span class="bold-num">1</span>/<span class="number-of-slides"><?=$total_slides?></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-md-12">
										<a class="carousel-control fr-arrow left" href="#myCarousel" role="button" data-slide="prev">
										</a>
										<a class="carousel-control fr-arrow right" href="#myCarousel" role="button" data-slide="next">
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="arrow-down-scroll">
					<span class="fr-arrow"></span>
				</div>
			</section>
			<?php } ?>

			<div class="layout-content">


				<section id="tabs-main" class="tabs-main">
					<div class="layout-container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<ul class="nav nav-tabs">
									<li><a data-toggle="tab" href="#busy"><?=CHtml::encode($texts['tabs_title1'])?></a></li>
									<li class="active"><a data-toggle="tab" href="#fitness"><?=CHtml::encode($texts['tabs_title2'])?></a></li>
									<li><a data-toggle="tab" href="#sport"><?=CHtml::encode($texts['tabs_title3'])?></a></li>
								</ul>

								<div class="tab-content">
									<h2 class="accordion-content-title"><a data-toggle="tab" href="#busy"><?=CHtml::encode($texts['tabs_title1'])?></a></h2>
									<div id="busy" class="tab-pane fade">
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<?=$texts['tabs_body1']?>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
											<?
											$program1 = $program2 = $program3 = array();
											foreach ($programs as $value) {
												if ($value['program_id'] == $texts['tabs_program1'])
													$program1 = $value;

												if ($value['program_id'] == $texts['tabs_program2'])
													$program2 = $value;

												if ($value['program_id'] == $texts['tabs_program3'])
													$program3 = $value;

											}

											?>
											<p class="tabs-pane-card-h h3"><?=CHtml::encode($texts['tabs_program_title1'])?></p>
											<div class="tabs-pane-card-itself">

												<?php if (!empty($program1['program_photo'])) { $photo = json_decode($program1['program_photo'], true); ?>
												<div class="tabs-pane-card-bg lazy" data-original="<?=$assetsUrl?>/program/<?=$photo['file']?>" style="background-image: url()"></div>
												<?php } ?>

												<div class="tabs-pane-card-title"><?=CHtml::encode($program1['program_title'])?>
												<?php if (!empty($program1['program_calories'])) { ?>
												<strong><?=CHtml::encode($program1['program_calories'])?></strong> <span>ккал</span>
												<?php } ?>
												</div>
												<div class="tabs-pane-card-descr"><?=CHtml::encode($program1['program_tip'])?></div>
												<div class="card-buttons">
													<div class="button-cont">
														<button onclick="yaCounter38015400.reachGoal('ORDERTRY'); return true;" data-toggle="modal" data-target="#order-modal-<?=$program1['program_id']?>" class="btn order-btn invert-btn">Попробовать</button>

													</div>
													<button onclick="yaCounter38015400.reachGoal('ORDERPODROB'); return true;" data-toggle="modal" data-target="#program-info-<?=$program1['program_id']?>" class="btn order-btn invert-btn btn-additional">Подробнее</button>
												</div>
											</div>
										</div>
									</div>
									<h2 class="accordion-content-title"><a class="aactive" data-toggle="tab" href="#fitness"><?=CHtml::encode($texts['tabs_title2'])?></a></h2>
									<div id="fitness" class="tab-pane fade in active">
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<?=$texts['tabs_body2']?>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">

											<p class="tabs-pane-card-h h3"><?=CHtml::encode($texts['tabs_program_title2'])?></p>
											<div class="tabs-pane-card-itself">

												<?php if (!empty($program2['program_photo'])) { $photo = json_decode($program2['program_photo'], true); ?>
												<div class="tabs-pane-card-bg lazy" data-original="<?=$assetsUrl?>/program/<?=$photo['file']?>" style="background-image: url()"></div>
												<?php } ?>

												<div class="tabs-pane-card-title"><?=CHtml::encode($program2['program_title'])?>
												<?php if (!empty($program2['program_calories'])) { ?>
												<strong><?=CHtml::encode($program2['program_calories'])?></strong> <span>ккал</span>
												<?php } ?>
												</div>
												<div class="tabs-pane-card-descr"><?=CHtml::encode($program2['program_tip'])?></div>
												<div class="card-buttons">
													<div class="button-cont">
														<button onclick="yaCounter38015400.reachGoal('ORDERTRY'); return true;" data-toggle="modal" data-target="#order-modal-<?=$program2['program_id']?>" class="btn order-btn invert-btn">Попробовать</button>

													</div>
													<button onclick="yaCounter38015400.reachGoal('ORDERPODROB'); return true;" data-toggle="modal" data-target="#program-info-<?=$program2['program_id']?>" class="btn order-btn invert-btn btn-additional">Подробнее</button>
												</div>
											</div>
										</div>
									</div>
									<h2 class="accordion-content-title"><a data-toggle="tab" href="#sport"><?=CHtml::encode($texts['tabs_title3'])?></a></h2>
									<div id="sport" class="tab-pane fade">
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<?=$texts['tabs_body3']?>
										</div>
										<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
											<? $program = $programs[$texts['tabs_program3']]; ?>
											<p class="tabs-pane-card-h h3"><?=CHtml::encode($texts['tabs_program_title3'])?></p>
											<div class="tabs-pane-card-itself">

												<?php if (!empty($program3['program_photo'])) { $photo = json_decode($program3['program_photo'], true); ?>
												<div class="tabs-pane-card-bg lazy" data-original="<?=$assetsUrl?>/program/<?=$photo['file']?>" style="background-image: url()"></div>
												<?php } ?>

												<div class="tabs-pane-card-title"><?=CHtml::encode($program3['program_title'])?>
												<?php if (!empty($program3['program_calories'])) { ?>
												<strong><?=CHtml::encode($program3['program_calories'])?></strong> <span>ккал</span>
												<?php } ?>
												</div>
												<div class="tabs-pane-card-descr"><?=CHtml::encode($program3['program_tip'])?></div>
												<div class="card-buttons">
													<div class="button-cont">
														<button onclick="yaCounter38015400.reachGoal('ORDERTRY'); return true;" data-toggle="modal" data-target="#order-modal-<?=$program3['program_id']?>" class="btn order-btn invert-btn">Попробовать</button>

													</div>
													<button onclick="yaCounter38015400.reachGoal('ORDERPODROB'); return true;" data-toggle="modal" data-target="#program-info-<?=$program3['program_id']?>" class="btn order-btn invert-btn btn-additional">Подробнее</button>
												</div>
											</div>
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>

				</section>





				<section id="allow-you" class="allow-you">
					<div class="square"></div>
					<div class="layout-container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<h2 class="green-header h3"><?=CHtml::encode($texts['p_title'])?></h2>
								<div class="header-descr"><p class="h4"><?=CHtml::encode($texts['p_subtitle'])?></p></div>
							</div>
						</div>
						<div class="row">
							<div class="allow-wrap">
								<div class="items-wrap-small">
									<div class="col-sm-1"></div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
										<div class="allow-block">
											<div class="img-cont">
												<div class="p-icon">
													<img class="lazy" data-original="<?=$staticUrl?>/images/p_icon_1.png" alt="">
													<span class="p-lines"></span>
												</div>
											</div>
											<div class="descr">
												<div class="header-cont">
													<p class="orange-header h5"><?=CHtml::encode($texts['p_title_1'])?></p>
												</div>
												<p><?=CHtml::encode($texts['p_text_1'])?></p>
											</div>
										</div>
									</div>
									<div class="col-sm-2"></div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
										<div class="allow-block">
											<div class="img-cont">
												<div class="p-icon">
													<img class="lazy" data-original="<?=$staticUrl?>/images/p_icon_2.png" alt="">
													<span class="p-clock-arrow"></span>
													<span class="p-clock-arrow p-clock-arrow-1"></span>
													<span class="p-clock-arrow p-clock-arrow-2"></span>
												</div>
											</div>
											<div class="descr">
												<div class="header-cont">
													<p class="green-header h5"><?=CHtml::encode($texts['p_title_2'])?></p>
												</div>
												<p><?=CHtml::encode($texts['p_text_2'])?></p>
											</div>
										</div>
									</div>
									<div class="col-sm-1"></div>
								</div>
								<div class="col-sm-1"></div>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
									<div class="allow-block">
										<div class="img-cont">
											<div class="p-icon">
												<img class="lazy" data-original="<?=$staticUrl?>/images/p_icon_3.png" alt="">
												<span class="p-wheel p-wheel-1"></span>
												<span class="p-wheel p-wheel-2"></span>
											</div>
										</div>
										<div class="descr">
											<div class="header-cont">
												<p class="red-header h5"><?=CHtml::encode($texts['p_title_3'])?></p>
											</div>
											<p><?=CHtml::encode($texts['p_text_3'])?></p>
										</div>
									</div>
								</div>
								<div class="col-sm-2"></div>
								<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
									<div class="allow-block">
										<div class="img-cont">
											<div class="p-icon">
												<img class="lazy" data-original="<?=$staticUrl?>/images/p_icon_4.png" alt="">
												<span class="p-par"></span>
											</div>
										</div>
										<div class="descr">
											<div class="header-cont">
												<p class="light-green-header h5"><?=CHtml::encode($texts['p_title_4'])?></p>
											</div>
											<p><?=CHtml::encode($texts['p_text_4'])?></p>
										</div>
									</div>
								</div>
								<div class="col-sm-1"></div>
							</div>
						</div>
					</div>
				</section>





				<section id="who-needs" class="who-needs">
					<div class="square"></div>
					<div class="layout-container">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<h2 class="green-header h3">Кому нужен Smart Calories?</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12 who-needs-left-bg">
								<div class="who-needs-weight lazy" data-original="<?=$staticUrl;?>/images/who-needs-weight.png" style="background-image: url();">
									<p class="h4"><?=CHtml::encode($texts['text1title'])?></p>

									<div class="who-needs-decsp"><?=$texts['text1body']?></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12">
								<div class="who-needs-business lazy" data-original="<?=$staticUrl;?>/images/who-needs-business.png" style="background-image: url();">
									<p class="h4"><?=CHtml::encode($texts['text2title'])?></p>

									<div class="who-needs-decsp"><?=$texts['text2body']?></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-xs-12">
								<div class="who-needs-moms lazy" data-original="<?=$staticUrl;?>/images/who-needs-moms.png" style="background-image: url();">
									<p class="h4"><?=CHtml::encode($texts['text3title'])?></p>

									<div class="who-needs-decsp"><?=$texts['text3body']?></div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-xs-12 who-needs-right-bg">
								<div class="who-needs-sport lazy" data-original="<?=$staticUrl;?>/images/who-needs-sport.png" style="background-image: url();">
									<p class="h4"><?=CHtml::encode($texts['text4title'])?></p>
									<div class="who-needs-decsp"><?=$texts['text4body']?></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 col-md-4"></div>
							<div class="col-lg-4 col-md-4 col-xs-12 text-center">
							<button onclick="yaCounter38015400.reachGoal('ORDERCONSUL'); return true;" class="btn big-btn" data-toggle="modal" data-target="#order-modal-2"><?=CHtml::encode($texts['button_title3'])?></button>
							</div>
						</div>


					</div>
				</section>





				<section id="programs" class="programs">
					<div class="header-divider lazy" data-original="<?=$staticUrl;?>/images/programs.jpg" style="background-image: url();"></div>



					<div class="programs-wrap">
						<div class="layout-container">
							<div class="row">
								<div class="programs-header">
									<h2 class="green-header center">Наши программы</h2>
								</div>
							</div>

							<?php if (!empty($programs)) { ?>
								<?php
								$i = 0;
								$last = count($programs) - 1;
								?>
								<div class="row cards-row">
									<?php

									foreach ($programs as $index => $program) { $i++; ?>
										<?php if ($i == 1) { ?>
											<div class="margin-row">
												<?php } ?>
												<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
													<div class="card-wrap">
														<div class="card-number"><?=$index + 1?></div>
														<div class="card-itself">
															<?php if (!empty($program['program_photo'])) { $photo = json_decode($program['program_photo'], true); ?>
															<div class="card-bg lazy" data-original="<?=$assetsUrl?>/program/<?=$photo['file']?>" style="background-image: url()"></div>
															<?php } ?>
															<div class="card-header">
																<p class="regular-header h2"><?=CHtml::encode($program['program_title'])?></p>
																<?php if (!empty($program['program_calories'])) { ?>
																	<div class="right-head">
																		<p class="bold-headr h2"><?=CHtml::encode($program['program_calories'])?></p>
																		<span class="kkal">ккал</span>
																	</div>
																	<?php } ?>
																</div>
																<div class="card-descr">
																	<p><?=CHtml::encode($program['program_tip'])?></p>
																</div>
																<div class="card-buttons">
																	<div class="button-cont">
																		<button onclick="yaCounter38015400.reachGoal('ORDERNOW'); return true;" data-toggle="modal" data-target="#order-modal-<?=$program['program_id']?>" class="btn order-btn invert-btn">Заказать</button>

																	</div>
																	<button onclick="yaCounter38015400.reachGoal('ORDERPODROBNEY'); return true;" data-toggle="modal" data-target="#program-info-<?=$program['program_id']?>" class="btn order-btn invert-btn btn-additional">Подробнее</button>
																</div>
															</div>
														</div>
													</div>
													<?php if ($i == 3 || $index == $last) { $i = 0; ?>
													</div>
													<?php } ?>
													<?php } ?>
												</div>
												<?php } ?>
											</div>
										</div>
										<?php if ($texts['a_counter']) { ?>
											<div id="action-block" class="action-block">
												<div class="programs-wrap">
													<div class="layout-container">
														<div class="ab-head">
															<div class="ab-title"><?=CHtml::encode($texts['a_title'])?></div>
															<div class="ab-subtitle"><?=CHtml::encode($texts['a_subtitle'])?></div>
														</div>
														<div class="ab-cards">
															<div class="ab-card">
																<div class="abc-wrap">
																	<div class="abc-num">1</div>
																	<div class="abc-arrow"><img class="lazy" data-original="<?=$staticUrl?>/images/arrow-br.png" alt=""></div>
																	<div class="abc-icon"><img class="lazy" data-original="<?=$staticUrl?>/images/i1.png" alt=""></div>
																	<div class="abc-text"><?=CHtml::encode($texts['a_block_1'])?></div>
																</div>
						</div><!--
					--><div class="ab-card">
					<div class="abc-wrap">
						<div class="abc-num abc-num-2">2</div>
						<div class="abc-arrow" style="-webkit-transition-delay: .8s; transition-delay: .8s"><img class="lazy" data-original="<?=$staticUrl?>/images/arrow-br.png" alt=""></div>
						<div class="abc-icon"><img class="lazy" data-original="<?=$staticUrl?>/images/i2.png" alt=""></div>
						<div class="abc-text"><?=CHtml::encode($texts['a_block_2'])?></div>
					</div>
						</div><!--
					--><div class="ab-card">
					<div class="abc-wrap">
						<div class="abc-num abc-num-3">3</div>
						<div class="abc-icon"><img class="lazy" data-original="<?=$staticUrl?>/images/i3.png" alt=""></div>
						<div class="abc-text"><?=CHtml::encode($texts['a_block_3'])?></div>
					</div>
				</div>
			</div>
			<div id="ab-counter" class="ab-counter">
				С нами уже <span data-count="<?=$texts['a_counter']?>"></span> <?=Yii::t('app', 'едок|едока|едоков|едока', $texts['a_counter'])?>. Присоединяйтесь!
			</div>
		</div>
	</div>
	<div class="ab-content lazy" data-original="<?=$staticUrl;?>/images/ab-content.jpg" style="background-image: url();">
		<div class="programs-wrap">
			<div class="layout-container">
				<div class="abc-title"><strong>Акция!</strong></div>
				<div class="abc-subtitle">Стоимость пробного дня</div>
				<div class="abc-price">
					<div class="abc-prcie-new"><?=$texts['a_price']?> <span>руб.</span></div>
					<div class="abc-prcie-old"><?=$texts['a_price_before']?> <span>руб.</span></div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-4"></div>
					<div class="col-lg-4 col-md-4 col-xs-12 text-center"><button onclick="yaCounter38015400.reachGoal('ORDERWANT'); return true;" class="btn big-btn" data-toggle="modal" data-target="#order-modal-2"><?=CHtml::encode($texts['button_title4'])?></button></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  } ?>


</section>


<section id="who-we" class="who-we">
	<div class="header-divider lazy" data-original="<?=$staticUrl;?>/images/who-we-are.jpg" style="background-image: url();"></div>
	<div class="who-we-wrap">
		<div class="layout-container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<?php if (!empty($texts['founder_photo'])) { ?>
						<?php
						$photo = json_decode($texts['founder_photo'], true);
						?>
						<div class="img-wrap">
							<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt="">
						</div>
						<?php } ?>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<div class="descr-wrap">
							<h2 class="green"><?=CHtml::encode($texts['founder_title'])?></h2>
							<h2><?=CHtml::encode($texts['founder_subtitle'])?></h2>
							<?=$texts['founder_text']?>
							<div class="row">
								<div class="col-lg-5 col-xs-12">
									<button onclick="yaCounter38015400.reachGoal('ORDERTOMMOR'); return true;" class="btn invert-btn big-btn" data-toggle="modal" data-target="#order-modal"><?=CHtml::encode($texts['button_title5'])?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>






<section id="update-days" class="update-days">
	<div class="square"></div>
	<div class="layout-container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 text-center">
				<h3 class="green-header">Как изменится ваш день</h3>
			</div>
		</div>
	</div>
	<div class="update-days-wrapper">
		<div class="layout-container text-center">
			<div class="row update-days-top-img lazy" data-original="<?=$staticUrl;?>/images/update-days-top-img.png" style="background-image: url();">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
					<div class="update-days-title-old"><?=CHtml::encode($texts['update_days_title1'])?></div>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 dmnone"></div>
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
					<div class="update-days-title-new"><?=CHtml::encode($texts['update_days_title2'])?></div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
					<div class="update-days-descr text-right"><?=CHtml::encode($texts['update_days_body9_1'])?></div>
					<div class="update-days-pic-left">
						<?php if (!empty($texts['update_days_img9_1'])) {
							$photo = json_decode($texts['update_days_img9_1'], true);?>
							<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 update-days-time_abs"><div class="update-days-time"><span>9:00</span></div></div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
						<div class="update-days-pic-right"><?php if (!empty($texts['update_days_img9_2'])) {
							$photo = json_decode($texts['update_days_img9_2'], true);?>
							<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
							<div class="update-days-descr text-left"><?=CHtml::encode($texts['update_days_body9_2'])?></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
							<div class="update-days-descr text-right"><?=CHtml::encode($texts['update_days_body11_1'])?></div>
							<div class="update-days-pic-left"><?php if (!empty($texts['update_days_img11_1'])) {
								$photo = json_decode($texts['update_days_img11_1'], true);?>
								<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 update-days-time_abs"><div class="update-days-time"><span>11:00</span></div></div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
								<div class="update-days-pic-right"><?php if (!empty($texts['update_days_img11_2'])) {
									$photo = json_decode($texts['update_days_img11_2'], true);?>
									<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
									<div class="update-days-descr text-left"><?=CHtml::encode($texts['update_days_body11_2'])?></div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
									<div class="update-days-descr text-right"><?=CHtml::encode($texts['update_days_body13_1'])?></div>
									<div class="update-days-pic-left"><?php if (!empty($texts['update_days_img13_1'])) {
										$photo = json_decode($texts['update_days_img13_1'], true);?>
										<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 update-days-time_abs"><div class="update-days-time"><span>13:00</span></div></div>
									<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
										<div class="update-days-pic-right"><?php if (!empty($texts['update_days_img13_2'])) {
											$photo = json_decode($texts['update_days_img13_2'], true);?>
											<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
											<div class="update-days-descr text-left"><?=CHtml::encode($texts['update_days_body13_2'])?></div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
											<div class="update-days-descr text-right"><?=CHtml::encode($texts['update_days_body18_1'])?></div>
											<div class="update-days-pic-left"><?php if (!empty($texts['update_days_img18_1'])) {
												$photo = json_decode($texts['update_days_img9_1'], true);?>
												<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-2 update-days-time_abs"><div class="update-days-time"><span>18:00</span></div></div>
											<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
												<div class="update-days-pic-right"><?php if (!empty($texts['update_days_img18_2'])) {
													$photo = json_decode($texts['update_days_img18_2'], true);?>
													<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
													<div class="update-days-descr text-left"><?=CHtml::encode($texts['update_days_body18_2'])?></div>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
													<div class="update-days-descr text-right"><?=CHtml::encode($texts['update_days_body21_1'])?></div>
													<div class="update-days-pic-left"><?php if (!empty($texts['update_days_img21_1'])) {
														$photo = json_decode($texts['update_days_img21_1'], true);?>
														<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
													</div>
													<div class="col-lg-2 col-md-2 col-sm-2 update-days-time_abs"><div class="update-days-time"><span>21:00</span></div></div>
													<div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
														<div class="update-days-pic-right"><?php if (!empty($texts['update_days_img21_2'])) {
															$photo = json_decode($texts['update_days_img21_2'], true);?>
															<img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""><?php } ?></div>
															<div class="update-days-descr text-left"><?=CHtml::encode($texts['update_days_body21_2'])?></div>
														</div>
													</div>
												</div>
											</div>
										</section>

										<section id="how-it-works" class="how-it-works">
											<div class="header-divider lazy" data-original="<?=$staticUrl;?>/images/how-it-works-bg.jpg" style="background-image: url();"></div>
											<div class="layout-container">
												<div id="how-it-works" class="how-it-works-wrap">
													<div class="row">
														<div class="items-wrap-small">
															<div class="col-sm-1"></div>
															<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
																<div class="how-card">
																	<div class="how-num">1</div>
																	<div class="arrow-cont"><div><img class="lazy" data-original="<?=$staticUrl?>/images/arrow-br.png" alt=""></div></div>
																	<?php if (!empty($texts['hiw_icon_1'])) { $photo = json_decode($texts['hiw_icon_1'], true); ?>
																	<div class="how-img"><img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""></div>
																	<?php } else { ?>
																		<div class="how-img"><img class="lazy" data-original="<?=$staticUrl?>/images/how-f.svg" alt=""></div>
																		<?php } ?>
																		<div class="how-descr">
																			<p><?=CHtml::encode($texts['hiw_icon_tip_1'])?></p>
																		</div>
																	</div>
																</div>
																<div class="col-sm-2"></div>
																<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
																	<div class="how-card">
																		<div class="how-num">2</div>
																		<div class="arrow-cont"><div style="-webkit-transition-delay: .8s; transition-delay: .8s"><img class="lazy" data-original="<?=$staticUrl?>/images/arrow-br.png" alt=""></div></div>
																		<?php if (!empty($texts['hiw_icon_2'])) { $photo = json_decode($texts['hiw_icon_2'], true); ?>
																		<div class="how-img"><img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""></div>
																		<?php } else { ?>
																			<div class="how-img"><img class="lazy" data-original="<?=$staticUrl?>/images/how-s.svg" alt=""></div>
																			<?php } ?>
																			<div class="how-descr">
																				<p><?=CHtml::encode($texts['hiw_icon_tip_2'])?></p>
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-1"></div>
																</div>
																<div class="col-sm-1"></div>
																<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
																	<div class="how-card">
																		<div class="how-num">3</div>
																		<div class="arrow-cont"><div style="-webkit-transition-delay: 1.6s; transition-delay: 1.6s"><img class="lazy" data-original="<?=$staticUrl?>/images/arrow-br.png" alt=""></div></div>
																		<?php if (!empty($texts['hiw_icon_3'])) { $photo = json_decode($texts['hiw_icon_3'], true); ?>
																		<div class="how-img"><img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""></div>
																		<?php } else { ?>
																			<div class="how-img"><img class="lazy" data-original="<?=$staticUrl?>/images/how-t.svg" alt=""></div>
																			<?php } ?>
																			<div class="how-descr">
																				<p><?=CHtml::encode($texts['hiw_icon_tip_3'])?></p>
																			</div>
																		</div>
																	</div>
																	<div class="col-sm-2"></div>
																	<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
																		<div class="how-card">
																			<div class="how-num">4</div>
																			<?php if (!empty($texts['hiw_icon_4'])) { $photo = json_decode($texts['hiw_icon_4'], true); ?>
																			<div class="how-img"><img class="lazy" data-original="<?=$assetsUrl?>/images/<?=$photo['file']?>" alt=""></div>
																			<?php } else { ?>
																				<div class="how-img"><img class="lazy" data-original="<?=$staticUrl?>/images/how-ft.svg" alt=""></div>
																				<?php } ?>
																				<div class="how-descr">
																					<p><?=CHtml::encode($texts['hiw_icon_tip_4'])?></p>
																				</div>
																			</div>
																		</div>
																	</div>

																	<div class="every-day">
																		<div class="row">
																			<div class="col-lg-12 col-md-12 col-xs-12">
																				<p class="green-header center h2"><?=CHtml::encode($texts['hiw_title'])?></p>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-lg-4 col-md-4"></div>
																			<div class="col-lg-4 col-md-4 col-xs-12 text-center"><button onclick="yaCounter38015400.reachGoal('ORDERPROG'); return true;" class="btn big-btn" data-toggle="modal" data-target="#order-modal"><?=CHtml::encode($texts['button_title6'])?></button></div>
																		</div>
																	</div>
																</div>
															</div>
														</section>

														<section id="blog" class="blog">
															<div class="header-divider lazy" data-original="<?=$staticUrl;?>/images/blog-bg.jpg" style="background-image: url();"></div>
															<div class="blog-wrapper">
																<div class="layout-container">
																	<?php if (!empty($posts)) { ?>
																		<div id="blog-slider">
																			<?php foreach ($posts as $post) { ?>
																				<div class="blog-slide">
																					<div class="post">
																						<div class="row">
																							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
																								<div class="blog-thumbnail">
																									<?php if (!empty($post['post_photo'])) { $photo = json_decode($post['post_photo'], true); ?>
																									<img class="lazy" data-original="<?=$assetsUrl?>/post/<?=$photo['file']?>" alt="">
																									<?php } ?>
																								</div>
																							</div>
																							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
																								<div class="blog-header">
																									<h3 class="regular-header h2"><?=CHtml::encode($post['post_title'])?></h3>
																								</div>
																								<div class="blog-text">
																									<p><?=str_replace(array("\r", "\n"), array("", "<br>\n"), CHtml::encode($post['post_intro']))?></p>
																									<a href="<?=$this->createUrl('blog', array('alias' => $post['post_alias']))?>">Подробнее</a>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<?php } ?>
																			</div>
																			<?php if (count($posts) > 1) { ?><div id="blog-dots"></div><?php } ?>
																			<?php } ?>
																		</div>
																	</div>
																</section>
															</div>

															<div class="layout-footer">
																<div id="contacts" class="layout-container">
																	<div class="row">
																		<div class="col-lg-3 col-md-3 col-sm-4">
																			<div class="footer-item addres">
																				<div class="item-head"><span class="fr-map"></span><h3>Адрес</h3></div>
																				<div class="item-content">
																					<p><?=str_replace(array("\r", "\n"), array("", "<br>\n"), CHtml::encode($texts['footer_address']))?></p>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-3 col-sm-4">
																			<div class="footer-item phone">
																				<div class="item-head"><span class="fr-phone"></span><h3>Телефон</h3></div>
																				<div class="item-content">
																					<p><?=str_replace(array("\r", "\n"), array("", "<br>\n"), CHtml::encode($texts['footer_phone']))?></p>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-3 col-spec-2 col-md-2 col-sm-4">
																			<div class="footer-item mail">
																				<div class="item-head"><span class="fr-mail"></span><h3>Email</h3></div>
																				<div class="item-content">
																					<p><?=str_replace(array("\r", "\n"), array("", "<br>\n"), CHtml::encode($texts['footer_email']))?></p>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-3 col-spec-4 col-md-4 col-sm-12">
																			<button onclick="yaCounter38015400.reachGoal('ORDERPROG'); return true;" class="btn footer-btn invert-btn big-btn" data-toggle="modal" data-target="#order-modal"><?=CHtml::encode($texts['button_title7'])?></button>
																			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
				<a rel="nofollow" href="https://drive.google.com/open?id=16KdEWeCCFl700D7Rqgjnisss5WCYJ0iKNSAzYEHE1G0" target="_blank" class="btn order-btn invert-btn">Анкета</a>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 text-right">
				<a class="btn order-btn invert-btn" data-toggle="modal" data-target="#requisites-modal">Реквизиты</a>
				</div>
</div>

																		</div>
																	</div>
																</div>
															</div>
															<div class="septa text-center">
																<a href="http://septa-agency.com/" target="_blank"><img class="lazy" data-original="<?=$staticUrl?>/images/septa.png" alt=""></a>
															</div>

															<div class="modal fade order-modal" id="order-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																			<h4 class="modal-title" id="myModalLabel">Оставьте заявку и мы с вами свяжемся</h4>
																		</div>
																		<div class="modal-body">
																			<form id="reg-form" class="form" method="post" novalidate action="/registration">
																				<div class="form-group">
																					<input type="text" name="registration[firstname]" placeholder="Имя" class="form-control">
																				</div>
																				<div class="form-group">
																					<input type="tel" name="registration[phone]" placeholder="Телефон" class="form-control phone_text_form">
																				</div>
																				<div class="form-group">
																					<input type="email" name="registration[mail]" placeholder="Email" class="form-control">
																				</div>
																				<div class="cap"  style="margin: 0 auto; display:block; width: 304px;">
																					<div class="cap_item" id="recaptcha1"></div>
																					<!-- <div class="g-recaptcha" data-sitekey="6Lf9zSgUAAAAAKYEkkV0btU7u8KX2lZ_LhJzS9P3"></div> -->
																				</div>
																				<div class="text-center">
																					<button class="click_to_send_order btn big-btn">Отправить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</div>

															<div class="modal fade order-modal" id="requisites-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																			<h4 class="modal-title" id="myModalLabel">Наши реквизиты</h4>
																		</div>
																		<div class="modal-body">
																			<p>ИП ВОЮШ АЛЕКСАНДРА АЛЕКСАНДРОВНА</p>
																			<p>ИНН: 390400539353</p>
																			<p>ОГРН: 315774600396602</p>
																			<p>Расчетный счет: 40802810100000107835</p>
																			<p>Банк: АО «Тинькофф Банк»</p>
																			<p>Корр. счет Банка: 30101810145250000974</p>
																			<p>ИНН Банка: 7710140679</p>
																			<p>БИК Банка: 044525974</p>
																		</div>
																	</div>
																</div>
															</div>

															<div class="modal fade order-modal" id="order-modal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																			<h4 class="modal-title" id="myModalLabel">Оставьте заявку и мы с вами свяжемся</h4>
																		</div>
																		<div class="modal-body">
																			<form id="reg-form" class="form" method="post" novalidate>
																				<input type="hidden" name="registration[comment]" value="Акция!">
																				<div class="form-group">
																					<input type="text" name="registration[firstname]" placeholder="Имя" class="form-control">
																				</div>
																				<div class="form-group">
																					<input type="tel" name="registration[phone]" placeholder="Телефон" class="form-control phone_text_form">
																				</div>
																				<div class="form-group">
																					<input type="email" name="registration[mail]" placeholder="Email" class="form-control">
																				</div>
																				<div class="cap"  style="margin: 0 auto; display:block; width: 304px;">
																					<div id="recaptcha3" class="cap_item"></div>
																					<!-- <div class="g-recaptcha" data-sitekey="6Lf9zSgUAAAAAKYEkkV0btU7u8KX2lZ_LhJzS9P3"></div> -->
																				</div>
																				<div class="text-center">
																					<button class="click_to_send_order btn big-btn">Отправить</button>
																				</div>
																			</form>
																		</div>
																	</div>
																</div>
															</div>

															<?php if (!empty($programs)) { ?>
																<?php
																$cap_i = 0;
																foreach ($programs as $program) {
																	$cap_i ++;
																	?>
																	<div class="modal fade order-modal" id="order-modal-<?=$program['program_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<div class="modal-header">
																					<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																					<h4 class="modal-title" id="myModalLabel">Оставьте заявку и мы с вами свяжемся</h4>
																				</div>
																				<div class="modal-body">
																					<form id="reg-form" class="form" method="post" novalidate>
																						<div class="form-group">
																							<input type="hidden" name="registration[program_id]" value="<?=$program['program_id']?>">
																							<span style="font-size: 20px">Программа: <strong><?=$program['program_title']?></strong></span>
																						</div>
																						<div class="form-group">
																							<input type="text" name="registration[firstname]" placeholder="Имя" class="form-control">
																						</div>
																						<div class="form-group">
																							<input type="tel" name="registration[phone]" placeholder="Телефон" class="form-control phone_text_form">
																						</div>
																						<div class="form-group">
																							<input type="email" name="registration[mail]" placeholder="Email" class="form-control">
																						</div>
																						<div class="cap"  style="margin: 0 auto; display:block; width: 304px;">
																							<div class="cap_item" id="recaptcha_<?php echo $cap_i;?>"></div>
																							<!-- <div class="g-recaptcha" data-sitekey="6Lf9zSgUAAAAAKYEkkV0btU7u8KX2lZ_LhJzS9P3"></div> -->
																						</div>
																						<div class="text-center">
																							<button class="click_to_send_order btn big-btn">Отправить</button>
																						</div>
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>


																	<div class="modal fade details-modal" id="program-info-<?=$program['program_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																		<div class="modal-dialog" role="document">
																			<div class="modal-content">
																				<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																				<div class="row">
																					<div class="col-lg-12 col-md-12 col-xs-12">
																						<div class="img-cont">
																							<?php if (!empty($program['program_photo'])) { $photo = json_decode($program['program_photo'], true); ?>
																							<img class="lazy" data-original="<?=$assetsUrl?>/program/<?=$photo['file']?>" alt="">
																							<?php } ?>
																						</div>
																						<div class="modal-main">
																							<div class="header-modal">
																								<div class="header-left">
																									<h3><?=CHtml::encode($program['program_title'])?></h3>
																								</div>
																								<?php if (!empty($program['program_price'])) { ?>
																									<div class="header-right">
																										<h3>Стоимость &mdash; <span class="yellow-bold"><?=CHtml::encode($program['program_price'])?></span> руб. за <?=Yii::t('app', '{n} день|{n} дня|{n} дней', (int) $program['program_days'])?></h3>
																									</div>
																									<?php } ?>
																								</div>
																								<div class="modal-cont">
																									<div class="first-block">
																										<?php if (!empty($program['program_calories'])) { ?>
																											<h3 class="yellow-bold"><?=CHtml::encode($program['program_calories'])?> <span class="yellow-kkal">ккал</span></h3>
																											<?php } ?>
																											<p><?=str_replace(array("\r","\n"), array("", "<br>\n"), CHtml::encode($program['program_text']))?></p>
																										</div>
																										<div class="second-block">
																											<h3 class="yellow-bold">Пример меню</h3>
																											<div class="menu-row">
																												<?php if (!empty($program['program_breakfest'])) { ?>
																													<div class="menu-block">
																														<h4>Завтрак</h4>
																														<ul>
																															<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_breakfest'])?></li>
																														</ul>
																													</div>
																													<?php } ?>
																													<?php if (!empty($program['program_breakfest_2'])) { ?>
																														<div class="menu-block">
																															<h4>Второй завтрак</h4>
																															<ul>
																																<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_breakfest_2'])?></li>
																															</ul>
																														</div>
																														<?php } ?>
																														<?php if (!empty($program['program_perekus'])) { ?>
																															<div class="menu-block">
																																<h4>Перекус</h4>
																																<ul>
																																	<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_perekus'])?></li>
																																</ul>
																															</div>
																															<?php } ?>
																														</div>
																														<div class="menu-row">
																															<?php if (!empty($program['program_lunch'])) { ?>
																																<div class="menu-block">
																																	<h4>Обед</h4>
																																	<ul>
																																		<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_lunch'])?></li>
																																	</ul>
																																</div>
																																<?php } ?>
																																<?php if (!empty($program['program_lunch_2'])) { ?>
																																	<div class="menu-block">
																																		<h4>Полдник</h4>
																																		<ul>
																																			<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_lunch_2'])?></li>
																																		</ul>
																																	</div>
																																	<?php } ?>
																																</div>
																																<div class="menu-row">
																																	<?php if (!empty($program['program_dinner'])) { ?>
																																		<div class="menu-block">
																																			<h4>Ужин</h4>
																																			<ul>
																																				<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_dinner'])?></li>
																																			</ul>
																																		</div>
																																		<?php } ?>
																																		<?php if (!empty($program['program_night'])) { ?>
																																			<div class="menu-block">
																																				<h4>На ночь</h4>
																																				<ul>
																																					<li><?=str_replace(array("\r", "\n"), array("", "</li>\n<li>"), $program['program_night'])?></li>
																																				</ul>
																																			</div>
																																			<?php } ?>
																																		</div>
																																	</div>
																																</div>
																															</div>
																															<div class="modal-btn text-center">
																																<button data-target="#order-modal-<?=$program['program_id']?>" data-program="#program-modal-<?=$program['program_id']?>" class="btn big-btn program-btn">Сделать заказ</button>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>
																										<?php } ?>
																										<?php } ?>

																										<div class="modal fade thank-you-modal" id="thank-you-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
																											<div class="modal-dialog" role="document">
																												<a type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
																												<div class="modal-content">
																													<div class="thank-you-img">
																														<img class="lazy" data-original="<?=$staticUrl?>/images/thank-you-img.jpg" alt="">
																													</div>
																													<div class="text">
																														<h2>Спасибо за заявку!<br>Мы обязательно с вами свяжемся</h2>
																													</div>
																												</div>
																											</div>
																										</div>
<script type="text/javascript">
	var onloadCallback = function() {
		var ren = document.getElementsByClassName("cap_item");
		for (i=0;i<ren.length;i++){
			grecaptcha.render(ren[i].id, {
				'sitekey' : '6Le11CgUAAAAAJ--xRLclxyJe1jfTApG2OmWSz24'
			});
		}
	};
</script>
