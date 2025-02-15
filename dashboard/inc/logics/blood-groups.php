<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $bloodGroupName = getDBCol('blood_groups', $id);
    
    
    if(isset($_GET['act-bloodGroup'])){
        if(changeStatus('blood_groups', $id, 'active') == 'ok'){
            $smsg = "Blood Group $bloodGroupName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-bloodGroup'])){
        if(changeStatus('blood_groups', $id, 'inactive')){
            $smsg = "Blood Group $bloodGroupName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-bloodGroup'])){
        $app_config['promptMsg'] = "You are about to delete Blood Group '$bloodGroupName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('blood_groups', 'id='.$id)){
                $smsg = "Blood Group $bloodGroupName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete Blood Groups table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('blood_groups') == 'success'){
		$smsg = 'Blood Groups table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add blood-groups
// logics
if(isset($_POST['addBloodGroup'])){
    //collection and scrutiny of data from form
    $bloodGroupName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['bloodGroupName'])));

    // data validation
    if(empty($bloodGroupName)){
        array_push($errs, $bloodGroupNameError = "Please Input a Blood Group");
    }

    // prevent duplicate in database
    $checkBloodGroup = mysqli_query($dbCon, "SELECT * FROM blood_groups WHERE name='$bloodGroupName'");
    if(mysqli_num_rows($checkBloodGroup) > 0){
        array_push($errs, $bloodGroupExistError = "");
        $emsg = "Blood Group '$bloodGroupName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO blood_groups (name, dc) VALUES ('$bloodGroupName', NOW())");
        if($query){
            $smsg = "Blood Group '$bloodGroupName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Blood Group could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit bloodGroup

if(isset($_POST['updateBloodGroup'])){
    //collection and scrutiny of data from form
    $bloodGroupName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['bloodGroupName'])));
    $oldBloodGroupName = getDBCol('blood_groups', $id);

    // data validation
    if(empty($bloodGroupName)){
        array_push($errs, $bloodGroupNameError = "Please Input a Blood Group");
    }
    
    if($oldBloodGroupName == $bloodGroupName){
        array_push($errs, $bloodGroupExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkBloodGroup = mysqli_query($dbCon, "SELECT * FROM blood_groups WHERE name='$bloodGroupName'");
    if(mysqli_num_rows($checkBloodGroup) > 0){
        array_push($errs, $bloodGroupExistError = "");
        $emsg = "Blood Group '$bloodGroupName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE blood_groups SET name='$bloodGroupName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Blood Group '$oldBloodGroupName' updated to '$bloodGroupName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Blood Group could not be saved ".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
