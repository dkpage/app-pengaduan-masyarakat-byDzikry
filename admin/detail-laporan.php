<?php
$title = "Detail Pengaduan - ";
include "header.php";
include "sidebar.php";


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

<style>
.field-laporan {
    width: 300px;
}

@media screen and (max-width:685px) {
    .field-laporan {
        width: 100%;
    }
}
</style>
<section class="p-3 text-end border border-success mb-3 ">
    <div class="d-inline d-md-flex justify-content-end gap-2">
        <?php 
        // agar laporan yang sudah selesai tidak bisa ditanggapi lagi
        if($sttsLpr != "selesai"){
        ?>
        <button id="" class="btn btn-sm btn-primary border border-1 rounded-1" data-toggle="modal"
            data-target="#tanggapi">
            <i class="fa fa-reply"></i> Tanggapi
        </button>
        <?php
        }
        ?>
        <button id="" class="btn btn-sm btn-danger border border-1 rounded-1" data-toggle="modal" data-target="#hapus">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <?php if($level == "admin"){ ?>
        <a href="generate?dl=<?php echo md5($idlpr);?>" class="btn btn-sm btn-primary border border-1 rounded-1">
            <i class="fa-regular fa-file"></i> Generate Laporan
        </a>
        <?php } ?>
    </div>
</section>
<section class="p-4">

    <div id="laporan" class="">
        <hr class="border-dark opacity-100">
        <div class="d-block">
            <div class="text-start">
                <h3 class="mb-0 fw-bold text-capitalize"><?php echo $judulLpr; ?></h3>

            </div>

        </div>
        <hr class="border-dark opacity-100">
        <div class="d-flex justify-content-between">
            <table class="d-block flex-fill">
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
        <?php } ?>

    </div>

</section>
<!-- DIALOG UNTUK HAPUS PENGADUAN  -->
<div class="modal fade" id="hapus">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="" method="POST">
                    <h1 class="text-danger">
                        <i class="fa fa-circle-question"></i>
                    </h1>
                    <h5>Hapus Laporan <b><?php echo $judulLpr;?></b> dari
                        <b><?php echo $nama_plpr;?></b> ?
                    </h5>
                    <input type="text" name="hapus" value="<?php echo $idlpr;?>" hidden="hidden">
                    <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- DIALOG UNTUK TANGGAPI PENGADUAN  -->
<div class="modal fade" id="tanggapi">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body ">
                <h3 class="text-capitalize">Tanggapi <?php echo $judulLpr ?></h3>
                <hr>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tanggapan</label>
                        <textarea type="text" name="tanggapan" id="" class="form-control"></textarea>
                    </div>

                    <input type="text" name="idLap" id="" value="<?php echo $idlpr?>" hidden>
                    <button type="submit" class="btn btn-primary" name="edit">Tanggapi</button>
                    <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>

                </form>

            </div>
        </div>
    </div>
</div>


<?php
        }else{
        ?>
<section class="p-4 border border-1 rounded-1">
    <h4>Tidak ada data yang sesuai.</h4>
    <a href="pengaduan">Lihat data Pengaduan</a>
</section>
<?php
        }
}else{
    ?>
<section class="p-4 border border-1 rounded-1">
    <h4>Tidak ada data yang sesuai.</h4>
    <a href="pengaduan">Lihat data Pengaduan</a>
</section>
<?php
    }
?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=masterdata]").parent().addClass("menu-open");
$("a[href=masterdata]").addClass("active");
$("a[href=pengaduan]").addClass("active");
</script>

<?php
include "footer.php";
?>

<?php

// kode php untuk hapus pengaduan
if(isset($_POST['hapus'])){
    $idh = $_POST['hapus'];

    $hapusLap = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan='$idh'");

    // menghapus foto pengaduan dari server jika ada lampiran fotonya
    $lihatData = mysqli_query($koneksi, "SELECT foto FROM pengaduan WHERE id_pengaduan='$idh'");
    $dPeng = mysqli_fetch_array($lihatData);
    $fotPeng = $dPeng['foto'];

    if($fotPeng != ""){
        unlink("admin/assets/img/pengaduan/$fotPeng");
    }
    if($hapusLap == TRUE){
        echo "<script>toastr.success('Laporan berhasil dihapus');
                
        setInterval(function() {
            location.replace('pengaduan');
        }, 1000);</script>";
        }else{
        echo "<script>toastr.error('Gagal menghapus laporan');</script>";
        }
}

?>

<?php

// kode php untuk tanggapi pengaduan
if(isset($_POST['tanggapan'])){
    $tanggapan = $_POST['tanggapan'];
    $id_laporan = $_POST['idLap'];
    
    $tanggapi = mysqli_query($koneksi, "INSERT INTO tanggapan(id_pengaduan,tgl_tanggapan,tanggapan,id_petugas) VALUES ('$id_laporan','$appTimestamp','$tanggapan','$id_petugas')");

    // membuat qrcode sebagai ganti tandatangan
    include "plugins/phpqrcode/qrlib.php"; 

    $qr_dir="assets/img/pengaduan/qrcode/";
    if (!file_exists($qr_dir))
    mkdir($qr_dir, 0755);
    $qrval = md5($id_laporan);
    $qr_file=$qrval.'.png';   
    $qr_path = $qr_dir.$qr_file;
    QRcode::png($qrval, $qr_path , "H", 6, 4);

    // QRcode::png("eusi kode na", "assets/img/pengaduan/qrcode/eusi kode na.png", "H", 6, 4);

    if($tanggapi == TRUE){

        $editStts = mysqli_query($koneksi, "UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='$id_laporan'");
        if($editStts == TRUE){

            echo "<script>toastr.success('Laporan berhasil ditanggapi');
                
            setInterval(function() {
                location.replace('pengaduan');
            }, 1000);</script>";
            }else{
            echo "<script>toastr.error('Gagal update status laporan');</script>";
            }
        }else{
            echo "<script>toastr.error('Gagal menyimpan tanggapan ke database');</script>";
    }
}
    

?>