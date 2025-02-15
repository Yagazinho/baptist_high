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
    
      $q = dbUpdate('administrators',['fname'=>$fName, 'lname'=>$lName, 'bio'=>$bio, 'state'=>$state, 'designation'=>$designation, 'address'=>$address, 'phone'=>$phone, 'email'=>$email, 'fbURL'=>$facebook, 'twURL'=>$twitter, 'lkURL'=>$linkedIn, 'igURL'=>$instagram, 'country'=>$country, 'gender'=>$gender, 'du'=>$now],"id=".$uId);
    if($q == 'success'){
        $doLog = logAction('you updated your basic info',$uId);
        if($doLog == 'logged'){
            $smsg = "basic information updated successfully";
            $url = $adminURL.'profile?vw=e-info';
            header("Refresh: 2; url=$url");
        }
    }
    else{
        $emsg = "something went wrong.<br>".mysqli_error($dbCon);
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
            $smsg = "password was changed successfully. you will be signed out shortly";
            $logout = $adminURL.'logout';
            header("Refresh: 10; url=$logout");
        }
        else{
            $emsg = "something went wrong.";
        }
    }
}

if(isset($_POST['updateImage'])){
    $uploadPath = '../uploads/images/administrators/';
    $userImage = $_FILES['userImage']['name'];
    $userImageSz = $_FILES['userImage']['size'];
    $imgNameArr = explode('.',$userImage);
    $fileExt = strtolower(end($imgNameArr));
    // check extension
    $validExts = ['jpg','png'];
    if(!in_array($fileExt,$validExts)){
        array_push($errs, $userImageError = "Invalid format encountered, jpg/png expected");
    }
    // check size
    if($userImageSz > 500000){
        array_push($errs, $userImageError = "File too large, 500kb max is expected");
    } 

    if(count($errs) == 0){
        $newFileName = strtolower($cuUserName).'.'.$fileExt;
        $pngFile = strtolower($cuUserName).'.png';
        $jpgFile = strtolower($cuUserName).'.jpg';
    $q = dbUpdate('administrators',['image'=>$newFileName, 'du'=>$now],"id=".$uId);
    if($q == 'success'){
        if(file_exists($uploadPath.$pngFile)){ unlink($uploadPath.$pngFile); }
            if(file_exists($uploadPath.$jpgFile)){ unlink($uploadPath.$jpgFile); }
            if(move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadPath.$newFileName)){
                $smsg = "profile image was updated successfully";
                $url = $adminURL.'profile?vw=e-image';
                header("Refresh: 5; url=$url");
            }
        }
        else{
            $emsg = "something went wrong. ".mysqli_error($dbCon);
        }
    }
    
}

if(isset($_GET['do'])){
    $do = $_GET['do'];
    if($do == 'reset-image'){
        $promptMsg = "You are about to reset your image back to default. Are you sure?";
        $pgURL = $adminURL."profile?vw=e-info";
        $prompt = true;
        if(isset($_POST['doAction'])){
            $prompt = false;
            $q = dbUpdate('administrators',['image'=>$adminDefaultImg, 'du'=>$now],"id=".$uId);
            if($q == 'success'){
                $pngFile = strtolower($cuUserName).'.png';
                $jpgFile = strtolower($cuUserName).'.jpg';
                if(file_exists($uploadPath.$pngFile)){ unlink($uploadPath.$pngFile); }
                if(file_exists($uploadPath.$jpgFile)){ unlink($uploadPath.$jpgFile); }
                $smsg = "image reset was successful";
                $url = $adminURL.'profile?vw=e-info';
                header("Refresh: 5; url=$url");
            }
            else{
                $emsg = "activation failed. try again";
            }
        }
    }
}

?>
