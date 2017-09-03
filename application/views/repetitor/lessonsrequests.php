<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Запросы на уроки</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_less_request">
    <section class="start_less">
        <div>
            <h1>Запросы на уроки</h1>
        </div>
        <div>
            <h3>18:20 (UTC+2)</h3>
            <h4>23 сентября 2017,суббота</h4>
        </div>
    </section>
    <section class="head">
        <div>
            <p>Дата запроса</p>
        </div>
        <div>
            <p>Ученик</p>
        </div>
        <div>
            <p>Предмет</p>
        </div>
        <div>
            <p>Специализация</p>
        </div>
        <div>
            <p>Пожелания Ученика</p>
        </div>
        <div>
            <p>Время / дата</p>
        </div>
        <div>
            <p>Кол-во уроков/мин.</p>
        </div>
        <div>
            <p>Сумма (общая)</p>
        </div>
        <div>
            <p>Действия</p>
        </div>
    </section>
    <section class="table">
        <aside>
            <div>
                <p>22.09.2017</p>
                <p>22:35</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID11111111</p>
            </div>
            <div>
                <p>Английский язык</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>Повысить уровень понимания устной речи</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 – 19:30</p>
            </div>
            <div>
                <p>1/50 мин.</p>
            </div>
            <div>
                <p>10 $</p>
            </div>
            <div>
                <button class="ok">Принять</button>
                <button class="mess">Сообщение</button>
                <button class="del">Отклонить</button>
            </div>
        </aside>
        <aside>
            <div>
                <p>22.09.2017</p>
                <p>22:35</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID11111111</p>
            </div>
            <div>
                <p>Английский язык</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>Повысить уровень понимания устной речи</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 – 19:30</p>
            </div>
            <div>
                <p>1/50 мин.</p>
            </div>
            <div>
                <p>10 $</p>
            </div>
            <div>
                <button class="ok">Принять</button>
                <button class="mess">Сообщение</button>
                <button class="del">Отклонить</button>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
