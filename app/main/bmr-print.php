<?php 
    session_start();

    $age = $_POST['age'] ?? 0;
    $gender = $_POST['gender'] ? ($_POST['gender'] == 1 ? -161 : 5) : 0;
    $height = $_POST['height'] ?? 0;
    $weight = $_POST['weight'] ?? 0;

    $bmr_actual = (10 * $_POST['weight']) + (6.25 * $_POST['height']) - (5 * $_POST['age']) + $gender;
    $bmr_ideal = (10 * ($_POST['height'] - 100)) + (6.25 * $_POST['height']) - (5 * $_POST['age']) + $gender;

    $calorie_needs_actual = $bmr_actual * $_POST['scale'];
    $calorie_needs_ideal = $bmr_ideal * $_POST['scale'];

    // echo '<script>window.print()</script>';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Report BMR | BMR Calculator</title>

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
                        <h2 class="font-weight-bold">RS Mitra Keluarga Cikarang</h2>
                        <h7 class="mt-2">Alamat: Jl. Raya industri No.100, Cikarang, Kec. Cikarang Utara, Kabupaten Bekasi, Jawa Barat 17550</h7>
                        <h6 class="mt-2">Telp: (021) 89840500</h6>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container py-5">
                <section class="section-pengantar">
                    <p class="ml-5">Berikut hasil pemeriksaan Bassal Metabolic Rate & Perhitungan jumlah kalori harian <?= $_SESSION['name']; ?>.</p>
                    <p>Rincian data diri sebagai berikut:</p>
                    <table style="margin: 0 0 25px 75px">
                        <tr>
                            <td>Nama</td>
                            <td class="px-3">:</td>
                            <td><?= $_SESSION['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['gender'] == 1 ? 'Perempuan' : 'Laki-laki'; ?></td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['age']; ?> Tahun</td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['weight']; ?> Kg</td>
                        </tr>
                        <tr>
                            <td>Berat Badan Ideal</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['height'] - 100; ?> Kg</td>
                        </tr>
                        <tr>
                            <td>Tinggi Badan</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['height']; ?> cm</td>
                        </tr>
                        <tr>
                            <td>Aktifitas Fisik</td>
                            <td class="px-3">:</td>
                            <td><?= $_POST['scale_name']; ?></td>
                        </tr>
                    </table>
                </section>

                <section class="section-bmr" style="margin: 100px 0">
                    <p>Berikut adalah angka rincian Bassal Metabolic Rate</p>
                    <div class="col-12 row justify-content-center">
                        <table class="table-bordered col-8">
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Aktual</th>
                                    <th class="text-center">Ideal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-2 align-middle">BMR</td>
                                    <td class="py-2 align-middle text-center"><?= $bmr_actual; ?></td>
                                    <td class="py-2 align-middle text-center"><?= $bmr_ideal; ?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-2 align-middle">Kebutuhan Kalori Harian</td>
                                    <td class="py-2 text-center align-middle"><?= $calorie_needs_actual; ?></td>
                                    <td class="py-2 text-center align-middle"><?= $calorie_needs_ideal; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="section-signee" style="margin-top: 300px">
                    <div class="col-12 row justify-content-end">
                        <table>
                            <tr>
                                <td class="text-center py-2">Jakarta, <?= date('d/m/Y'); ?></td>
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
                                    [Nama Dokter]
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