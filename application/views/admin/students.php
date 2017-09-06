<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Ученики.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-students">
    <h1>Ученики</h1>
    <section class="head">
        <aside>
            <div>
                <p>Имя+ID Ученика</p>
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
                <p>email</p>
            </div>
            <div>
                <p>Skype</p>
            </div>
            <div>
                <p>Запросов на уроки</p>
            </div>
            <div>
                <p>Свободные заявки</p>
            </div>
            <div>
                <p>Купил уроков</p>
            </div>
            <div>
                <p>Общая сумма пополнений, $</p>
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
                <button class="mess">Написать сообщение</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
