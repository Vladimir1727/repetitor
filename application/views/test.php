<?php $this->load->view('main/header'); ?>
<title>Тестовая страница</title>
</head>
<style media="screen">
.must{
    /*position: relative;*/
}
.must::before{
    content : 'Обязательно';
}


</style>
<body>
<?php $this->load->view('main/header_menu'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/verify2.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<h1 class="text-center">Добро пожаловать в тест</h1>

<input type="text" name="" value="33" id="77">

<script type="text/javascript">
    var t = document.getElementById('77').value;
    console.log('t=',t);
</script>

<?php $this->load->view('main/footer'); ?>
