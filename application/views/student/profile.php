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
                        $d = strrpos($student['avatar'],'.');
                        $av = substr($student['avatar'], 0 , $d).'_thumb'.substr($student['avatar'], $d);
                        echo '<img src="../../images/'.$av.'" alt="avarat">';
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
                <input type="text" placeholder="Имя*" id="first_name" value="<?php echo $student['first_name']; ?>">
                <input type="text" placeholder="Фамилия*" id="last_name" value="<?php echo $student['last_name']; ?>">
                <input type="text" placeholder="Отчество" id="father_name"  value="<?php echo $student['father_name']; ?>">
            </div>
            <div>
                <select name="tzone" id="tzone_id">
                    <<option value="0">Выберите часовой пояс</option>
                    <?php
                        foreach ($tzones as $option) {
                            if ($option['id'] == $student['tzone_id']){
                                echo '<option value="'.$option['id'].'" selected="selecter">'.$option['zone_name'].'</option>';
                            } else{
                                echo '<option value="'.$option['id'].'">'.$option['zone_name'].'</option>';
                            }
                        }
                    ?>
                </select>
                <input type="text" placeholder="Телефон" id="phone" value="<?php echo $student['phone']; ?>">
                <input type="text" placeholder="Логин Skype*" id="skype"  value="<?php echo $student['skype']; ?>">
            </div>
            <div>
                <input type="text" placeholder="Email*" id="email" value="<?php echo $student['email']; ?>">
                <input type="password" placeholder="Пароль*" id="password" value="<?php echo $student['password']; ?>">
                <input type="password" placeholder="Подтверждение пароля*" id="password2" value="<?php echo $student['password']; ?>">
            </div>
            <button id="save_profile">Сохранить</button>
        </div>
    </section>
</main>

<script src="<?php echo base_url(); ?>js/student/profile.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
