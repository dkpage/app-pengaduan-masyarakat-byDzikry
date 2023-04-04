<?php

$title = "Pengaturan - ";
include "header.php";
include "sidebar.php";

if($level != "admin"){
    echo "<script>location.replace('dashboard')</script>";
}


?>

<style>
/* CUSTOM CSS IN PAGE  */
ul,
li {
    list-style-type: none;
}

.nav-link .fa-caret-up,
.nav-link.active .fa-caret-down {
    display: none;
}

.nav-link.active .fa-caret-up,
.nav-link .fa-caret-down {
    display: inline;
}
</style>
<script>
// mengaktifkan menu pada sidebar
$("a[href=pengaturan]").addClass("active");
</script>

<div class="p-4">
    <section class="d-grid">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="aplikasi-tab" data-toggle="pill" href="#aplikasi" role="tab"
                    aria-controls="aplikasi" aria-selected="true">Aplikasi
                    <i class="fa fa-caret-down"></i>
                    <i class="fa fa-caret-up"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="instansi-tab" data-toggle="pill" href="#instansi" role="tab"
                    aria-controls="instansi" aria-selected="false">Instansi
                    <i class="fa fa-caret-down"></i>
                    <i class="fa fa-caret-up"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kategori-tab" data-toggle="pill" href="#kategori" role="tab"
                    aria-controls="kategori" aria-selected="false">Kategori
                    <i class="fa fa-caret-down"></i>
                    <i class="fa fa-caret-up"></i>
                </a>
            </li>

        </ul>
        <br>
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade show active" id="aplikasi" role="tabpanel" aria-labelledby="aplikasi-tab">
                <!-- PENGATURAN APLIKASI  -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-end">
                        <a href="javascript:" class="btn btn-primary btn-sm" id="editApp">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <div id="btnEditApp" class="d-none">
                            <a href="javascript:" id="cancEditApp" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-close"></i> Batal</a>
                            <button name="sApp" type="submit" class="btn btn-primary btn-sm" id="saveApp">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Nama Aplikasi</label>
                        <input type="text" name="namaApp" class="form-control" value="<?php echo $nama_aplikasi?>"
                            form-edit="aplikasi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Singkatan</label>
                        <input type="text" name="singkat" class="form-control" value="<?php echo $singkatanAplikasi?>"
                            form-edit="aplikasi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Versi Aplikasi</label>
                        <input type="text" name="versi" class="form-control" value="<?php echo $versi_aplikasi?>"
                            form-edit="aplikasi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Logo Aplikasi</label><br>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline me-3">
                                <input type="radio" id="rApplogo" name="radlogo" value="0" form-edit="aplikasi"
                                    disabled="disabled">
                                <label for="rApplogo"> Gunakan Logo Khusus
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="rInslogo" name="radlogo" value="1" form-edit="aplikasi"
                                    disabled="disabled">
                                <label for="rInslogo"> Gunakan Logo Instansi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="lgCustom d-none" id="lgCustom">
                        <span>Logo saat ini</span>
                        <div class="d-grid d-md-flex justify-content-start align-items-start gap-3 mb-3">
                            <div class="d-grid">

                                <img src="assets/img/<?php echo $cust_logo_aplikasi?>" alt="" height="40">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Ubah Logo Aplikasi</label>
                            <input type="file" name="logoApp" accept="image/png, image/jpeg, image/jpg, image/svg"
                                class="form-control" value="" form-edit="aplikasi" disabled="disabled">
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="instansi" role="tabpanel" aria-labelledby="instansi-tab">
                <!-- PENGATURAN INSTANSI  -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-end">
                        <a href="javascript:" class="btn btn-primary btn-sm" id="editIns">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <div id="btnEditIns" class="d-none">
                            <a href="javascript:" id="cancEditIns" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-close"></i> Batal</a>
                            <button name="sInstansi" type="submit" class="btn btn-primary btn-sm" id="saveIns">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Nama Instansi</label>
                        <input type="text" name="namaInstansi" class="form-control" value="<?php echo $nama_instansi?>"
                            form-edit="instansi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat Instansi</label>
                        <input type="text" name="alamatInstansi" class="form-control"
                            value="<?php echo $alamat_instansi?>" form-edit="instansi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">No. Telepon Instansi</label>
                        <input type="number" name="noTelpInstansi" class="form-control"
                            value="<?php echo $telp_instansi?>" form-edit="instansi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">e-Mail Instansi</label>
                        <input type="email" name="emailInstansi" class="form-control"
                            value="<?php echo $email_instansi?>" form-edit="instansi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Website Instansi</label>
                        <input type="url" name="webInstansi" class="form-control" value="<?php echo $web_instansi?>"
                            form-edit="instansi" disabled="disabled">
                    </div>
                    <div class="form-group">
                        <label for="">Logo Instansi</label><br>
                        <img src="assets/img/<?php echo $logo_instansi?>" alt="" height="60">
                    </div>
                    <div class="form-group">
                        <label for="">Ubah Logo</label>
                        <input type="file" name="logoIns" accept="image/png" class="form-control" value=""
                            form-edit="instansi" disabled="disabled">
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
                <!-- PENGATURAN KATEGORI  -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="text-end">
                        <a href="javascript:" class="btn btn-primary btn-sm" id="editKat">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <div id="btnEditKat" class="d-none">
                            <a href="javascript:" id="cancEditKat" class="btn btn-secondary btn-sm"><i
                                    class="fa fa-close"></i> Batal</a>
                            <button type="submit" name="sKategori" class="btn btn-primary btn-sm" id="saveKat">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>

                    </div>
                    <label for="">Kategori Laporan</label>
                    <div class="form-group d-grid" id="kategori-list">
                        <?php
                        // menampilkan kategori yang sudah ada
                        while($kategori = mysqli_fetch_array($dataKategori)){
                        ?>

                        <div class="d-flex justify-content-between align-items-center gap-3 kategori-field">
                            <input type="text" name="kategori[]" class="form-control mb-1 inputKat"
                                value="<?php echo $kategori['kategori']?>" form-edit="kategori" disabled="disabled">
                            <a href="javascript:void(0)" class="btn btn-light border mb-1 hapusKat"
                                style="pointer-events:none;">
                                <i class="fa fa-xmark"></i>
                            </a>
                        </div>
                        <?php } ?>

                    </div>
                    <div class="d-none" id="field-new">
                        <div class="d-flex justify-content-between align-items-center gap-3  kat-tambahan"
                            id="input-kategori">
                            <input type="text" name="kategori[]" class="form-control mb-1 inputKat" value=""
                                form-edit="kategori" placeholder="Tulis kategori...">
                            <a href="javascript:void(0)" class="btn btn-light border mb-1 hapusKat">
                                <i class="fa fa-xmark"></i>
                            </a>
                        </div>
                    </div>
                    <a href="javascript:" id="tbhKategori" class="btn btn-light btn-sm border mt-1"
                        style="pointer-events:none;">
                        <i class="fa fa-plus"></i> Tambah Kategori
                    </a>

                </form>
            </div>
        </div>
    </section>
