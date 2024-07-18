<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
                DELETE FROM consumption WHERE id='$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Hapus Data!');
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