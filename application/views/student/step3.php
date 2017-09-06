<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Записаться на занятие. Шаг1</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="step">
    <h1>Заявка добавлена</h1>
    <h2>Ваша заявка на рассмотрения репетитора.</h2>
    <h2>После подтверджения репетиторам стоимость урока будет списана с Вашего личного счета.</h2>
    <h2>Пополнить счет и проверить статус заявки Вы можете в кабинете Ученика.</h2>
    <a href="<?php echo base_url(); ?>index.php/student/" class="back">Вернуться в личный кабинет</a>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
