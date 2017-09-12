
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Вход администратора</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<form id="logform" action="<?php echo base_url();?>index.php/admin/trylogin" method="post" class="slogin">
	<h1>Вход Администратора</h1>
	<input type="password" placeholder="Введите пароль" name="pass" id="pass">
	<div>
		<label>
			<input type="checkbox" name="remember">
			<span></span>
			Запомнить меня
		</label>
		<a href="#" class="forgot">Забыли пароль</a>
	</div>
	<input type="submit" value="Войти">
	<?php
	if ($error!=''){
		echo '<p class="error">'.$error.'</p>';
	}
	 ?>
</form>

<?php $this->load->view('main/footer'); ?>
