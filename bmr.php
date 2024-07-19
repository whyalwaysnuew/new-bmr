<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }

    $activity_scale = mysqli_query($koneksi, "SELECT * FROM activity_scale");


    if(isset($_POST['submit'])){

        $age = $_POST['age'] ?? 0;
        $gender = $_POST['gender'] ? ($_POST['gender'] == 1 ? -161 : 5) : 0;
        $height = $_POST['height'] ?? 0;
        $weight = $_POST['weight'] ?? 0;
        $scale = $_POST['scale'] ?? 0;

        $bmr_actual = (10 * $_POST['weight']) + (6.25 * $_POST['height']) - (5 * $_POST['age']) + $gender;
        $bmr_ideal = (10 * ($_POST['height'] - 100)) + (6.25 * $_POST['height']) - (5 * $_POST['age']) + $gender;

        $calorie_needs_actual = $bmr_actual * $scale;
        $calorie_needs_ideal = $bmr_ideal * $scale;

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

    <title>Hitung Bassal Metabolic Rate | BMR Calculator</title>

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
            <li class="nav-item active">
                <a class="nav-link" href="bmr.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Bassal Metabolic Rate</span></a>
            </li>

			<!-- Nav Item - Charts -->
            <li class="nav-item">
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
                        <h1 class="h3 mb-0 text-gray-800">Hitung Bassal Metabolic Rate</h1>
                        <a href="" class="btn btn-sm btn-primary">Hitung Ulang</a>
                    </div>

                    <?php if(!isset($_POST['submit'])) {?>
                        <form action="" method="post">
                            <!-- Content Row -->
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <!-- Illustrations -->
                                    <div class="card shadow">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
                                        </div>
                                        <div class="card-body d-flex flex-wrap">
                                            <div class="form-group col-12 col-md-6">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select class="form-control" id="gender" name="gender" require>
                                                    <option value="1" selected>Perempuan</option>
                                                    <option value="2">Laki-laki</option>
                                                </select>
                                            </div>
        
                                            <div class="form-group col-12 col-md-6">
                                                <label for="age">Umur</label>
                                                <input type="number" name="age" id="age" placeholder="e.g. 20" class="form-control" value="0" require>
                                            </div>

                                            <div class="form-group col-12 col-md-6">
                                                <label for="height">Tinggi Badan</label>
                                                <input type="number" name="height" id="height" placeholder="e.g. 167" class="form-control" value="0" require>
                                            </div>
                                            
                                            <div class="form-group col-12 col-md-6">
                                                <label for="weight">Berat Badan</label>
                                                <input type="number" name="weight" id="weight" placeholder="e.g. 50" class="form-control" value="0" require>
                                            </div>
        
                                            <div class="form-group col-12 col-md-6">
                                                <label for="scale">Aktifitas Fisik</label>
                                                <select class="form-control" id="scale" name="scale">
                                                    <option value="0" selected>-- Pilih --</option>
                                                    <?php if($activity_scale) {?>
                                                        <?php foreach ($activity_scale as $row) { ?>
                                                        <option value="<?= $row['scale'] ?>"><?= $row['name'] ?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
        
                                        </div>

                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary col-12 py-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <div class="row">
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Kebutuhan Kalori Harian</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $calorie_needs_actual; ?> Kkal</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-utensils fa-2x text-gray-300"></i>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 mb-4">
                                <div class="card border-left-warning shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                    Kebutuhan Kalori Ideal</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $calorie_needs_ideal; ?> Kkal</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 mb-4">
                                <div class="card <?= $calorie_needs_actual == $calorie_needs_ideal ? 'border-left-success' : ($calorie_needs_actual < $calorie_needs_ideal ? 'border-left-danger' : 'border-left-info') ?> shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold <?= $calorie_needs_actual == $calorie_needs_ideal ? 'text-success' : ($calorie_needs_actual < $calorie_needs_ideal ? 'text-danger' : 'text-info') ?> text-uppercase mb-1">
                                                    <?= $calorie_needs_actual < $calorie_needs_ideal ? 'Kekurangan' : 'Kelebihan'; ?> Kalori</div>
                                                <div class="h5 mb-0 font-weight-bold <?= $calorie_needs_actual == $calorie_needs_ideal ? 'text-success' : ($calorie_needs_actual < $calorie_needs_ideal ? 'text-danger' : 'text-info') ?>"><?= $calorie_needs_actual - $calorie_needs_ideal; ?> Kkal</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
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