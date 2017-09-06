<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Избранные репетиторы</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="student_favorites">
    <section class="start_less">
        <div>
            <h1>Избранные репетиторы</h1>
        </div>
        <div>
            <h3>15:35 (UTC+2)</h3>
            <h4>22 октября 2017,воскресенье</h4>
        </div>
    </section>
    <table>
        <thead>
            <tr>
                <th>Репетиторы</th>
                <th>Предмет</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p>Светлана</p>
                    <p>ID333333</p>
                </td>
                <td>
                    <p>Английский язык</p>
                </td>
                <td>
                    <button class="ok">Запланировать урок</button>
                    <button class="mess">Сообщение</button>
                </td>
            </tr>
        </tbody>
    </table>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
