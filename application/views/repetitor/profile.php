
<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Профиль репетитора</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>
<section class="start-profile">
    <h1>Приветствуем Вас на странице «Настройка профиля»!</h1>
    <ul>
        <li>Для того чтобы стать нашим репетитором, Вам осталось сделать несколько шагов.</li>
        <li>Заполните все поля во вкладках и отправьте запрос на активацию профиля.</li>
        <li>После подачи заявки, профиль попадает на рассмотрение к методисту. В первую очередь рассматриваются максимально заполненные профили.</li>
        <li>При положительном результате ответ об активности профиля Вы получите на указанный Вами адрес электронной почты или сможете проверить в личном кабинете через 24 часа после подачи заявки.</li>
    </ul>
</section>
<main class="rep-profile">
    <section class="menu">
        <ul>
            <li><a href="#" class="active" id="personal-but">Личные данные</a></li>
            <li><a href="#">Предмет</a></li>
            <li><a href="#">Образование и опыт</a></li>
            <li><a href="#">Документы</a></li>
            <li><a href="#" id="present-but">Презентация</a></li>
            <li><a href="#">Реквизиты</a></li>
            <li><a href="#">Состояние профиля</a></li>
        </ul>
    </section>
    <section class="warp">
        <aside id="personal">
            <form method="post">
                <div>
                    <input type="text" name="first_name" placeholder="Имя*">
                    <input type="text" name="last_name" placeholder="Фамилия*">
                    <input type="text" name="father_name" placeholder="Отчество">
                </div>
                <div>
                    <select name="tzone">
                        <?php
                            foreach ($tzones as $option) {
        						echo '<option value="'.$option['id'].'">'.$option['zone_name'].'</option>';
                            }
                        ?>
                    </select>
                    <input type="text" name="phone" placeholder="Телефон">
                    <input type="text" name="skype" placeholder="Логин Skype*">
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email*">
                    <input type="text" name="password" placeholder="Пароль*">
                    <input type="text" name="password" placeholder="Подтверждение пароля*">
                </div>
                <button type="submit" name="button">Сохранить</button>
            </form>
        </aside>
        <aside id="present">
            <div class="avatar">
                <div class="img">
                    <img src="<?php echo base_url(); ?>img/avatar3.png" alt="empty avarat" style="padding-top: 30px">
                </div>
                <p>
                    *Загрузите вашу фотографию* (JPG, PNG, не менее 200*200 px.)
                </p>
                <button type="button" name="button">Загрузить фото</button>
            </div>
            <div class="info">
                <p>
                    Напишите кратко основную информацию о себе*<br>
                    (презентация отображается посетителям сайта)
                </p>
                <textarea name="name" placeholder="До 400 символов"></textarea>
                <p>
                    Разместите ссылку на вашу видео-презентацию.(1-3 минуты)
                </p>
                <input type="text" placeholder="https://www.youtube.com/...">
                <button type="submit" name="button">Сохранить</button>
            </div>
        </aside>
    </section>
</main>
<a href="#" class="send-rep-profile">Отправить запрос на активацию профиля</a>

<script src="<?php echo base_url(); ?>js/repetitor/profile.js"></script>
<?php $this->load->view('main/footer'); ?>
