<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. История уроков</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_getmoney">
    <h1>Вывод средств</h1>
    <h2>Баланс личного счёта: <span class="total">0 $</span></h2>
    <h2>Сумма вывода: <input type="text" placeholder="$"></h2>
    <h2>Способ вывода:</h2>
    <div class="pay_type">
        <label>
            <input type="radio" value="0" name="type"  checked><span class="check"></span>
            <span class="img"><img src="<?php echo base_url(); ?>img/yandex.png" alt="yandex"></span>
            <span class="number">
                <?php
                echo $repetitor['yandex'];
                if (is_null($repetitor['yandex']) || $repetitor['yandex'] == ''){
                    echo 'нет данных';
                } else{
                    echo $repetitor['yandex'];
                }
                ?>
            </span>
        </label>
        <label>
            <input type="radio" value="0" name="type"><span class="check"></span>
            <span class="img"><img src="<?php echo base_url(); ?>img/paypal.png" alt="paypal"></span>
            <span class="number">
                <?php
                if (is_null($repetitor['paypal']) || $repetitor['paypal'] == ''){
                    echo 'нет данных';
                } else{
                    echo $repetitor['paypal'];
                }
                ?>
            </span>
        </label>
        <button>Отправить запрос</button>
    </div>
</main>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
