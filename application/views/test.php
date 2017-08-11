<?php $this->load->view('main/header'); ?>
<title>Тестовая страница</title>
</head>
<body>
<?php $this->load->view('main/header_menu'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/verify2.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<h1 class="text-center">Добро пожаловать в тест</h1>

<?php echo form_open_multipart('main/upload2', array('id' => 'file_form' ));?>
    <input type="file" name="userfile" size="20" id="add-file" class="hidden">
    <!-- <input type="submit" name="" value="отправить"> -->
</form>
<!-- <?php echo form_open('main/formtest');?>
    <input type="text" name="name" placeholder="name...">
    <input type="submit" name="" value="отправить">
</form> -->
<a href="#" id="add-photo-but">Добавить документ</a>
<ul class="photos">
</ul>



<script src="<?php echo base_url(); ?>js/test.js"></script>
<?php $this->load->view('main/footer'); ?>
