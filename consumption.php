<?php 
    require_once('database/koneksi.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit(); 
    }

    $consumptions = mysqli_query($koneksi, "SELECT * FROM consumption");
    // $query = "";
    // $urlcrud
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Konsumsi - BMR Calculator</title>

    <!-- Custom fonts for this template-->
    <link href="public/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.0/css/dataTables.dataTables.min.css">
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
            <li class="nav-item active">
                <a class="nav-link" href="consumption.php">
                    <i class="fas fa-cheese"></i>
                    <span>Konsumsi</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="question.php">
                    <i class="fas fa-question-circle"></i>
                    <span>Rules Pertanyaan</span></a>
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
                        <h1 class="h3 mb-0 text-gray-800">Konsumsi</h1>
                        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#addModal">
                            <!-- <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> -->
                            <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                            Tambah Data
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Konsumsi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="align-middle text-center">No</th>
                                            <th class="align-middle">Name</th>
                                            <th class="align-middle">Type</th>
                                            <th class="align-middle">Energy</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($consumptions) {?>
                                            <?php foreach ($consumptions as $key => $consumption) { ?>
                                            <tr>
                                                <td class="text-center align-middle"><?= $key+1; ?></td>
                                                <td class="align-middle"><?= $consumption['name']; ?></td>
                                                <td class="align-middle">
                                                    <?= $consumption['type'] == '1' ? 'Makanan Utama' : ''; ?>
                                                    <?= $consumption['type'] == '2' ? 'Sayuran' : ''; ?>
                                                    <?= $consumption['type'] == '3' ? 'Lauk Pauk' : ''; ?>
                                                    <?= $consumption['type'] == '4' ? 'Minuman' : ''; ?>
                                                    <?= $consumption['type'] == '5' ? 'Cemilan' : ''; ?>
                                                    <?= $consumption['type'] == '6' ? 'Buah' : ''; ?>
                                                </td>
                                                <td class="align-middle"><?= $consumption['energy']; ?></td>
                                                <td class="align-middle justify-content-center">
                                                    <a href="#" class="btn btn-warning text-white" data-toggle="modal" data-target="#editModal<?= $key ?>">Ubah</a>
                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $key ?>">Hapus</a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="editModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $consumption['name']; ?></h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="app/consumption/update.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" id="id" value="<?= $consumption['id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="name">Nama</label>
                                                                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Nasi Goreng" value="<?= $consumption['name']; ?>" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="type">Jenis</label>
                                                                    <select class="form-control" id="type" name="type" required>
                                                                        <option value="1" <?= $consumption['type'] == '1' ? 'selected' : ''; ?>>Makanan Utama</option>
                                                                        <option value="2" <?= $consumption['type'] == '2' ? 'selected' : ''; ?>>Sayuran</option>
                                                                        <option value="3" <?= $consumption['type'] == '3' ? 'selected' : ''; ?>>Lauk Pauk</option>
                                                                        <option value="4" <?= $consumption['type'] == '4' ? 'selected' : ''; ?>>Minuman</option>
                                                                        <option value="5" <?= $consumption['type'] == '5' ? 'selected' : ''; ?>>Cemilan</option>
                                                                        <option value="6" <?= $consumption['type'] == '6' ? 'selected' : ''; ?>>Buah</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="energy">Energi</label>
                                                                    <input type="text" class="form-control" id="energy" name="energy" placeholder="e.g. 250" value="<?= $consumption['energy']; ?>" required>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="deleteModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Hapus?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <form action="app/consumption/delete.php" method="post">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" id="id" value="<?= $consumption['id']; ?>">
                                                                

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger" name="submit">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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

    <!-- Logout Modal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Konsumsi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="app/consumption/store.php" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="e.g. Nasi Goreng">
                        </div>

                        <div class="form-group">
                            <label for="type">Jenis</label>
                            <select class="form-control" id="type" name="type">
                                <option value="1" selected>Makanan Utama</option>
                                <option value="2">Sayuran</option>
                                <option value="3">Lauk Pauk</option>
                                <option value="4">Minuman</option>
                                <option value="5">Cemilan</option>
                                <option value="6">Buah</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="energy">Energi</label>
                            <input type="text" class="form-control" id="energy" name="energy" placeholder="e.g. 250">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="public/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="public/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="public/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="public/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="public/sbadmin/js/demo/datatables-demo.js"></script>

    <script src="https://cdn.datatables.net/2.1.0/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#dataTable');
    </script>
</body>

</html>