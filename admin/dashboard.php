<?php
$title = "Dashboard - ";
include "header.php";
include "sidebar.php";

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

<style>
.box-angka {
    min-width: 250px;
}

.box-angka .inner h3 {
    font-size: 32pt;
}

.box-angka .icon i {
    font-size: 58pt;
    opacity: 30%;
}
</style>

<script>
// mengaktifkan menu pada sidebar
$("a[href=dashboard]").addClass("active");
</script>

<section class="d-block d-lg-flex justify-content-between align-items-center gap-1 w-100 p-1">
    <div
        class="p-0 box-angka py-1 px-3 d-flex justify-content-between align-items-center bg-white shadow mt-2 text-dark">
        <div class="inner">
            <h3 class="mb-0 fw-bold"><?php echo $jmlDataLaporan; ?></h3>
            <p>Laporan</p>
        </div>
        <div class="opacity-50 icon">
            <i class="fa-regular fa-folder-open"></i>
        </div>
    </div>
    <div
        class="p-0 box-angka py-1 px-3 d-flex justify-content-between align-items-center bg-white shadow mt-2 text-dark">
        <div class="inner">
            <h3 class="mb-0 fw-bold"><?php echo $jmlDataTanggapan; ?></h3>
            <p>Laporan ditanggapi</p>
        </div>
        <div class="opacity-50 icon">
            <i class="fa fa-reply"></i>
        </div>
    </div>
    <div
        class="p-0 box-angka py-1 px-3 d-flex justify-content-between align-items-center bg-white shadow mt-2 text-dark">
        <div class="inner">
            <h3 class="mb-0 fw-bold"><?php echo $jmlDataPetugas; ?></h3>
            <p>Petugas</p>
        </div>
        <div class="opacity-50 icon">
            <i class="fa fa-users-gear"></i>
        </div>
    </div>
    <div
        class="p-0 box-angka py-1 px-3 d-flex justify-content-between align-items-center bg-white shadow mt-2 text-dark">
        <div class="inner">
            <h3 class="mb-0 fw-bold"><?php echo $jmlDataMasyarakat; ?></h3>
            <p>Masyarakat</p>
        </div>
        <div class="opacity-50 icon">
            <i class="fa fa-users"></i>
        </div>
    </div>

</section>
<br>

<section class="d-block d-md-flex justify-content-between align-items-start gap-2 mt-3">
    <div class="flex-fill bg-white p-3 border border-success mt-2">
        <h5 class="fw-bold text-dark">Laporan Terbaru</h5>
        <br>
        <div class="d-block">
            <table class="table">
                <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data pengaduan dari database tabel pengaduan
            $data_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan ORDER BY tgl_pengaduan LIMIT 0, 5");

            // melakukan perulangan --- menampilkan data pengaduan
            while($pengaduan = mysqli_fetch_array($data_pengaduan)){
                // mengubah data kedalam variable
                $id_lap = $pengaduan['id_pengaduan'];
                $tgl_lap = $pengaduan['tgl_pengaduan'];
                $judul_lap = $pengaduan['judul'];
                $kategori_lap = $pengaduan['kategori'];
                $nik_pel = $pengaduan['nik'];
                $stts_lap = $pengaduan['status'];

                //menampilkan data kedalam tabel html pada tag <tr></tr>
            ?>
                <tr class="w-100 d-flex justify-content-between">
                    <td class="">
                        <?php 
                    if($stts_lap == "0"){
                    ?>
                        <i class="fa fa-ellipsis text-secondary"></i>
                        <?php
                    }elseif($stts_lap == "proses"){
                    ?>
                        <i class="fa fa-rotate text-primary"></i>
                        <?php
                    }elseif($stts_lap == "selesai"){
                        ?>
                        <i class="fa fa-check text-success"></i>
                        <?php
                        }
                    
                    ?>
                    </td>
                    <td class="flex-fill text-start"><?php echo $judul_lap;?></td>
                    <td class="text-end"><a href="detail-laporan?dl=<?php echo md5($id_lap);?>"
                            class="badge badge-primary"><i class="fa fa-eye me-2"></i>Lihat</a></td>
                </tr>
                <?php } ?>
            </table>

        </div>
    </div>
    <div class="col-12 col-md-5 flex-fill  bg-white p-3 border border-success  mt-2">
        <h5 class="fw-bold">Pengguna Baru</h5>
        <br>
        <div class="d-block">
            <table class="table">
                <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data masyarakat dari database tabel masyarakat
            $data_masyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat ORDER BY timestamp LIMIT 0, 5");

            // melakukan perulangan --- menampilkan data masyarakat
            while($rdata_mas = mysqli_fetch_array($data_masyarakat)){
                // mengubah data kedalam variable
                $id_mas = $rdata_mas['id'];
                $nama_mas = $rdata_mas['nama'];
                $nik = $rdata_mas['nik'];
                $username = $rdata_mas['username'];
                $password = $rdata_mas['password'];
                $telp = $rdata_mas['telp'];
                $status = $rdata_mas['status'];

                // membuat warna dan icon status berbeda tergantung statusnya
                if($status == "aktif"){
                    $statclass = "badge-success";
                    $staticon = "fa-check";
                }elseif($status == "nonaktif" || $status == "ditolak"){
                    $statclass = "badge-danger";
                    $staticon = "fa-xmark";
                }elseif($status == "pending"){
                    $statclass = "badge-warning";
                    $staticon = "fa-arrows-rotate";
                }else{
                    $statclass = "";
                    $staticon = "";
                }

                ?>

                <tr>
                    <td>
                        <img src="assets/avatar.png" alt="" class="img-circle" height="30">
                    </td>
                    <td>
                        <span class="mb-0"><?php echo $nama_mas;?></span>
                        <!-- <small><?php echo $username;?></small> -->
                    </td>
                    <td>
                        <span class="badge <?php echo $statclass ;?>">
                            <i class="fa <?php echo $staticon;?> me-1"></i>
                            <?php echo $status;?></span>
                    </td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>
</section>


<?php
include "footer.php";
?>