<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
                DELETE FROM activity_scale WHERE id='$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Hapus Data!');
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