<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. возврат средств.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-payback">
    <h1>Запросы на вывод средств</h1>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
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
                <p>Светлана</p>
                <p>ID 22222222</p>
            </div>
            <div>
                <p>ЯндексДеньги</p>
                <p>4546576444</p>
            </div>
            <div>
                <p>100</p>
            </div>
            <div>
                <button class="mess">Написать сообщение</button>
                <button class="ok">В историю</button>
                <button class="del">Удалить</button>
            </div>
        </aside>
    </section>
    <h2>История запросов</h2>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
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
                <p>Светлана</p>
                <p>ID 22222222</p>
            </div>
            <div>
                <p>ЯндексДеньги</p>
                <p>4546576444</p>
            </div>
            <div>
                <p>100</p>
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
