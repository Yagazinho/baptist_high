<?php 
include 'inc/config.php';

#page constants
const TITLE = 'Admin Login';
const KEYWORDS = '';
const PAGE_DESC = 'admin login page';
$page = 'login';

#login logics
include 'inc/logics/login.php';

include 'inc/head.php';
?>

<main>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="w-100" style="max-width:400px;">
            <h3 class="text-center mb-4">
                
            </h3>
        </div>
    </div>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="<?= $adminURL ?>home" class="logo d-flex align-items-center w-auto">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body overflow-auto">

                                <div class="py-3">
                                    <h5 class="card-title text-center pb-0 fs-4">Admin Login</h5>
                                    <p class="text-center small">Enter your username &amp; password to login</p>
                                    <?php include 'inc/alerts.php'; ?>
                                </div>

                                <form class="row g-3" action="" method="post">

                                    <div class="col-12">
                                        <label class="form-label">Username / Email</label>
                                        <div class="input-group mb-1">
                                            <span class="btn btn-theme" type="submit"><i class="bi bi-person-fill"></i></span>
                                            <input type="text" class="form-control" name="user">
                                        </div>
                                        <?php if(isset($userError)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $userError ?></span><?php endif ?>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-1">
                                            <span class="btn btn-theme" type="submit"><i class="bi bi-lock-fill"></i></span>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <?php if(isset($passwordError)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $passwordError ?></span><?php endif ?>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-theme w-100" type="submit" name="loginAdmin">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="#">Create an account</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->


<?php include 'inc/foot.php'; ?>
