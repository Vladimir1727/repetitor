<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
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
        <?php
            foreach ($repetitors as $repetitor) {
                if ($repetitor['status'] == 2){
                    echo '<aside>';
                    echo '<div><p>'.$repetitor['first_name'].'</p>';
                    if ($repetitor['father_name'] != ''){
                        echo '<p>'.$repetitor['father_name'].'</p>';
                    }
                    echo '<p>ID ';
                    $len = strlen(strval($repetitor['id']));
                    for($i = 0; $i < (7-$len); $i++){
                        echo '0';
                    }
                    echo $repetitor['id'];
                    echo '</p></div>';
                    $date = substr($repetitor['created_at'],8,2).'.'.substr($repetitor['created_at'],5,2).'.'.substr($repetitor['created_at'],0,4);
                    echo '<div><p>'.$date.'</p></div><div>';
                    if (!is_null($repetitor['subject1'])){
                        //echo '<p><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'?subject='.$repetitor['subject2'].'">'.$repetitor['subject2_name'].'</a></p>';
                        echo '<p><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'?subject='.$repetitor['subject1'].'">'.$repetitor['subject1_name'].'</a></p>';
                    }
                    if (!is_null($repetitor['subject2'])){
                        echo '<p><a href="'.base_url().'index.php/main/rinfo/'.$repetitor['id'].'?subject='.$repetitor['subject2'].'">'.$repetitor['subject2_name'].'</a></p>';
                    }
                    echo '</div>';
                    //echo '<div><p>'.$repetitor['visit_at'].'</p></div>';
                    $date = substr($repetitor['visit_at'],8,2).'.'.substr($repetitor['visit_at'],5,2).'.'.substr($repetitor['visit_at'],0,4);
                    echo '<div><p>'.$date.'</p></div>';
                    echo '<div><p>'.'0'.'</p></div>';
                    echo '<div><p>'.$repetitor['email'].'</p></div>';
                    echo '<div><p>'.$repetitor['skype'].'</p></div>';
                    echo '<div><p>'.$repetitor['students'].'</p></div>';
                    echo '<div><p>'.$repetitor['req'].'</p></div>';
                    echo '<div><p>'.$repetitor['lessons'].'</p></div>';
                    echo '<div><p>'.$repetitor['ls'].'</p></div>';
                    echo '<div><p>'.$repetitor['pay'].'</p></div>';
                    echo '<div><p>'.$repetitor['balance'].'</p></div>';
                    echo '<div><p>'.$repetitor['system'].'</p></div>';
                    echo '<div><form action="'.base_url().'index.php/admin/changeRepetitor" method="post">';
                    echo '<a class="mess" href="'.base_url().'index.php/admin/chat?id='.$repetitor['id'].'&role=1">Написать сообщение</a>';
                    echo '<button class="off" name="off" type="submit">Выключить</button>';
                    echo '<button class="del" name="del" type="submit">Удалить</button>';
                    echo '<input type="hidden" value="'.$repetitor['id'].'" name="id">';
                    echo '</form></div></aside>';
                }
            }
         ?>
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
            <?php
                foreach ($repetitors as $repetitor) {
                    if ($repetitor['status'] == 1){
                        echo '<aside>';
                        echo '<div><p>'.$repetitor['first_name'].'</p>';
                        if ($repetitor['father_name'] != ''){
                            echo '<p>'.$repetitor['father_name'].'</p>';
                        }
                        echo '<p>ID ';
                        $len = strlen(strval($repetitor['id']));
                        for($i = 0; $i < (7-$len); $i++){
                            echo '0';
                        }
                        echo $repetitor['id'];
                        echo '</p></div>';
                        $date = substr($repetitor['created_at'],8,2).'.'.substr($repetitor['created_at'],5,2).'.'.substr($repetitor['created_at'],0,4);
                        echo '<div><p>'.$date.'</p></div>';
                        echo '<div><p>'.$repetitor['subject1'].'</p>';
                        if (!is_null($repetitor['subject2'])){
                            echo '<p>'.$repetitor['subject2'].'</p>';
                        }
                        echo '</div>';
                        echo '<div><p>'.$repetitor['email'].'</p></div>';
                        echo '<div><p>'.$repetitor['skype'].'</p></div>';
                        echo '<div><form action="'.base_url().'index.php/admin/changeRepetitor" method="post">';
                        echo '<button class="mess" name="view" type="submit">Просмотреть профиль</button>';
                        echo '<button class="ok" name="ok" type="submit">Включить</button>';
                        echo '<button class="del" name="del" type="submit">Удалить</button>';
                        echo '<input type="hidden" value="'.$repetitor['id'].'" name="id">';
                        echo '</form></div></aside>';
                    }
                }
             ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/repetitors.js"></script>
<?php $this->load->view('main/footer'); ?>
