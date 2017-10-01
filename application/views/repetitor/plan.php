<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Рассписание</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>
<input type="hidden" value="<?php echo $repetitor['id'];?>" id="repetitor_id">
<input type="hidden" value="<?php echo $student['id'];?>" id="student_id">
<input type="hidden" value="<?php echo $student['first_name'];?>" id="student_name">
<main class="rep_plan">
    <h1>Расписание</h1>
    <section class="start_time">
        <div class="form">
            <button id="save">Сохранить изменения</button>
            <input type="text" placeholder="Найти Ученика" value="<?php echo $student['first_name'].' ID '.$student['id'] ?>" disabled="disabled">
                <?php
                if ($repetitor['sub_num']==1){
                    echo '<select id="subject" disabled>';
                    echo '<option value="'.$repetitor['subject1'].'">'.$repetitor['sub1_name'].'</option>';
                    echo '<select>';
                } else{
                    echo '<select id="subject">';
                    echo '<option value="'.$repetitor['subject1'].'">'.$repetitor['sub1_name'].'</option>';
                    echo '<option value="'.$repetitor['subject2'].'">'.$repetitor['sub2_name'].'</option>';
                    echo '<select>';
                }
                ?>
        </div>
        <div class="green">
        </div>
        <div class="weeks">
            <a href="#" id="prev"><< Предыдущая неделя</a>
            <span id="weeks">6-12 октября 2017</span>
            <a href="#" id="next">Следующая неделя >></a>
        </div>
    </section>
    <section class="plan">
        <table>
            <thead>
                <tr>
                    <th>Вр<span class="big">емя</span></th>
                    <th>П<span class="big">о</span>н<span class="big">едельник</span></th>
                    <th>Вт<span class="big">орник</span></th>
                    <th>Ср<span class="big">еда</span></th>
                    <th>Ч<span class="big">е</span>т<span class="big">верг</span></th>
                    <th>П<span class="big">я</span>т<span class="big">ница</span></th>
                    <th>С<span class="big">у</span>б<span class="big">бота</span></th>
                    <th>В<span class="big">о</span>с<span class="big">кресенье</span></th>
                </tr>
            </thead>
            <tbody id="table">
                <tr> <td>0:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>1:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>2:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>3:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>4:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>5:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>6:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>7:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>8:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>9:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>10:00</td><td class="busy">Мария ID000001</td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>11:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
                <tr> <td>12:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
                <tr> <td>13:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="free"></td> </tr>
                <tr> <td>14:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>15:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>16:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>17:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>18:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>19:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>20:00</td><td class="free"></td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>21:00</td><td class="free"></td><td class="free"></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>22:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
                <tr> <td>23:00</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td> </tr>
            </tbody>
        </table>
        <aside>
            <h3>Выбранный Ученик:</h3>
            <h4><?php echo $student['first_name'] ?></h4>
            <p>ID <?php echo $student['id'] ?></p>
            <p>
                UTC
                <?php
                if (is_null($student['tzone_id'])){
                    echo ' не определился';
                } else{
                    if ($student['tzone']>0){
                        echo '+';
                    }
                    echo $student['tzone'];
                }
                ?>
            </p>
        </aside>
    </section>

</main>

<script src="<?php echo base_url(); ?>js/repetitor/plan.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
