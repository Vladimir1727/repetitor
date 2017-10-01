<?php $this->load->view('main/header'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Избранные репетиторы</title>
</head>
<body>
<?php $this->load->view('student/header_menu'); ?>
<main class="student_favorites">
    <section class="start_less">
        <div>
            <h1>Избранные репетиторы</h1>
        </div>
        <div>
            <h3><span id="local-time"></span> (UTC
                <?php
                  echo ($student['tzone']>0) ? '+'.$student['tzone'] : $student['tzone'];
                ?>)
            </h3>
            <h4><span id="local-date"></span></h4>
        </div>
    </section>
    <table>
        <thead>
            <?php if (count($repetitors)>0){
                echo '<tr>
                    <th>Репетиторы</th>
                    <th>Предмет</th>
                    <th>Действия</th>
                </tr>';
            }
            ?>
        </thead>
        <tbody>
            <?php
            foreach ($repetitors as $repetitor) {
                echo '<tr><td><p>';
                echo $repetitor['first_name'];
                if (!is_null($repetitor['father_name'])){
                    echo ' '.$repetitor['father_name'];
                }
                echo '</p><p>ID ';
                echo $repetitor['id'];
                echo '</p></td><td><p>';
                echo $repetitor['sub1'];
                echo '</p><p>';
                echo $repetitor['sub2'];
                echo '</p></td><td>';
                echo '<a href="'.base_url().'index.php/student/step1/'.$repetitor['id'].'" class="ok">Запланировать урок</a>';
                echo '<a href="'.base_url().'index.php/student/chat/'.$repetitor['id'].'" class="mess">Сообщение</a>';
                echo '</td></tr>';
            }
             ?>
        </tbody>
    </table>
</main>
<script src="<?php echo base_url(); ?>js/student/favorites.js"></script>
<script>
    var baseUrl = '../';
</script>
<script src="<?php echo base_url(); ?>js/student/student.js"></script>
<?php $this->load->view('main/footer'); ?>
