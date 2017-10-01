<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Баланс</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="rep_balance">
    <section class="start_balance">
        <h1>Баланс личного счёта: <span><?php echo $student['balance']; ?>$</span></h1>
        <!-- <button>Пополнить</button> -->
        <a href="<?php echo base_url(); ?>index.php/student/pay">Пополнить</a>
    </section>
    <h2>История транзакций:</h2>
    <h3 class="in">Оплата</h3>
    <section class="header-in in">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Основание</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table in">
        <?php
        foreach ($lessons as $lesson) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $lesson['pay_at'];
            echo substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4);
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
            echo $lesson['count'].' уроков по расписанию';
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['sum'];
            echo '</p>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
    <h3 class="out">Пополнения</h3>
    <section class="header-out out">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Способ пополнения</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table out">
        <?php
        foreach ($pays as $pay) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $pay['created_at'];
            echo substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4);
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $pay['type'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $lesson['cost'];
            echo '</p>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
