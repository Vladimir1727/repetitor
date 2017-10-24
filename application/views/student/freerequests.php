<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Свободные заявки</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<?php
$zone = ' (UTC';
$zone .= ($student['tzone']>0) ? '+'.$student['tzone'] : $student['tzone'];
$zone .= ')';
 ?>
<main class="student_free">
    <section class="start_less">
        <div>
            <h1>Свободные заявки</h1>
        </div>
        <div>
            <h3><span id="local-time">18:20</span><?php echo $zone; ?></h3>
            <h4 id="local-date">23 сентября 2017,суббота</h4>
        </div>
    </section>
    <h2 class="posted">Размещённые заявки</h2>
    <section class="head">
        <div>
            <p>Дата запроса</p>
        </div>
        <div>
            <p>Предмет</p>
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
    <section class="table">
        <?php
        foreach ($requests as $request) {
            echo '<aside>';
            echo '<div>';
            $c =  $request['created_at'];
            echo '<p>'.substr($c,8,2).'.'.substr($c,5,2).'.'.substr($c,0,4).'</p>';
            echo '<p>'.substr($c,11,2).':'.substr($c,14,2).'</p>';
            echo '</div>';
            echo '<div>';
            echo '<p>';
            echo $request['subject'];
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
            echo '<h5>Откликнулись: '.$request['req'].'</h5>';
            if ($request['req']>0){
                echo '<button class="ok">Показать</button>';
            }
            //echo '<a class="ok" href="#">Показать</a>';
            echo '<button class="del">Удалить заявку</button>';
            echo '<input type="hidden" value='.$request['id'].' name="id">';
            echo '</div>';
            echo '</aside>';
        }
         ?>
    </section>
    <h2 class="new">Новая заявка</h2>
    <form method="post" action="addfreerequest">
    <section class="new">
        <label>
            <h3>Предмет</h3>
            <select id="subject_id" name="subject_id">
                <option value="0">Выберите предмет</option>
                <?php
                foreach($subjects as $subject){
                    echo '<option value="'.$subject['id'].'">'.$subject['subject'].'</option>';
                }
                 ?>
            </select>
        </label>
        <label>
            <div>
                <h3>Цель обучения</h3>
                <h5>кратко изложите Вашу заявку</h5>
            </div>
            <div>
                <textarea id="about" name="about"></textarea>
            </div>
        </label>
        <label>
            <div>
                <h3>Время занятий</h3>
                <h5>Напишите удобное для Вас время и дни недели</h5>
            </div>
            <div>
                <textarea id="dates" name="about_time"></textarea>
            </div>
        </label>
    </form>
        <button id="add_but">Разместить</button>
    </section>
</main>

<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/freerequests.js"></script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
