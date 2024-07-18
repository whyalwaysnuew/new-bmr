<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            INSERT INTO activity_scale (name, scale)
            VALUES (
                '$_POST[name]',
                '$_POST[scale]'
            )");

    if($query) {

        echo "
            <script>
                alert('Berhasil Simpan Data!');
                document.location='../../activity-scale.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error!');
                document.location='../../activity-scale.php';
            </script>
        ";
    }
}


?>