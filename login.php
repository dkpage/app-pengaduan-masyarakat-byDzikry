<?php
$title = "Login - ";
include "header.php";
// include "menu.php";


// jika sesi masih ada, maka akan langsun redirect ke halaman utamanya
if($login == "login" && $tipe == "masyarakat"){
    echo "<script>location.replace('index')</script>";
}elseif($login == "login" && $tipe == "petugas"){
    echo "<script>location.replace('admin/')</script>";
}


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
            <h1 class="h3 mb-3 fw-bold rubik">Silahkan Login</h1>
        </div>
    </div>
    <div class="col-12 col-md-7 bg-white" id="form">
        <a href="./" class="float-left">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

        <br><br>
        <!-- ALERT LOGIN  -->
        <!-- Alert jika berhasil logout  -->
        <div class="alert alert-success rounded-0 d-none" id="logout" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-check"></i>
            <span>Logout Berhasil</span>
        </div>
        <!-- Alert jika berhasil login  -->
        <div class="alert alert-success rounded-0 d-none" id="berhasil" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-check"></i>
            <span>Login Berhasil, Tunggu sebentar</span>
        </div>
        <!-- Alert jika gagal login  -->
        <div class="alert alert-danger rounded-0 d-none" id="ditolak" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-ban"></i>
            <span>Registrasi anda ditolak oleh Petugas</span>
        </div>
        <!-- Alert jika akun belum diverifikasi  -->
        <div class="alert alert-info rounded-0 d-none" id="pending" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-circle-info"></i>
            <span>Akun anda belum diverifikasi oleh Petugas</span>
        </div>
        <!-- Alert jika akun nonaktif  -->
        <div class="alert alert-warning rounded-0 d-none" id="nonaktif" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-triangle-exclamation"></i>
            <span>Akun anda telah nonaktif</span>
        </div>
        <!-- Alert jika akun nonaktif  -->
        <div class="alert alert-danger rounded-0 d-none" id="gagal" data-aos="fade-down" data-aos-duration="500">
            <i class="fa fa-xmark"></i>
            <span>Username atau password tidak sesuai, silahkan periksa kembali</span>
        </div>
        <!-- ALERT LOGIN END  -->
        <form method="post">
            <label for="form-user">Username</label>
            <div class="form-group mb-2">
                <input type="text" class="form-control rounded-0" name="username" id="form-user">
            </div>
            <label for="">Password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control rounded-0" name="pswd" id="f-pass">
                <div class="input-group-append ">
                    <span class="input-group-text rounded-0">
                        <i class="fas fa-eye" id="buka"></i>
                        <i class="fas fa-eye-slash d-none" id="tutup"></i>
                    </span>
                </div>
            </div>
            <button class=" btn  btn-primary mb-3 rounded-0" name="simpan" type="submit">Masuk</button>
            <br>
            <span>Belum Punya Akun? <b class=""><a href="register">Daftar Sekarang!</a></b></span>
        </form>

        <br>
        <br>
        <div class="alert alert-info rounded-0">
            <strong>Akun Pengguna</strong> dapat dilihat pada file <a class="text-primary"
                href="readme.md">readme.md</a>
        </div>
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
if ((window.location.href.indexOf("#logout") > -1)) {
    $("#logout").removeClass("d-none");
    setInterval(function() {
        $("#logout").addClass("d-none");
        history.pushState({}, null, "login");
    }, 2000);
}
</script>


<?php
include "footer.php";

//Sistem login
if(isset($_POST['simpan'])){
    // menangkap data dari formulir login dengan metode POST
    $username = $_POST['username'];
    $pswd = md5($_POST['pswd']);

    // cek data didatabase yang memiliki username dan pasword yang sama dengan data diatas
    $cekdata = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$pswd'");
    $cek = mysqli_num_rows($cekdata);
    // echo $cek;

    
    if($cek > 0){
        $datauser = mysqli_fetch_array($cekdata);
       
        // menyimpan data user ke sesi 
        $_SESSION['nama'] = $datauser['nama_petugas'];
        $_SESSION['id_login'] = $datauser['id_petugas'];
        $_SESSION['status'] = "login";
        $_SESSION['tipe_login'] = "petugas";

            // mengarahkan ke halaman admin untuk admin dan petugas tanpa redirect halaman
            // dengan javascript
            ?>
<script>
$("#berhasil").removeClass("d-none");
setInterval(function() {
    location.replace("admin/");
}, 1000);
</script>
<?php
        
    }else{
        // cek data masyarakat jika di data petugas tidak ditemukan
        // cek data didatabase yang memiliki username dan pasword yang sama dengan data diatas
        $cekdatamasyarakat = mysqli_query($koneksi, "SELECT * FROM masyarakat WHERE username='$username' AND password='$pswd'");
        $cekmas = mysqli_num_rows($cekdatamasyarakat);
        // echo $cek;

        
        if($cekmas > 0){
            $datauser = mysqli_fetch_array($cekdatamasyarakat);
        
            // memulai sesi login
            // session_start();
            // menyimpan data user ke sesi 
            $_SESSION['nama'] = $datauser['nama'];
            $_SESSION['id_login'] = $datauser['id'];
            $_SESSION['status'] = "login";
            $_SESSION['tipe_login'] = "masyarakat";

            // jika akun belum diverifikasi
            if($datauser['status'] == "pending"){
                // menghapus semua session
                session_destroy();
                ?>
<script>
$("#pending").removeClass("d-none");
setInterval(function() {
    $("#pending").addClass("d-none");
}, 2000);
</script>
<?php

                                }elseif($datauser['status'] == "nonaktif"){
                    // menghapus semua session
                    session_destroy();
                                    ?>
<script>
$("#nonaktif").removeClass("d-none");
setInterval(function() {
    $("#nonaktif").addClass("d-none");
}, 2000);
</script>
<?php

                                }elseif($datauser['status'] == "ditolak"){
                    // menghapus semua session
                    session_destroy();
                                    ?>
<script>
$("#ditolak").removeClass("d-none");
setInterval(function() {
    $("#ditolak").addClass("d-none");
}, 2000);
</script>
<?php

            }else{

                        // REDIRECT ke halaman tertentu jika login karena ingin akses ke halaman tersebut
                        if(isset($_GET['p'])){
                            $halaman = $_GET['p'];
                            // mengarahkan ke halaman masyarakat dengan redirect halaman 
                            // dengan javascript
                ?>
<script>
$("#berhasil").removeClass("d-none");
setInterval(function() {
    location.replace("<?php echo $halaman ?>");
}, 1000);
</script>
<?php
                
                        }else{
                            // mengarahkan ke halaman masyarakat tanpa redirect halaman
                            // dengan javascript
                            ?>
<script>
$("#berhasil").removeClass("d-none");
setInterval(function() {
    location.replace("./");
}, 1000);
</script>
<?php
                    }

                 }
            }else{?>
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