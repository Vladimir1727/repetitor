<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Свободные заявки.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-free">
    <h1>Свободные заявки</h1>
    <h2 class="new">Новые заявки (10)</h2>
    <section class="head">
        <aside>
            <div>
                <p>Дата запроса</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Цель ученика</p>
            </div>
            <div>
                <p>Удобный день/время</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <aside>
            <div>
                <p>22.09.2017</p>
                <p>22:45</p>
                <h5>Откликнулись: 5</h5>
            </div>
            <div>
                <p>Английский язык</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 – 19:30</p>
            </div>
            <div>
                <button class="ok">Одобрить</button>
                <button class="mess">Редактировать</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
    <h2 class="ok">Одобренные (1)</h2>
    <section class="head">
        <aside>
            <div>
                <p>Дата запроса</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Цель ученика</p>
            </div>
            <div>
                <p>Удобный день/время</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <aside>
            <div>
                <p>22.09.2017</p>
                <p>22:45</p>
                <h5>Откликнулись: 5</h5>
            </div>
            <div>
                <p>Английский язык</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 – 19:30</p>
            </div>
            <div>
                <h5>Откликнулись: 5</h5>
                <button class="mess">Показать</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
