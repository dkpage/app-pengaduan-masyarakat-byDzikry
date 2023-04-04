<?php
$title = "Print";
include "header.php";


if(isset($_GET['dl'])){

    // menangkat data id yang dikirim dengan metode GET pada URL
    $id_lpr = $_GET['dl'];
    
    // mengambil data pengaduan dari database sesuai id yang dikirim diatas dengan data yang di MD5/enkripsi
    $dataLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE MD5(id_pengaduan)='$id_lpr'");
    $varLap = mysqli_fetch_array($dataLaporan);
    $jdt = mysqli_num_rows($dataLaporan);

    if($jdt > 0){
    // mengubah ke variable
    $idlpr = $varLap['id_pengaduan'];
    $judulLpr =  $varLap['judul'];
    $timestampLpr =  $varLap['timestamp'];
    $tglLpr =  $varLap['tgl_pengaduan'];
    $nikLpr =  $varLap['nik'];
    $isiLpr =  $varLap['isi_laporan'];
    $fotoLpr =  $varLap['foto'];
    $kategoriLpr =  $varLap['kategori'];
    $sttsLpr =  $varLap['status'];
    
    // mengambil data masyarakat sesuai nik yang ada pada laporan
    $dataMas = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nikLpr'");

    // cek apakah akun pengguna masih ada atau tidak
    if(mysqli_num_rows($dataMas) > 0){
        $rDataMas = mysqli_fetch_array($dataMas);
        // mengubah data pelapor kedalam variable
        $nama_plpr = $rDataMas['nama'];
        $tlp_plpr = $rDataMas['telp'];
    }else{
        $nama_plpr = "Akun Terhapus";
        $tlp_plpr = "-";
    }
   
?>
<style type="text/css" id="css">
/* [ Menghapus Header dan footer ] */
*,
::after,
::before {
    box-sizing: unset;
}

.print-canvas {
    background-color: #e0e0e0;
    padding: 10px 20px 10px 20px;
    margin: 0;
}

.print-preview {
    width: 210mm;
    height: 297mm;
}

#footerPrint {
    position: relative;
}

@media print {
    * {
        /* -webkit-print-color-adjust: exact; */
        box-sizing: unset;
    }


    body {
        margin: 0;
        padding: 0;
    }

    :not(#print) {
        background-color: white;
    }

    #notPrint,
    .notPrint {
        display: none;
    }

    .print-canvas {

        background: transparent;
        padding: 0;
        margin: 0;
    }

    .print-preview {
        width: 100%;
        min-height: 297mm;
        margin: none;
        padding: 0;
    }

    #footerPrint {
        position: fixed;
        bottom: 0;
        right: 1.5rem;
    }
}



.qrcode {
    height: 30mm;
    width: 30mm;
}
</style>


<section class="print-canvas ">
    <div id="print-preview" class="p-4 bg-white">
        <div class="d-flex justify-content-between gap-3 align-items-start">
            <img src="assets/img/<?php echo $logo_aplikasi?>" alt="" height="80">
            <div class="text-start flex-fill">
                <span class="mb-0 mt-0">
                    <b><?php echo $nama_aplikasi?></b>
                    <br>
                    <?php echo $nama_instansi?> <br> <?php echo $alamat_instansi?> <br>
                    <?php echo $telp_instansi?> - <?php echo $web_instansi?>
                </span>
            </div>

        </div>
        <hr class="border-dark opacity-100">
        <div class="d-block">
            <div class="text-start">
                <h3 class="mb-0 fw-bold">Pengaduan Masyarakat</h3>

            </div>

        </div>
        <hr class="border-dark opacity-100">
        <div class="d-flex justify-content-between">
            <table class="d-block flex-fill">
                <tr>
                    <td width="" class="fw-bold">Judul Laporan</td>
                    <td>:</td>
                    <td class="text-capitalize"><?php echo $judulLpr; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Tanggal</td>
                    <td>:</td>
                    <td><?php echo $tglLpr; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Kategori</td>
                    <td>:</td>
                    <td><?php echo $kategoriLpr; ?></td>
                </tr>

                <tr>
                    <td class="fw-bold ">ID Laporan</td>
                    <td>:</td>
                    <td class="text-uppercase"><?php echo $id_lpr; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">Terakhir di update</td>
                    <td>:</td>
                    <td><?php echo $timestampLpr; ?></td>
                </tr>
            </table>
            <table class="d-block flex-fill">
                <tr>
                    <td class="fw-bold">Nama Pelapor</td>
                    <td>:</td>
                    <td class="text-uppercase"><?php echo $nama_plpr; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">NIK</td>
                    <td>:</td>
                    <td><?php echo $nikLpr; ?></td>
                </tr>
                <tr>
                    <td class="fw-bold">No. Telp</td>
                    <td>:</td>
                    <td><?php echo $tlp_plpr; ?></td>
                </tr>

            </table>
        </div>
        <br>

        <div class="flex-fill">
            <p class="fw-bold">
                Isi Laporan
            </p>
            <div class="border border-1 border-dark p-3 text-justify">
                <p><?php echo $isiLpr; ?></p>
            </div>
        </div>
        <br>
        <div class="flex-fill">
            <p class="fw-bold">
                Foto Pendukung
            </p>
            <div class="border border-1 border-dark p-3 ">
                <img src="assets/img/pengaduan/<?php echo $fotoLpr; ?>" alt="" class="img-fluid"
                    style="max-height:300px;">
            </div>
        </div>
        <br>
        <?php

        if($sttsLpr == "selesai"){
            
            // jika statusnya sudah selesai, maka tampilkan field tanggapan
            // mengambil data dari database sesuai idLpr
            $ambilTanggapan = mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_pengaduan='$idlpr'");
            $tanggapan = mysqli_fetch_array($ambilTanggapan);
            // mengubah ke variable
            $isiTanggapan = $tanggapan['tanggapan'];
            $idPet = $tanggapan['id_petugas'];
            $tglTanggapan  = $tanggapan['tgl_tanggapan'];

            // mengambil nama yang menanggapi
            $dPetugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$idPet'");
            $petugas = mysqli_fetch_array($dPetugas);
            $nmPet = $petugas['nama_petugas'];
        
        ?>
        <div class="flex-fill">
            <p class="fw-bold">
                Tanggapan
            </p>
            <tr>
                <p>Ditanggapi oleh : <b><?php echo $nmPet;?></b> pada <?php echo $tglTanggapan;?></p>
            </tr>
            <div class="border border-1 border-dark p-3 ">
                <p>
                    <?php echo $isiTanggapan;?>
                </p>
            </div>
        </div>
        <br>
        <div class="d-grid text-end" id="footerPrint">
            <div class="d-grid">
                <div class="text-">
                    <span> <?php echo $appTimestamp; ?></span><br>
                    <b><?php  echo $nama_petugas ?></b>
                </div>
                <div class="text-">
                    <img src="assets/img/pengaduan/qrcode/<?php echo md5($idlpr);?>.png" alt="" class="qrcode">
                </div>

            </div>
        </div>
        <?php } ?>

    </div>
</section>


<?php
        }else{
            ?>
<section class="p-4 border border-1 rounded-1">
    <h4>Tidak ada data yang sesuai.</h4>
    <a href="pengaduan">Lihat data Pengaduan</a>
</section>
<?php
        }
}
?>


<?php
include "footer.php";
?>

<script>
$(".main-header, .main-footer, .preloader").remove();
</script>