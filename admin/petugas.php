<?php
$title = "Data Admin dan Petugas - ";
include "header.php";
include "sidebar.php";

if($level == "petugas"){
    echo "<script>location.replace('index')</script>";
}
?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=masterdata]").parent().addClass("menu-open");
$("a[href=masterdata]").addClass("active");
$("a[href=petugas]").addClass("active");
</script>
<div class="p-4">
    <section class="">
        <div class="text-left d-flex justify-content-end gap-3">
            <button id="tambahPengguna" class="btn btn-sm btn-outline-dark rounded border border-1 " data-toggle="modal"
                data-target="#tambah">
                <i class="fa fa-user-plus me-2"></i>Tambah Petugas
            </button>
        </div>
    </section>
    <br>
    <section class="p-0">
        <table id="tabelPetugas" class="table table-hover table-striped" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No. Telp.</th>
                    <th>Level</th>
                    <th class="not-print">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // memulai nomor dari 1
            $i = 1;
            // mengambil data petugas dari database tabel petugas
            $data_petugas = mysqli_query($koneksi, "SELECT * FROM petugas");

            // melakukan perulangan --- menampilkan data petugas
            while($rdata_petugas = mysqli_fetch_array($data_petugas)){
                // mengubah data kedalam variable
                $id_pet = $rdata_petugas['id_petugas'];
                $nama_pet = $rdata_petugas['nama_petugas'];
                $username_pet = $rdata_petugas['username'];
                $password_pet = $rdata_petugas['password'];
                $level_pet = $rdata_petugas['level'];
                $telp_pet = $rdata_petugas['telp'];

                //menampilkan data kedalam tabel html pada tag <tr></tr>
            ?>
                <tr>
                    <td width="20"><?php echo $i++ ?></td>
                    <td><?php echo $nama_pet;?></td>
                    <td><?php echo $username_pet;?></td>
                    <td><?php echo $telp_pet;?></td>
                    <td>
                        <?php 
                        if($level_pet == "admin"){
                            echo "Administrator";
                        }elseif($level_pet == "petugas"){
                            echo "Petugas Umum";
                        }
                        ?>
                    </td>
                    <td class="not-print">
                        <!-- <a href="javascript:void(0)" class="badge badge-primary" data-toggle="modal"
                            data-target="#edit<?php echo $id_pet;?>">
                            <i class="fa fa-user-pen me-1"></i>Edit
                        </a> -->
                        <?php
                    // melindungi data agar tidak bisa menghapus data sendiri jika id petugasnya sama dengan id login
                    if($id_pet != $id_petugas){
                        ?>

                        <a href="javascript:void(0)" class="badge badge-danger" data-toggle="modal"
                            data-target="#hapus<?php echo $id_pet;?>">
                            <i class="fa fa-trash me-1"></i>Hapus
                        </a>


                        <?php } ?>
                    </td>
                </tr>

                <!-- DIALOG UNTUK EDIT DATA  -->
                <div class="modal fade" id="edit<?php echo $id_pet;?>">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-body ">
                                <h3 class="text-capitalize">Edit Data <?php echo $nama_pet ?></h3>
                                <hr>
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="nama" id="" value="<?php echo $nama_pet ?>"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" id="" value="<?php echo $username_pet ?>"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="psw" id="" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="edit" disabled>Simpan</button>
                                    <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- DIALOG UNTUK HAPUS PETUGAS  -->
                <div class="modal fade" id="hapus<?php echo $id_pet;?>">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <form action="" method="POST">
                                    <h1 class="text-danger">
                                        <i class="fa fa-circle-question"></i>
                                    </h1>
                                    <h5>Hapus Petugas atas nama <b><?php echo $nama_pet;?></b> ?</h5>
                                    <input type="text" name="hapus" value="<?php echo $id_pet;?>" hidden="hidden">
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
</div>


<!-- DIALOG UNTUK EDIT DATA  -->
<div class="modal fade" id="tambah">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-body ">
                <h3 class="">Tambah Petugas</h3>
                <hr>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" id="" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="number" name="tlp" id="" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select name="level" id="" class="form-control form-select select2bs4">
                            <option value="admin">Administrator</option>
                            <option value="petugas">Petugas Umum</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" id="" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="psw" id="" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    <button class="btn  btn-secondary" data-dismiss="modal">Batal</button>

                </form>

            </div>
        </div>
    </div>
</div>



<?php
include "footer.php";
?>

<script>
$(function() {
    $("#tabelPetugas").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#tabelPetugas_wrapper .col-md-6:eq(0)');
});
</script>


<?php
// kode untuk menambahkan data petugas
if(isset($_POST['tambah'])){
    $nama_ptgs = $_POST['nama'];
    $notelp = $_POST['tlp'];
    $lev = $_POST['level'];
    $uname = $_POST['username'];
    // $passs = $_POST['psw'];
    $paswd = md5($_POST['psw']);

    $tambahPetugas = mysqli_query($koneksi, "INSERT INTO petugas(nama_petugas,username,password,telp,level) VALUES ('$nama_ptgs','$uname','$paswd','$notelp','$lev')");

    if($tambahPetugas == TRUE){
        echo "<script>toastr.success('Petugas Berhasil ditambahkan');
                
                setInterval(function() {
                    location.replace('petugas');
                }, 1000);</script>";
    }else{
        echo "<script>toastr.error('Gagal menambahkan petugas');</script>";
    }
}
?>

<?php
// kode php untuk hapus petugas
if(isset($_POST['hapus'])){
    $idh = $_POST['hapus'];

    $hapusPtgs = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$idh'");

    if($hapusPtgs == TRUE){
        echo "<script>toastr.success('Petugas Berhasil dihapus');
                
        setInterval(function() {
            location.replace('petugas');
        }, 1000);</script>";
    }else{
    echo "<script>toastr.error('Gagal menghapus petugas');</script>";
    }
}

?>