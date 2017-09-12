<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. История Чатов.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-chathistory">
    <h1>История чатов</h1>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время сообщения</p>
            </div>
            <div>
                <p>Имя + ID Ученика</p>
            </div>
            <div>
                <p>Имя + ID Репетитора</p>
            </div>
            <div>
                <p>Текст сообщения</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <aside>
            <div>
                <p>23.10.2017</p>
                <p>14:35 UTC + 3</p>
            </div>
            <div>
                <p>Мария</p>
                <p>ID 22222222</p>
            </div>
            <div>
                <p>Светлана</p>
                <p>ID 22222222</p>
            </div>
            <div>
                <p class="student">Мария:</p>
                <p>Хотела бы записаться на урок к Вам. Можете рассказать подронее о методке обучения</p>
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
