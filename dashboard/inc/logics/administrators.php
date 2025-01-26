<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $userName = getDBCol('administrators', $id);
    
    
    if(isset($_GET['act-administrator'])){
        if(changeStatus('administrators', $id, 'active') == 'ok'){
            $smsg = "administrator $userName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-administrator'])){
        if(changeStatus('administrators', $id, 'inactive')){
            $smsg = "administrator $userName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-administrator'])){
        $app_config['promptMsg'] = "You are about to delete administrator '$userName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('administrators', 'id='.$id)){
                $smsg = "Administrator $userName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete administrators table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('administrators') == 'success'){
		$smsg = 'Administrators table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add administrators
// logics
if(isset($_POST['addAdministrator'])){
    //collection and scrutiny of data from form
    $userName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['userName'])));

    // data validation
    if(empty($userName)){
        array_push($errs, $userNameError = "Please Input a Administrator Name");
    }

    // prevent duplicate in database
    $checkAdministrator = mysqli_query($dbCon, "SELECT * FROM administrators WHERE name='$userName'");
    if(mysqli_num_rows($checkAdministrator) > 0){
        array_push($errs, $administratorExistError = "");
        $emsg = "Administrator '$userName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO administrators (name, dc) VALUES ('$userName', NOW())");
        if($query){
            $smsg = "Administrator '$userName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Administrator could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit administrator

if(isset($_POST['updateAdministrator'])){
    //collection and scrutiny of data from form
    $userName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['userName'])));
    $oldUserName = getDBCol('administrators', $id);

    // data validation
    if(empty($userName)){
        array_push($errs, $userNameError = "Please Input a Administrator Name");
    }
    
    if($oldUserName == $userName){
        array_push($errs, $administratorExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkAdministrator = mysqli_query($dbCon, "SELECT * FROM administrators WHERE name='$userName'");
    if(mysqli_num_rows($checkAdministrator) > 0){
        array_push($errs, $administratorExistError = "");
        $emsg = "Administrator '$userName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE administrators SET name='$userName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Administrator '$oldUserName' updated to '$userName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Administrator could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
