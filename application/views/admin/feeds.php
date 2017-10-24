<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Отзывы.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-chathistory">
    <h1>Отзывы</h1>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время отзыва</p>
            </div>
            <div>
                <p>Имя + ID Ученика</p>
            </div>
            <div>
                <p>Имя + ID Репетитора</p>
            </div>
            <div>
                <p>Текст отзыва</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($feeds as $feed) {
            echo '<aside>';
            echo '<div>';
            $c = $feed['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$feed['student'].'</p>';
            echo '<p>ID '.$feed['student_id'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$feed['repetitor'].'</p>';
            echo '<p>ID '.$feed['repetitor_id'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<div class="stars">';
            for ($i=1; $i <= $feed['rating'] ; $i++) {
                echo '<span class="star1"></span>';
            }
            for ($i=5; $i > $feed['rating'] ; $i--) {
                echo '<span class="star0"></span>';
            }
            echo '</div>';
            echo '<p>'.$feed['about'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<button class="del">Очистить</button>';
            echo '<input type="hidden" value='.$feed['id'].' name="id">';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/feeds.js"></script>
<?php $this->load->view('main/footer'); ?>
