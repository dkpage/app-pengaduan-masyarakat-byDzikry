<?php
$title = "Generate Laporan - ";
include "header.php";
include "sidebar.php";
?>
<script>
// mengaktifkan menu pada sidebar
$("a[href=generate]").addClass("active");
</script>
<section class="p-3 text-end border border-success mb-3 ">
    <div class="d-inline d-md-flex justify-content-end gap-2">

        <button id="pilih" class="btn btn-sm btn-primary border border-1 rounded-1">
            <i class="fa fa-list"></i> Pilih Laporan
        </button>
        <button id="print" class="btn btn-sm btn-outline-primary  rounded-1">
            <i class="fa fa-print"></i> Cetak/PDF
        </button>

    </div>
</section>

<?php if(isset($_GET['dl'])){ ?>

<div id="form-pilih" class="sembunyi">
    <section class="d-grid gap-2 p-3 border border-success mb-3">
        <form action="" method="get" class="d-grid d-md-flex gap-2">
            <select name="dl" id="" class="select2 select2bs4 form-control form-select">
                <option value="">-- Pilih Pengaduan -- </option>
                <?php
            $listLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan");
            while($listL = mysqli_fetch_array($listLaporan)){
            ?>
                <option value="<?php echo md5($listL['id_pengaduan'])?>"><?php echo $listL['judul']?></option>
                <?php }
            ?>
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Lihat</button>
        </form>
    </section>
</div>

<?php } ?>

<script>
$("#pilih").on("click", function() {
    $("#form-pilih").toggleClass("sembunyi");
})
</script>

<?php

if(isset($_GET['dl'])){
?>
<section class="border border-1 mb-0">
    <iframe id="printLap" src="printLaporan.php?dl=<?php echo $_GET['dl']?>" frameborder="0" width="100%"
        height="500px"></iframe>
</section>



<?php
}else{

?>
<div id="form-pilih" class="">
    <section class="d-grid gap-2 p-3 border border-success mb-3">
        <form action="" method="get" class="d-grid d-md-flex gap-2">
            <select name="dl" id="" class="select2 select2bs4 form-control form-select">
                <option value="">-- Pilih Pengaduan -- </option>
                <?php
            $listLaporan = mysqli_query($koneksi, "SELECT * FROM pengaduan");
            while($listL = mysqli_fetch_array($listLaporan)){
            ?>
                <option value="<?php echo md5($listL['id_pengaduan'])?>"><?php echo $listL['judul']?></option>
                <?php }
            ?>
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Lihat</button>
        </form>
    </section>
</div>

<?php
}

include "footer.php";
?>

<script>
localStorage.setItem('AdminLTE:IFrame:Options', JSON.stringify({
    autoIframeMode: false,
    autoItemActive: false
}))
</script>
<script>
// FUNGSI UNTUK MENCETAK DOKUMEN LAPORAN
$("#print").on("click", function() {
    var laporan = document.getElementById("printLap").contentWindow.print();
})
</script>