<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $attendanceTypeName = getDBCol('attendance_types', $id);
    
    
    if(isset($_GET['act-attendanceType'])){
        if(changeStatus('attendance_types', $id, 'active') == 'ok'){
            $smsg = "Attendance Type $attendanceTypeName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-attendanceType'])){
        if(changeStatus('attendance_types', $id, 'inactive')){
            $smsg = "Attendance Type $attendanceTypeName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-attendanceType'])){
        $app_config['promptMsg'] = "You are about to delete Attendance Type '$attendanceTypeName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('attendance_types', 'id='.$id)){
                $smsg = "Attendance Type $attendanceTypeName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete Attendance Types table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('attendance_types') == 'success'){
		$smsg = 'Attendance Types table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}

// logics
if(isset($_POST['addAttendanceType'])){
    //collection and scrutiny of data from form
    $attendanceTypeName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['attendanceTypeName'])));

    // data validation
    if(empty($attendanceTypeName)){
        array_push($errs, $attendanceTypeNameError = "Please Input a Attendance Type");
    }

    // prevent duplicate in database
    $checkAttendanceType = mysqli_query($dbCon, "SELECT * FROM attendance_types WHERE name='$attendanceTypeName'");
    if(mysqli_num_rows($checkAttendanceType) > 0){
        array_push($errs, $attendanceTypeExistError = "");
        $emsg = "Attendance Type '$attendanceTypeName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO attendance_types (name, dc) VALUES ('$attendanceTypeName', NOW())");
        if($query){
            $smsg = "Attendance Type '$attendanceTypeName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Attendance Type could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit attendanceType

if(isset($_POST['updateAttendanceType'])){
    //collection and scrutiny of data from form
    $attendanceTypeName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['attendanceTypeName'])));
    $oldAttendanceTypeName = getDBCol('attendance_types', $id);

    // data validation
    if(empty($attendanceTypeName)){
        array_push($errs, $attendanceTypeNameError = "Please Input a Attendance Type");
    }
    
    if($oldAttendanceTypeName == $attendanceTypeName){
        array_push($errs, $attendanceTypeExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkAttendanceType = mysqli_query($dbCon, "SELECT * FROM attendance_types WHERE name='$attendanceTypeName'");
    if(mysqli_num_rows($checkAttendanceType) > 0){
        array_push($errs, $attendanceTypeExistError = "");
        $emsg = "Attendance Type '$attendanceTypeName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE attendance_types SET name='$attendanceTypeName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Attendance Type '$oldAttendanceTypeName' updated to '$attendanceTypeName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Attendance Type could not be saved ".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
