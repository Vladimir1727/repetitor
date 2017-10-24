<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Пополнение личного счета</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="student_pay">
    <h1>Пополнение личного счета</h1>
    <section>
        <form id="pay_form">
            <label>
                <h3>Пополнить на сумму</h3>
                <input type="text" placeholder="$" id="sum" name="sum">
                <input type="hidden" name="" value="" id="main_ex">
            </label>
            <h3>Выберите способ пополнения:</h3>
            <label>
                <input type="radio" name="pay_type" value="1" checked id="card">
                <span></span>
                Visa/MasterCart
            </label>
            <label>
                <input type="radio" name="pay_type" value="2" id="money">
                <span></span>
                ЯндексДеньги
            </label>
            <label>
                <input type="radio" name="pay_type" value="3" id="paypal">
                <span></span>
                PayPal
            </label>
            <a href="#" id="pay">Пополнить</a>
        </form>
    </section>
</main>
<?php
//$receiverEmail = 'evgueny007-facilitator@gmail.com'; //email получателя платежа(на него зарегестрирован paypal аккаунт)
$receiverEmail = 'evgueny007@gmail.com';
//$returnUrl = 'https://tutor.reallanguage.club/index.php/admin/getpaypal';
$returnUrl = 'https://tutor.reallanguage.club/index.php/student/';
$customData = array ('student_id' => $student['id']);
 ?>
<form class="" action="https://www.paypal.com/cgi-bin/websc" method="post" id="paypal_form">
<!-- <form class="" action="https://www.sandbox.paypal.com/cgi-bin/websc" method="post" id="paypal_form"> -->
    <input type="hidden" name="cmd" value="_xclick" id="cmd">
    <!-- <input name="item_name" type="hidden" value="За услуги репетитора" />
    <input name="item_number" type="hidden" value="1" /> -->
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



<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/pay.js"></script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
