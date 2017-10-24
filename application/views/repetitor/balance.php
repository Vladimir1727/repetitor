<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Баланс</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_balance">
    <section class="start_balance">
        <h1>Баланс личного счёта: <span><?php echo $repetitor['balance']; ?> $</span></h1>
        <a href="<?php echo base_url(); ?>index.php/repetitor/getmoney">Вывести средства</a>
    </section>
    <h2>История транзакций:</h2>
    <h3 class="in">Зачисления</h3>
    <section class="header-in in">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Ученик</p>
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
            echo $pay['student_name'];
            echo '</p>';
            echo '<p>ID';
            echo $pay['student_id'];
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo '1 урок по расписанию';
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $pay['cost'];
            echo '</p>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
    <h3 class="out">Вывод средств</h3>
    <section class="header-out out">
        <aside>
            <div>
                <p>Дата</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
        </aside>
    </section>
    <section class="table out">
        <!-- <aside>
            <div>
                <p>25.10.2017</p>
            </div>
            <div>
                <p>Яндекс Деньги</p>
            </div>
            <div>
                <p>600</p>
            </div>
        </aside> -->
        <?php
        foreach ($salaries as $sal) {
            echo '<aside>';
            echo '<div>';
            $c = $sal['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '<p>';
            if (is_null($sal['done_at'])){
                echo 'Запрошено';
            } elseif($sal['is_done']==1){
                echo 'Подтверждено';
            } else{
                echo 'Отказано';
            }
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            if ($sal['type']=='yandex'){
                echo 'Яндекс Деньги';
            } elseif($sal['type']=='paypal'){
                echo 'PayPal';
            } else{
                echo 'Visa / Mastercard / Maestro';
            }
            echo '</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $sal['cost'].' $';
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
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
