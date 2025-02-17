<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $studentName = getDBCol('students', $id);
    
    
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
    $parent = intval(trim($_POST['parent']));
    $class = intval(trim($_POST['class']));
    $section = intval(trim($_POST['section']));
    $gender = intval(trim($_POST['gender']));
    $bloodGroup = intval(trim($_POST['bloodGroup']));
    $coverImage = $_FILES['coverImage']['name'];
    $coverImageFile = $_FILES['coverImage']['tmp_file'];
    $coverImageSz = $_FILES['coverImage']['size'];
    $imgNameArr = explode('.',$coverImage);
    $fileExts = end($imageNameArr);
    $validExt = ['jpeg','jpg','png'];
    

    // data validation
    if(empty($studentName)){
        array_push($errs, $studentNameError = "Please Input a Student First Name");
    }

    // prevent duplicate in database
    $checkStudent = mysqli_query($dbCon, "SELECT * FROM students WHERE name='$studentName'");
    if(mysqli_num_rows($checkStudent) > 0){
        array_push($errs, $studentExistError = "");
        $emsg = "Student '$studentName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO students (name, dc) VALUES ('$studentName', NOW())");
        if($query){
            $smsg = "Student '$studentName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Student could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
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
