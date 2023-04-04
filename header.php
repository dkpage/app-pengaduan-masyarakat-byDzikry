<?php
session_start();

include "admin/config/dbconfig.php";
include "admin/config/appconfig.php";
// cek sesi apakah sudah login atau belum
if(isset($_SESSION['status'])){
    // jika sudah login maka....
    $login = $_SESSION['status'];
    $tipe = $_SESSION['tipe_login'];


    if($tipe == "masyarakat"){
        // jika tipe penggunanya adalah masyarakat maka....
        // Mengambil data petugas sesuai dengan id_login yang dikirim dari $_SESSION
        $id_user = $_SESSION['id_login'];
        $datamasyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE id='$id_user'");
        $pengguna = mysqli_fetch_assoc($datamasyarakat);

        // mengubah data kedalam variable
        $id = $pengguna['id'];
        $nama = $pengguna['nama'];
        $nik = $pengguna['nik'];
        $username = $pengguna['username'];
        $password = $pengguna['password'];
        $telp = $pengguna['telp'];
        $status = $pengguna['status'];
        $foto_pengguna = $pengguna['foto'];

        if($foto_pengguna != ""){
            $fotoUser = $foto_pengguna;
        }else{
            $fotoUser = "default.png";
        }

    }elseif($tipe == "petugas"){
        // jika loginnya sebagai petugas maka....
        // Mengambil data petugas sesuai dengan id_login yang dikirim dari $_SESSION
        $id_user = $_SESSION['id_login'];
        $datapetugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$id_user'");
        $petugas = mysqli_fetch_assoc($datapetugas);

        // mengubah data ke variable
        $id = $petugas['id_petugas'];
        $nama = $petugas['nama_petugas'];
        $username = $petugas['username'];
        $password = $petugas['password'];
        $telp = $petugas['telp'];
        $level = $petugas['level'];
    }
}else{
    $login = "belum_login";
    $tipe = "guest";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> <?php echo $nama_aplikasi?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="admin/assets/img/<?php echo $logo_aplikasi?>">

    <!-- Theme AdminLTE -->
    <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="admin/plugins/bootstrap5/css/bootstrap.min.css">

    <link rel="stylesheet" href="custom.css">

    <!-- AOS Animate  -->
    <link rel="stylesheet" href="admin/plugins/aos/aos.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- FONT CUSTOM -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <!-- JQuery Js  -->
    <script src="admin/plugins/jquery363/jquery.min.js"></script>

    <style id="styleAdd">
    /* SELECTION COLOR  */
    ::selection {
        color: white;
        background: #28a745;
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

<body>

    <!-- LOADER IMAGE  -->
    <div class="d-flex justify-content-center align-items-center fixed-top vh-100 w-100 m-0 p-0" id="loader">
        <div class="loader-img">
            <img src="admin/assets/img/<?php echo $logo_aplikasi?>" alt="">
        </div>
    </div>