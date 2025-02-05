<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stateName = getDBCol('states', $id);
    
    
    if(isset($_GET['act-state'])){
        if(changeStatus('states', $id, 'active') == 'ok'){
            $smsg = "state $stateName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-state'])){
        if(changeStatus('states', $id, 'inactive')){
            $smsg = "state $stateName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-state'])){
        $app_config['promptMsg'] = "You are about to delete state '$stateName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('states', 'id='.$id)){
                $smsg = "State $stateName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete states table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('states') == 'success'){
		$smsg = 'States table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add states
// logics
if(isset($_POST['addState'])){
    //collection and scrutiny of data from form
    $stateName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['stateName'])));

    // data validation
    if(empty($stateName)){
        array_push($errs, $stateNameError = "Please Input a State Name");
    }

    // prevent duplicate in database
    $checkState = mysqli_query($dbCon, "SELECT * FROM states WHERE name='$stateName'");
    if(mysqli_num_rows($checkState) > 0){
        array_push($errs, $stateExistError = "");
        $emsg = "State '$stateName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO states (name, dc) VALUES ('$stateName', NOW())");
        if($query){
            $smsg = "State '$stateName' saved successfully";
		    // pageReload(2000, $pageURL);
        }else{
            $emsg = "State could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit state

if(isset($_POST['updateState'])){
    //collection and scrutiny of data from form
    $stateName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['stateName'])));
    $oldStateName = getDBCol('states', $id);

    // data validation
    if(empty($stateName)){
        array_push($errs, $stateNameError = "Please Input a State Name");
    }
    
    if($oldStateName == $stateName){
        array_push($errs, $stateExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkState = mysqli_query($dbCon, "SELECT * FROM states WHERE name='$stateName'");
    if(mysqli_num_rows($checkState) > 0){
        array_push($errs, $stateExistError = "");
        $emsg = "State '$stateName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE states SET name='$stateName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "State '$oldStateName' updated to '$stateName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "State could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
