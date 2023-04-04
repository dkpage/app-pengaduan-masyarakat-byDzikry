<style>
.img-pengguna {
    background-size: cover;
    background-position: top center;
}

@media screen and (min-width:760px) {
    .judul-aplikasi {
        width: 300px;
    }
}
</style>

<div class="header bg-white shadow sticky-top" id="top-menu">
    <div class="container">
        <header class="d-flex justify-content-between py-3">
            <a href="./"
                class="d-flex justify-content-center align-items-center mb-3 mb-md-0 me-md-auto text-warning text-decoration-none gap-3">
                <img src="admin/assets/img/<?php echo $logo_instansi?>" alt="" height="50">
                <img src="admin/assets/img/<?php echo $logo_aplikasi?>" alt="" height="50">
                <div class="text-start text-dark judul-aplikasi">
                    <span class="text-start d-none d-md-block"><?php echo $nama_aplikasi?></span>
                </div>
            </a>
            <div class="d-flex d-md-none justify-content-between align-items-center gap-2">
                <h3 class="mb-0 d-block d-md-none"><?php echo $singkatanAplikasi;?></h3>
                <a href="javascript:void(0)" class="d-block d-md-none btn btn-sm p-3" id="menuShow">
                    <span class="h1 mb-0"><i class="fa-solid fa-bars"></i></span>
                </a>
            </div>
            <!-- mobile menu  -->
            <div class="mobile-menu menu-hide d-md-flex justify-content-between align-items-center gap-2" id="menu">
                <a href="javascript:void(0)" class="d-block d-md-none nav-link text-secondary text-end fs-3"
                    id="menuClose">
                    <span class="mb-0"><i class="fa-solid fa-xmark"></i></span>
                </a>
                </ul>

                <?php 
                // tampilan dinamis sesuai login
                if($login == "login"){
                    if($tipe == "masyarakat"){
                        //jika login sebagai masyarakat, maka tampilakn tombol user-menu dengan namanya
                        ?>
                <div class="user-menu-link d-block">
                    <a href="javascript:void(0)"
                        class="border-left py-1 px-2 rounded-0 d-flex justify-content-between align-items-center gap-2">

                        <div class="rounded-circle img-pengguna border"
                            style="height:30px;width:30px;background-image:url('admin/assets/img/masyarakat/<?php echo $fotoUser ?>')">
                        </div>
                        <span><?php echo $nama ?></span>
                        <i class="fa fa-caret-down"></i>

                    </a>
                    <div class="position-absolute bg-white shadow user-menu rounded-0">
                        <div class="d-grid  user-menu-panel p-3  rounded-0">
                            <a href="pengaduan" class="text-start mt-2">
                                <i class="fa-regular fa-folder-open me-2 text-primary"></i>
                                Pengaduan
                            </a>

                            <a href="profil" class="text-start mt-2">
                                <i class="fa fa-user me-2 text-primary"></i>
                                Profil</a>
                            <a href="logout" class="text-start mt-2">
                                <i class="fa fa-right-from-bracket me-2 text-danger"></i>
                                Logout</a>
                        </div>
                    </div>
                </div>
                <script>
                $(".user-menu-link").on("click", function() {
                    $(".user-menu").toggleClass("show");
                })
                </script>

                <?php
                    }elseif($tipe == "petugas"){
                        // jika login sebagai petugas, maka tampilkan tombol menuju admin panel
                        ?>
                <a href="admin/" class="btn btn-sm btn-outline-light py-1 px-2 rounded-1">
                    <i class="fa fa-arrow-right me-2"></i> Panel Petugas
                </a>
                <?php
                    }
                }else{

                    // jika belum login, maka tampilkan tombol login dan register
                    ?>

                <a href="login" class="btn btn-sm btn-primary py-1 px-2 rounded-1 text-center"><i
                        class="fa fa-right-to-bracket me-2"></i>Login</a>
                <a href="register" class="btn btn-sm btn-secondary py-1 px-2 rounded-1 text-center"><i
                        class="fa fa-user-plus me-2"></i>Register</a>

                <?php
                }
                ?>

            </div>


        </header>
    </div>
</div>


<script>
$("#menuShow, #menuClose").on("click", function() {
    $("#menu").toggleClass("menu-hide");
})
</script>