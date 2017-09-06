<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Записаться на занятие. Шаг1</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="step">
    <section class="start_time">
        <div class="steps">
            <div class="step">
    			<p>
    				ШАГ 1
    			</p>
    		</div>
    		<div class="arrow">
    			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
    		</div>
    		<div class="step active">
    			<p>
    				ШАГ 2
    			</p>
    		</div>
        </div>
        <h1>Шаг 2. Уточните Ваши цели</h1>
        <div class="green">
        </div>
    </section>
    <section class="form">
        <p>Специализация</p>
        <select>
            <?php
                foreach($spec as $sp){
                    echo '<option value="'.$sp['id'].'">'.$sp['specialization'].'</option>';
                }
             ?>
        </select>
        <p>Напишите кратко ваши цели и пожелания:</p>
        <textarea></textarea>
    </section>
    <a href="<?php echo base_url(); ?>index.php/student/step3" class="next">Далее</a>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
