<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>APP-TI</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../dist/img/th (2).jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">APP TI</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../dist/img/WhatsApp Image 2024-10-21 at 21.33.43_c206a574 (1).jpg"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Galang Anggara Putra</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php?p=home" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=mhs" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Mahasiswa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=mhs&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Mahasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=mhs&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Mahasiswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=prodi" class="nav-link">
                                <i class="nav-icon fas fa-school"></i>
                                <p>
                                    Prodi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=prodi&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Prodi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=prodi&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Prodi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=dosen" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Dosen
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=dosen&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=dosen&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Dosen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=kategori" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Kategori
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=kategori&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=kategori&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=berita" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Berita
                                    <i class="right fas fa-angle-left "></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=berita&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Berita</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=berita&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Berita</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=matkul" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Mata Kuliah
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=matkul&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Matakuliah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=matkul&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Matakuliah</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">

                                <p>
                                    Admin
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="index.php?p=user" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=user&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=user&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="index.php?p=level" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Level
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=level&aksi=list" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Level</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=level&aksi=input" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Level</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Sign out</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <?php
                            $page = isset($_GET['p']) ? $_GET['p'] : 'home';
                            $pageTitle = 'Home'; // Default title
                            
                            switch ($page) {
                                case 'dashboard':
                                    $pageTitle = 'Dashboard';
                                    break;
                                case 'mhs':
                                    $pageTitle = 'Mahasiswa';
                                    break;
                                case 'prodi':
                                    $pageTitle = 'Program Studi';
                                    break;
                                case 'dosen':
                                    $pageTitle = 'Dosen';
                                    break;
                                case 'kategori':
                                    $pageTitle = 'Kategori';
                                    break;
                                case 'berita':
                                    $pageTitle = 'Berita';
                                    break;
                                case 'matkul':
                                    $pageTitle = 'Mata Kuliah';
                                    break;
                                case 'user':
                                        $pageTitle = 'User';
                                        break;
                                case 'level':
                                        $pageTitle = 'Level';
                                        break;
                            }
                            ?>
                            <h1><?php echo $pageTitle; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">APP TI</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if ($page == 'home')
                                        include 'home.php';
                                    if ($page == 'dashboard')
                                        include 'dashboard.php';
                                    if ($page == 'mhs')
                                        include 'mahasiswa.php';
                                    if ($page == 'prodi')
                                        include 'prodi.php';
                                    if ($page == 'dosen')
                                        include 'dosen.php';
                                    if ($page == 'kategori')
                                        include 'kategori.php';
                                    if ($page == 'berita')
                                        include 'berita.php';
                                    if ($page == 'matkul')
                                        include 'matakuliah.php';
                                    if ($page == 'user')
                                        include 'user.php';
                                    if ($page == 'level')
                                        include 'level.php';
                                    ?>
                                    

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">

                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>