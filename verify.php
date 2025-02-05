<?php 
include 'dashboard/inc/config.php';

#page constants
const TITLE = 'Account Verification';
const KEYWORDS = '';
const PAGE_DESC = 'verification Page';
$page = 'verify';


#login logics
include 'dashboard/inc/logics/verify.php';

include 'dashboard/inc/head.php';
?>
<style>
    @media(max-width:540px){
        .w-sm-100{
            width: 100%;
        }
    }
    
    @media(min-width:540px){
        .w-md-50 .w-lg-50{
            width: 50%;
       }
    }

</style>
<main>
    <div class="container">
        <!-- Content -->
        <div class="container content-space-2 content-space-lg-3 d-flex justify-content-center w-md-50 w-lg-50  w-sm-100 mt-5">
            <div class="w-md-50  w-lg-50 text-center mx-md-auto  px-3 py-5">
                <div class="mb-5">
                    <img class="img-fluid" src="assets/img/illustrations/hi-five.png" alt="SVG" style="width: 15rem;">
                </div>
                <h5 class="card-title text-center pb-0 fs-4">Account Verification</h5>
                <?php include 'dashboard/inc/alerts.php'; ?>
                <?php if(!$verified && !$invalidUser): ?>
                <p class="text-justify"><strong class="text-primary">Hi <?= ucfirst($username) ?>,</strong> as part of your registration process you are expected to verify your account by clicking the verify button below. Your account shall be prepared and your login credentials will be sent to your registered email address.</p>
                <a href="<?= $baseURL ?>verify?ut=<?= $ut ?>&nu=<?= $nu ?>&verify" class="btn btn-primary w-100">Verify</a>
                <?php elseif($invalidUser): ?>
                <p class="text-justify">Invalid User Encountered. Please use the link below to create an account for yourself if you want to become a member or vendor</p>
                <a href="<?= $baseURL ?>register" class="btn btn-primary w-100">Register</a>
                <?php elseif($verified): ?>
                <?php if(isset($verifyMsg)): ?>
                <p><?= $verifyMsg ?></p>
                <?php else: ?>
                <p class="text-justify"><strong class="text-primary">Hi <?= ucfirst($username) ?>,</strong>You have already verified your account please use the link below to sign in instead</p>
                <?php endif ?>
                <a href="<?= $baseURL ?>login" class="btn btn-primary w-100">Sign in</a>
                <?php endif ?>
            </div>
        </div>
        <!-- End Content -->
    </div>
</main><!-- End #main -->


<?php include 'dashboard/inc/foot.php'; ?>

