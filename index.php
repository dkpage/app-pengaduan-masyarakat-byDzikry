<?php
$title = "";
include "header.php";
include "menu.php";
?>

<script>
$(document).ready(function() {
    $("#top-menu").removeClass("sticky-top bg-white shadow");
    $("#top-menu").addClass("fixed-top intop text-white");
})
</script>

<script>
window.onscroll = function() {
    fixedHeader();
};
var header = document.getElementById("top-menu");
var sticky = header.offsetTop;

function fixedHeader() {
    if (window.pageYOffset > sticky) {
        $("#top-menu").removeClass("intop text-white").addClass("scroll-top bg-white shadow");
    } else {
        $("#top-menu").removeClass("scroll-top bg-white shadow").addClass("intop text-white");
    }
}
</script>

<section class="bg-secondary mt-0" id="hero" style="background-image:url('admin/assets/img/bg-index.jpg');">
    <div class="px-3 d-grid container">
        <br>
        <div class="text-center">
            <?php if($login == "login"){ ?>
            <h1 class="text-white fw-bold">Layanan Pengaduan Terpadu</h1>
            <h4> <?php echo $nama_instansi?></h4>
            <?php }else{ ?>
            <h1 class="text-white fw-bold">Selamat Datang...</h1>
            <p class="text-white">
                Di Aplikasi <?php echo $nama_aplikasi?> (<?php echo $singkatanAplikasi?>). <br>
                <?php echo $nama_instansi?>
            </p>
            <?php } ?>
            <br>
            <?php if($login == "login" && $tipe == "petugas"){ ?>

            <a href="admin/" class="btn btn-outline-light btn-lg fw-bold">Buka Panel Petugas</a>

            <?php }elseif($login != "login"){ ?>

            <a href="login?p=./" class="btn btn-outline-light btn-lg fw-bold">Login Untuk Melapor</a>

            <?php } ?>
        </div>
        <br>
        <br>

    </div>
</section>

<?php if($login == "login" && $tipe == "masyarakat"){ ?>
<!-- FORMULIR LAPORAN  -->
<section class="sec-30" id="f-laporan">
    <div class="container text-center d-flex justify-content-center" id="formLaporan">
        <div class="bg-white shadow p-4 col-12 col-md-6 col-lg-6">
            <div class="text-start bg-primary p-3">
                <h5 class="mb-0">Sampaikan Laporan Anda</h5>
            </div>
            <hr>
            <!-- ALERT BERHASIL MENYIMPAN LAPORAN  -->
            <div class="alert alert-success text-start rounded-0 d-none" id="berhasil" data-aos="fade-down"
                data-aos-duration="1000">
                <b><i class="fa fa-check"></i> Berhasil</b>
                <span>Laporan anda telah disimpan</span>
            </div>
            <!-- ALERT GAGAL MENYIMPAN LAPORAN  -->
            <div class="alert alert-danger text-start rounded-0 d-none" id="gagal" data-aos="fade-down"
                data-aos-duration="1000">
                <b><i class="fa fa-check"></i> Oops!</b>
                <span>Laporan anda gagal disimpan</span>
            </div>
            <form method="POST" class="text-start" enctype="multipart/form-data">
                <input type="text" name="nik" id="" class="d-none" value="<?php echo $nik ?>">

                <div class="form-group mb-2 ">
                    <label for="">Judul Laporan <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control rounded-0" id="judul" required>
                </div>

                <div class="form-group mb-2 flex-fill">
                    <label for="">Tanggal Kejadian <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_pengaduan" class="form-control rounded-0 " id="tgl_pengaduan" required>
                </div>

                <div class="form-group mb-2 ">
                    <label for="">Kategori Laporan <span class="text-danger">*</span></label>
                    <select name="kategori" id="kategori" class="form-control form-select rounded-0 ">
                        <option value="">-- Pilih Kategori --</option>
                        <?php 

                    while($kategori = mysqli_fetch_array($dataKategori)){
                        $katgr = $kategori['kategori'];
                    ?>
                        <option value="<?php echo $katgr?>"><?php echo $katgr?></option>
                        <?php }?>
                    </select>

                    <br>
                    <div class="form-group mb-2 flex-fill">
                        <label for="">Upload File Pendukung <small><i>Optional</i></small></label>
                        <input type="file" name="foto" class="form-control rounded-0" id="file"
                            accept="image/png, image/jpeg, image/jpg, image/svg">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="">isi_laporan Laporan <span class="text-danger">*</span></label>
                    <textarea type="date" name="isi_laporan" class="form-control rounded-0" id="isi_laporan" rows="5"
                        required></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" name="kirim" class="btn btn-primary rounded-0 px-3"><i
                            class="fa fa-paper-plane me-2"></i>
                        Kirim</button>
                </div>
            </form>
        </div>

    </div>
</section>

<?php } ?>

