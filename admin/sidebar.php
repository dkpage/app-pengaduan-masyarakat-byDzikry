<aside class="main-sidebar main-sidebar-custom sidebar-dark-success">
    <!-- Brand Logo -->
    <div class="text-center d-grid">
        <a href="dashboard" class="text-center p-3 lh-2">
            <img src="assets/img/<?php echo $logo_aplikasi?>" alt="<?php echo $nama_aplikasi;?>" class="" style=""
                height="50">
            <!-- <span class="brand-text font-weight-light">-</span> -->
        </a>
    </div>
    <hr class="border-light">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="masterdata" class="nav-link">
                        <i class="nav-icon fa fa-database"></i>
                        <p>
                            Master Data
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if($level == "admin"){ ?>
                        <li class="nav-item">
                            <a href="petugas" class="nav-link">
                                <i class="nav-icon fas fa-users-gear"></i>
                                <p>
                                    Data Petugas
                                </p>
                            </a>
                        </li>
                        <?php } ?>

                        <li class="nav-item">
                            <a href="masyarakat" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Data Masyarakat
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pengaduan" class="nav-link">
                                <i class="nav-icon fa-regular fa-folder-open"></i>
                                <p>
                                    Pengaduan
                                    <?php 
                            // mengambil jumlah data pengaduan 
                            $data_pengd = mysqli_query($koneksi, "SELECT * FROM pengaduan");
                            $jmlpeng = mysqli_num_rows($data_pengd);
                            ?>
                                    <span class="right badge badge-danger"><?php echo $jmlpeng ?></span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if($level == "admin"){ ?>
                <li class="nav-item">
                    <a href="generate" class="nav-link">
                        <i class="nav-icon fa-regular fa-file"></i>
                        <p>
                            Generate Laporan
                        </p>
                    </a>
                </li>
                <?php } ?>

                <?php if($level == "admin"){ ?>
                <li class="nav-item">
                    <a href="pengaturan" class="nav-link">
                        <i class="nav-icon fas fa-gear"></i>
                        <p>
                            Pengaturan
                        </p>
                    </a>
                </li>
                <?php } ?>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-white py-5 mt-3">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 fw-bold"><?= $title ?></h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content pb-5">
        <div class="container-fluid">