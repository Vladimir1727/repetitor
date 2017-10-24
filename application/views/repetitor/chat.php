<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Чат репетитора.</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>
<input type="hidden" value="<?php echo $repetitor['id']; ?>" id="repetitor_id">
<input type="hidden" value="<?php echo $repetitor['avatar']; ?>" id="repetitor_avatar">
<input type="hidden" value="<?php echo $repetitor['first_name']; ?>" id="repetitor_name">
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

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