<!-- TIMLINE  -->
<section class="sec-20" id="tl-laporan">
    <div class="container text-center py-4">
        <div class="text-center sec-title">
            <h4>Proses Perjalanan Laporan Anda</h4>
        </div>
        <div class="timeline-area">
            <div class="timline-box text-center">
                <div class="icon-box rounded-circle p-3 shadow bg-primary">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="text-box">
                    <h5>Tulis Laporan</h5>
                    <span>Anda menyampaikan laporan pengaduan anda melalui aplikasi ini</span>
                </div>
            </div>
            <i class="fa fa-angle-right md-icon"></i>
            <i class="fa fa-angle-down sm-icon"></i>
            <div class="timline-box text-center">
                <div class="icon-box rounded-circle p-3 shadow">
                    <i class="fa fa-rotate"></i>
                </div>
                <div class="text-box">
                    <h5>Proses Verifikasi</h5>
                    <span>Laporan anda akan diterima dan diverifikasi oleh petugas</span>
                </div>
            </div>
            <i class="fa fa-angle-right md-icon"></i>
            <i class="fa fa-angle-down sm-icon"></i>
            <div class="timline-box text-center">
                <div class="icon-box rounded-circle p-3 shadow">
                    <i class="fa fa-reply"></i>
                </div>
                <div class="text-box">
                    <h5>Laporan Ditanggapi</h5>
                    <span>Petugas yang bersangkutan akan menanggapi laporan anda maksimal 5 hari kerja</span>
                </div>
            </div>
            <i class="fa fa-angle-right md-icon"></i>
            <i class="fa fa-angle-down sm-icon"></i>
            <div class="timline-box text-center">
                <div class="icon-box rounded-circle p-3 shadow">
                    <i class="fa fa-check "></i>
                </div>
                <div class="text-box">
                    <h5>Selesai</h5>
                    <span>Anda akan menerima tanggapan dari petugas dan Laporan anda selesai</span>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
// statistik laporan 
// menghitung banyaknya laporan
$cDataLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan");
$jmlDataLaporan = mysqli_num_rows($cDataLaporan);

// menghitung banyaknya tanggapan
$cDataTanggapan = mysqli_query($koneksi, "SELECT * FROM tanggapan");
$jmlDataTanggapan = mysqli_num_rows($cDataTanggapan);

// menghitung banyaknya petugas
$cDataPetugas = mysqli_query($koneksi, "SELECT * FROM petugas");
$jmlDataPetugas = mysqli_num_rows($cDataPetugas);

// menghitung banyaknya masyarakat
$cDataMasyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat");
$jmlDataMasyarakat = mysqli_num_rows($cDataMasyarakat);


?>


<!-- JUMLAH LAPORAN  -->
<section class="sec-30 bg-image-gradient" id="jml-laporan">
    <div class="container">
        <h1><?php echo $jmlDataLaporan ?></h1>
        <span>Laporan tersimpan</span>
    </div>
</section>

<section class="sec-30" id="statistik">
    <div class="container">
        <div class="statistik-area text-success flex-wrap">
            <div class="statistik-box col-4 col-md-2">
                <div class="stat-icon-box">
                    <i class="fa-regular fa-folder-open"></i>
                </div>
                <div class="stat-text-box">
                    <h1><?php echo $jmlDataLaporan ?></h1>
                    <span>Pengaduan</span>
                </div>
            </div>
            <div class="statistik-box col-4 col-md-2">
                <div class=" stat-icon-box">
                    <i class="fa fa-reply"></i>
                </div>
                <div class="stat-text-box">
                    <h1><?php echo $jmlDataTanggapan ?></h1>
                    <span>Tanggapan</span>
                </div>
            </div>
            <div class="statistik-box col-4 col-md-2">
                <div class=" stat-icon-box">
                    <i class="fa fa-users"></i>
                </div>
                <div class="stat-text-box">
                    <h1><?php echo $jmlDataMasyarakat ?></h1>
                    <span>Pengguna</span>
                </div>
            </div>
            <div class="statistik-box col-4 col-md-2">
                <div class=" stat-icon-box">
                    <i class="fa fa-user-gear"></i>
                </div>
                <div class="stat-text-box">
                    <h1><?php echo $jmlDataPetugas ?></h1>
                    <span>Petugas</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LAPORAN TERBARU  -->
