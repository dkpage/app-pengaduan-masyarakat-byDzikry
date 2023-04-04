<?php
$title = "Lapor - ";
include "header.php";
include "menu.php";

// jika belum login, maka akan di arahkan ke halaman login
if($login != "login"){
    echo "<script>location.replace('login.php?p=lapor')</script>";
}

// jika tipe pengguna sebagai petugas dan levelnya admin, maka akan diarahkan ke halaman admin
if($tipe == "petugas" && $level == "admin"){
    echo "<script>location.replace('admin/pengaduan')</script>";
}


?>

<style>
.form50 {
    width: 50%;
}

@media only screen and (max-width:576px) {
    .form50 {
        width: unset;
    }
}
</style>


<main class="container py-3 content">
    <div class="text-left">
        <h3 class="h3 fw-bold mb-3 rubik">FORMULIR PENGADUAN</h3>
    </div>

    <form method="POST" class="roboto" enctype="multipart/form-data">
        <input type="text" name="nik" id="" class="d-none" value="<?php echo $nik ?>">
        <div class="d-block d-lg-flex justify-content-between align-items-center gap-2">
            <div class="form-group mb-2 form50">
                <label for="">Judul Laporan <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control rounded-0 border-dark" id="judul" required>
            </div>

            <div class="form-group mb-2 flex-fill">
                <label for="">Tanggal Kejadian <span class="text-danger">*</span></label>
                <input type="date" name="tgl_pengaduan" class="form-control rounded-0 border-dark" id="tgl_pengaduan"
                    required>
            </div>
        </div>

        <div class="d-block d-lg-flex justify-content-between align-items-center gap-2">
            <div class="form-group mb-2 form50">
                <label for="">Kategori Laporan <span class="text-danger">*</span></label>
                <select name="kategori" id="kategori" class="form-control form-select rounded-0 border-dark">
                    <option value="">-- Pilih Kategori --</option>
                    <?php 

                    while($kategori = mysqli_fetch_array($dataKategori)){
                        $katgr = $kategori['kategori'];
                    ?>
                    <option value="<?php echo $katgr?>"><?php echo $katgr?></option>
                    <?php }?>
                </select>
            </div>

            <div class="form-group mb-2 flex-fill">
                <label for="">Upload File Pendukung <small><i>Optional</i></small></label>
                <input type="file" name="foto" class="form-control rounded-0 border-dark" id="file"
                    accept="image/png, image/jpeg, image/jpg, image/svg">
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="">isi_laporan Laporan <span class="text-danger">*</span></label>
            <textarea type="date" name="isi_laporan" class="form-control rounded-0 border-dark" id="isi_laporan"
                rows="5" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" name="kirim" class="btn btn-primary rounded-0 px-3"><i
                    class="fa fa-paper-plane me-2"></i>
                Kirim</button>
        </div>
    </form>
</main>

<!-- DIALOG KONFIRMASI BERHASIL TERKIRIM  -->
<div class="modal fade" id="berhasil" data-bs-backdrop="static">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <span class="h1 text-success" style="font-size:72pt;">
                    <i class="fa-regular fa-circle-check"></i>
                </span>
                <br>
                <br>
                <span>Laporan anda telah terikirm, silahkan periksa secara berkala untuk
                    mengetahui tanggapan dari petugas</span>
                <br>
                <br>
                <div class="d-block d-md-flex justify-content-center gap-1">
                    <a href="lapor" class="btn btn-sm btn-primary w-100 mt-1">Buat Laporan lagi</a>
                    <a href="pengaduan" class="btn btn-sm btn-primary w-100 mt-1">Lihat Pengaduan</a>
                    <a href="index" class="btn btn-sm btn-secondary w-100 mt-1">Selesai</a>
                </div>

            </div>
        </div>
    </div>
</div>


<?php

include 'footer.php';

?>

<?php

if(isset($_POST["kirim"])){
    
    $nik_pelapor = $_POST['nik'];
    $judul = $_POST["judul"];
    $id_pelapor = 1;
    $tgl_pengaduan = $_POST["tgl_pengaduan"];
    $kategori = $_POST["kategori"];
    $isi_laporan = $_POST["isi_laporan"];
    // $nik = 123456789012345;
    $status = '0';
    // $nama = 'pengaduan';

    
    if(!empty($_FILES['foto']['name'])){
        $nama_foto = $_FILES['foto']['name'];
        $ukuran_foto = $_FILES['foto']['size'];
        $tipe_foto = $_FILES['foto']['type'];
        $tmp_foto = $_FILES['foto']['tmp_name'];
        // echo $nama_foto.$foto2;

        $foto = $nama_foto;

        $x = explode(".", $foto);
        $nama_fbaru = "LAP".round(microtime(true)) .'.' . end($x);

        $foto_path = "admin/assets/img/pengaduan/".$nama_fbaru;
        // $simpanfoto = move_uploaded_file($tmp_foto, $foto_path);

        if($tipe_foto=="image/jpeg" || $tipe_foto=="image/jpg" || $tipe_foto=="image/gif" || $tipe_foto=="image/png"){
        
            // [ Untuk menyimpan foto ]
            $uploadfoto = move_uploaded_file($tmp_foto, $foto_path);
            if($uploadfoto == TRUE){
            

                $tambahdata = mysqli_query($koneksi, "INSERT INTO pengaduan (judul, tgl_pengaduan, isi_laporan, foto, status, kategori, nik ) VALUES ('$judul','$tgl_pengaduan','$isi_laporan','$nama_fbaru','$status','$kategori','$nik_pelapor')");


                // memanggil modal jika berhasil
                if($tambahdata == TRUE){

                ?>
<script>
$(document).ready(function() {
    $("#berhasil").modal('show');
});
</script>
<?php
                }else{
                    echo "<script>alert('Pengaduan gagal disimpan')</script>";
                }

               
            }
        }else{
            echo "<script>window.alert('Tipe gambar harus .jpg / .jpeg / .png / .gif ')</script>";
            
        }
}elseif(empty($_FILES['foto']['name'])){      
// [ Menyimpan ke database ]

$tambahdata = mysqli_query($koneksi, "INSERT INTO pengaduan (judul, tgl_pengaduan, isi_laporan, status, kategori, nik ) VALUES ('$judul','$tgl_pengaduan','$isi_laporan','$status','$kategori','$nik_pelapor')");

// memanggil modal jika berhasil
if($tambahdata == TRUE){
    ?>
<script>
$(document).ready(function() {
    $("#berhasil").modal('show');
});
</script>
<?php
}else{
    // ALERT jika gagal disimpan
    echo "<script>alert('Pengaduan gagal disimpan');</script>";
}

}

}


?>