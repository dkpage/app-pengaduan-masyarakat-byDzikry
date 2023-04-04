<?php

include "plugins/phpqrcode/qrlib.php"; 
// [ Untuk membuat dan menyimpan QR Code ]

// $qrval = "ini qr nya";

$qr_dir="assets/img/pengaduan/qrcode/";
if (!file_exists($qr_dir))
mkdir($qr_dir, 0755);
$qrval = "C20AD4D76FE97759AA27A0C99BFF6710";
$qr_file=$qrval.'.png';   
$qr_path = $qr_dir.$qr_file;
QRcode::png($qrval, $qr_path , "H", 6, 4);

echo "<img src='".$qr_dir.$qrval.".png'></img>";

?>