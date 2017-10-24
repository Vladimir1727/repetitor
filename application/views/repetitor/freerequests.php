<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Свободные заявки</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>

<main class="rep_free">
    <section class="start_less">
        <div>
            <h1>Свободные заявки</h1>
            <select id="subject_id">
                <option value="0">Выберите предмет</option>
                <?php
                // foreach ($subjects as $subject) {
                //     echo '<option value='.$subject['id'].'>'.$subject['subject'].'</option>';
                // }
                echo '<option value='.$repetitor['subject1'].'>'.$repetitor['sub1_name'].'</option>';
                if (!is_null($repetitor['subject2'])){
                    echo '<option value='.$repetitor['subject2'].'>'.$repetitor['sub2_name'].'</option>';
                }
                 ?>
            </select>
        </div>
        <div>
            <h3>18:20 (UTC+2)</h3>
            <h4>23 сентября 2017,суббота</h4>
        </div>
    </section>
    <h2 class="new">Новые заяки (<span id="c_new"><?php echo count($requests); ?></span>)</h2>
    <section class="head">
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
    </section>
    <section class="table" id="table_new">
        <?php
        foreach ($requests as $request) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $request['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo '</p>';
            echo '<h5>Откликнулись: '.$request['req'].'</h5>';
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
            echo '<button class="ok">Откликнуться</button>';
            echo '<button class="del">Отклонить</button>';
            echo '<input type="hidden" name="id" value='.$request['id'].'>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
    <h2 class="old">Отвеченные (<span id="c_old"><?php echo count($accepted); ?></span>)</h2>
    <section class="head">
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
    </section>
    <section class="table" id="table_old">
        <?php
        foreach ($accepted as $request) {
            echo '<aside>';
            echo '<div>';
            echo '<p>';
            $c = $request['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2);
            echo '</p>';
            echo '<h5>Откликнулись: '.$request['req'].'</h5>';
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
            echo '<a href="'.base_url().'index.php/repetitor/chat?id='.$request['student_id'].'" class="mess">Чат с учеником</a>';
            echo '<button class="del">Отклонить</button>';
            echo '<input type="hidden" name="id" value='.$request['id'].'>';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
</main>

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/freerequests.js"></script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
