<?php $this->load->view('main/header'); ?>
<title>Тестовая страница</title>
</head>
<style media="screen">


</style>
<body>
<?php $this->load->view('main/header_menu'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/verify2.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<h1 class="text-center">Добро пожаловать в тест</h1>

<a href="/" id="del">SKYPE</a>

<script type="text/javascript">
(function($){$(function(){
    console.log('start test');
    $('#del').click(function(){
        var skype= 'profalians.it';
        window.open("skype:"+skype+"?call&video=true");
        console.log('del');
        return false;
    });
})})(jQuery)
</script>

<?php $this->load->view('main/footer'); ?>