<section class="sec-20" id="lap-terbaru">
    <div class="container p-3 shadow">
        <div class="sec-title text-start">
            <h4>Laporan Terbaru</h4>
        </div>
        <div class="lap-new-area">

            <?php 
        // memulai nomor dari 1
        $i = 1;
        // mengambil data pengaduan dari database tabel pengaduan
        $data_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan LIMIT 8");

        // melakukan perulangan --- menampilkan data pengaduan
        while($pengaduan = mysqli_fetch_array($data_pengaduan)){
            // mengubah data kedalam variable
            $id_lap = $pengaduan['id_pengaduan'];
            $tgl_lap = $pengaduan['tgl_pengaduan'];
            $judul_lap = $pengaduan['judul'];
            $isi_lap = substr($pengaduan['isi_laporan'], 0, 250);
            $kategori_lap = $pengaduan['kategori'];
            $nik_pel = $pengaduan['nik'];
            $stts_lap = $pengaduan['status'];

            $dataPelapor = mysqli_query($koneksi, "SELECT nama FROM masyarakat WHERE nik='$nik_pel'");
            if(mysqli_num_rows($dataPelapor)>0){
                $namaPelapor = mysqli_fetch_array($dataPelapor)['nama'];
            }else{
                $namaPelapor = "Anonim";
            }
            

        ?>
            <div class="lap-box p-3 border border-1 d-grid">

                <div class="judul-lap  mb-3">
                    <?php
                if($stts_lap == "selesai"){ ?>
                    <i class="fa-regular fa-circle-check text-success icon-status"></i>
                    <?php }else{?>
                    <i class="fa fa-rotate text-secondary icon-status"></i>
                    <?php } ?>
                    <h5 class="d-inline text-capitalize ms-2 text-dark"><?php echo $judul_lap ?></h5>
                </div>
                <div class="isi-lap  mb-2">
                    <span><?php echo $isi_lap ?></span>
                </div>
                <div class="d-grid d-md-flex justify-content-start align-items-center gap-3 text-secondary">
                    <span><i class="fa fa-user me-2"></i><?php echo $namaPelapor ?></span>
                    <span><i class="fa fa-calendar me-2"></i><?php echo $tgl_lap ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<section class="bg-dark" id="index-footer">
    <div class="container py-5">
        <div class="d-grid d-md-flex justify-content-between align-items-center">
            <div class="col-12 col-md-5 d-grid">
                <img src="admin/assets/img/<?php echo $logo_instansi?>" alt="" height="80" class="mb-2">
                <h3 class="mb-0"><?php echo $singkatanAplikasi?></h3>
                <span><?php echo $nama_instansi?></span>
                <span><?php echo $alamat_instansi?></span>
                <br>
                <a class="text-white" href="Tel:<?php echo $telp_instansi?>">
                    <?php echo $telp_instansi?>
                </a>
                <a class="text-white" href="mailto:<?php echo $email_instansi ?>">
                    <?php echo $email_instansi ?>
                </a>
                <a class="text-white" href="<?php echo $web_instansi ?>">
                    <?php echo $web_instansi ?>
                </a>
            </div>
            <div class="col-12 col-md-3 mt-2 text-start text-md-center">
                <div class="social-buttons">
                    <a href="#" class="social-button">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="#" class="social-button">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-button">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-button">
                        <i class="fa-brands fa-twitter"></i>
                    </a>

                </div>



            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";

?>

<script>
$(document).ready(function() {
    $(".bg-image-gradient").css("background-image", "url('admin/assets/img/bg-index.jpg')");
})
</script>


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
            // [ Untuk menyimpan foto ]
            $uploadfoto = move_uploaded_file($tmp_foto, $foto_path);
            if($uploadfoto == TRUE){
            

                $tambahdata = mysqli_query($koneksi, "INSERT INTO pengaduan (judul, tgl_pengaduan, isi_laporan, foto, status, kategori, nik ) VALUES ('$judul','$tgl_pengaduan','$isi_laporan','$nama_fbaru','$status','$kategori','$nik_pelapor')");


                // memanggil Alert konfirmasi
                if($tambahdata == TRUE){

                    echo '<script>$("#berhasil").removeClass("d-none");setInterval(function(){$("#berhasil").addClass("d-none")}, 5000)</script>';

                }else{
                    
                    echo '<script>$("#gagal").removeClass("d-none");setInterval(function(){$("#gagal").addClass("d-none")}, 5000)</script>';
                }

               
            }
    }elseif(empty($_FILES['foto']['name'])){      
    // [ Menyimpan ke database ]

    $tambahdata = mysqli_query($koneksi, "INSERT INTO pengaduan (judul, tgl_pengaduan, isi_laporan, status, kategori, nik ) VALUES ('$judul','$tgl_pengaduan','$isi_laporan','$status','$kategori','$nik_pelapor')");

        /// memanggil Alert konfirmasi
        if($tambahdata == TRUE){

            echo '<script>$("#berhasil").removeClass("d-none");setInterval(function(){$("#berhasil").addClass("d-none")}, 5000)</script>';

        }else{
            
            echo '<script>$("#gagal").removeClass("d-none");setInterval(function(){$("#gagal").addClass("d-none")}, 5000)</script>';
        }

    }

}


?>