</div>
</section>
</div>
<footer class="main-footer">
    <span class="text-disabled">Copyright <?php echo $thn;?> - <?php echo $nama_aplikasi?> by <a
            href="https://dkmaulana.my.id" target="_blank">Dzikry Maulana</a></span>

</footer>


<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Popper  -->
<!-- <script src="plugins/popper/popper.min.js"></script> -->
<!-- <script src="plugins/popper/js/bootstrap.bundle.min.js"></script> -->
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
})
</script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- SweetAlert2 Js -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr Js -->
<script src="plugins/toastr/toastr.min.js"></script>

<script>
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
</script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.js"></script>

</body>

</html>