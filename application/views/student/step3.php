<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Записаться на занятие. Шаг 3</title>
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
        <form action="<?php echo base_url(); ?>index.php/student/makePay" method="post" id="pay_form">
            <input type="hidden" name="go_to" value="student/stepend">
            <input type="hidden" name="repetitor_id" value="<?php echo $repetitor_id; ?>">
            <input type="hidden" name="specialization_id" value="<?php echo $specialization_id; ?>">
            <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
            <input type="hidden" name="about" value="<?php echo $about; ?>">
            <?php foreach ($dates as $date){
                echo '<input type="hidden" name="date[]" value="'.$date.'">';
            }
            ?>
            <label>
                Сумма $
                <input type="text" placeholder="$" name="sum" id="sum" value="<?php echo $sum; ?>">
                <input type="hidden" name="" value="" id="main_ex">
            </label>
            <p>Выберите способ пополнения:</p>
            <label>
                <input type="radio"  value="1" checked name="pay_type"  id="card">
                <span class="check"></span>
                Visa/MasterCard
            </label>
            <label>
                <input type="radio" value="2" name="pay_type" id="money">
                <span class="check"></span>
                ЯндексДеньги
            </label>
            <label>
                <input type="radio"  value="3" name="pay_type" id="paypal">
                <span class="check"></span>
                PayPal
            </label>
            <input type="submit" value="Пополнить" id="pay">
        </form>
    </section>
    <?php
    //$receiverEmail = 'evgueny007-facilitator@gmail.com'; //email получателя платежа(на него зарегестрирован paypal аккаунт)
    $receiverEmail = 'evgueny007@gmail.com';
    //$returnUrl = 'https://tutor.reallanguage.club/index.php/admin/getpaypal';
    $returnUrl = 'https://tutor.reallanguage.club/index.php/student/stepend';
    $customData = array ('student_id' => $student['id']);
     ?>
    <form class="" action="https://www.paypal.com/cgi-bin/websc" method="post" id="paypal_form">
    <!-- <form class="" action="https://www.sandbox.paypal.com/cgi-bin/websc" method="post" id="paypal_form"> -->
        <input type="hidden" name="cmd" value="_xclick" id="cmd">
        <!--<input type="hidden" name="landing_page" value="billing"> -->
        <input type="hidden" name="business" value="<?php echo $receiverEmail; ?>">
        <input id="paypalAmmount" type="hidden" name="amount" value="">
        <input type="hidden" name="return" value="<?php echo $returnUrl; ?>">
        <input type="hidden" name="custom" value="<?php echo $student['id']?>"  id="paypal_ex_id">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="bn" value="PP-BuyNowBF">
    </form>
    <form class="hidden" method="POST" action="https://money.yandex.ru/quickpay/confirm.xml"  id="yandex_form">
        <input type="hidden" name="receiver" value="410011776472684">
        <!-- <input type="hidden" name="receiver" value="410014468308149"> -->
        <input type="hidden" name="formcomment" value="Сайт Reallanguage.club">
        <input type="hidden" name="short-dest" value="За услуги репетитора">
        <input type="hidden" name="label" value="" id="yandex_ex_id">
        <input type="hidden" name="quickpay-form" value="donate">
        <input type="hidden" name="targets" value="транзакция {order_id}">
        <input type="hidden" name="sum" value="4568.25" data-type="number"  id="yandex_sum">
        <input type="hidden" name="comment" value="">
        <input type="hidden" name="need-fio" value="true">
        <input type="hidden" name="need-email" value="true">
        <input type="hidden" name="need-phone" value="false">
        <input type="hidden" name="need-address" value="false">
        <label><input type="radio" name="paymentType" value="PC"  id="yandex_mon">Яндекс.Деньгами</label>
        <label><input type="radio" name="paymentType" value="AC" id="yandex_card">Банковской картой</label>
    </form>
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
