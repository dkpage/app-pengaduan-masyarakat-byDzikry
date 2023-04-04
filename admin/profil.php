<?php
$title = "Profil - ";
include "header.php";
include "sidebar.php";
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

@media screen and (max-width:685px) {
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
<section class="p-4 border border-1 rounded-1">
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="d-grid d-md-flex justify-content-between align-items-start gap-4">

            <div class="d-grid flex-fill border border-2 rounded-1 p-3 " id="form-left">
                <div id="foto-profil" style="background-image:url('assets/img/petugas/<?php echo $foto_petugas?>');">
                </div>
                <!-- <img src="assets/img/foto-petugas/<?php echo $foto_petugas?>" alt="" class=" form-control border-1"> -->
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
                    <input type="text" name="nama" id="" value="<?php echo $nama_petugas?>" class="form-control"
                        disabled="disabled">
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
        $namaFbaru = "PTGS-SIPELAPMAS-".round(microtime(true)) .'.' . end($x);

        $fotoPath = "assets/img/petugas/".$namaFbaru;

         // Untuk menyimpan foto
         $uploadfoto = move_uploaded_file($tmpFoto, $fotoPath);

         if($uploadfoto == TRUE){
            // menghapus foto asal di server jika sebelumnya pernah mengganti foto profil
            if($foto_petugas != "default.jpg"){
                unlink("assets/img/petugas/$foto_petugas");
            }

            // simpan data ke database dengan foto
            $editData = mysqli_query($koneksi, "UPDATE petugas  SET nama_petugas='$namaBaru', username='$uName', telp='$tlpBaru', password='$pasBaru', foto='$namaFbaru' WHERE id_petugas='$id_petugas'");

            // jika berhasil update data dengan foto
            if($editData == TRUE){
                echo "<script>toastr.success('Update profil berhasil');
                
                setInterval(function() {
                    location.replace('profil');
                }, 1000);</script>";
            }else{
                // jika gagal update data dengan foto
                echo "<script>toastr.error('Gagal menambahkan ke database');</script>";
            }
         }else{
            // jika gagal upload foto
            echo "<script>toastr.error('Gagal upload foto ke server');</script>";
         }
    }else{
        // jika foto tidak di ubah
        // simpan data ke database tanpa foto
        $editData = mysqli_query($koneksi, "UPDATE petugas  SET nama_petugas='$namaBaru', username='$uName', telp='$tlpBaru', password='$pasBaru' WHERE id_petugas='$id_petugas'");

        // jika berhasil update data tanpa foto
        if($editData == TRUE){
            echo "<script>toastr.success('Update profil berhasil');
                
            setInterval(function() {
                location.replace('profil');
            }, 1000);</script>";
        }else{
            // jika gagal update data tanpa foto
            echo "<script>toastr.error('Gagal menambahkan ke database');</script>";
        }
    }
}

?>