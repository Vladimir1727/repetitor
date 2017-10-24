<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club.</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="stop">
    <h1>Cтраница будет доступна после активации профиля</h1>
    <h2>Заполните все поля во вкладках Настроек профиля и отправьте запрос на активацию</h2>
</main>

<script>
    var baseUrl = '../';
</script>
<?php $this->load->view('main/footer'); ?>
