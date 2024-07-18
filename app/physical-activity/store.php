<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            INSERT INTO physical_activity (name, description, calorie)
            VALUES (
                '$_POST[name]',
                '$_POST[description]',
                '$_POST[calorie]'
            )");

    if($query) {

        echo "
            <script>
                alert('Berhasil Simpan Data!');
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