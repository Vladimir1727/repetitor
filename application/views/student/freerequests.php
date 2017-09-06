<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Свободные заявки</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>

<main class="student_free">
    <section class="start_less">
        <div>
            <h1>Свободные заявки</h1>
        </div>
        <div>
            <h3>18:20 (UTC+2)</h3>
            <h4>23 сентября 2017,суббота</h4>
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
        <aside>
            <div>
                <p>22.09.2017</p>
                <p>22:45</p>

            </div>
            <div>
                <p>Английский язык</p>
            </div>
            <div>
                <p>Сдача экзамена B2</p>
            </div>
            <div>
                <p>23.09.2017</p>
                <p>18:30 - 19:30</p>
            </div>
            <div>
                <h5>Откликнулись: 5</h5>
                <button class="ok">Показать</button>
                <button class="del">Удалить заявку</button>
            </div>
        </aside>
    </section>
    <h2 class="new">Новая заявка</h2>
    <section class="new">
        <label>
            <h3>Предмет</h3>
            <select>
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
                <textarea></textarea>
            </div>
        </label>
        <label>
            <div>
                <h3>Время занятий</h3>
                <h5>Напишите удобное для Вас время и дни недели</h5>
            </div>
            <div>
                <textarea></textarea>
            </div>
        </label>
        <button>Разместить</button>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/chat.js"></script>
<?php $this->load->view('main/footer'); ?>
