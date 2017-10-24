<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Свободные заявки.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-free">
    <h1>Свободные заявки</h1>
    <h2 class="new">Новые заявки (<?php echo count($requests); ?>)</h2>
    <section class="head">
        <aside>
            <div>
                <p>Дата запроса</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Цель ученика</p>
            </div>
            <div>
                <p>Удобный день/время</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($requests as $request) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $request['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['subject'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['student_name'];
            echo '</p>';
            echo '<p>';
            echo 'ID '.$request['student_id'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['about'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['about_time'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<button class="ok">Одобрить</button>';
            echo '<button class="mess">Редактировать</button>';
            echo '<button class="del">Удалить</button>';
            echo '<input type="hidden" value='.$request['id'].' name="id">';
            echo '<input type="hidden" value="'.$request['about'].'" name="about">';
            echo '<input type="hidden" value="'.$request['about_time'].'" name="about_time">';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
    <h2 class="ok">Одобренные (<?php echo count($accepted); ?>)</h2>
    <section class="head">
        <aside>
            <div>
                <p>Дата запроса</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Цель ученика</p>
            </div>
            <div>
                <p>Удобный день/время</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($accepted as $request) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $request['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo '</p>';
            echo '<h5>Отозвались: '.$request['req'].'</h5>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['subject'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['student_name'];
            echo '</p>';
            echo '<p>';
            echo 'ID '.$request['student_id'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['about'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['about_time'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<h5>Отозвались: '.$request['req'].'</h5>';
            if ($request['req']>0){
                echo '<button class="show">Показать</button>';
            }
            echo '<button class="del">Удалить</button>';
            echo '<input type="hidden" value='.$request['id'].' name="id">';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/freerequests.js"></script>
<?php $this->load->view('main/footer'); ?>