</div>

<script>
// untuk bisa mengedit form edit aplikasi
$("#editApp").on("click", function() {
    $("[form-edit=aplikasi]").removeAttr("disabled", "disabled");
    $("#editApp").addClass("d-none");
    $("#btnEditApp").removeClass("d-none");
})
// mengunci formulir edit aplikasi
$("#cancEditApp").on("click", function() {
    $("[form-edit=aplikasi]").attr("disabled", "disabled");
    $("#editApp").removeClass("d-none");
    $("#btnEditApp").addClass("d-none");
})

// membuka edit instansi
$("#editIns").on("click", function() {
    $("[form-edit=instansi]").removeAttr("disabled", "disabled");
    $("#editIns").addClass("d-none");
    $("#btnEditIns").removeClass("d-none");
})
// mengunci formulir edit instansi
$("#cancEditIns").on("click", function() {
    $("[form-edit=instansi]").attr("disabled", "disabled");
    $("#editIns").removeClass("d-none");
    $("#btnEditIns").addClass("d-none");

})

// membuka edit kategori
$("#editKat").on("click", function() {
    $("[form-edit=kategori]").removeAttr("disabled", "disabled");
    $("#tbhKategori").removeAttr("style");
    $(".hapusKat").removeAttr("style");
    $("#editKat").addClass("d-none");
    $("#btnEditKat").removeClass("d-none");
    $(".kat-tambahan").removeClass("d-none").addClass("d-flex");
})
// mengunci formulir edit kategori
$("#cancEditKat").on("click", function() {
    $("[form-edit=kategori]").attr("disabled", "disabled");
    $("#tbhKategori").attr("style", "pointer-events:none;");
    $(".hapusKat").attr("style", "pointer-events:none;");
    $("#editKat").removeClass("d-none");
    $("#btnEditKat").addClass("d-none");
    $(".kat-tambahan").addClass("d-none").removeClass("d-flex");
})
</script>


<script>
var inKategori = document.querySelector("#field-new").innerHTML;

// menambahkan kategori
$("#tbhKategori").on("click", function() {
    $(inKategori).clone().appendTo("#kategori-list");

})

// menghapus kategori
$("#kategori-list").on("click", ".hapusKat", function() {
    $(this).parent().remove();
})
</script>


<script>
// menampilkan logo custom
var rAppLogo = document.getElementById("rAppLogo");
$("#rApplogo").on("click", function() {
    $("#rInslogo").prop("checked", false);
    $("#rApplogo").prop("checked", true)
    $("#lgCustom").removeClass("d-none");
})
$("#rInslogo").on("click", function() {
    $("#rApplogo").prop("checked", false);
    $("#rInslogo").prop("checked", true);
    $("#lgCustom").addClass("d-none");
})
</script>


<?php

include "footer.php";

?>


