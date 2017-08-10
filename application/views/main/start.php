
<?php $this->load->view('main/header'); ?>
<title>Репетиторы по разным языкам</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/start.css">

<h1>Начните говорить на иностранном языке как его носитель - свободно и без усилий!</h1>
<h2>На нашем сайте вы найдёте эффективные инструменты улучшающие речевые навыки для разных уровней владения иностранным языком.</h2>
<h3>Какой язык вы изучаете?</h3>
<section class="lang">
    <a href="<?php echo base_url(); ?>index.php/main/?lang=en" class="eng"><span></span>Английский</a>
    <a href="<?php echo base_url(); ?>index.php/main/" class="fra"><span></span>Французский</a>
    <a href="<?php echo base_url(); ?>index.php/main/" class="det"><span></span>Немецкий</a>
    <a href="<?php echo base_url(); ?>index.php/main/" class="isp"><span></span>Испанский</a>
    <a href="<?php echo base_url(); ?>index.php/main/" class="ita"><span></span>Итальянский</a>
    <a href="<?php echo base_url(); ?>index.php/main/" class="rus"><span></span>Русский</a>
</section>




<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/start.js"></script>
