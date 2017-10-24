<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Запросы на уроки</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_less_request">
    <section class="start_less">
        <div>
            <h1>Запросы на уроки</h1>
        </div>
        <div>
            <h3><span id="local-time">18:20</span> (UTC <?php echo ($repetitor['tzone']>0) ? '+'.$repetitor['tzone'] : $repetitor['tzone']; ?>)</h3>
            <h4 id="local-date">23 сентября 2017,суббота</h4>
        </div>
    </section>
    <section class="head">
        <div>
            <p>Дата запроса</p>
        </div>
        <div>
            <p>Ученик</p>
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
        foreach ($lessons as $lesson){
            echo '<aside>';
            echo '<div>';
            $c = $lesson['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$lesson['student'].'</p>';
            echo '<p>ID '.$lesson['student_id'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$lesson['subject'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$lesson['specialization'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$lesson['about'].'</p>';
            echo '</div>';
            echo '<div>';
            $c = $lesson['date_from'];
            $n = date('Y-m-d H:i:s', strtotime($lesson['date_from']) + 60*60);
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo ' - '.substr($n,11,2).':'.substr($n,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>1 / 50 мин.</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$lesson['cost'].' $</p>';
            echo '</div>';
            echo '<div>';
            echo '<button class="ok" lesson="'.$lesson['id'].'">Принять</button>';
            echo '<a class="mess" href="'.base_url().'index.php/repetitor/chat?id='.$lesson['student_id'].'">Сообщение</a>';
            echo '<button class="del" lesson="'.$lesson['id'].'">Отклонить</button>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/lessonsRequests.js"></script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
