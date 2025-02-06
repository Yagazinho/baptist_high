<?php

global $dbCon, $now;

if(isset($_POST['createAccount'])){
    $userName = trim(mysqli_real_escape_string($dbCon, $_POST['userName']));
    $fName = trim(mysqli_real_escape_string($dbCon, $_POST['fName']));
    $lName = trim(mysqli_real_escape_string($dbCon, $_POST['lName']));
    $email = trim(mysqli_real_escape_string($dbCon, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($dbCon, $_POST['phone']));
    $pass = trim(mysqli_real_escape_string($dbCon, $_POST['pass']));
    $gender = intval(trim($_POST['gender']));
    $userType = intval(trim($_POST['userType']));

    if(empty($userName)){
        array_push($errs, $userNameError = "Value Expepcted");
    }
    if(empty($fName)){
        array_push($errs, $fNameError = "Please input your first name");
    }
    if(empty($lName)){
        array_push($errs, $lNameError = "Please input your last name");
    }
    if(empty($email)){
        array_push($errs, $emailError = "Please input your email");
    }
    if(empty($phone)){
        array_push($errs, $phoneError = "Please input your phone number");
    }
    if($gender == (0 || "")){
        array_push($errs, $genderError = "Please select a gender");
    }
    if(empty($pass)){
        array_push($errs, $passError = "Please input your password");
    }
    if(strlen($pass) < 8){
        array_push($errs, $passError = "Minimum of 8 characters required");
    }
    if(!isset($_POST['userType'])){
        array_push($errs, $noTypeError = "");
        $emsg = "No user type selected";
    }else{
        $userType = intval($_POST['userType']);
       if ($userType == $studentTypeId) { 
            $targetTable = "students"; $tag = "student"; $prefix = "SMS-";
        } 
       if ($userType == $parentTypeId) { 
            $targetTable = "parents"; $tag = "parent"; $prefix = "SMP-";
        } 
       if ($userType == $teacherTypeId) { 
            $targetTable = "teachers"; $tag = "teacher"; $prefix = "SMT-";
        } 
       if ($userType == $accountantTypeId) { 
            $targetTable = "accountants"; $tag = "accountant"; $prefix = "SMA-";
        } 
       if ($userType == $librarianTypeId) { 
            $targetTable = "librarians"; $tag = "librarian"; $prefix = "SML-";
        }
        
//        Prevent duplicate data in database
        if(cntRows($targetTable, "*", "username='$userName'") > 0){
            array_push($errs, $userNameError = "$tag already exists");
        $emsg = "$tag '$userName' already exists in the database. try again";
        }
        if(cntRows($targetTable, "*", "email='$email'") > 0){
            array_push($errs, $emailError = "$tag already exists");
        $emsg = "email '$email' already taken by a $tag in the database. try again";
        }
        if(cntRows($targetTable,"*","phone='$phone'") > 0){
            array_push($errs, $phoneError = "$tag Exists");;
        $emsg = "phone number '$phone' already taken by a $tag in the database. try again";
        }
        
//        save data when there are no errors
        if(count($errs) == 0){
            $cryptPwd = md5($pass);
            while(true){
                $randVal = "$prefix".rand(0000000,9999999);
                if(preventDuplicateID($targetTable,$randVal) == 'ok'){
                break;
                }
            }
            
            $tag = ucfirst($tag);
            if(dbInsert($targetTable,['userId'=>$randVal,'username'=>$userName, 'fname' =>$fName, 'lname' =>$lName, 'email'=>$email, 'phone'=>$phone, 'gender'=>$gender, 'password'=>$cryptPwd, 'dc'=>$now]) == 'success'){
                $targetEmail = $email;
                $targetName = $fName." ".$lName;
                $verificationURL = $baseURL."verify?ut=$userType&nu=".strtolower($randVal);
                require "dashboard/vendor/PHPMailer/PHPMailerAutoLoad.php";
                include "dashboard/inc/mail/templates/new-account.php";
                $smsg = "Congrats '$userName', You have been registered successfully as a $tag on ".APP_NAME;
            }else{
                $emsg = "something went wrong. try again ".mysqli_error($dbCon);
            }
        }
        
    }
    
}
