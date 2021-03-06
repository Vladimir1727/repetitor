<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы Real Language Club. Рассписание</title>
</head>
<body>
<?php $this->load->view('repetitor/header_menu'); ?>
<input type="hidden" id="repetitor_id" value="<?php echo $repetitor['id']; ?>">
<input type="hidden" value="<?php echo $repetitor['tzone']; ?>" id="zone">
<main class="rep_timetable">
    <h1>Расписание</h1>
    <section class="start_time">
        <div class="form">
            <button id="save">Сохранить изменения</button>
            <input type="text" placeholder="Найти Ученика" id="search">
        </div>
        <div class="green">
        </div>
        <div class="weeks">
            <a href="#" id="prev"><< Предыдущая неделя</a>
            <span  id="weeks">неделя</span>
            <a href="#" id="next">Следующая неделя >></a>
        </div>
    </section>
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
</main>

<script src="<?php echo base_url(); ?>js/repetitor/timetable.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/repetitor/repetitor.js"></script>
<?php $this->load->view('main/footer'); ?>
