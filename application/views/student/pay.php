<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Пополнение личного счета</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="student_pay">
    <h1>Пополнение личного счета</h1>
    <section>
        <label><h3>Пополнить на сумму</h3><input type="text" placeholder="$"></label>
        <h3>Выберите способ пополнения:</h3>
        <label>
            <input type="radio" name="pay_type" value="1" checked>
            <span></span>
            Visa/MasterCart
        </label>
        <label>
            <input type="radio" name="pay_type" value="2">
            <span></span>
            ЯндексДеньги
        </label>
        <label>
            <input type="radio" name="pay_type" value="3">
            <span></span>
            PayPal
        </label>
        <a href="#">Пополнить</a>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
