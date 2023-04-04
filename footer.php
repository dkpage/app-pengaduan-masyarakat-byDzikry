<footer class="py-2 text-center bg-primary">
    <div class="container">
        <span class="text-white credit">Copyright &copy; <?php echo $thn?> - <?php echo $nama_aplikasi?> by <a
                href="https://dkmaulana.my.id" target="_blank" class="text-warning">Dzikry Maulana</a></span>
    </div>

</footer>

<!-- Bootstrap Js  -->
<script src="admin/plugins/bootstrap5/js/bootstrap.min.js"></script>
<script src="admin/plugins/bootstrap5/js/bootstrap.bundle.js"></script>

<!-- AdminLTE js  -->
<script src="admin/dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="admin/plugins/datatables-responsive/js/responsive.bootstrap4.js"></script>
<script src="admin/plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="admin/plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="admin/plugins/jszip/jszip.min.js"></script>
<script src="admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="admin/plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="admin/plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="admin/plugins/datatables-buttons/js/buttons.colVis.js"></script>



<script>
// javascript menghilangkan loader dengan jQuery
$(document).ready(function() {
    setInterval(function() {
        $("#loader").addClass("loader-hide");
        setInterval(function() {
            $("#loader").addClass("d-none");
            setInterval(function() {
                $("#loader").remove();
            }, 50);
        }, 200);
    }, 500);
})
</script>


<script src="admin/plugins/aos/aos.js"></script>
<script>
AOS.init();
</script>

</body>

</html>