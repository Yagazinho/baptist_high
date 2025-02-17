<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $designationName = getDBCol('designations', $id);
    
    
    if(isset($_GET['act-designation'])){
        if(changeStatus('designations', $id, 'active') == 'ok'){
            $smsg = "designation $designationName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-designation'])){
        if(changeStatus('designations', $id, 'inactive')){
            $smsg = "designation $designationName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-designation'])){
        $app_config['promptMsg'] = "You are about to delete designation '$designationName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('designations', 'id='.$id)){
                $smsg = "Designation $designationName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete designations table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('designations') == 'success'){
		$smsg = 'Designations table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add designations
// logics
if(isset($_POST['addDesignation'])){
    //collection and scrutiny of data from form
    $designationName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['designationName'])));

    // data validation
    if(empty($designationName)){
        array_push($errs, $designationNameError = "Please Input a Designation Name");
    }

    // prevent duplicate in database
    $checkDesignation = mysqli_query($dbCon, "SELECT * FROM designations WHERE name='$designationName'");
    if(mysqli_num_rows($checkDesignation) > 0){
        array_push($errs, $designationExistError = "");
        $emsg = "'$designationName' Designation already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO designations (name, dc) VALUES ('$designationName', NOW())");
        if($query){
            $smsg = "'$designationName' Designation saved successfully";
		    // pageReload(2000, $pageURL);
        }else{
            $emsg = "Designation could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit designation

if(isset($_POST['updateDesignation'])){
    //collection and scrutiny of data from form
    $designationName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['designationName'])));
    $oldDesignationName = getDBCol('designations', $id);

    // data validation
    if(empty($designationName)){
        array_push($errs, $designationNameError = "Please Input a Designation Name");
    }
    
    if($oldDesignationName == $designationName){
        array_push($errs, $designationExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkDesignation = mysqli_query($dbCon, "SELECT * FROM designations WHERE name='$designationName'");
    if(mysqli_num_rows($checkDesignation) > 0){
        array_push($errs, $designationExistError = "");
        $emsg = "Designation '$designationName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE designations SET name='$designationName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Designation '$oldDesignationName' updated to '$designationName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Designation could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
