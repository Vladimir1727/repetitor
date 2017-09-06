<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. История уроков</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-lessonshistory">
    <section class="start_less">
        <div>
            <h1>История уроков</h1>
        </div>
        <div>
            <h3>15:35 (UTC+2)</h3>
            <h4>24 сентября 2017,воскресенье</h4>
        </div>
    </section>
    <section class="head">
        <aside>
            <div>
                <p>Дата и время урока</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Репетитор</p>
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
                <p>Кол-во уроков/минут</p>
            </div>
            <div>
                <p>Статус</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <aside>
            <div>
                <p>22.10.2017</p>
                <p>18:30–19:30</p>
                <p>(UTC +2)</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 11111111</p>
            </div>
            <div>
                <p>Светлана</p>
                <p>ID 22222222</p>
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
                <p>1/50 мин.</p>
            </div>
            <div>
                <p class="ok">Проведён</p>
            </div>
        </aside>
        <aside>
            <div>
                <p>23.10.2017</p>
                <p>18:30–19:30</p>
                <p>(UTC +2)</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 11111111</p>
            </div>
            <div>
                <p>Светлана</p>
                <p>ID 22222222</p>
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
                <p>1/50 мин.</p>
            </div>
            <div>
                <p class="del">Отменён</p>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
