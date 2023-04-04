<?php

define("HOST","localhost");
define("USERNAME","root");
define("PASSWORD", "");
define("DB_NAME", "pengaduan-masyarakat");

$koneksi = mysqli_connect(HOST,USERNAME,PASSWORD,DB_NAME);

if($koneksi == TRUE){
//    echo "<script>alert('Koneksi Database Berhasil!')</script>";
}else{
    echo "<script>alert('Koneksi Database Gagal!')</script>";
}

?>