<?php
include("dashboard/inc/config.php");
include("includes/head.php");



global $dbCon, $now;

#login logics
include 'dashboard/inc/logics/signup.php';

include 'dashboard/inc/head.php';
?>

<body class="custom-body">

    <div class="form-container">
        <div class="form-section">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-5 mb-md-7">
                        <h1 class="h2 mt-10">Welcome To My School Manager</h1>
                        <p>Create Account.</p>
                        <?php include 'dashboard/inc/alerts.php'; ?>
                    </div>
                    <form action="" method="post" class="p-5">
                        <div class="col-12">
                            <div class="mb-3 pb-3 border-bottom border-primary">
                                <label for="" class="form-label d-block">Specify Account Type</label>
                                <?php
                                $q = mysqli_query($dbCon, "SELECT * FROM user_types");
                                if(mysqli_num_rows($q) > 0){
                                while($row = mysqli_fetch_array($q)){
                                    $id = $row['id'];
                                    if($id == $accountantTypeId){continue;}
                                ?>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="type<?= $id?>" name="userType" value="<?= $id ?>" <?php if(isset($_POST['userType']) && $_POST['userType'] == $id) {echo 'checked' ;}elseif(!isset($_POST['userType']) && $id == $teacherTypeId) {echo 'checked' ;} ?>><?= $row['name'];?>
                                    <label for="type<?= $id ?>" class="form-check-label"></label>
                                </div>
                                <?php }}?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="ms-3 pb-1" for="fName"><strong>First Name</strong></label>
                                <input type="text" name="fName" placeholder="First Name" class="form-control snup-in">
                                <span class="text-danger"><?php if(isset($fNameError)){echo $fNameError;} ?></span>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="ms-3 pb-1" for="lName"><strong>Last Name</strong></label>
                                <input type="text" name="lName" placeholder="Last Name" class="form-control snup-in">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="ms-3 pb-1" for="userName"><strong>Username</strong></label>
                                <input type="text" name="userName" placeholder="Username" class="form-control snup-in">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="ms-3 pb-1" for="lName"><strong>Email</strong></label>
                                <input type="email" name="email" placeholder="Email" class="form-control snup-in">
                            </div>
                            <div class="col-md-8 mb-2">
                                <label class="ms-3 pb-1" for="phone"><strong>Phone</strong></label>
                                <input type="tel" name="phone" placeholder="Phone" class="form-control snup-in">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="ms-3 pb-1" for="gender"><strong>Gender</strong></label>
                                <div class="input-group">
                                    <span class="btn btn-primary" type="submit"><i class="bx bx-female-sign"></i></span>
                                    <select name="gender" class="form-select">
                                        <option value="">--Select--</option>
                                        <?php
                                        $q = mysqli_query($dbCon, "SELECT * FROM genders");
                                        while($row = mysqli_fetch_array($q)){
                                        ?>
                                        <option <?php if((isset($_POST['gender']) && $_POST['gender'] == $row['id'])){echo 'selected';} ?> value="<?= $row['id']?>"><?= $row['name']?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="text-danger"><?php if(isset($genderError)){echo $genderError;} ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2 position-relative">
                                <label class="ms-3 pb-1" for="pass"><strong>Password</strong></label>
                                <input type="password" name="pass" required placeholder="Password" id="password" class="form-control snup-in" value=<?= isset($_POST['pass']) ? $_POST['pass'] : ''?>>
                                <i class="bx bx-show position-absolute" id="togglePass" style="top:54%; right:45px; cursor:pointer; tranform:translateY(-50%);"></i>
                                <span class="text-danger"><?php if(isset($passError)){echo $passError;} ?></span>    
                            </div>
                            <div class="form-check justify-content-center my-2">
                                <div class="ps-5">
                                    <input class="form-check-input me-1" type="checkbox" id="check1" name="iAgree" value="true" required <?= isset($_POST['iAgree']) ? $_POST['iAgree'] : ''?>>
                                    <label for="check1" class="form-check-label"><strong>I Agree To All Terms, Privacy Policy and Fee</strong></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1">
                                <button type="submit" name="createAccount">Sign Up</button>
                            </div>
                            <div class="col-md-12 mt-1 ms-2">
                                <p>Already have an account? <a href="<?= $baseURL?>login" class="agree-link">log in</a></p>
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
