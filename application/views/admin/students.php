<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
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
        <?php
            foreach ($students as $student) {
                if ($student['status'] != 3){
                    echo '<aside>';
                    echo '<div><p>'.$student['first_name'].'</p>';
                    if ($student['father_name'] != ''){
                        echo '<p>'.$student['father_name'].'</p>';
                    }
                    echo '<p>ID ';
                    $len = strlen(strval($student['id']));
                    for($i = 0; $i < (7-$len); $i++){
                        echo '0';
                    }
                    echo $student['id'];
                    echo '</p></div>';
                    $date = substr($student['created_at'],8,2).'.'.substr($student['created_at'],5,2).'.'.substr($student['created_at'],0,4);
                    echo '<div><p>'.$date.'</p></div>';
                    echo '<div><p>'.'-'.'</p></div>';
                    $date = substr($student['visit_at'],8,2).'.'.substr($student['visit_at'],5,2).'.'.substr($student['visit_at'],0,4);
                    echo '<div><p>'.$date.'</p></div>';
                    echo '<div><p>'.$student['email'].'</p></div>';
                    echo '<div><p>'.$student['skype'].'</p></div>';
                    echo '<div><p>'.$student['req'].'</p></div>';
                    echo '<div><p>'.$student['free'].'</p></div>';
                    echo '<div><p>'.$student['buy'].'</p></div>';
                    echo '<div><p>'.$student['adds'].'</p></div>';
                    echo '<div><p>'.$student['balance'].'</p></div>';
                    echo '<div><p>'.$student['sum'].'</p></div>';
                    echo '<div><form action="'.base_url().'index.php/admin/changeStudent" method="post">';
                    echo '<a class="mess" href="'.base_url().'index.php/admin/chat?id='.$student['id'].'&role=2">Написать сообщение</a>';
                    if ($student['status'] == 1){
                        echo '<button class="off" name="off" type="submit">Выключить</button>';
                    } else{
                        echo '<button class="ok" name="ok" type="submit">Включить</button>';
                    }
                    echo '<button class="del" name="del" type="submit">Удалить</button>';
                    echo '<input type="hidden" value="'.$student['id'].'" name="id">';
                    echo '</form></div></aside>';
                }
            }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/students.js"></script>
<?php $this->load->view('main/footer'); ?>
