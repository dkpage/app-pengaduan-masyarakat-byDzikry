<?php
$title = "Generate - ";
include "header.php";
include "sidebar.php";
?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=generate]").addClass("active");
</script>
<section class="p-3 text-end border border-success mb-3 ">
    <div class="d-inline d-md-flex justify-content-end gap-2">

        <button id="pilih" class="btn btn-sm btn-primary border border-1 rounded-1">
            <i class="fa fa-list"></i> Pilih Laporan
        </button>
        <button id="print" class="btn btn-sm btn-outline-primary  rounded-1">
            <i class="fa fa-print"></i> Cetak/PDF
        </button>

    </div>
</section>
<div id="form-pilih" class="sembunyi">
    <section class="d-grid gap-2 p-3 border border-success mb-3">
        <form action="" method="get" class="d-grid d-md-flex gap-2">
            <select name="dl" id="" class="select2 select2bs4 form-control form-select">
                <option value="">-- Pilih Pengaduan -- </option>
                <?php
            $listLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan");
            while($listL = mysqli_fetch_array($listLaporan)){
            ?>
                <option value="<?php echo md5($listL['id_pengaduan'])?>"><?php echo $listL['judul']?></option>
                <?php }
            ?>
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Lihat</button>
        </form>
    </section>
</div>


<script>
$("#pilih").on("click", function() {
    $("#form-pilih").toggleClass("sembunyi");
})
</script>

<?php

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

<section class="p-4">

    <div id="laporan" class="">
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
        <?php } ?>

    </div>

</section>
<div class="d-none" id="footerPrint">
    <div class="d-flex justify-content-end position-absolute bottom-0">
        <span class="text-dark"><?php echo $nama_aplikasi?> - Dicetak oleh
            <?php  echo $nama_petugas ?> <br> <?php echo $appTimestamp; ?></span>
    </div>
</div>

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
<section class="d-grid gap-2 p-3 border border-success mb-3">
    <form action="" method="get" class="d-grid d-md-flex gap-2">
        <select name="dl" id="" class="select2 select2bs4 form-control form-select">
            <option value="">-- Pilih Pengaduan -- </option>
            <?php
            $listLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan");
            while($listL = mysqli_fetch_array($listLaporan)){
            ?>
            <option value="<?php echo md5($listL['id_pengaduan'])?>"><?php echo $listL['judul']?></option>
            <?php }
            ?>
        </select>
        <button type="submit" class="btn btn-sm btn-secondary">Lihat</button>
    </form>
</section>
<?php
    }
?>


<?php
include "footer.php";
?>


<!-- <script>
const date = new Date();

let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

// This arrangement can be altered based on how we want the date's format to appear.
let currentDate = `${day}-${month}-${year}`;
document.getElementById("tgl").innerHTML = currentDate;
</script> -->

<script>
// FUNGSI UNTUK MENCETAK DOKUMEN LAPORAN
$("#print").on("click", function() {
    var style = "<link rel='stylesheet' href='plugins/bootstrap5/css/bootstrap.min.css'>";
    var styleBs4 = "<link rel='stylesheet' href='plugins/bootstrap/css/bootstrap.min.css'>";
    var styleALte = "<link rel='stylesheet' href='dist/css/adminlte.min.css'>";
    var styleAdd = document.getElementById("styleAdd").innerHTML;

    var laporan = document.getElementById("laporan").innerHTML;
    var footerPrint = document.getElementById("footerPrint").innerHTML;

    var halamanCetak = window.open();

    halamanCetak.document.write("<!DOCTYPE html><html lang='en'><head>" + style + styleALte + "<style>" +
        styleAdd + "</style>" +
        "</head><body class='p-4'>" +
        laporan + footerPrint +
        "</body></html>");
    $(halamanCetak).ready(function() {
        setInterval(function() {
            halamanCetak.print();
            halamanCetak.close();
        }, 100);

    })

})
</script>


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