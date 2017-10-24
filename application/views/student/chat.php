<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Чат ученика</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<input type="hidden" value="<?php echo $student['id']; ?>" id="student_id">
<input type="hidden" value="<?php echo $student['avatar']; ?>" id="student_avatar">
<input type="hidden" value="<?php echo $student['first_name']; ?>" id="student_name">
<input type="hidden" value="<?php echo $start_id; ?>" id="start_id">
<input type="hidden" value="<?php echo $role; ?>" id="start_role">
<main class="chat">
    <section class="users">
        <div  id="user">

        </div>
        <div  id="users">

        </div>
    </section>
    <section class="mess">
        <aside class="plan">
            <a href="#" id="plan">Запланировать урок</a>
        </aside>
        <aside class="chat" id="chat">

        </aside>
        <aside class="send">
            <a href="#" id="send_but">Отправить</a>
            <div>
                <textarea id="message"></textarea>
            </div>
        </aside>
    </section>
</main>
<script src="<?php echo base_url(); ?>js/student/chat.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
