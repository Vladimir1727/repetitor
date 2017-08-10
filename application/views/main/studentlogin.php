
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/slogin.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Вход ученика</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<form id="logform" action="index.html" method="post">
	<p>Впервые на сайте?</p>
	<a href="#">Регистрация нового ученика</a>
	<h1>Вход для Ученика</h1>
	<h2>
		Введите email и пароль, которые
		вы указывали при регистрации
	</h2>
	<input type="text" placeholder="Введите e-mail" name="email">
	<input type="password" placeholder="Введите пароль" name="pass">
	<div>
		<label>
			<input type="checkbox" name="remember">
			<span></span>
			Запомнить меня
		</label>
		<a href="#" class="forgot">Забыли пароль</a>
	</div>
	<input type="submit" value="Войти">

</form>

<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/studentlogin.js"></script>
