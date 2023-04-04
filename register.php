<?php
$title = "Register - ";
include "header.php";
// include "menu.php";
?>



<style>
html,
body {
    background-color: #f2f2f2;
    padding: 20px 50px 20px 50px;
}

@media screen and (max-width:768px) {

    html,
    body {
        padding: 0;
    }

    #banner-form {
        height: 250px;
    }
}
</style>

<section class="d-grid d-md-flex justify-content-between align-items-center shadow bg-white">
    <div class="col-12 col-md-5 p-3 bg-primary  justify-content-center  align-items-center" id="banner-form">
        <div class="text-center">
            <img class="mb-3" src="admin/assets/img/<?php echo $logo_aplikasi?>" alt="" height="80">
            <br>
            <h1 class="h3 mb-3 fw-bold rubik">Daftarkan Akun Anda</h1>
        </div>
    </div>
    <div class="col-12 col-md-7 bg-white" id="form">
        <a href="./" class="float-left">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

        <br><br>
        <!-- ALERT LOGIN  -->
        <!-- Alert jika berhasil register  -->
        <div class="alert alert-success rounded-0 d-none" id="berhasil" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-check"></i>
            <span>Pendaftaran berhasil, silahkan tunggu verifikasi oleh Petugas</span>
        </div>
        <!-- Alert jika nik sudah terdaftar  -->
        <div class="alert alert-warning rounded-0 d-none" id="nikTrdftr" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-triangle-exclamation"></i>
            <span>NIK yang anda masukkan sudah terdaftar, silahkan Login menggunakan akun yang sudah ada!</span>
        </div>
        <!-- Alert jika data gagal disimpan  -->
        <div class="alert alert-danger rounded-0 d-none" id="gagal" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-xmark"></i>
            <span>Ups! ada kesalahan, Pendaftaran gagal, silahkan coba lagi</span>
        </div>
        <!-- ALERT LOGIN END  -->
        <form method="post">

            <div class="form-group mb-2">
                <label for="nik">NIK Anda</label>
                <input type="number" class="form-control rounded-0" id="nik" name="nik">
                <span class="text-danger d-none" id="nikKrg">NIK Harus berjumlah 16 digit</span>
            </div>

            <div class="form-group mb-2">
                <label for="inNama">Nama Lengkap</label>
                <input type="text" class="form-control rounded-0" id="inNama" name="nama">
            </div>

            <div class="form-group mb-2">
                <label for="inUsername">Username</label>
                <input type="text" class="form-control rounded-0" id="inUsername" name="user">
            </div>

            <div class="form-group mb-2">
                <label for="inTelp">No Handphone</label>
                <input type="text" class="form-control rounded-0" id="inTelp" name="telp">
                <span class="text-danger d-none" id="tlpKrg">No. Handphone harus minimal 11 digit dan maksimal 13
                    digit</span>
            </div>
            <label for="">Password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control rounded-0" name="passw" id="f-pass">
                <div class="input-group-append ">
                    <span class="input-group-text rounded-0">
                        <i class="fas fa-eye" id="buka"></i>
                        <i class="fas fa-eye-slash d-none" id="tutup"></i>
                    </span>
                </div>
            </div>
            <!-- <div class="form-group mb-4">
                <label for="inPassword">Kata Sandi</label>
                <input type="password" class="form-control rounded-0" id="inPassword" name="passw">
            </div> -->
            <button class=" btn  btn-primary mb-3 rounded-0" type="submit" name="daftar">Daftar</button>
            <br>
            <span>Sudah Punya Akun? <b class=""><a href="login">Login Sekarang!</a></b></span>
        </form>
    </div>
</section>


<script>
// menampilkan password
$("#buka").on("click", function() {
    // password ditampilkan dengan mengubah type menjadi text
    $("#f-pass").attr("type", "text");

    // menampilkan icon dengan menghapus class d-none
    $("#tutup").removeClass("d-none");
    // menyembunyikan icon dengan menambahkan class d-none
    $("#buka").addClass("d-none");

})
$("#tutup").on("click", function() {
    // password disembunyikan dengan mengubah type menjadi password
    $("#f-pass").attr("type", "password");

    // menampilkan icon dengan menghapus class d-none
    $("#buka").removeClass("d-none");
    // menyembunyikan icon dengan menambahkan class d-none
    $("#tutup").addClass("d-none");

})
</script>


<script>
$(document).ready(function() {
    // Membuat selector untuk elemen input
    var input = $("#nik");

    // Menambahkan event listener ketika input kehilangan fokus
    input.blur(function() {
        // Mengambil nilai input
        var nikval = $(this).val();

        // Memeriksa apakah nilai input memiliki panjang 16 digit
        if (nikval.length !== 16) {
            // Jika tidak, tampilkan pesan error
            $("#nik").addClass("border-danger text-danger");
            $("button[type=submit]").attr("disabled", "disabled");
            $("#nikKrg").removeClass("d-none");
            // alert('Input harus terdiri dari 16 digit!');
        } else if (nikval.length == 16) {
            $("#nik").removeClass("border-danger text-danger");
            $("button[type=submit]").removeAttr("disabled", "disabled");
            $("#nikKrg").addClass("d-none");
        }
    });
});
$(document).ready(function() {
    // Membuat selector untuk elemen input
    var inputT = $("#inTelp");

    // Menambahkan event listener ketika input kehilangan fokus
    inputT.blur(function() {
        // Mengambil nilai input
        var tlpVal = $(this).val();

        // Memeriksa apakah nilai input memiliki panjang 16 digit
        if (tlpVal.length < 11 || tlpVal.length > 13) {
            // Jika tidak, tampilkan pesan error
            $("#inTelp").addClass("border-danger text-danger");
            $("button[type=submit]").attr("disabled", "disabled");
            $("#tlpKrg").removeClass("d-none");
            // alert('Input harus terdiri dari 16 digit!');
        } else if (tlpVal.length > 11 || tlpVal.length < 13) {
            $("#inTelp").removeClass("border-danger text-danger");
            $("button[type=submit]").removeAttr("disabled", "disabled");
            $("#tlpKrg").addClass("d-none");
        }
    });
});
</script>


<?php

include 'footer.php';


if(isset($_POST["daftar"])){


    // menangkap data yang dikirim dari formulir
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $user = $_POST["user"];
    $telp = $_POST["telp"];
    $passw = md5($_POST["passw"]); //ditambahkan md5() agar password di enkripsi

        // cek data apakah nik sudah terdaftar atau belum
        $cekDataMasyarakat = mysqli_query($koneksi, "SELECT nik FROM masyarakat WHERE nik='$nik'");
        if(mysqli_num_rows($cekDataMasyarakat)>0){
            // jika nik sudah ada di database maka....
            ?>
<script>
$("#nikTrdftr").removeClass("d-none");
setInterval(function() {
    $("#nikTrdftr").addClass("d-none");
}, 5000);
</script>

<?php
        }else{
        // jika nik belum terdaftar maka....
        // menambahkan data ke database
        $tambahdata = mysqli_query($koneksi, "INSERT INTO masyarakat (nik,nama,username,password,telp,status) VALUES ('$nik','$nama','$user','$passw','$telp','pending')");

        if($tambahdata == TRUE){

        ?>
<script>
$("#berhasil").removeClass("d-none");
</script>


<?php
        }else{
            ?>

<script>
$("#gagal").removeClass("d-none");
setInterval(function() {
    $("#gagal").addClass("d-none");
}, 5000);
</script>
<?php
        }
    }
}


?>