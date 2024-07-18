<?php 
include('../../database/koneksi.php');

    if(isset($_POST['submit'])){

        $pagi = $_POST['utama_1'] + $_POST['sayuran_1'] + $_POST['lauk_1'] + $_POST['minum_1'] + $_POST['cemilan_1'] + $_POST['buah_1'];
        $siang = $_POST['utama_2'] + $_POST['sayuran_2'] + $_POST['lauk_2'] + $_POST['minum_2'] + $_POST['cemilan_2'] + $_POST['buah_2'];
        $malam = $_POST['utama_3'] + $_POST['sayuran_3'] + $_POST['lauk_3'] + $_POST['minum_3'] + $_POST['cemilan_3'] + $_POST['buah_3'];
        
        echo 'Total Konsumsi kalori kamu hari ini adalah: ' . $pagi + $siang + $malam;
    }


?>