<?php
session_start();

include 'config/dbconfig.php';
include 'config/appconfig.php';

$status = $_SESSION['status'];
$idlogin = $_SESSION['id_login'];
$tipelogin = $_SESSION['tipe_login'];


// jika status login tidak ada, maka diarahkan ke halaman login
if($status != "login"){
    header("location:../login.php");
}

// jika tipe_login sama dengan masyarakat, maka diarahkan ke halaman utama aplikasi
if($tipelogin == "masyarakat"){
    header("location:../");
}

// Mengambil data petugas sesuai dengan id_login yang dikirim dari $_SESSION
$datapetugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$idlogin'");
$petugas = mysqli_fetch_assoc($datapetugas);

// cek data apakah data ada di database petugas
$cekpetugas = mysqli_num_rows($datapetugas);
// echo $cekpetugas;
if($cekpetugas < 0){
    header("location:../");
}

// mengubah data ke variable
$id_petugas = $petugas['id_petugas'];
$nama_petugas = $petugas['nama_petugas'];
$username = $petugas['username'];
$password = $petugas['password'];
$telp = $petugas['telp'];
$level = $petugas['level'];

if($petugas['foto'] != ""){
    $foto_petugas = $petugas['foto'];
}else{
    $foto_petugas = "default.jpg";
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> <?php echo $nama_aplikasi?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/<?php echo $logo_aplikasi?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">


    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/bootstrap5/css/bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <!-- FONT CUSTOM -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.css">

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery363/jquery.min.js"></script>

    <!-- Custom CSS Lokal  -->
    <link rel="stylesheet" href="dist/custom.css">

    <style id="styleAdd">
    /* SELECTION COLOR  */
    ::selection {
        color: black;
        background: yellow;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Inter', sans-serif;
        font-weight: bold;
    }

    a {
        text-decoration: none;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="background-color:#ffffff;">
            <img class="animation__shake" src="assets/img/<?php echo $logo_aplikasi?>"
                alt="<?php echo $nama_aplikasi;?>" height="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-success fixed-top d-flex justify-content-between gap-2">
            <!-- Left navbar links -->
            <div class="navbar-nav">

                <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                        class="fas fa-bars"></i></a>

            </div>
            <div class="navbar-nav text-start mx-2">
                <span><b><?php echo $singkatanAplikasi?></b>
                    <small class="d-none d-md-block"> <?php echo $nama_aplikasi?></small>
                </span>
            </div>
            <div class="ml-auto user-opt">
                <a class="nav-link user-opt-link" href="javascript:">
                    <div class=" d-flex justify-content-start align-items-center gap-2">
                        <div class="flex-fill mb-0 user-avatar rounded-circle"
                            style="background-image:url('assets/img/petugas/<?php echo $foto_petugas;?>');">
                        </div>
                        <span class="d-none d-md-block"><?php echo $nama_petugas?></span>
                        <i class="fa fa-caret-down"></i>
                    </div>
                </a>
                <div class="user-opt-panel bg-white shadow rounded-0">

                    <div class="d-grid p-3">
                        <span class="d-block d-md-none mb-2"><?php echo $nama_petugas?></span>
                        <span class="badge bg-warning text-start mb-2 p-2">
                            <?php if($level == "admin"){echo "Administrator";}elseif($level == "petugas"){echo "Petugas";}?>
                        </span>
                        <a href="profil" class="d-flex justify-content-between align-items-center mb-2">
                            <i class="fa fa-user text-primary"></i>
                            <span class="flex-fill text-start ms-2">Profil</span>
                            <i class="fa fa-caret-right "></i>
                        </a>
                        <a href="../logout" class="d-flex justify-content-between align-items-center mb-2">
                            <i class="fa fa-right-from-bracket text-danger"></i>
                            <span class="flex-fill text-start ms-2">Logout</span>
                            <i class="fa fa-caret-right"></i>
                        </a>
                    </div>

                </div>
                <script>
                $(".user-opt-link").on("click", function() {
                    $(".user-opt-panel").toggleClass("show")
                })
                </script>
            </div>
        </nav>
        <!-- /.navbar -->