<?php $this->load->view('main/header'); ?>
<meta name = "robots" content = "noindex,nofollow">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>js/jquery-ui.min.js"></script>
<title>Репетиторы по разным языкам. Админ. Репетиторы.</title>
</head>
<body>
<?php $this->load->view('admin/header_menu'); ?>

<main class="admin-prerep">
    <h1>Репетиторы (предварительно)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Дата регистрации</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($repetitors as $repetitor) {
                echo '<tr>';
                echo '<td>';
                echo $repetitor['id'];
                echo '</td>';
                echo '<td>';
                echo substr($repetitor['created_at'],8,2).'.'.substr($repetitor['created_at'],5,2).'.'.substr($repetitor['created_at'],0,4);
                echo '</td>';
                echo '<td>';
                echo $repetitor['email'];
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</main>
<?php $this->load->view('main/footer'); ?>
