<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            UPDATE consumption SET 
                name = '$_POST[name]',
                type = '$_POST[type]',
                energy = '$_POST[energy]'
            WHERE id = '$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Ubah Data!');
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