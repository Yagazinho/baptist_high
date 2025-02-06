<?php
$verified = $invalidUser = $verifyOk = false;
if(isset($_GET['ut']) && isset($_GET['nu'])){
    $ut = $_GET['ut']; $nu = $_GET['nu'];
    if(!empty($ut) && !empty($nu)){
        $userType = getDBCol("user_types", $ut);
        if($ut == $studentTypeId){
            $table = "students";
            $userId = getColumnValNoID("students", "userId='$nu'", 'id');
            if($userId != null){
                $username = getDBCol("students", $userId, 'username');
                $fname = getDBCol("students", $userId, 'fname');
                $lname = getDBCol("students", $userId, 'lname');
                $email = getDBCol("students", $userId, 'email');
                $phone = getDBCol("students", $userId, 'phone');
                $userStatus = getDBCol("students", $userId, 'status');

                if($userStatus != 'pending'){
                    $verified = true;
                }
            }else{
                $invalidUser = true;
            }
        }elseif($ut == $teacherTypeId){
            $table = "teachers";
            $userId = getColumnValNoID("teachers", "userId='$nu'", 'id');
            if($userId != null){
                $username = getDBCol("teachers", $userId, 'username');
                $fname = getDBCol("teachers", $userId, 'fname');
                $lname = getDBCol("teachers", $userId, 'lname');
                $email = getDBCol("teachers", $userId, 'email');
                $phone = getDBCol("teachers", $userId, 'phone');
                $userStatus = getDBCol("teachers", $userId, 'status');
                
                 if($userStatus != 'pending'){
                    $verified = true;
                }
            }else{
                $invalidUser = true;
            }
        }
        elseif($ut == $parentTypeId){
            $table = "parents";
            $userId = getColumnValNoID("parents", "userId='$nu'", 'id');
            if($userId != null){
                $username = getDBCol("parents", $userId, 'username');
                $fname = getDBCol("parents", $userId, 'fname');
                $lname = getDBCol("parents", $userId, 'lname');
                $email = getDBCol("parents", $userId, 'email');
                $phone = getDBCol("parents", $userId, 'phone');
                $userStatus = getDBCol("parents", $userId, 'status'); 
                
                if($userStatus != 'pending'){
                    $verified = true;
                }
            }else{
                $invalidUser = true;
            }
        }elseif($ut == $accoutantTypeId){
            $table = "accountants";
            $userId = getColumnValNoID("accountants", "userId='$nu'", 'id');
            if($userId != null){
                $username = getDBCol("accountants", $userId, 'username');
                $fname = getDBCol("accountants", $userId, 'fname');
                $lname = getDBCol("accountants", $userId, 'lname');
                $email = getDBCol("accountants", $userId, 'email');
                $phone = getDBCol("accountants", $userId, 'phone');
                $userStatus = getDBCol("accountants", $userId, 'status'); 
                
                if($userStatus != 'pending'){
                    $verified = true;
                }
            }else{
                $invalidUser = true;
            }
        }elseif($ut == $librarianTypeId){
            $table = "librarians";
            $userId = getColumnValNoID("librarians", "userId='$nu'", 'id');
            if($userId != null){
                $username = getDBCol("librarians", $userId, 'username');
                $fname = getDBCol("librarians", $userId, 'fname');
                $lname = getDBCol("librarians", $userId, 'lname');
                $email = getDBCol("librarians", $userId, 'email');
                $phone = getDBCol("librarians", $userId, 'phone');
                $userStatus = getDBCol("librarians", $userId, 'status'); 
                
                if($userStatus != 'pending'){
                    $verified = true;
                }
            }else{
                $invalidUser = true;
            }
        }

        if(isset($_GET['verify'])){
            if(changeStatus($table,$userID) == 'changed'){
                $username = ucfirst($username);
                $verified = true;
                $verifyMsg = "<strong>Hi $username,</strong>You have successfully verified your account kindly note that your credentials will be sent to your registered email address shortly, But you can still sign in below";
                $targetEmail = $email;
                $tag = $userType;
                $targetName = $fName." ".$lName;
                require "dashboard/vendor/PHPMailer/PHPMailerAutoLoad.php";
                include "dashboard/inc/mail/templates/verified.php";
                $smsg = "Congrats '$username', Verification of your account as a $tag was succesfully done. A confirmation email has been sent to you.";
            }else{
                $emsg = "An error occured while trying to verify your account, please try again later";
            }            
        }
    }
}



?>
