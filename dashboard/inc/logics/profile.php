<?php
if(isset($_POST['updateInfo'])){
    $fName = trim(mysqli_real_escape_string($dbCon, $_POST['fName']));
    $lName = trim(mysqli_real_escape_string($dbCon, $_POST['lName']));
    $bio = trim(mysqli_real_escape_string($dbCon, $_POST['bio']));
    $designation = trim(mysqli_real_escape_string($dbCon, $_POST['designation']));
    $address = trim(mysqli_real_escape_string($dbCon, $_POST['address']));
    $phone = trim(mysqli_real_escape_string($dbCon, $_POST['fName']));
    $email = trim(mysqli_real_escape_string($dbCon, $_POST['email']));
    $twitter = trim(mysqli_real_escape_string($dbCon, $_POST['twitter']));
    $facebook = trim(mysqli_real_escape_string($dbCon, $_POST['facebook']));
    $instagram = trim(mysqli_real_escape_string($dbCon, $_POST['instagram']));
    $linkedIn = trim(mysqli_real_escape_string($dbCon, $_POST['linkedIn']));
    
    $country = trim(intval($_POST['country']));
    $state = trim(intval($_POST['state']));
    $gender = trim(intval($_POST['gender']));
    
     $query = mysqli_query($dbCon, "UPDATE administrators SET fname='$fName', lname='$lName', bio='$bio', country='$country', state='$state', gender='$gender', designation='$designation', address='$address', phone='$phone', email='$email', fbURL='$facebook', twURL='$twitter', igURL='$instagram', lkURL='$linkedIn', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Administrator updated successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Aministrator data could not be saved.<br>".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
}

if(isset($_POST['updatePassword'])){
    $password = trim(mysqli_real_escape_string($dbCon, $_POST['password']));
    $newPassword = trim(mysqli_real_escape_string($dbCon, $_POST['newPassword']));
    $newPassword2 = trim(mysqli_real_escape_string($dbCon, $_POST['newPassword2']));

    if(empty($password)){
        array_push($errs, $passwordError = "Please Input your current password");
    }
    else{
        $cryptPwd = md5($password);
        $checkPassword = mysqli_query($dbCon, "SELECT * FROM administrators WHERE id=$id AND password='$cryptPwd'");
        if(mysqli_num_rows($checkPassword) == 0){
            array_push($errs, $passwordError = "Incorrect Password");
        }
    }
    if(empty($newPassword)){
        array_push($errs, $newPasswordError = "Please Input your new password");
    }
    if(empty($newPassword2)){
        array_push($errs, $newPassword2Error = "Please Retype your new password");
    }

    if(!empty($password) && !empty($newPassword) && !empty($newPassword2) && $newPassword != $newPassword2){
        array_push($errs, $newPassword2Error = "New Passwords do not match");
    }

    if(count($errs) == 0){
        $cryptNewPwd = md5($newPassword);
        $query = mysqli_query($dbCon, "UPDATE administrators SET password='$cryptNewPwd', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Password updated successfully";
        }
    }
}

?>
