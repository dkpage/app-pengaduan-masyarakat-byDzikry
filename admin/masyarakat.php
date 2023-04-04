<?php
$title = "Data Masyarakat - ";
include "header.php";
include "sidebar.php";
?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=masterdata]").parent().addClass("menu-open");
$("a[href=masterdata]").addClass("active");
$("a[href=masyarakat]").addClass("active");
</script>
<!-- <section class="">
    <div class="text-left d-flex justify-content-end gap-3">
        <button id="tambahPengguna" class="btn rounded border border-1 ">
            <i class="fa fa-user-plus me-2"></i>Tambah Data Masyarakat
        </button>
    </div>
</section> -->
<!-- <br> -->
<section class="p-4">
    <table id="tabelMas" class="table table-striped" style="width:100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Username</th>
                <th>Status</th>
                <th class="not-print">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data masyarakat dari database tabel masyarakat
            $data_masyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat");

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
                    $staticon = "fa-circle-check";
                }elseif($status == "nonaktif" || $status == "ditolak"){
                    $statclass = "badge-danger";
                    $staticon = "fa-circle-xmark";
                }elseif($status == "pending"){
                    $statclass = "badge-warning";
                    $staticon = "fa-arrows-rotate";
                }else{
                    $statclass = "";
                    $staticon = "";
                }

                //menampilkan data kedalam tabel html pada tag <tr></tr>
            ?>
            <tr>
                <td width="20"><?php echo $i++ ?></td>
                <td><?php echo $nama_mas;?></td>
                <td><?php echo $nik;?></td>
                <td><?php echo $username;?></td>
                <td class="not-print">
                    <span class="badge <?php echo $statclass ;?>">
                        <i class="fa <?php echo $staticon;?> me-1"></i>
                        <?php echo $status;?></span>
                </td>
                <td class="">
                    <?php 
                    // jika status = pending, maka aksinya adalah verifikasi dan tolak registrasi
                    if($status == "pending"){
                    ?>
                    <a href="javascript:void(0)" id="" class="badge badge-primary" data-toggle="modal"
                        data-target="#verif<?php echo $id_mas;?>">Verifikasi</a>
                    <a href="javascript:void(0)" id="" data-toggle="modal" data-target="#tolak<?php echo $id_mas;?>"
                        class="badge badge-danger">Tolak</a>

                    <?php
                    }else{ 
                    // jika statusnya tidak = pending, maka aksinya edit dan hapus
                    ?>
                    <!-- <a href="#" class="badge badge-primary" data-toggle="modal"
                        data-target="#edit<?php // echo $id_mas;?>">
                        <i class="fa fa-user-pen me-1"></i>Edit
                    </a> -->
                    <a href="#" class="badge badge-danger" data-toggle="modal"
                        data-target="#hapus<?php echo $id_mas;?>">
                        <i class="fa fa-trash me-1"></i>Hapus
                    </a>



                    <?php } ?>
                </td>
            </tr>
            <!-- DIALOG UNTUK EDIT DATA  -->
            <div class="modal fade" id="edit<?php echo $id_mas;?>">
                <div class="modal-dialog ">
                    <div class="modal-content">
                        <div class="modal-body ">
                            <h3 class="text-uppercase">EDIT DATA <?php echo $nama_mas ?></h3>
                            <hr>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama" id="" value="<?php echo $nama_mas ?>"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="number" name="nik" id="" value="<?php echo $nik ?>"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" id="" value="<?php echo $username ?>"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" name="psw" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" id="" class="form-select">
                                        <option value="<?php echo $status ?>"><?php echo $status ?></option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                                <button disabled type="submit" class="btn btn-primary" name="edit">Simpan</button>
                                <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- DIALOG UNTUK HAPUS REGISTRASI  -->
            <div class="modal fade" id="hapus<?php echo $id_mas;?>">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form action="" method="POST">
                                <h1 class="text-danger">
                                    <i class="fa fa-circle-question"></i>
                                </h1>
                                <h5>Hapus Data Masyarakat atas nama <b><?php echo $nama_mas;?></b> ?</h5>
                                <input type="text" name="hapus" value="<?php echo $id_mas;?>" hidden="hidden">
                                <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- DIALOG UNTUK MEMVERIFIKASI  -->
            <div class="modal fade" id="verif<?php echo $id_mas;?>">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form action="" method="POST">
                                <h1 class="text-primary">
                                    <i class="fa fa-circle-question"></i>
                                </h1>
                                <h5>Verifikasi Masyarakat atas nama <b><?php echo $nama_mas;?></b> ?</h5>
                                <input type="text" name="verifikasi" value="<?php echo $id_mas;?>" hidden="hidden">
                                <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Verifikasi</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- DIALOG UNTUK MENOLAK REGISTRASI  -->
            <div class="modal fade" id="tolak<?php echo $id_mas;?>">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <form action="" method="POST">
                                <h1 class="text-danger">
                                    <i class="fa fa-circle-question"></i>
                                </h1>
                                <h5>Tolak Registrasi Masyarakat atas nama <b><?php echo $nama_mas;?></b> ?</h5>
                                <input type="text" name="tolak" value="<?php echo $id_mas;?>" hidden="hidden">
                                <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">Tolak</button>

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
    $("#tabelMas").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        <?php if($level == "admin"){ ?> "buttons": ["excel", "pdf", "print"]
        <?php } ?>
    }).buttons().container().appendTo('#tabelMas_wrapper .col-md-6:eq(0)');

});
</script>

<?php
// memverifikasi masyarakat
if(isset($_POST['verifikasi'])){
    $id_ver = $_POST['verifikasi'];

    $verifikasi = mysqli_query($koneksi, "UPDATE masyarakat SET status='aktif' WHERE id='$id_ver'");
    if($verifikasi == TRUE){
        
        ?>
<script>
Toast.fire({
    icon: 'success',
    title: 'Berhasil Verifikasi Masyarakat yang diminta'
})

setInterval(function() {
    location.replace("masyarakat");
}, 2000);
</script>
<?php
    }
}
?>

<?php

//menghapus data masyarakat
if(isset($_POST['hapus'])){
    $id_hapus = $_POST['hapus'];

    // menghapus foto pengguna dari server jika ada  fotonya
    $lihatData = mysqli_query($koneksi, "SELECT foto FROM masyarakat WHERE id='$id_hapus'");
    $dQuery = mysqli_fetch_array($lihatData);
    $fotQuery = $dQuery['foto'];
    if($fotQuery != ""){
        unlink("assets/img/masyarakat/$fotQuery");
    }

    // hapus dari database
    $hapusdata = mysqli_query($koneksi, "DELETE FROM masyarakat WHERE id='$id_hapus'");
    

    if($hapusdata == TRUE){
        echo "<script>toastr.success('Penghapusan Masyarakat berhasil');
                
        setInterval(function() {
            location.replace('masyarakat');
        }, 1000);</script>";
        }else{
        echo "<script>toastr.error('Gagal menghapus Masyarakat');</script>";
        }
}
?>

<?php

//menolak permintaan registrasi
if(isset($_POST['tolak'])){
    $id_tolak = $_POST['tolak'];

    $tolak = mysqli_query($koneksi, "UPDATE masyarakat SET status='ditolak' WHERE id='$id_tolak'");

    if($tolak == TRUE){
        echo "<script>toastr.success('Permintaan registrasi telah ditolak');
                
        setInterval(function() {
            location.replace('masyarakat');
        }, 1000);</script>";
        }else{
        echo "<script>toastr.error('Gagal menolak registrasi');</script>";
        }
}
?>