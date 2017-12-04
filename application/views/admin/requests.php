<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Запросы</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-chathistory">
    <h1>Запросы на уроки</h1>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время создания</p>
            </div>
            <div>
                <p>Дата/время урока</p>
            </div>
            <div>
                <p>Имя + ID Ученика</p>
            </div>
            <div>
                <p>Имя + ID Репетитора</p>
            </div>
            <div>
                <p>Статус</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        $szone = date('H',time())-gmdate('H', time());
        foreach ($requests as $req) {
            echo '<aside>';
            echo '<div>';
            $c = $req['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            $adminZone = 1;
            $c = date('Y-m-d H:i:s', strtotime($req['date_from']) + $adminZone*60*60);
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$req['student_name'].'</p>';
            echo '<p>ID '.$req['student_id'].'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>'.$req['repetitor_name'].'</p>';
            echo '<p>ID '.$req['repetitor_id'].'</p>';
            echo '</div>';
            echo '<div>';
            if (time() > (strtotime($req['date_from']) + ($szone+60/10)*60*60)){
                echo '<p class="text-danger text-center">ПРОСРОЧЕН</p>';
            } else{
                echo '<p class="text-center text-success">ожидает одобрения</p>';
            }
            if (is_null($req['pay_at'])){
                echo '<p class="text-center">не оплачен</p>';
            } else{
                echo '<p class="text-center text-success">Оплачен</p>';
            }
            echo '</div>';

            echo '</aside>';
        }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/feeds.js"></script>
<?php $this->load->view('main/footer'); ?>
