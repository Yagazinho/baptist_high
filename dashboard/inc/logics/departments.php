<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $departmentName = getDBCol('departments', $id);
    
    
    if(isset($_GET['act-department'])){
        if(changeStatus('departments', $id, 'active') == 'ok'){
            $smsg = "department $departmentName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-department'])){
        if(changeStatus('departments', $id, 'inactive')){
            $smsg = "department $departmentName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-department'])){
        $app_config['promptMsg'] = "You are about to delete department '$departmentName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('departments', 'id='.$id)){
                $smsg = "Department $departmentName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete departments table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('departments') == 'success'){
		$smsg = 'Departments table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add departments
// logics
if(isset($_POST['addDepartment'])){
    //collection and scrutiny of data from form
    $departmentName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['departmentName'])));

    // data validation
    if(empty($departmentName)){
        array_push($errs, $departmentNameError = "Please Input a Department Name");
    }

    // prevent duplicate in database
    $checkDepartment = mysqli_query($dbCon, "SELECT * FROM departments WHERE name='$departmentName'");
    if(mysqli_num_rows($checkDepartment) > 0){
        array_push($errs, $departmentExistError = "");
        $emsg = "'$departmentName' Department already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO departments (name, dc) VALUES ('$departmentName', NOW())");
        if($query){
            $smsg = "'$departmentName' Department saved successfully";
		    // pageReload(2000, $pageURL);
        }else{
            $emsg = "Department could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit department

if(isset($_POST['updateDepartment'])){
    //collection and scrutiny of data from form
    $departmentName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['departmentName'])));
    $oldDepartmentName = getDBCol('departments', $id);

    // data validation
    if(empty($departmentName)){
        array_push($errs, $departmentNameError = "Please Input a Department Name");
    }
    
    if($oldDepartmentName == $departmentName){
        array_push($errs, $departmentExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkDepartment = mysqli_query($dbCon, "SELECT * FROM departments WHERE name='$departmentName'");
    if(mysqli_num_rows($checkDepartment) > 0){
        array_push($errs, $departmentExistError = "");
        $emsg = "Department '$departmentName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE departments SET name='$departmentName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Department '$oldDepartmentName' updated to '$departmentName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Department could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
