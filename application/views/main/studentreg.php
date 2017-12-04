
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Регистрация ученика</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
	<form id="regform" action="index.html" method="post" class="sreg">
		<h1>Регистрация нового ученика</h1>
		<h2>Введите email и пароль, которые будете  использовать при входе</h2>
		<input type="text" placeholder="Введите e-mail" name="email">
		<input type="password" placeholder="Пароль не менее 4 знаков" name="pass">
		<p>
			Регистрируясь, Вы принимаете условия
			<a href="https://reallanguage.club/polzovatelskoe-soglashenie/">"Пользовательского соглашения"</a>.
		</p>
		<input type="submit" value="Зарегистрироваться">
	</form>

<?php $this->load->view('main/footer'); ?>
<script src="<?php echo base_url(); ?>js/main/studentreg.js"></script>
