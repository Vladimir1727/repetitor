<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Записаться на занятие. Шаг 3</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<input type="hidden" value="<?php echo $sum; ?>" id="min_sum">
<main class="step">
    <section class="start_time">
        <div class="steps">
            <div class="step">
    			<p>
    				ШАГ 1
    			</p>
    		</div>
    		<div class="arrow">
    			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
    		</div>
    		<div class="step">
    			<p>
    				ШАГ 2
    			</p>
    		</div>
            <div class="arrow">
    			<img src="<?php echo base_url(); ?>img/arrow1.png" alt="arow">
    		</div>
    		<div class="step active">
    			<p>
    				ШАГ 3
    			</p>
    		</div>
        </div>
        <h1>Шаг 3. Пополните личный счёт на сумму урока.</h1>
        <p class="about">Окончательный расчёт за урок вы сделаете из личного кабинета после подтверждения заявки репетитором.</p>
        <div class="green">
        </div>
    </section>
    <section class="form">
        <form action="<?php echo base_url(); ?>index.php/student/makePay" method="post">
            <input type="hidden" name="go_to" value="student/stepend">
            <label>
                Сумма $
                <input type="text" placeholder="$" name="sum" id="sum" value="<?php echo $sum; ?>">
            </label>
            <p>Выберите способ пополнения:</p>
            <label>
                <input type="radio" id="visa" value="Visa" checked name="pay_type">
                <span class="check"></span>
                Visa/MasterCard
            </label>
            <label>
                <input type="radio" id="yandex" value="YandexMoney" name="pay_type">
                <span class="check"></span>
                ЯндексДеньги
            </label>
            <label>
                <input type="radio" id="paypal" value="PayPal" name="pay_type">
                <span class="check"></span>
                PayPal
            </label>
            <input type="submit" value="Пополнить" id="pay">
        </form>
    </section>

    <p class="about">100% гарантия безопасности. Сертификат SSL.
После пополнения, сумма отображается на балансе вашего личного кабинета. Запрос на урок сможете найти в личном кабинете в разделе «Запросы на уроки».
</p>
</main>
<script src="<?php echo base_url(); ?>js/student/step3.js"></script>
<script>
    var baseUrl = '../../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
