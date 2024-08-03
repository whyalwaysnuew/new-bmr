<?php 
    require_once('../../database/koneksi.php');
    session_start();
    $setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM settings WHERE id=1"));

    $age = $_POST['age'] ?? 0;
    $gender = $_POST['gender'] ?? 0;
    $height = $_POST['height'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $target_weight = $_POST['target_weight'] ?? 0;
    $scale = $_POST['scale'];

    if($gender == 1){
        $bmr = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age); // Perempuan
    } else if($gender == 2) {
        $bmr = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age); // Laki-laki
    } else {
        $bmr = 0;
    }

    // Menghitung kebutuhan kalori harian
    $calorie_needs = $bmr * $scale;
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
                        <h2 class="font-weight-bold"><?= $setting['name'] ?? null; ?></h2>
                        <h7 class="mt-2">Alamat: <?= $setting['address']; ?></h7>
                        <h6 class="mt-2">Telp: <?= $setting['phone']; ?></h6>
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
                    <p>
                        Berdasarkan tinggi badan, rentang berat badan ideal Anda adalah <b><?= $height - 100; ?> - <?= $height - 90; ?> Kg</b>. Dibutuhkan <b><?= $calorie_needs; ?></b> kalori/hari untuk mempertahankan berat badan saat ini dengan tingkat aktifitas <?= $scale; ?>
                    </p>
                    <br>
                    <p class=" fs-2hx">
                        Untuk mencapai target berat badan ideal <b><?= $target_weight; ?> Kg</b>, perlu <?= $weight > $target_weight ? 'penurunan' : 'peningkatan'; ?> berat badan sebesar <b><?= abs($target_weight - $weight) . ' Kg'; ?></b>. Disarankan untuk <?= $weight > $target_weight ? 'mengurangi' : 'menambah'; ?> kalori harian dan <?= $weight > $target_weight ? 'meningkatkan' : 'menjaga'; ?> aktifitas fisik.
                    </p>
                    <br>
                    <p class=" fs-2hx">
                        Kebutuhan kalori harian Anda adalah <b><?= $calorie_needs; ?></b>. Anda perlu <?= $weight > $target_weight ? 'mengurangi' : 'menambahkan'; ?> <b>500 -1000</b> kalori. Anda bisa <?= $weight > $target_weight ? 'mengurangi' : 'meningkatkan'; ?> asupan kalori harian menjadi sekitar <b><?= $weight > $target_weight ? $calorie_needs - 1000 : $calorie_needs + 500; ?> - <?= $weight > $target_weight ? $calorie_needs - 500 : $calorie_needs + 1000; ?></b> kalori perhari.
                    </p>
                </section>

                <section class="section-signee" style="margin-top: 300px">
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