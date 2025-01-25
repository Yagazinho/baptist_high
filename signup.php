<?php
include("dashboard/inc/config.php");
include("includes/head.php");
?>

<body class="custom-body">

    <div class="form-container">
        <div class="form-section">
            <div class="card">
                <div class="card-body">
                    <div class="card-header bg-white text-center border-bottom-0 d-flex">
                        <h2 class="justify-content-center text-center border-bottom-0">Create An Account</h2>
                    </div>
                    <form action="" method="post" class="p-5">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="ms-3 pb-1" for="fName"><strong>First Name</strong></label>
                                <input type="text" name="fName" placeholder="First Name" class="form-control snup-in">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="ms-3 pb-1" for="lName"><strong>Last Name</strong></label>
                                <input type="text" name="lName" placeholder="Last Name" class="form-control snup-in">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="ms-3 pb-1" for="lName"><strong>Email</strong></label>
                                <input type="email" name="email" placeholder="Email" class="form-control snup-in">
                            </div>
                            <div class="col-md-12 mb-2 position-relative">
                                <label class="ms-3 pb-1" for="pass"><strong>Password</strong></label>
                                <input type="password" name="pass" placeholder="Password" id="password" class="form-control snup-in">
                                <i class="bx bx-show position-absolute" id="togglePass" style="top:54%; right:45px; cursor:pointer; tranform:translateY(-50%);"></i>    
                            </div>
                            <div class="form-check justify-content-center my-2">
                                <div class="ps-5">
                                    <input class="form-check-input me-1" type="checkbox" id="check1" name="agree" value="">
                                    <label for="check1" class="form-check-label"><strong>I Agree To All Terms, Privacy Policy and Fee</strong></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <button type="submit">Sign Up</button>
                            </div>
                            <div class="col-md-12 mt-1 ms-2">
                                <p>Already have an account? <a href="login.php" class="agree-link">log in</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Contact Form -->
        </div>
    </div>
</body>
<!-- Preloader
    <div id="preloader"></div> -->
    <!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main JS File -->
<script src="assets/js/snup.js"></script>

</body>

</html>
