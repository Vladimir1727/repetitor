<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Записаться на занятие. Шаг 2</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="step">
<form action="<?php echo base_url(); ?>index.php/student/step3" method="post" id="step_form">
    <?php
    foreach ($dates as $date) {
        echo '<input type="hidden" value="'.$date.'" name="date[]">';
    }
     ?>
    <input type="hidden" value="<?php echo $repetitor['id']; ?>" id="repetitor_id" name="repetitor_id">
    <input type="hidden" value="<?php echo $student['id']; ?>" id="student_id" name="student_id">
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
    		<div class="step  active">
    			<p>
    				ШАГ 2
    			</p>
    		</div>
            <div class="arrow">
    			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
    		</div>
    		<div class="step">
    			<p>
    				ШАГ 3
    			</p>
    		</div>
        </div>
        <h1>Шаг 2. Уточните Ваши цели</h1>
        <div class="green">
        </div>
    </section>
    <section class="form">
        <p>Предмет</p>
        <select id="subject" name="subject_id">
            <?php
                foreach($subjects as $subject){
                    echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
                }
             ?>
        </select>
        <p>Специализация</p>
        <select id="specialization" name="specialization_id">
            <?php
                foreach($spec as $sp){
                    echo '<option value="'.$sp['id'].'">'.$sp['specialization'].'</option>';
                }
             ?>
        </select>
        <p>Напишите кратко ваши цели и пожелания:</p>
        <textarea id='about' name="about"></textarea>
    </section>
    <a href="<?php echo base_url(); ?>index.php/student/step3" class="next" id="step3">Далее</a>
</form>
</main>
<script src="<?php echo base_url(); ?>js/student/step2.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