<?php
// kode mengubah data aplikasi
if(isset($_POST['sApp'])){
    // menangkat data dari form
    $namaApp = $_POST['namaApp'];
    $nickApp = $_POST['singkat'];
    $versiApp = $_POST['versi'];
    $logoApp = $_POST['radlogo'];
    $logoFile = $_FILES['logoApp']['name'];
    
    // jika ada logo yang di upload
    if(!empty($logoFile)){
        $namaLogo = $_FILES['logoApp']['name'];
        $tmpLogo = $_FILES['logoApp']['tmp_name'];

        $x = explode(".",$namaLogo);
        // mengubah nama gambar
        $namaLogoBaru = $nickApp.round(microtime(true)).".".end($x);
        $logoPath = "assets/img/".$namaLogoBaru;
        // menyimpan logo ke server
        $uploadLogo = move_uploaded_file($tmpLogo, $logoPath);
        // jika logo sudah di upload
        if($uploadLogo == TRUE){
            // meghapus logo yang sudah ada
            unlink("assets/img/$cust_logo_aplikasi");
            // menyimpan ke database
            $updateApp = mysqli_query($koneksi, "UPDATE aplikasi SET nama_app='$namaApp', singkatan='$nickApp', versi='$versiApp', logo='$logoApp', logo_custom='$namaLogoBaru'");

            if($updateApp == TRUE){
                echo "<script>toastr.success('Data Aplikasi Berhasil diubah');
                
                setInterval(function() {
                    location.replace('pengaturan');
                }, 1000);</script>";
            }else{
                echo "<script>toastr.error('Data Aplikasi Gagal diubah');</script>";
            }
        }
    }else{
        // menyimpan ke database tanpa logo
        $updateApp = mysqli_query($koneksi, "UPDATE aplikasi SET nama_app='$namaApp', singkatan='$nickApp', versi='$versiApp', logo='$logoApp'");

        if($updateApp == TRUE){
            echo "<script>toastr.success('Data Aplikasi Berhasil diubah');
            
            setInterval(function() {
                location.replace('pengaturan');
            }, 1000);</script>";
        }else{
            echo "<script>toastr.error('Data Aplikasi Gagal diubah');</script>";
        }
    }
}

// kode mengubah data instansi
if(isset($_POST['sInstansi'])){
    $namaInst = $_POST['namaInstansi'];
    $alamatInst = $_POST['alamatInstansi'];
    $noTelpInst = $_POST['noTelpInstansi'];
    $emailInst = $_POST['emailInstansi'];
    $webInst = $_POST['webInstansi'];

    if(!empty($_FILES['logoIns']['name'])){
        $namaLogo = $_FILES['logoIns']['name'];
        $tmpLogo = $_FILES['logoIns']['tmp_name'];

        $x = explode(".",$namaLogo);
        // mengubah nama gambar
        $namaLogoBaru = $namaInst.round(microtime(true)).".".end($x);
        $logoPath = "assets/img/".$namaLogoBaru;
        // menyimpan logo ke server
        $uploadLogo = move_uploaded_file($tmpLogo, $logoPath);

        if($uploadLogo == TRUE){
            // meghapus logo yang sudah ada
            unlink("assets/img/$logo_instansi");
            // menyimpan ke database dengan logo
            $updateIns = mysqli_query($koneksi, "UPDATE instansi SET nama_instansi='$namaInst', alamat='$alamatInst', no_telp='$noTelpInst', email='$emailInst', website='$webInst', logo_instansi='$namaLogoBaru'");

            if($updateIns == TRUE){
                echo "<script>toastr.success('Data Instansi Berhasil diubah');
                
                setInterval(function() {
                    location.replace('pengaturan');
                }, 1000);</script>";
            }else{
                echo "<script>toastr.error('Data Instansi Gagal diubah');</script>";
            }
        }
    }else{
        // menyimpan ke database tanpa logo
        $updateIns = mysqli_query($koneksi, "UPDATE instansi SET nama_instansi='$namaInst', alamat='$alamatInst', no_telp='$noTelpInst', email='$emailInst', website='$webInst'");

        if($updateIns == TRUE){
            echo "<script>toastr.success('Data Instansi Berhasil diubah');
            
            setInterval(function() {
                location.replace('pengaturan');
            }, 1000);</script>";
        }else{
            echo "<script>toastr.error('Data Instansi Gagal diubah');</script>";
        }
    }

}

// menambahkan kategori laporan, tapi dengan cara menghapus terlebih dahulu semua data kategori laporan
if(isset($_POST['sKategori'])){

    $kategori = $_POST['kategori'];
    // kode menghapus kategori
    $hapusSemuaKategori = mysqli_query($koneksi, "DELETE FROM kategori");
    if($hapusSemuaKategori == TRUE){
    // kode menambahkan kategori
    // melakukan perulangan fungsi sesuai dengan jumlah data yang diterima
    for($a = 0; $a < count($kategori)-1; $a++){
        $dKategori = $kategori[$a];
        $simpanKategori  = mysqli_query($koneksi, "INSERT INTO kategori(kategori) VALUES('$dKategori')");

        if($simpanKategori ==  TRUE){
            echo "<script>toastr.success('Kategori $dKategori berhasil disimpan');
                
            setInterval(function() {
                location.replace('pengaturan');
            }, 1000);</script>";
        }else{
            echo "<script>toastr.error('Kategori $dKategori gagal disimpan');</script>";
        }
    }
    }
    


}


?>