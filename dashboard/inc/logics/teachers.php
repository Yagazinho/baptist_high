<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $teacherName = getDBCol('teachers', $id, 'fname');
    
    
    if(isset($_GET['act-teacher'])){
        if(changeStatus('teachers', $id, 'active') == 'ok'){
            $smsg = "teacher $teacherName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-teacher'])){
        if(changeStatus('teachers', $id, 'inactive')){
            $smsg = "teacher $teacherName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-teacher'])){
        $app_config['promptMsg'] = "You are about to delete teacher '$teacherName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('teachers', 'id='.$id)){
                $smsg = "Role $teacherName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete teachers table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('teachers') == 'success'){
		$smsg = 'Roles table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add teachers
// logics

if(isset($_POST['addTeacher'])){
    
    $fname = trim(mysqli_real_escape_string($dbCon, $_POST['fname']));
    $lname = trim(mysqli_real_escape_string($dbCon, $_POST['lname']));
    $email = trim(mysqli_real_escape_string($dbCon, $_POST['email']));
    $phone = trim(mysqli_real_escape_string($dbCon, $_POST['phone']));
    $pwd = trim(mysqli_real_escape_string($dbCon, $_POST['pwd']));
    $pwd1 = trim(mysqli_real_escape_string($dbCon, $_POST['pwd1']));
    $gender = intval(trim($_POST['gender']));

 
    if(empty($fname)){
        array_push($errs, $fnameError = "Please input your first name");
    }
    if(empty($lname)){
        array_push($errs, $lnameError = "Please input your last name");
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
    if(empty($pwd)){
        array_push($errs, $passError = "Please input your password");
    }
    if(strlen($pwd) < 8){
        array_push($errs, $passError = "Minimum of 8 characters required");
    }
    if($pwd != $pwd1){
        array_push($errs, $pwdError = "Passwords do not match");
    }
    
    $targetTable = "teachers";
    $prefix = "SMT-";
    $tag = "Teacher";
    
//        Prevent duplicate data in database
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
            $cryptPwd = md5($pwd);
            while(true){
                $randVal = "$prefix".rand(0000000,9999999);
                if(preventDuplicateID($targetTable, $randVal) == 'ok'){
                break;
                }
            }
            
            $tag = ucfirst($tag);
            if(dbInsert($targetTable,['userId'=>$randVal, 'fname' =>$fname, 'lname' =>$lname, 'email'=>$email, 'phone'=>$phone, 'gender'=>$gender, 'password'=>$cryptPwd, 'dc'=>$now]) == 'success'){
                $targetName = $fname;
                $smsg = "Congrats '$targetName', You have been registered successfully as a $tag on ".APP_NAME;
            }else{
                $emsg = "something went wrong. try again ".mysqli_error($dbCon);
            }
        }
        
    }
    

//edit teacher





?>
