<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
                DELETE FROM physical_activity WHERE id='$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Hapus Data!');
                document.location='../../physical-activity.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error!');
                document.location='../../physical-activity.php';
            </script>
        ";
    }
}


?>