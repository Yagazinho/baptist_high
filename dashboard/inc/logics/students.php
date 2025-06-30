<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $fname = getDBCol('students', $id, 'fname');
    $lname = getDBCol('students', $id, 'lname');
    $studentName = $fname." ".$lname;
    
    
    if(isset($_GET['act-student'])){
        if(changeStatus('students', $id, 'active') == 'ok'){
            $smsg = "student $studentName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-student'])){
        if(changeStatus('students', $id, 'inactive')){
            $smsg = "student $studentName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-student'])){
        $app_config['promptMsg'] = "You are about to delete student '$studentName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('students', 'id='.$id)){
                $smsg = "Student $studentName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete students table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('students') == 'success'){
		$smsg = 'Students table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add students
// logics
if(isset($_POST['addStudent'])){
    //collection and scrutiny of data from form
    $fName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['fName'])));
    $lName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['lName'])));
    $email = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['email'])));
    $pwd = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['pwd'])));
    $dob = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['dob'])));
    $address = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['address'])));
    $phone = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['phone'])));
    $class = intval(trim($_POST['class']));
    $section = intval(trim($_POST['section']));
    $gender = intval(trim($_POST['gender']));
    $bloodGroup = intval(trim($_POST['bloodGroup']));
    

    // data validation
    if(empty($fName)){
        array_push($errs, $fNameError = "Please Input a Student First Name");
    }
    if(empty($lName)){
        array_push($errs, $lNameError = "Please Input a Student Last Name");
    }
    if(empty($email)){
        array_push($errs, $emailError = "field cannot be empty");
    }
    if(empty($pwd)){
        array_push($errs, $pwdError = "field cannot be empty");
    }
    if(empty($dob)){
        array_push($errs, $dobError = "field cannot be empty");
    }
    if($class == (0 || "")){
        array_push($errs, $classError = "Please Select a Class");
    }
    if($section == (0 || "")){
        array_push($errs, $sectionError = "Please Select a Class Section");
    }
    if($gender == (0 || "")){
        array_push($errs, $genderError = "Please Select a Gender");
    }
//    if(strlen($phone) < 11){
//        array_push($errs, $phoneError = "Invalid phone number");
//    }

     
    $targetTable = "students";
    $prefix = "SMS-";
    $tag = "student";
    
//        Prevent duplicate data in database
        if(cntRows($targetTable, "*", "email='$email'") > 0){
            array_push($errs, $emailError = "$tag already exists");
        $emsg = "email '$email' already taken by a $tag in the database. try again";
        }
        if(cntRows($targetTable,"*","phone='$phone'") > 0){
            array_push($errs, $phoneError = "$tag Exists");;
        $emsg = "phone number '$phone' already taken by a $tag in the database. try again";
        }
        

    // proceed to data storage when there is no error
    if(count($errs) == 0){
            $cryptPwd = md5($pwd);
            while(true){
                $randVal = "$prefix".rand(0000000,9999999);
                if(preventDuplicateID($targetTable, $randVal) == 'ok'){
                break;
                }
            }
        $query = mysqli_query($dbCon, "INSERT INTO $targetTable (userId,fname,lname,email,password,dob,class,sectionId,gender,address,bloodGroup,dc) VALUES ('$randVal','$fName','$lName','$email','$cryptPwd','$dob',$class,$section,$gender,'$address',$bloodGroup,NOW())");
        if($query){
            $smsg = "Student '$studentName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Student could not be saved ".mysqli_error($dbCon);
//		    pageReload(2000, $pageURL);
        }
    }

}

//edit student

if(isset($_POST['updateStudent'])){
    //collection and scrutiny of data from form
    $studentName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['studentName'])));
    $oldStudentName = getDBCol('students', $id);

    // data validation
    if(empty($studentName)){
        array_push($errs, $studentNameError = "Please Input a Student Name");
    }
    
    if($oldStudentName == $studentName){
        array_push($errs, $studentExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkStudent = mysqli_query($dbCon, "SELECT * FROM students WHERE name='$studentName'");
    if(mysqli_num_rows($checkStudent) > 0){
        array_push($errs, $studentExistError = "");
        $emsg = "Student '$studentName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE students SET name='$studentName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Student '$oldStudentName' updated to '$studentName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Student could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
