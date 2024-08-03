<?php 
    require_once('../../database/koneksi.php');
    session_start();
    $setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM settings WHERE id=1"));

    $utama_1 = $_POST['utama_1'];
        $utama_2 = $_POST['utama_2'];
        $utama_3 = $_POST['utama_3'];
        $sayuran_1 = $_POST['sayuran_1'];
        $sayuran_2 = $_POST['sayuran_2'];
        $sayuran_3 = $_POST['sayuran_3'];
        $lauk_1 = $_POST['lauk_1'];
        $lauk_2 = $_POST['lauk_2'];
        $lauk_3 = $_POST['lauk_3'];
        $minum_1 = $_POST['minum_1'];
        $minum_2 = $_POST['minum_2'];
        $minum_3 = $_POST['minum_3'];
        $cemilan_1 = $_POST['cemilan_1'];
        $cemilan_2 = $_POST['cemilan_2'];
        $cemilan_3 = $_POST['cemilan_3'];
        $buah_1 = $_POST['buah_1'];
        $buah_2 = $_POST['buah_2'];
        $buah_3 = $_POST['buah_3'];

        $utama_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$utama_1'"));
        $utama_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$utama_2'"));
        $utama_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$utama_3'"));
        
        $sayuran_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$sayuran_1'"));
        $sayuran_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$sayuran_2'"));
        $sayuran_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$sayuran_3'"));
        
        $lauk_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$lauk_1'"));
        $lauk_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$lauk_2'"));
        $lauk_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$lauk_3'"));
        
        $minum_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$minum_1'"));
        $minum_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$minum_2'"));
        $minum_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$minum_3'"));
        
        $cemilan_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$cemilan_1'"));
        $cemilan_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$cemilan_2'"));
        $cemilan_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$cemilan_3'"));
        
        $buah_pagi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$buah_1'"));
        $buah_siang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$buah_2'"));
        $buah_malam = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM consumption WHERE id='$buah_3'"));

        $pagi = $utama_pagi['energy'] + $sayuran_pagi['energy'] + $lauk_pagi['energy'] + $minum_pagi['energy'] + $cemilan_pagi['energy'] + $buah_pagi['energy'];
        $siang = $utama_siang['energy'] + $sayuran_malam['energy'] + $lauk_siang['energy'] + $minum_siang['energy'] + $cemilan_siang['energy'] + $buah_siang['energy'];
        $malam = $utama_malam['energy'] + $sayuran_siang['energy'] + $lauk_malam['energy'] + $minum_malam['energy'] + $cemilan_malam['energy'] + $buah_malam['energy'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Report Kalkulasi Kalori | BMR Calculator</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <main>
            <div class="container">
                <div class="row justify-content-center align-items-center pt-4">
                    <div class="col-2">
                        <img src="../../public/assets/img/rs.jpg" alt="" class="img-fluid">
                    </div>
                    <div class="text-center col-10">
                        <h2 class="font-weight-bold"><?= $setting['name'] ?? null; ?></h2>
                        <h7 class="mt-2">Alamat: <?= $setting['address']; ?></h7>
                        <h6 class="mt-2">Telp: <?= $setting['phone']; ?></h6>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container py-5">
                <section class="section-pengantar" style="margin-bottom: 50px">
                    <p class="ml-5">Berikut hasil akumulasi kalori dari makanan yang dikonsumsi <?= $_SESSION['name']; ?>.</p>
                    <p>Rincian konsumsi sebagai berikut:</p>
                    <table class="table-bordered col-12">
                        <thead>
                            <tr class="text-center align-middle">
                                <th>Waktu</th>
                                <th>Nama Makanan/Minuman</th>
                                <th>Kalori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center align-middle" rowspan="6">Pagi</td>
                                <td class="py-2 px-4"><?= $utama_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $utama_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $sayuran_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $sayuran_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $lauk_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $lauk_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $minum_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $minum_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $cemilan_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $cemilan_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $buah_pagi['name']; ?></td>
                                <td class="text-center py-2"><?= $buah_pagi['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle" rowspan="6">Siang</td>
                                <td class="py-2 px-4"><?= $utama_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $utama_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $sayuran_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $sayuran_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $lauk_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $lauk_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $minum_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $minum_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $cemilan_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $cemilan_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $buah_siang['name']; ?></td>
                                <td class="text-center py-2"><?= $buah_siang['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center align-middle" rowspan="6">Malam</td>
                                <td class="py-2 px-4"><?= $utama_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $utama_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $sayuran_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $sayuran_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $lauk_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $lauk_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $minum_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $minum_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $cemilan_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $cemilan_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4"><?= $buah_malam['name']; ?></td>
                                <td class="text-center py-2"><?= $buah_malam['energy']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-weight-bold text-center">Total</td>
                                <td class="text-center"><?= $pagi + $siang + $malam; ?> Kkal</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="section-signee" style="margin-top: 100px">
                    <div class="col-12 row justify-content-end">
                        <table>
                            <tr>
                                <td class="text-center py-2">Jakarta, <?= date('l d F Y'); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center py-2">Mengetahui,</td>
                            </tr>
                            <tr>
                                <td class="text-center py-2">Dokter</td>
                            </tr>
                            <tr>
                                <td style="height:150px"></td>
                            </tr>
                            <tr>
                                <td class="text-center font-weight-bold">
                                    <?= $setting['doctor']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
    </main>

    
    <!-- Bootstrap core JavaScript-->
    <script src="../../public/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../public/sbadmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../public/sbadmin/js/demo/chart-area-demo.js"></script>
    <script src="../../public/sbadmin/js/demo/chart-pie-demo.js"></script>

    <script>
        window.print()
    </script>
</body>

</html>