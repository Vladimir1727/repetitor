<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Уроки</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<?php
$zone = ' (UTC';
$zone .= ($student['tzone']>0) ? '+'.$student['tzone'] : $student['tzone'];
$zone .= ')';
 ?>
<main class="rep_lessons">
    <section class="start_less">
        <div>
            <h1>Уроки</h1>
        </div>
        <div>
            <h3><span id="local-time">18:20</span><?php echo $zone; ?></h3>
            <h4 id="local-date">23 сентября 2017,суббота</h4>
        </div>
    </section>
    <section class="head">
        <div>
            <p>Дата и время урока</p>
        </div>
        <div>
            <p>Репетитор</p>
        </div>
        <div>
            <p>Предмет</p>
        </div>
        <div>
            <p>Skype реетитора</p>
        </div>
        <div>
            <p>Специализация</p>
        </div>
        <div>
            <p>Пожелания ученика</p>
        </div>
        <div>
            <p>Кол-во уроков/мин.</p>
        </div>
        <div>
            <p>Действия</p>
        </div>
    </section>
    <section class="table">
        <?php
        foreach ($lessons as $lesson) {
            echo '<aside>';
            echo '<div>';
            $c = $lesson['date_from'];
            $n = date('Y-m-d H:i:s', strtotime($lesson['date_from']) + 60*60);
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo ' - '.substr($n,11,2).':'.substr($n,14,2);
            echo '</p><p>'.$zone;
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['repetitor'];
            echo '<p></p>ID '.$lesson['repetitor_id'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['subject'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['skype'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['specialization'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['about'];
            echo '</p></div>';
            echo '<div><p>';
            echo '1/50 мин.';
            echo '</p></div>';
            echo '<div>';
            echo '<form>';
            if ($lesson['active']){
                echo '<button class="ok">Начать урок</button>';
            }
            echo '<input name="id" type="hidden" value="'.$lesson['id'].'">';
            echo '<a class="mess" href="'.base_url().'index.php/student/chat?id='.$lesson['repetitor_id'].'">Сообщение</a>';
            if ($lesson['calcel']){
                echo '<button class="del">Отменить</button>';
            }
            echo '</form>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>


<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/lessons.js"></script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
