<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $typeName = getDBCol('user_types', $id);
    
    
    if(isset($_GET['act-type'])){
        if(changeStatus('user_types', $id, 'active') == 'ok'){
            $smsg = "type $typeName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-type'])){
        if(changeStatus('user_types', $id, 'inactive')){
            $smsg = "type $typeName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-type'])){
        $app_config['promptMsg'] = "You are about to delete user type '$typeName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('user_types', 'id='.$id)){
                $smsg = "Type $typeName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete user types table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('user_types') == 'success'){
		$smsg = 'Usertypes table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add types
// logics
if(isset($_POST['addType'])){
    //collection and scrutiny of data from form
    $typeName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['typeName'])));

    // data validation
    if(empty($typeName)){
        array_push($errs, $typeNameError = "Please Input a User Type");
    }

    // prevent duplicate in database
    $checkType = mysqli_query($dbCon, "SELECT * FROM user_types WHERE name='$typeName'");
    if(mysqli_num_rows($checkType) > 0){
        array_push($errs, $typeExistError = "");
        $emsg = "User type '$typeName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO user_types (name, dc) VALUES ('$typeName', NOW())");
        if($query){
            $smsg = "User type '$typeName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "User type could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit type

if(isset($_POST['updateType'])){
    //collection and scrutiny of data from form
    $typeName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['typeName'])));
    $oldTypeName = getDBCol('user_types', $id);

    // data validation
    if(empty($typeName)){
        array_push($errs, $typeNameError = "Please Input a User Type");
    }
    
    if($oldTypeName == $typeName){
        array_push($errs, $typeExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkType = mysqli_query($dbCon, "SELECT * FROM user_types WHERE name='$typeName'");
    if(mysqli_num_rows($checkType) > 0){
        array_push($errs, $typeExistError = "");
        $emsg = "User type '$typeName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE user_types SET name='$typeName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "User type '$oldTypeName' updated to '$typeName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "User type could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}




?>