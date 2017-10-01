<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Запросы на уроки</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<input type="hidden" name="timezone" value="<?php echo ($student['tzone']) ?>">

<main class="rep_less_request">
    <section class="start_less">
        <div>
            <h1>Запросы на уроки</h1>
        </div>
        <div>
            <h3><span id="local-time">18:20</span> (UTC <?php echo ($student['tzone']>0) ? '+'.$student['tzone'] : $student['tzone']; ?>)</h3>
            <h4 id="local-date">23 сентября 2017,суббота</h4>
        </div>
    </section>
    <section class="head">
        <div>
            <p>Дата запроса</p>
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
            <p>Время / дата</p>
        </div>
        <div>
            <p>Кол-во уроков/мин.</p>
        </div>
        <div>
            <p>Сумма (общая)</p>
        </div>
        <div>
            <p>Действия</p>
        </div>
    </section>
    <section class="table">

        <?php
        foreach ($lessons as $lesson) {
            echo '<aside>';
            echo '<div><p>';
            $c = $lesson['created_at'];
            echo substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4);
            echo '</p><p>'.substr($c,11,2).':'.substr($c,14,2);
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['repetitor'];
            echo '<p></p>ID '.$lesson['repetitor_id'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['subject'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['specialization'];
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['about'];
            echo '</p></div>';
            echo '<div>';
            foreach ($lesson['dates'] as $d) {
                echo '<p>'.substr($d,8,2).'.'.substr($d,5,2).'.'.substr($d,0,4).'</p>';
                echo '<p>'.substr($d,11,2).':'.substr($d,14,2).'</p>';
            }
            echo '</div>';
            echo '<div><p>';
            echo $lesson['count'].'/'.($lesson['count']*50).' мин';
            echo '</p></div>';
            echo '<div><p>';
            echo $lesson['sum'];
            echo '$</p></div>';
            echo '<div>';
            echo '<form>';
            if (is_null($lesson['pay_at'])){
                echo '<input class="ok pay" name="pay" type="submit" value="Оплатить">';
            }else{
                //echo '<input class="ok wait" name="wait" type="submit" value="На рассмотрении">';
                echo '<button class="ok wait">На рассмотрении</button>';
            }
            foreach ($lesson['ids'] as $ids) {
                echo '<input name="ids[]" type="hidden" value="'.$ids.'">';
            }
            echo '<a class="mess" href="'.base_url().'index.php/student/chat?id='.$lesson['repetitor_id'].'">Сообщение</a>';
            echo '<input class="del" name="del" type="submit" value="Удалить">';
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
<script src="<?php echo base_url(); ?>js/student/lessonsrequests.js"></script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
