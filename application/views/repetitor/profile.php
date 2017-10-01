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
            <li><a href="#" id="subject-but">Предмет</a></li>
            <li><a href="#" id="edu-but">Образование и опыт</a></li>
            <li><a href="#" id="docs-but">Документы</a></li>
            <li><a href="#" id="present-but">Презентация</a></li>
            <li><a href="#" id="pay-but">Реквизиты</a></li>
            <li><a href="#" id="status-but">Состояние профиля</a></li>
        </ul>
    </section>
    <section class="warp">
        <aside id="personal">
            <form method="post" class="personal">
                <div>
                    <input type="text" name="first_name" placeholder="Имя*" id="first_name" value="<?php echo $repetitor['first_name'] ?>">
                    <input type="text" name="last_name" placeholder="Фамилия*" id="last_name" value="<?php echo $repetitor['last_name'] ?>">
                    <input type="text" name="father_name" placeholder="Отчество" id="father_name" value="<?php echo $repetitor['father_name'] ?>">
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
                    <input type="text" name="phone" placeholder="Телефон" id="phone" value="+<?php echo $repetitor['phone'] ?>">
                    <input type="text" name="skype" placeholder="Логин Skype*" id="skype" value="<?php echo $repetitor['skype'] ?>">
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email*" id="email" value="<?php echo $repetitor['email'] ?>">
                    <input type="password" name="password" placeholder="Пароль*" id="password" value="<?php echo $repetitor['password'] ?>">
                    <input type="password" name="password2" placeholder="Подтверждение пароля*" id="password2" value="<?php echo $repetitor['password'] ?>">
                </div>
                <button type="submit" name="button" id="save_personal">Сохранить</button>
            </form>
        </aside>
        <aside id="present">
            <div class="avatar">
                <div class="img" id="avatar-profile">
                    <?php
                        if (is_null($repetitor['avatar'])){
                            echo '<img src="'.base_url().'img/avatar3.png" alt="empty avarat" style="padding-top: 30px">';
                        } else{
                            $d = strrpos($repetitor['avatar'],'.');
    						$av = substr($repetitor['avatar'], 0 , $d).'_thumb'.substr($repetitor['avatar'], $d);
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
                <p>
                    Напишите кратко основную информацию о себе*<br>
                    (презентация отображается посетителям сайта)
                </p>
                <textarea id="about" placeholder="До 400 символов"><?php printf($repetitor['about']); ?></textarea>
                <p>
                    Разместите ссылку на вашу видео-презентацию.(1-3 минуты)
                </p>
                <input type="text" placeholder="https://www.youtube.com/..." id="link" value="<?php echo $repetitor['link'] ?>">
                <button type="submit" name="button" id="save_present">Сохранить</button>
            </div>
        </aside>
        <aside id="subject">
            <div>
            <form id="subject_form">
                <div>
                    <label class="sradio" id="sub1">
                        <input type="radio" name="position" value="1" checked>
                        <span></span>
                        Предмет №1
                    </label>
                    <label class="sradio" id="sub2">
                        <input type="radio" name="position" value="2">
                        <span></span>
                        Предмет №2
                    </label>
                    <select name="subject_id" id="subject_id">
                        <option value="0">Предмет*</option>
                        <?php
                            foreach ($subjects as $option) {
                                echo '<option value="'.$option['id'].'">'.$option['subject'].'</option>';
                            }
                        ?>
                    </select> <button id="new_sub"></button>

                    <select name="lang_id" id="lang_id">
                        <option value="0">Родной язык*</option>
                        <?php
                        foreach ($languages as $option) {
                                echo '<option value="'.$option['id'].'">'.$option['language'].'</option>';
                            }
                        ?>
                    </select>
                    <h2>Возрастные группы*<small>(выберите минимум 1 пункт)</small></h2>
                        <?php
                        foreach ($ages as $inp) {
                            echo '<label>';
                                echo '<input value="'.$inp['id'].'" name="age_id[]" type="checkbox">';
                                echo '<span></span> ';
                                echo $inp['age'];
                                echo "</label>";
                            }
                        ?>
                </div>
                <div>
                    <h2>Уровень владения языка учеником*<br><small>(выберите минимум 1 пункт)</small></h2>
                        <?php
                        foreach ($levels as $inp) {
                                echo '<label>';
                                echo '<input value="'.$inp['id'].'" name="level_id[]" type="checkbox">';
                                echo '<span></span> ';
                                echo $inp['level'];
                                echo "</label>";
                            }
                        ?>
                    <h2>Цена за 1 час (50 мин.) в $*</h2>
                    <div>
                        <input type="text" placeholder="Ваша цена $" name="price" id="price">
                        + наш % =
                        <input type="text" placeholder="Для ученика $" id="sprice">
                    </div>
                </div>
                <div>
                    <h2>Специализация*<small>(выберите минимум 1 пункт)</small></h2>
                        <div>
                         <?php
                        for ($i=0; $i < 8; $i++) {
                            echo '<label>';
                            echo '<input value="'.$specializations[$i]['id'].'" name="specialization_id[]" type="checkbox">';
                            echo '<span></span> ';
                            echo $specializations[$i]['specialization'];
                            echo "</label>";
                        }
                        echo '</div><div>';
                        for ($i=8; $i < count($specializations); $i++) {
                            echo '<label>';
                            echo '<input value="'.$specializations[$i]['id'].'" name="specialization_id[]" type="checkbox">';
                            echo '<span></span> ';
                            echo $specializations[$i]['specialization'];
                            echo "</label>";
                        }
                        ?>
                        </div>
                </div>
            </form>
            </div>
                <button type="submit" name="button" id="save_subject">Сохранить</button>
        </aside>
        <aside id="pay">
            <div>
                <h2>Выберите один из вариантов. На данные реквизиты будут выводиться ваши заработанные средства, по запросу.</h2>
                <h3>(Внимательно проверьте правильность внесённых данных! Вы несёте полную ответственность за не верно внесённые персональные данные!)</h3>
                <label>
                    <span class="img"><img src="<?php echo base_url(); ?>img/yandex.png" alt="yandex"></span>
                    <input type="text" placeholder="номер кошелька" id="yandex" value="<?php echo $repetitor['yandex']; ?>">
                    <span class="check"></span>
                </label>
                <label>
                    <span class="img"><img src="<?php echo base_url(); ?>img/paypal.png" alt="paypal"></span>
                    <input type="text" placeholder="аккаунт" id="paypal" value="<?php echo $repetitor['paypal']; ?>">
                    <span class="check"></span>
                </label>
            </div>
            <button type="submit" name="button" id="save_pay">Сохранить</button>
        </aside>
        <aside id="edu">
            <div>
                <div class="vuz">
                    <input type="text" id="university" placeholder="ВУЗ (напишите полное название)" value="<?php echo $repetitor['university']; ?>">
                    <input type="text" id="specialty" placeholder="Специальность" value="<?php echo $repetitor['specialty']; ?>">
                </div>
                <div class="deg">
                    <select id="uni_year">
                        <option value="0">Год окончания</option>
                        <?php
                        $year = date('Y');
                        for ($i = date('Y'); $i >= 1965; $i--){
                            if ($repetitor['uni_year']==$i){
                                echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                            }else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        }
                         ?>
                    </select>
                    <select id="experience">
                        <option value="-1">Опыт работы репетитором (лет)</option>
                        <?php
                        for ($i=0;$i<=50;$i++){
                            if ($repetitor['experience']==$i){
                                echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                            }else{
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        }
                         ?>
                    </select>
                </div>
                <div class="year">
                    <select id="degree_id">
                        <option value="0">Ученая степень</option>
                        <?php
                        foreach ($uni_degrees as $option) {
                            if ($repetitor['degree_id'] == $option['id']){
                                echo '<option value="'.$option['id'].'" selected="selected">'.$option['uni_degree'].'</option>';
                            }else{
                                echo '<option value="'.$option['id'].'">'.$option['uni_degree'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div>
                <textarea placeholder="Опыт преподавания (до 400 символов)" id="exp_comment"><?php echo $repetitor['exp_comment'] ?></textarea>
            </div>
            <button type="submit" name="button" id="save_edu">Сохранить</button>
        </aside>
        <aside id="docs">
            <div class="header">
                <h3>Загрузите скан (электронную копию) вашего диплома об образовании (JPG, PNG)</h3>
                <h3>Загрузите скан (электронную копию) иного документа (сертификат, грамота и т.д.), подтверждающего ваши компетенции, как преподавателя (JPG, PNG)</h3>
            </div>
            <div class="doc">

                <button id="load1">Загрузить</button>
                <input type="file" name="userfile" size="20" id="add-file1" class="hidden">
                <div class="img"  id="load_block1">
                    <?php
                        if ($repetitor['doc1']){
                            echo '<img src="../../images/'.$repetitor['doc1'].'" alt="document">';
                        }
                     ?>
                </div>
            </div>
            <div class="doc">

                <button id="load2">Загрузить</button>
                <input type="file" name="userfile" size="20" id="add-file2" class="hidden">
                <div class="img" id="load_block2">
                    <?php
                        if ($repetitor['doc2']){
                            echo '<img src="../../images/'.$repetitor['doc2'].'" alt="document">';
                        }
                     ?>
                </div>
            </div>
        </aside>
        <aside id="status">
            <div>
                <h3>Состояния профиля по умолчанию</h3>
                <p><span class="check"></span>На рассмотрении</p>
                <h3>Вы можете изменить состояние профиля</h3>
                <label>
                <?php
                    if ($repetitor['activity']==0){
                        echo '<input type="checkbox" id="passive_status" checked="checked">';
                    } else{
                        echo '<input type="checkbox" id="passive_status">';
                    }
                 ?>
                    <span></span> Не активен (не отображается на сайте)
                </label>
                <label>
                    <?php
                    if ($repetitor['status']==3){
                        echo '<input type="checkbox" id="delete_status" checked="checked">';
                    } else{
                        echo '<input type="checkbox" id="delete_status">';
                    }
                     ?>
                    <span></span> Удалить профиль с сайта
                </label>
                <button type="submit" name="button" id="save_status">Сохранить</button>
                <div class="link">
                <?php
                if ($repetitor['status'] == 2){
                    $video = $_SERVER['SERVER_NAME'].base_url().'index.php/main/rinfo/'.$repetitor['id'];
                    echo '<h4>Ваша страница <span><a href="http://'.$video.'">'.$video.'</a></span>';
                }
                 ?>
                </div>
            </div>
        </aside>
    </section>
</main>
<a href="#" class="send-rep-profile btn" disabled="disabled" id="send_profile">
<?php
    if ($repetitor['status'] == 0){
        echo 'Отправить запрос на активацию профиля';
    } elseif ($repetitor['status'] == 1){
        echo 'Профиль находится на рассмотрении';
    } else{
        echo 'Изменить профиль';
    }
 ?>
</a>

<script src="<?php echo base_url(); ?>js/repetitor/profile.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
