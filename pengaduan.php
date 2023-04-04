<?php
$title = "Data Pengaduan - ";
include "header.php";
include "menu.php";


if($login != "login"){
    echo "<script>location.replace('login?p=pengaduan')</script>";
}elseif($login == "login" && $tipe == "petugas"){
    echo "<script>location.replace('admin/pengaduan')</script>";
}

?>

<script>
$(document).ready(function() {
    $("title").html("Pengaduan <?php echo $nama ?> - Sistem Informasi Pelaporan Pengaduan Masyarakat")
})
</script>


<br>
<section class="bg-white content">
    <div class="container">
        <div class="text-capitalize">
            <h2>Data Pengaduan <?php echo $nama ?></h2>
        </div>
        <br>
        <div class="alert alert-info">
            <i class="fa fa-circle-info"></i>
            <span>Silahkan klik pada tabel jika ingin melihat rinciannya</span>
        </div>
        <section class="p-2 table-responsive">

            <table id="" class="table table-head-fixed  table-hover" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Laporan</th>
                        <th>Kategori Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data pengaduan dari database tabel pengaduan
            $data_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan WHERE nik='$nik'");

            // melakukan perulangan --- menampilkan data pengaduan
            while($pengaduan = mysqli_fetch_array($data_pengaduan)){
                // mengubah data kedalam variable
                $id_lap = $pengaduan['id_pengaduan'];
                $tgl_lap = $pengaduan['tgl_pengaduan'];
                $judul_lap = $pengaduan['judul'];
                $kategori_lap = $pengaduan['kategori'];
                $nik_pel = $pengaduan['nik'];
                $stts_lap = $pengaduan['status'];
                $isi_lap = $pengaduan['isi_laporan'];
                $gamb_lap = $pengaduan['foto'];

                //menampilkan data kedalam tabel html pada tag <tr></tr>
            ?>
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td width="20"><?php echo $i++ ?></td>
                        <td><?php echo $tgl_lap;?></td>
                        <td><?php echo $kategori_lap;?></td>
                        <td><?php echo $judul_lap;?></td>
                        <td>
                            <?php 
                    if($stts_lap == "0"){
                    ?>
                            <span class="badge bg-secondary">
                                <i class="fa fa-ellipsis"></i> Menunggu
                            </span>

                            <?php
                    }elseif($stts_lap == "proses"){
                    ?>
                            <span class="badge bg-primary">
                                <i class="fa fa-rotate"></i> Proses
                            </span>

                            <?php
                    }elseif($stts_lap == "selesai"){
                        ?>
                            <span class="badge bg-success">
                                <i class="fa fa-check"></i> Selesai
                            </span>

                            <?php
                        }
                    
                    ?>
                        </td>
                    </tr>
                    <tr class="expandable-body">
                        <td colspan="5">
                            <div class="d-grid p-3">
                                <div class="d-grid">
                                    <span class="text-uppercase"><b>ID Laporan : </b><?php echo md5($id_lap) ?></span>
                                    <span><b>Pembaruan : </b><?php echo $tgl_lap ?></span>
                                </div>
                                <hr>
                                <div class="d-grid d-md-flex justify-content-between align-items-start gap-3 mb-3">
                                    <div class="col-12 col-md-7 d-grid p-2">
                                        <label>Laporan</label>
                                        <p class="text-justify"><?php echo $isi_lap?></p>
                                    </div>
                                    <div class="col-12 col-md-5 d-grid p-2">
                                        <label>Foto Pendukung</label>
                                        <img src="admin/assets/img/pengaduan/<?php echo $gamb_lap?>" alt=""
                                            height="200">
                                    </div>
                                </div>
                                <?php
                                if($stts_lap == "selesai"){
            
                                    // jika statusnya sudah selesai, maka tampilkan field tanggapan
                                    // mengambil data dari database sesuai idLpr
                                    $ambilTanggapan = mysqli_query($koneksi, "SELECT * FROM tanggapan WHERE id_pengaduan='$id_lap'");
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
                                <hr>
                                <div class="d-grid p-2 mb-3">
                                    <span>Ditanggapi oleh : <b><?php echo $nmPet?></b> Pada tanggal :
                                        <b><?php echo $tglTanggapan?></b></span>
                                    <label>Tanggapan</label>
                                    <p class="text-justify"><?php echo $isiTanggapan?></p>
                                </div>
                                <div class="d-flex justify-content-start align-items-center gap-3 p-2">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus<?php echo $id_lap;?>">
                                        <i class="fa fa-trash me-1"></i>Hapus
                                    </a>
                                </div>
                                <!-- DIALOG UNTUK HAPUS PENGADUAN  -->
                                <div class="modal fade" id="hapus<?php echo $id_lap?>">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <form action="" method="POST">
                                                    <h1 class="text-danger">
                                                        <i class="fa fa-circle-question"></i>
                                                    </h1>
                                                    <span class="fs-4 lh-1">Hapus Laporan
                                                        <b><?php echo $judul_lap;?></b>?
                                                    </span>
                                                    <input type="text" name="hapus" value="<?php echo $id_lap;?>"
                                                        hidden="hidden">
                                                    <br><br>
                                                    <button class="btn  btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>



                    <?php } ?>
                </tbody>
            </table>
        </section>
    </div>

</section>

<?php
include 'footer.php';

?>

<script>
$(function() {
    $("#tabelData").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["excel", "pdf", "print", "csv", "copy", "colvis"]
    }).buttons().container().appendTo('#tabelData_wrapper .col-md-6:eq(0)');
});
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
        ?>
<script>
location.replace("pengaduan");
</script>
<?php
    }
}

?>