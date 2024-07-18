<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            UPDATE activity_scale SET 
                name = '$_POST[name]',
                scale = '$_POST[scale]'
            WHERE id = '$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Ubah Data!');
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