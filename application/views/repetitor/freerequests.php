<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Свободные заявки</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_free">
    <section class="start_less">
        <div>
            <h1>Свободные заявки</h1>
            <select>
                <option value="0">Выберите предмет</option>
            </select>
        </div>
        <div>
            <h3>18:20 (UTC+2)</h3>
            <h4>23 сентября 2017,суббота</h4>
        </div>
    </section>
    <h2 class="new">Новые заяки (10)</h2>
    <section class="head">
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
                <p>ID11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 - 19:30</p>
            </div>
            <div>
                <button class="mess">Откликнуться</button>
                <button class="del">Отклонить</button>
            </div>
        </aside>
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
                <p>ID11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 - 19:30</p>
            </div>
            <div>
                <button class="mess">Откликнуться</button>
                <button class="del">Отклонить</button>
            </div>
        </aside>
    </section>
    <h2 class="old">Отвеченные (2)</h2>
    <section class="head">
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
                <p>ID11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 - 19:30</p>
            </div>
            <div>
                <button class="mess">Чат с учеником</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
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
                <p>ID11111111</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 - 19:30</p>
            </div>
            <div>
                <button class="mess">Чат с учеником</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
