<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Профиль репетитора</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<section class="start-profile">
    <h1>Приветствуем Вас на странице Вашего личного кабинета!</h1>
    <ul>
        <li>Мы рады, что Вы выбрали нашу платформу для изучения иностранного языка. Благодарим за доверие!</li>
        <li>Теперь для завершения регистрации осталось сделать несколько шагов: заполните информацию в настройке профиля, при желании загрузите фото, сохраните настройки.</li>
        <li>Желаем Вам успехов в учебе!</li>
    </ul>
</section>
<main class="student-profile">
    <section>
        <div class="avatar">
            <div class="img" id="avatar-profile">
                <?php
                    if (is_null($student['avatar'])){
                        echo '<img src="'.base_url().'img/avatar3.png" alt="empty avarat" style="padding-top: 30px">';
                    } else{
                        echo '<img src="../../images/'.$student['avatar'].'" alt="avarat">';
                    }
                ?>
            </div>
            <p>
                *Загрузите вашу фотографию* (JPG, PNG, не менее 200*200 px.)
            </p>
            <input type="file" name="userfile" size="20" id="add-file" class="hidden">
            <button type="button" name="button" id="load_avatar">Загрузить фото</button>
        </div>
        <div class="info">
            <div>
                <input type="text" placeholder="Имя*">
                <input type="text" placeholder="Фамилия*">
                <input type="text" placeholder="Отчество">
            </div>
            <div>
                <select name="tzone" id="tzone_id">
                    <?php
                        foreach ($tzones as $option) {
                            if ($option['id'] == $repetitor['tzone_id']){
                                echo '<option value="'.$option['id'].'" selected="selecter">'.$option['zone_name'].'</option>';
                            } else{
                                echo '<option value="'.$option['id'].'">'.$option['zone_name'].'</option>';
                            }
                        }
                    ?>
                </select>
                <input type="text" placeholder="Телефон">
                <input type="text" placeholder="Логин Skype*">
            </div>
            <div>
                <input type="text" placeholder="Email*">
                <input type="text" placeholder="Пароль*">
                <input type="text" placeholder="Подтверждение пароля*">
            </div>
            <button>Сохранить</button>
        </div>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/repetitor/profile.js"></script>
<?php $this->load->view('main/footer'); ?>
