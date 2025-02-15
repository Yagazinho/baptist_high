<?php
session_start();

include '../inc/config.php';

if(isset($_GET['dir'])){
    $dir = $_GET['dir'];
    if(isset($_SESSION['msmAdmin'])){ 
        $user = $_SESSION['msmAdmin']; 
        $userName = strtoupper(getDBCol('administrators',$user,'username'));
    }
    $homeUrl = $adminURL.'home';$loginUrl = $adminURL.'login';
    if($dir == 'login'){
        $text = "Welcome <span class='text-dark'>$userName</span>, you will be logged in shortly";        
        header("Refresh: 5; url=$homeUrl");
    }
    elseif($dir == 'logout'){
        $text = "Bye <span class='text-dark'>$userName</span>, you will be logged out shortly";
        unset($_SESSION['msmAdmin']);
        header("Refresh: 5; url=$loginUrl");
    }
    elseif($dir == 'not_logged_in'){
        $text = "You need to <span class='text-dark'>log in</span> first. You will be redirected to login page shortly";        
        header("Refresh: 5; url=$loginUrl");
    }
    else{
        exit();
    }
}
else{
//    exit();
}

#page constants
const TITLE = 'System Notification';


include '../inc/head.php';
?>

<main class="loader-bg">
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
                        <div class="py-4 text-center">
                            <img src="<?php echo $adminURL ?>assets/img/ripple-1s-200px.svg"  alt="" class="img-fluid loader">
                            <h5 class="text-center text-info"><?= (isset($text)) ? $text : '' ?></h5>
                        </div><!-- End Logo -->

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->


<?php include '../inc/foot.php'; ?>
