<?php 
    $servername = "localhost";
    $database = "bmi_calculator";
    $username = "root";
    $password = "";

    try {
        $koneksi = mysqli_connect($servername, $username, $password, $database);
        
        // echo "Connected Successfully!";
        // mysqli_close($koneksi);
    } catch (Exception $e) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }
?>
