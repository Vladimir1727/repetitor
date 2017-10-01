<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Записаться на занятие. Окончание.</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="step">
    <h1>Запрос отправлен</h1>
    <h2>Запрос успешно отправлен и находится на рассмотрении репетитора.</h2>
    <h2>Внесённая Вами сумма отображается на балансе Вашего личного кабинета. Стоимость урока будет списана с Вашего баланса только после подтверждения запроса репетитором.</h2>
    <h2>Запрос на урок сможете найти в личном кабинете в разделе «Запросы на уроки».</h2>
    <h2>Благодарим Вас за доверие к Real Language Club!</h2>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
