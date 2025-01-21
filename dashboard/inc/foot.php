<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/jquery-3.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/swal.js"></script>


<script>
    $(document).ready(function() {
        $('.datatable').DataTable();

        $('.only-num').keypress(function(event) {
            if (event.keyCode == 46 || event.keyCode == 8) {

            } else {
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
        });

    });

</script>

<script type="text/javascript">
    <?php if($smsg || $emsg || $imsg): ?>
    swal({
        text: "<?php if($smsg || $emsg || $imsg){echo $smsg.$imsg.$emsg;} ?>",
        icon: "<?php if($smsg){echo 'success';}elseif($emsg){echo 'error';} else{echo 'info'; } ?>",
        buttons: false,
        timer: 5000

    });
    <?php endif ?>

</script>

</body>

</html>
