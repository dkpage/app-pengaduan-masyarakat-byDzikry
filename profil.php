<?php
$title = "Profil - ";
include "header.php";
include "menu.php";
?>
<style>
#form-left {
    width: 120px;
}

#form-left img {
    height: 200px !important;
    width: auto;
}

#form-right {
    width: 70%;
}

@media screen and (max-width:576px) {
    #form-left {
        width: 100%;
    }

    #form-right {
        width: 100%;
    }

    #foto-profil {
        height: 300px;
    }
}


#foto-profil {
    height: 200px;
    width: 100%;
    background-position: top center;
    background-size: cover;
}
</style>

<section class="p-4  content container">
    <div class="text-left">
        <h3 class="h3 fw-bold mb-3 rubik">PROFIL</h3>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="d-grid d-md-flex justify-content-between align-items-start gap-4">

            <div class="d-grid flex-fill border border-2 rounded-1 p-3 " id="form-left">
                <div id="foto-profil"
                    style="background-image:url('admin/assets/img/masyarakat/<?php echo $fotoUser?>');">
                </div>

                <br>

                <a href="javascript:void(0)" id="tbEdit" class="btn btn-sm btn-primary mt-2">
                    <i class="fa fa-user-pen"></i> Edit
                </a>
                <button type="submit" name="edit" class="btn btn-sm btn-success mt-2 d-none" id="tbSimpan">
                    <i class="fa fa-check"></i> Simpan
                </button>
                <a href="javascript:void(0)" id="tbBatal" class="btn btn-sm btn-secondary mt-2 d-none">
                    <i class="fa fa-xmark"></i> Batal
                </a>

            </div>
            <div class="d-grid flex-fill p-2" id="form-right">

                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama" id="" value="<?php echo $nama?>" class="form-control"
                        disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="">NIK <small><i>Tidak dapat diubah</i></small></label>
                    <input type="number" name="nik" id="" value="<?php echo $nik?>" class="form-control"
                        disabled="disabled" readonly="readonly">
                </div>
                <div class="form-group">
                    <label for="">No. Telp</label>
                    <input type="number" name="notelp" id="" value="<?php echo $telp?>" class="form-control"
                        disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="" value="<?php echo $username?>" class="form-control"
                        disabled="disabled">
                </div>
                <div class="form-group">
                    <label for="">Password <small><i>Kosongkan jika tidak diubah</i></small></label>
                    <input type="text" name="pswd" id="" value="" class="form-control" disabled="disabled">
                    <input type="text" class="d-none" name="pwdlama" id="" value="<?php echo $password?>">
                </div>
                <div class="form-group">
                    <label for="">Ubah Foto</label>
                    <input type="file" name="foto" id="" class="form-control"
                        accept="image/png, image/jpeg, image/jpg, image/svg" disabled="disabled">
                </div>

            </div>

        </div>
    </form>
</section>


<!-- DIALOG KONFIRMASI BERHASIL TERKIRIM  -->
<div class="modal fade" id="sukses" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <span class="h1 text-success" style="font-size:72pt;">
                    <i class="fa-regular fa-circle-check"></i>
                </span>
                <br>
                <br>
                <span>Profil berhasil diperbarui</span>
            </div>
        </div>
    </div>
</div>



<script>
// ketika di klik tombol edit
$("#tbEdit").on("click", function() {
    // tombol simpan dan batal dimunculkan dengan menghapus class d-none
    $("#tbSimpan, #tbBatal").removeClass("d-none");
    // tombol edit disembunyikan dengan menambahkan class d-none
    $("#tbEdit").addClass("d-none");
    // tag input dihapus atribut disabled nya agar bisa di edit
    $("input").removeAttr("disabled");
})

// ketika tombol batal di klik
$("#tbBatal").on("click", function() {
    // tombol simpan dan batal di sembunyikan dengan menambahkan class d-none
    $("#tbSimpan, #tbBatal").addClass("d-none");
    // tombol edit ditampilkan lagi dengan menghapus class d-none
    $("#tbEdit").removeClass("d-none");
    // semua input kembali ditambahkan atribut disabled="disabled"
    $("input").attr("disabled", "disabled");
})
</script>



<?php
include "footer.php";
?>


<?php

if(isset($_POST['edit'])){
    $namaBaru = $_POST['nama'];
    $tlpBaru = $_POST['notelp'];
    $uName = $_POST['username'];
    // $nikBaru = $_POST['nik'];

    if($_POST['pswd'] != ""){
        $pasBaru = md5($_POST['pswd']);
    }else{
        $pasBaru = $_POST['pwdlama'];
    }

    if($_FILES['foto']['name'] != ""){
        $namaFoto = $_FILES['foto']['name'];
        $ukuranFoto = $_FILES['foto']['size'];
        $tipeFoto = $_FILES['foto']['type'];
        $tmpFoto = $_FILES['foto']['tmp_name'];

        $foto = $namaFoto;

        $x = explode(".", $foto);
        $namaFbaru = "USER-SIPELAPMAS-".round(microtime(true)) .'.' . end($x);

        $fotoPath = "admin/assets/img/masyarakat/".$namaFbaru;

         // Untuk menyimpan foto
         $uploadfoto = move_uploaded_file($tmpFoto, $fotoPath);

         if($uploadfoto == TRUE){
            // menghapus foto asal di server jika sebelumnya pernah mengganti foto profil
            if($fotoUser != "default.png"){
                unlink("admin/assets/img/masyarakat/$fotoUser");
            }

            // simpan data ke database dengan foto
            $editData = mysqli_query($koneksi, "UPDATE masyarakat  SET nama='$namaBaru',  username='$uName', telp='$tlpBaru', password='$pasBaru', foto='$namaFbaru' WHERE id='$id'");

            // jika berhasil update data dengan foto
            if($editData == TRUE){

                ?>
<script>
$(document).ready(function() {
    $('#sukses').modal('show');
    setInterval(function() {
        location.replace("profil");
    }, 1000);
})
</script>
<?php
            }else{
                // jika gagal update data dengan foto
                echo "<script>alert('Gagal mengubah data, errorCode 1')</script>";
            }
         }else{
            // jika gagal upload foto
            // echo "<script>alert('Gagal upload foto ke server, errorCode 2')</script>";
         }
    }else{
        // jika foto tidak di ubah
        // simpan data ke database tanpa foto
        $editData = mysqli_query($koneksi, "UPDATE masyarakat  SET nama='$namaBaru', username='$uName', telp='$tlpBaru', password='$pasBaru' WHERE id='$id'");

        // jika berhasil update data tanpa foto
        if($editData == TRUE){
            ?>
<script>
$(document).ready(function() {
    $('#sukses').modal('show');
    setInterval(function() {
        location.replace("profil");
    }, 1000);
})
</script>
<?php
        }else{
            // jika gagal update data tanpa foto
            echo "<script>alert('Gagal mengubah data, errorCode 3')</script>";
        }
    }
}

?>