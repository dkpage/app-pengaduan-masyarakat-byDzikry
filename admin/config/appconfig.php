<?php

// set tanggal dan waktu 
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id-ID');

$now = new DateTime();
// id berarti format Indonesia
$tglid = strftime('%d', $now->getTimestamp());
$blnid = strftime('%B', $now->getTimestamp());
$thnid = strftime('%Y', $now->getTimestamp());
$waktuid = strftime('%H:%M', $now->getTimestamp());

$tgl = date('d');
$bln = date('m');
$thn = date('Y');
$jam = date('H:i:s');

// membuat timestamp yang realtime
$appTimestamp = $thn."-".$bln."-".$tgl." ".$jam;

// echo $appTimestamp;


// mengambil data aplikasi
$appData = mysqli_query($koneksi, "SELECT * FROM aplikasi");
$aplikasi = mysqli_fetch_array($appData);

$nama_aplikasi = $aplikasi['nama_app'];
$singkatanAplikasi = $aplikasi['singkatan'];
$versi_aplikasi = $aplikasi['versi'];
$logo_app = $aplikasi['logo'];
$cust_logo_aplikasi = $aplikasi['logo_custom'];

// mengambil data instansi
$insData = mysqli_query($koneksi, "SELECT * FROM instansi");
$instansi = mysqli_fetch_array($insData);

$nama_instansi = $instansi['nama_instansi'];
$alamat_instansi = $instansi['alamat'];
$telp_instansi = $instansi['no_telp'];
$email_instansi = $instansi['email'];
$web_instansi = $instansi['website'];
$logo_instansi = $instansi['logo_instansi'];

// mengambil data kategori
$dataKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

// tambahan, jika admin ingin menggunakan logo instansi
if($logo_app == "0"){
    $logo_aplikasi = $cust_logo_aplikasi;
}elseif($logo_app == "1"){
    $logo_aplikasi = $logo_instansi;
}else{
    $logo_aplikasi = $cust_logo_aplikasi;
}


?>