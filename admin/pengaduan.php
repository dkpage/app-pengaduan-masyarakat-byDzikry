<?php
$title = "Data Pengaduan - ";
include "header.php";
include "sidebar.php";


?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=masterdata]").parent().addClass("menu-open");
$("a[href=masterdata]").addClass("active");
$("a[href=pengaduan]").addClass("active");
</script>

<section class="p-4">
    <table id="tabelPengaduan" class="table table-striped table-hover" style="width:100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Tanggal Laporan</th>
                <th>Kategori Laporan</th>
                <th>Judul Laporan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data pengaduan dari database tabel pengaduan
            $data_pengaduan = mysqli_query($koneksi, "SELECT * FROM pengaduan");

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
            <tr>
                <td width="20"><?php echo $i++ ?></td>
                <?php

                // mendapatkan nama pelapor berdasarkan nik
                $data_pelapor = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE nik='$nik_pel'");
                // cek apakah akun pengguna masih ada atau tidak
                if(mysqli_num_rows($data_pelapor) > 0){
                    $ardatapelapor = mysqli_fetch_array($data_pelapor);
                    $nama_pel = $ardatapelapor['nama'];
                }else{
                    $nama_pel = "Akun Terhapus";
                }
                
                ?>
                <td><?php echo $nama_pel;?></td>
                <td><?php echo $tgl_lap;?></td>
                <td><?php echo $kategori_lap;?></td>
                <td><?php echo $judul_lap;?></td>
                <td>
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
                <td class="">
                    <a href="detail-laporan?dl=<?php echo md5($id_lap);?>" class="badge badge-primary">
                        <i class="fa fa-eye me-1"></i>Lihat
                    </a>

                    <!-- <a href="javascript:void(0)" class="badge badge-danger" data-toggle="modal"
                        data-target="#hapus<?php // echo $id_lap;?>">
                        <i class="fa fa-trash me-1"></i>Hapus
                    </a> -->


                </td>
            </tr>
            <!-- DIALOG UNTUK HAPUS PENGADUAN  -->
            <div class="modal fade" id="hapus<?php echo $id_lap;?>">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form action="" method="POST">
                                <h1 class="text-danger">
                                    <i class="fa fa-circle-question"></i>
                                </h1>
                                <h5>Hapus Laporan <b><?php echo $judul_lap;?></b> dari
                                    <b><?php echo $nama_pel;?></b> ?
                                </h5>
                                <input type="text" name="hapus" value="<?php echo $id_lap;?>" hidden="hidden">
                                <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php
include "footer.php";
?>

<script>
$(function() {
    $("#tabelPengaduan").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        <?php if($level == "admin"){ ?> "buttons": ["excel", "pdf", "print"]
        <?php } ?>
    }).buttons().container().appendTo('#tabelPengaduan_wrapper .col-md-6:eq(0)');
});
</script>