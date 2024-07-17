<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            INSERT INTO consumption (name, type, energy)
            VALUES (
                '$_POST[name]',
                '$_POST[type]',
                '$_POST[energy]'
            )");

    if($query) {

        echo "
            <script>
                alert('Berhasil Simpan Data!');
                document.location='../../consumption.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error!');
                document.location='../../consumption.php';
            </script>
        ";
    }
}


?>