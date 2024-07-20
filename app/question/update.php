<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            UPDATE questions SET 
                quest = '$_POST[question]'
            WHERE id = '$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Ubah Data!');
                document.location='../../question.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error!');
                document.location='../../question.php';
            </script>
        ";
    }
}


?>