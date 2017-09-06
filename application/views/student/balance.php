<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Баланс</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="rep_balance">
    <section class="start_balance">
        <h1>Баланс личного счёта: <span>100 $</span></h1>
        <!-- <button>Пополнить</button> -->
        <a href="<?php echo base_url(); ?>index.php/student/pay">Пополнить</a>
    </section>
    <h2>История транзакций:</h2>
    <h3 class="in">Оплата</h3>
    <section class="header-in in">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Репетитор</p>
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
                <p>Светлана</p>
                <p>ID 33333333</p>
            </div>
            <div>
                <p>1 урок по расписанию</p>
            </div>
            <div>
                <p>60</p>
            </div>
        </aside>
    </section>
    <h3 class="out">Пополнения</h3>
    <section class="header-out out">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Способ пополнения</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table out">
        <aside>
            <div>
                <p>21.10.2017</p>
            </div>
            <div>
                <p>Яндекс Деньги</p>
            </div>
            <div>
                <p>170</p>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
