<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }

    $setting = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM settings WHERE id=1"));

    if(isset($_POST['submit'])){
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $name = $_POST['name'];
        $doctor = $_POST['doctor'];

        $query = mysqli_query($koneksi, "
                UPDATE settings SET 
                    name = '$name',
                    address = '$address',
                    phone = '$phone',
                    doctor = '$doctor'
                WHERE id = '1'
                ");

        if($query) {

            echo "
                <script>
                    alert('Berhasil Ubah Data!');
                    document.location='settings.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Error!');
                    document.location='settings.php';
                </script>
            ";
        }
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

    <title>Pengaturan | BMR Calculator</title>

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
            <li class="nav-item">
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
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Pengaturan</h1>
                    </div>

                    <!-- Content Row -->
                     <form action="" method="post">
                         <div class="row">
                             <div class="col-12">
                                 <div class="card shadow">
                                     <div class="card-header py-3">
                                         <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
                                     </div>
                                     <div class="card-body d-flex flex-wrap">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="name" class="font-weight-bold">Nama Instansi</label>
                                            <input type="text" name="name" id="name" placeholder="e.g. RS Mitra Keluarga" class="form-control" value="<?= $setting['name']; ?>" require>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label for="doctor" class="font-weight-bold">Nama Dokter</label>
                                            <input type="text" name="doctor" id="doctor" placeholder="e.g. Gian Pranata" class="form-control" value="<?= $setting['doctor']; ?>" require>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="address" class="font-weight-bold">Alamat</label>
                                            <textarea name="address" id="address" class="form-control"><?= $setting['address']; ?></textarea>
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <label for="phone" class="font-weight-bold">No Telp</label>
                                            <input type="text" name="phone" id="phone" placeholder="e.g. 08123455" class="form-control" value="<?= $setting['phone']; ?>" require>
                                        </div>
                                     </div>
                                     <div class="card-footer d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary col-12 py-2">Update</button>
                                    </div>
                                 </div>
                             </div>
                         </div>
                     </form>

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