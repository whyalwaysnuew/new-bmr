<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }

    $utama = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='1'");
    $sayur = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='2'");
    $lauk = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='3'");
    $minuman = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='4'");
    $cemilan = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='5'");
    $buah = mysqli_query($koneksi, "SELECT * FROM consumption WHERE type='6'");


    if(isset($_POST['submit'])){

        $pagi = $_POST['utama_1'] + $_POST['sayuran_1'] + $_POST['lauk_1'] + $_POST['minum_1'] + $_POST['cemilan_1'] + $_POST['buah_1'];
        $siang = $_POST['utama_2'] + $_POST['sayuran_2'] + $_POST['lauk_2'] + $_POST['minum_2'] + $_POST['cemilan_2'] + $_POST['buah_2'];
        $malam = $_POST['utama_3'] + $_POST['sayuran_3'] + $_POST['lauk_3'] + $_POST['minum_3'] + $_POST['cemilan_3'] + $_POST['buah_3'];
        
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

    <title>Hitung Kalori Harian | BMR Calculator</title>

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
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Bassal Metabolic Rate</span></a>
            </li>

			<!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="daily-calorie.php">
                    <i class="fas fa-cookie-bite"></i>
                    <span>Kalori Harian</span></a>
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
                        <h1 class="h3 mb-0 text-gray-800">Hitung Kalori Harian</h1>
                    </div>

                    <?php if(!isset($_POST['submit'])) {?>
                        <form action="" method="post">
                            <!-- Content Row -->
                            <div class="row">
        
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
        
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Pagi</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="utama_1">Makanan Utama</label>
                                                <select class="form-control" id="utama_1" name="utama_1" require>
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($utama) {?>
                                                        <?php foreach ($utama as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="sayuran_1">Sayuran</label>
                                                <select class="form-control" id="sayuran_1" name="sayuran_1">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($sayur) {?>
                                                        <?php foreach ($sayur as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="lauk_1">Lauk</label>
                                                <select class="form-control" id="lauk_1" name="lauk_1">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($lauk) {?>
                                                        <?php foreach ($lauk as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="minum_1">Minuman</label>
                                                <select class="form-control" id="minum_1" name="minum_1">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($minuman) {?>
                                                        <?php foreach ($minuman as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="cemilan_1">Cemilan</label>
                                                <select class="form-control" id="cemilan_1" name="cemilan_1">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($cemilan) {?>
                                                        <?php foreach ($cemilan as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="buah_1">Buah</label>
                                                <select class="form-control" id="buah_1" name="buah_1">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($buah) {?>
                                                        <?php foreach ($buah as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
        
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
        
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Siang</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="utama_2">Makanan Utama</label>
                                                <select class="form-control" id="utama_2" name="utama_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($utama) {?>
                                                        <?php foreach ($utama as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="sayuran_2">Sayuran</label>
                                                <select class="form-control" id="sayuran_2" name="sayuran_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($sayur) {?>
                                                        <?php foreach ($sayur as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="lauk_2">Lauk</label>
                                                <select class="form-control" id="lauk_2" name="lauk_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($lauk) {?>
                                                        <?php foreach ($lauk as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="minum_2">Minuman</label>
                                                <select class="form-control" id="minum_2" name="minum_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($minuman) {?>
                                                        <?php foreach ($minuman as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="cemilan_2">Cemilan</label>
                                                <select class="form-control" id="cemilan_2" name="cemilan_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($cemilan) {?>
                                                        <?php foreach ($cemilan as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="buah_2">Buah</label>
                                                <select class="form-control" id="buah_2" name="buah_2">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($buah) {?>
                                                        <?php foreach ($buah as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
        
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
        
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Malam</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="utama_3">Makanan Utama</label>
                                                <select class="form-control" id="utama_3" name="utama_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($utama) {?>
                                                        <?php foreach ($utama as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="sayuran_3">Sayuran</label>
                                                <select class="form-control" id="sayuran_3" name="sayuran_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($sayur) {?>
                                                        <?php foreach ($sayur as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="lauk_3">Lauk</label>
                                                <select class="form-control" id="lauk_3" name="lauk_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($lauk) {?>
                                                        <?php foreach ($lauk as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="minum_3">Minuman</label>
                                                <select class="form-control" id="minum_3" name="minum_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($minuman) {?>
                                                        <?php foreach ($minuman as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="cemilan_3">Cemilan</label>
                                                <select class="form-control" id="cemilan_3" name="cemilan_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($cemilan) {?>
                                                        <?php foreach ($cemilan as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                            <div class="form-group">
                                                <label for="buah_3">Buah</label>
                                                <select class="form-control" id="buah_3" name="buah_3">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($buah) {?>
                                                        <?php foreach ($buah as $row) { ?>
                                                        <option value="<?= $row['energy'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
                                
                            </div>

                            <div class="row mb-5">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" name="submit" class="btn btn-primary col-12 py-2">Submit</button>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <div class="row">

                            <div class="col-12 mb-4">

                                <!-- Illustrations -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Hasil Perhitungan Konsumsi Kalori</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="text-center">
                                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                                        src="public/assets/media/illustrations/sketchy-1/7.png" alt="...">
                                                </div>
                                            </div>
                                            <div class="col-8 px-4">
                                                <h4 class="small font-weight-bold mt-4">Jumlah Konsumsi Kalori Pagi Ini<span
                                                        class="float-right text-danger"><?= $pagi; ?> Kkal</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $pagi / ($pagi+$siang+$malam) * 100 ?>%"
                                                        aria-valuenow="<?= $pagi / ($pagi+$siang+$malam) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Jumlah Konsumsi Kalori Siang Ini<span
                                                        class="float-right text-danger"><?= $siang; ?> Kkal</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $siang / ($pagi+$siang+$malam) * 100 ?>%"
                                                        aria-valuenow="<?= $siang / ($pagi+$siang+$malam) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Jumlah Konsumsi Kalori Malam Ini<span
                                                        class="float-right text-danger"><?= $malam; ?> Kkal</span></h4>
                                                <div class="progress mb-4">
                                                    <div class="progress-bar" role="progressbar" style="width: <?= $malam / ($pagi+$siang+$malam) * 100 ?>%"
                                                        aria-valuenow="<?= $malam / ($pagi+$siang+$malam) * 100 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <h4 class="small font-weight-bold">Total Kalori Hari Ini<span
                                                        class="float-right text-danger"><?= $pagi + $siang + $malam; ?> Kkal</span></h4>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <p>Hitung kebutuhan kalori harian menggunakan persamaan Mifflin-St.Jeor</p> -->
                                         <div class="d-flex col-12 justify-content-end">
                                             <a href="" class="">Hitung Ulang &rarr;</a>
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