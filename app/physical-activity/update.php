<?php 
include('../../database/koneksi.php');

if(isset($_POST['submit'])){

    $query = mysqli_query($koneksi, "
            UPDATE physical_activity SET 
                name = '$_POST[name]',
                description = '$_POST[description]',
                calorie = '$_POST[calorie]'
            WHERE id = '$_POST[id]'
            ");

    if($query) {

        echo "
            <script>
                alert('Berhasil Ubah Data!');
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