<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
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
        <?php
        foreach ($chats as $chat) {
            echo '<aside>';
            echo '<div>';
            $c = $chat['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$chat['student_name'].'</p>';
            echo '<p>ID '.$chat['student_id'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$chat['repetitor_name'].'</p>';
            echo '<p>ID '.$chat['repetitor_id'].'</p>';
            echo '</div>';
            echo '<div>';
            if ($chat['from_role']==1){
                echo '<p class="repetitor">'.$chat['repetitor_name'].'</p>';
            } else{
                echo '<p class="student">'.$chat['student_name'].'</p>';
            }
            echo '<p>'.$chat['message'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<a class="mess" href="chat?id='.$chat['from_id'].'&role='.$chat['from_role'].'">Написать сообщение</a>';
            echo '<button class="del">Удалить</button>';
            echo '<input type="hidden" value='.$chat['id'].' name="id">';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/chathistory.js"></script>
<?php $this->load->view('main/footer'); ?>
