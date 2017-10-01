<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Баланс</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_balance">
    <section class="start_balance">
        <h1>Баланс личного счёта: <span>0 $</span></h1>
        <a href="<?php echo base_url(); ?>index.php/repetitor/getmoney">Вывести средства</a>
    </section>
    <h2>История транзакций:</h2>
    <h3 class="in">Зачисления</h3>
    <section class="header-in in">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Основание</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table in">
        <aside>
            <div>
                <p>23.10.2017</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 22222222</p>
            </div>
            <div>
                <p>1 урок по расписанию</p>
            </div>
            <div>
                <p>600</p>
            </div>
        </aside>
    </section>
    <h3 class="out">Вывод средств</h3>
    <section class="header-out out">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table out">
        <aside>
            <div>
                <p>25.10.2017</p>
            </div>
            <div>
                <p>Яндекс Деньги</p>
            </div>
            <div>
                <p>600</p>
            </div>
        </aside>
    </section>
</main>

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
