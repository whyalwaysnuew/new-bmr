<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }

    $activity_scale = mysqli_query($koneksi, "SELECT * FROM activity_scale");

    if(isset($_POST['submit'])){

        $scale_id = $_POST['scale'];
        $age = $_POST['age'] ?? 0;
        $gender = $_POST['gender'] ?? 0;
        $height = $_POST['height'] ?? 0;
        $weight = $_POST['weight'] ?? 0;
        $target_weight = $_POST['target_weight'] ?? 0;
        $activity_scale = $scale_id ? mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM activity_scale WHERE id=$scale_id")) : null;

        // Hitung BMR
        if($gender == 1){
            $bmr = 655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age); // Perempuan
        } else if($gender == 2) {
            $bmr = 66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age); // Laki-laki
        } else {
            $bmr = 0;
        }

        // Menghitung kebutuhan kalori harian
        $calorie_needs = $bmr * $activity_scale['scale'];

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Konsultasi | BMR Calculator</title>

    <!-- Custom fonts for this template-->
    <link href="public/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-text mx-3">BMR Calculator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/bmr-calculator">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="bmr.php">
                    <i class="fas fa-weight"></i>
                    <span>Bassal Metabolic Rate</span></a>
            </li>

			<!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="daily-calorie.php">
                    <i class="fas fa-cookie-bite"></i>
                    <span>Kalori Harian</span></a>
            </li>

			<!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="consultation.php">
                    <i class="fas fa-user-md"></i>
                    <span>Konsultasi</span></a>
            </li>
            
            <?php if($_SESSION['is_admin']){ ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Data Master
                </div>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="physical-activity.php">
                        <i class="fas fa-running"></i>
                        <span>Aktifitas Fisik</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="activity-scale.php">
                        <i class="fas fa-balance-scale"></i>
                        <span>Skala Aktifitas</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="consumption.php">
                        <i class="fas fa-cheese"></i>
                        <span>Konsumsi</span></a>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="settings.php">
                        <i class="fas fa-cogs"></i>
                        <span>Pengaturan</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            <?php } ?>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="public/sbadmin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Konsultasi</h1>
                        <?php if(isset($_POST['submit'])) {?>
                            <div class="d-flex">
                                <form action="app/main/consultation-print.php" target="_blank" class="mr-2" method="post">
                                    <input type="hidden" name="age" value="<?= $age; ?>">
                                    <input type="hidden" name="weight" value="<?= $weight; ?>">
                                    <input type="hidden" name="target_weight" value="<?= $target_weight; ?>">
                                    <input type="hidden" name="height" value="<?= $height; ?>">
                                    <input type="hidden" name="gender" value="<?= $gender; ?>">
                                    <input type="hidden" name="scale" value="<?= $activity_scale['scale']; ?>">
                                    <input type="hidden" name="scale_name" value="<?= $activity_scale['name']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Print</button>
                                </form>
                                <a href="" class="btn btn-sm btn-primary">Hitung Ulang</a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if(!isset($_POST['submit'])) {?>
                        <form action="" method="post">
                            <!-- Content Row -->
                            <div class="row">
        
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
                                        </div>
                                        <div class="card-body d-flex flex-wrap">
                                            <div class="form-group col-12">
                                                <label for="gender" class="font-weight-bold">Apa jenis kelamin anda?</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" checked>
                                                    <label class="form-check-label" for="gender1">
                                                        Peremuan
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                                    <label class="form-check-label" for="gender2">
                                                        Laki-laki
                                                    </label>
                                                </div>
                                            </div>
        
                                            <div class="form-group col-12">
                                                <label for="age" class="font-weight-bold">Berapa usia Anda?</label>
                                                <input type="number" name="age" id="age" placeholder="e.g. 20" class="form-control col-3" value="0" require>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="height" class="font-weight-bold">Berapa tinggi badan Anda?</label>
                                                <input type="number" name="height" id="height" placeholder="e.g. 167" class="form-control col-3" value="0" require>
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <label for="weight" class="font-weight-bold">Berapa berat badan Anda?</label>
                                                <input type="number" name="weight" id="weight" placeholder="e.g. 50" class="form-control col-3" value="0" require>
                                            </div>
        
                                            <div class="form-group col-12">
                                                <label for="scale" class="font-weight-bold">Berapa tingkat aktifitas fisik Anda sehari-hari?</label>
                                                <select class="form-control col-3" id="scale" name="scale">
                                                    <option value="0" disabled selected>-- Pilih --</option>
                                                    <?php if($activity_scale) {?>
                                                        <?php foreach ($activity_scale as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="target_weight" class="font-weight-bold">Berapa target berat badan Anda?</label>
                                                <input type="number" name="target_weight" id="target_weight" placeholder="e.g. 50" class="form-control col-3" value="0" require>
                                            </div>
        
                                        </div>

                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary col-12 py-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mb-5">
                                <div class="col-12 d-flex justify-content-end">
                                    <!-- <button type="submit" name="submit" class="btn btn-primary col-12 py-2">Submit</button> -->
                                </div>
                            </div>
                        </form>
                    <?php } else {?>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <tr class="">
                                                <td>Nama</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_SESSION['name']; ?></td>
                                            </tr>
                                            <tr class="">
                                                <td>Umur</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_POST['age']; ?></td>
                                            </tr>
                                            <tr class="">
                                                <td>Jenis Kelamin</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_POST['gender'] == '1' ? 'Perempuan' : 'Laki-laki'; ?></td>
                                            </tr>
                                            <tr class="">
                                                <td>Tinggi Badan</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_POST['height']; ?> cm</td>
                                            </tr>
                                            <tr class="">
                                                <td>Berat Badan Aktual</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_POST['weight']; ?> kg</td>
                                            </tr>
                                            <tr class="">
                                                <td>Target Berat Badan Ideal</td>
                                                <td class="px-2">:</td>
                                                <td><?= $_POST['target_weight']; ?> kg</td>
                                            </tr>
                                            <tr class="">
                                                <td>
                                                    Intensitas Aktifitas<br/>
                                                    (Aktifitas Fisik)
                                                </td>
                                                <td class="px-2">:</td>
                                                <td><?= @$activity_scale['name']; ?> (<?= @$activity_scale['scale']; ?>)</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-8">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Perhitungan</h6>
                                    </div>
                                    <div class="card-body">
                                        <label for="" class="form-label font-weight-bold">Rumus</label>
                                        <h6>
                                            <b>BMR Perempuan</b> <br>
                                            655 + (9.6 x berat badan dalam kilogram) + (1.8 x tinggi dalam centimeter) - (4.7 x usia dalam tahun)
                                        </h6>
                                        <br>
                                        <h6>
                                            <b>BMR Laki-laki</b> <br>
                                            66 + (13.7 x berat badan dalam kilogram) + (5x tinggi dalam centimeter) - (6.8 x usia dalam tahun)
                                        </h6>
                                        <br>
                                        <h6 class="">
                                            <b>Kebutuhan Kalori Harian</b> = BMR x Aktifitas Fisik
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Hasil</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex col-12">
                                            <div class="col-4">
                                                <div class="text-center">
                                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                        src="public/assets/media/illustrations/sketchy-1/7.png" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-8 d-flex align-items-center">
                                                <div>
                                                    <p>
                                                        Berdasarkan tinggi badan, rentang berat badan ideal Anda adalah <b><?= $height - 100; ?> - <?= $height - 90; ?> Kg</b>
                                                    </p>
                                                    <p>
                                                        <b><?= $calorie_needs; ?></b> kalori/hari untuk mempertahankan berat badan saat ini dengan tingkat aktifitas <?= $activity_scale['name']; ?>
                                                    </p>
                                                    <br>
                                                    <p class=" fs-2hx">
                                                        Untuk mencapai target berat badan ideal <b><?= $target_weight; ?> Kg</b>, perlu <?= $weight > $target_weight ? 'penurunan' : 'peningkatan'; ?> berat badan sebesar <b><?= abs($target_weight - $weight) . ' Kg.'; ?></b>
                                                        <br>
                                                        Disarankan untuk <?= $weight > $target_weight ? 'mengurangi' : 'menambah'; ?> kalori harian dan <?= $weight > $target_weight ? 'meningkatkan' : 'menjaga'; ?> aktifitas fisik.
                                                    </p>
                                                    <br>
                                                    <p class=" fs-2hx">
                                                        Kebutuhan kalori harian Anda adalah <b><?= $calorie_needs; ?></b>. Anda perlu <?= $weight > $target_weight ? 'mengurangi' : 'menambahkan'; ?> <b>500 -1000</b> kalori.
                                                        <br>
                                                        Anda bisa <?= $weight > $target_weight ? 'mengurangi' : 'meningkatkan'; ?> asupan kalori harian menjadi sekitar <b><?= $weight > $target_weight ? $calorie_needs - 1000 : $calorie_needs + 500; ?> - <?= $weight > $target_weight ? $calorie_needs - 500 : $calorie_needs + 1000; ?></b> kalori perhari.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Gian Pranata 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="public/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="public/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="public/sbadmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="public/sbadmin/js/demo/chart-area-demo.js"></script>
    <script src="public/sbadmin/js/demo/chart-pie-demo.js"></script>

</body>

</html>