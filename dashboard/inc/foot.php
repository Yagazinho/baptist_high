<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= $adminURL ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Template Main JS File -->
<script src="<?= $adminURL ?>assets/js/jquery-3.js"></script>
<script src="<?= $adminURL ?>assets/js/popper.min.js"></script>
<script src="<?= $adminURL ?>assets/js/swal.js"></script>
<script src="<?= $adminURL ?>assets/js/dash.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


<script src="../assets/js/snup.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "paging": true, // Enables pagination
            "searching": true, // Enables search/filter
            "ordering": true, // Enables sorting
            "lengthMenu": [5, 10, 25, 50], // Dropdown to select number of items per page
            "pageLength": 5 // Default items per page
        });
    });

</script>

<script type="text/javascript">
    <?php if($smsg || $emsg || $imsg): ?>
    swal({
        text: "<?php if($smsg || $emsg || $imsg){echo $smsg.$imsg.$emsg;} ?>",
        icon: "<?php if($smsg){echo 'success';}elseif($emsg){echo 'error';} else{echo 'info'; } ?>",
        buttons: false,
        timer: 10000

    });
    <?php endif ?>

    function showPreview(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.imgThumb').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }

</script>

</body>

</html>
