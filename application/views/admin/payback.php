<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. возврат средств.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-payback">
    <h1>Запросы на вывод средств</h1>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($requests as $request) {
            if (is_null($request['done_at'])){
                echo '<aside>';
                echo '<div>';
                $c = $request['created_at'];
                echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
                echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['repetitor'].'</p>';
                echo '<p>ID '.$request['repetitor_id'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['type'].'</p>';
                echo '<p>'.$request['req'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['cost'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<a class="mess" href="chat?id='.$request['repetitor_id'].'&role=1">Написать сообщение</a>';
                echo '<button class="ok">В историю</button>';
                echo '<button class="del">Удалить</button>';
                echo '<input type="hidden" value='.$request['id'].' name="id">';
                echo '</div>';
                echo '</aside>';
            }
        }
         ?>
    </section>
    <h2>История запросов</h2>
    <section class="header">
        <aside>
            <div>
                <p>Дата/время</p>
            </div>
            <div>
                <p>Репетитор</p>
            </div>
            <div>
                <p>Способ вывода</p>
            </div>
            <div>
                <p>Сумма ($)</p>
            </div>
            <div>
                <p>Действия</p>
            </div>
        </aside>
    </section>
    <section class="table">
        <?php
        foreach ($requests as $request) {
            if (!is_null($request['done_at'])){
                echo '<aside>';
                echo '<div>';
                $c = $request['created_at'];
                echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
                echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['repetitor'].'</p>';
                echo '<p>ID '.$request['repetitor_id'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['type'].'</p>';
                echo '<p>'.$request['req'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<p>'.$request['cost'].'</p>';
                echo '</div>';
                echo '<div>';
                echo '<a class="mess" href="chat?id='.$request['repetitor_id'].'&role=1">Написать сообщение</a>';
                echo '<button class="del">Удалить</button>';
                echo '<input type="hidden" value='.$request['id'].' name="id">';
                echo '</div>';
                echo '</aside>';
            }
        }
         ?>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/admin/payback.js"></script>
<?php $this->load->view('main/footer'); ?>
