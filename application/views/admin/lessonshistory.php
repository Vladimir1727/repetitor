<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. История уроков</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-lessonshistory">
    <section class="start_less">
        <div>
            <h1>История уроков</h1>
        </div>
        <div>
            <!-- <h3>15:35 (UTC+2)</h3>
            <h4>24 сентября 2017,воскресенье</h4> -->
        </div>
    </section>
    <section class="head">
        <aside>
            <div>
                <p>Дата и время урока</p>
            </div>
            <div>
                <p>Ученик</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Предмет</p>
            </div>
            <div>
                <p>Специализация</p>
            </div>
            <div>
                <p>Пожелания Ученика</p>
            </div>
            <div>
                <p>Кол-во уроков/минут</p>
            </div>
            <div>
                <p>Статус</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($lessons as $lesson) {
            echo '<aside>';
            echo '<div>';
            $c = $lesson['date_from'];
            $n = date('Y-m-d H:i:s', strtotime($c) + 60*60);
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo ' - '.substr($n,11,2).':'.substr($n,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['student'];
            echo '</p>';
            echo '<p>';
            echo 'ID '.$lesson['student_id'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['repetitor'];
            echo '</p>';
            echo '<p>';
            echo 'ID '.$lesson['repetitor_id'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['subject'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['specialization'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['about'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo '1/50 мин';
            echo '</p>';
            echo '</div>';
            echo '<div>';
            if ($lesson['status'] == 'Проведён'){
                echo '<p class="ok">';
            } else{
                echo '<p class="del">';
            }
            echo $lesson['status'];
            echo '</p>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<?php $this->load->view('main/footer'); ?>
