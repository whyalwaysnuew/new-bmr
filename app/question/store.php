<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            INSERT INTO questions (quest)
            VALUES (
                '$_POST[question]'
            )");

    if($query) {

        echo "
            <script>
                alert('Berhasil Simpan Data!');
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