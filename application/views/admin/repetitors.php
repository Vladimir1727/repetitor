<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Репетиторы.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-repetitors">
    <h1>Репетиторы</h1>
    <section class="head">
        <aside>
            <div>
                <p>Имя+ID Репетитора</p>
            </div>
            <div>
                <p>Дата регистрации</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>дата последнего входа</p>
            </div>
            <div>
                <p>Рейтинг</p>
            </div>
            <div>
                <p>email</p>
            </div>
            <div>
                <p>Skype</p>
            </div>
            <div>
                <p>Кол-во учеников</p>
            </div>
            <div>
                <p>Получил заявок</p>
            </div>
            <div>
                <p>Провёл уроков</p>
            </div>
            <div>
                <p>Сред. кол-во уроков с одним уч.</p>
            </div>
            <div>
                <p>Заработал, всего, $</p>
            </div>
            <div>
                <p>Баланс, текущий, $</p>
            </div>
            <div>
                <p>Система заработала, $</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <aside>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <button class="mess">Написать сообщение</button>
                <button class="on">Включить</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
        <aside>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <button class="mess">Написать сообщение</button>
                <button class="off">Отключить</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
    <h2>Кандидаты</h2>
    <section class="head_kand">
        <aside>
            <div>
                <p>Имя + ID Репетитора</p>
            </div>
            <div>
                <p>Дата регистрации</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>email</p>
            </div>
            <div>
                <p>Skype</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table_kand">
        <aside>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <p></p>
            </div>
            <div>
                <button class="mess">Просмотреть профиль</button>
                <button class="ok">Включить</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
