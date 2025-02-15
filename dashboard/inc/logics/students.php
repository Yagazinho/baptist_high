<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $roleName = getDBCol('roles', $id);
    
    
    if(isset($_GET['act-role'])){
        if(changeStatus('roles', $id, 'active') == 'ok'){
            $smsg = "role $roleName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-role'])){
        if(changeStatus('roles', $id, 'inactive')){
            $smsg = "role $roleName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-role'])){
        $app_config['promptMsg'] = "You are about to delete role '$roleName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('roles', 'id='.$id)){
                $smsg = "Role $roleName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete roles table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('roles') == 'success'){
		$smsg = 'Roles table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add roles
// logics
if(isset($_POST['addRole'])){
    //collection and scrutiny of data from form
    $roleName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['roleName'])));

    // data validation
    if(empty($roleName)){
        array_push($errs, $roleNameError = "Please Input a Role Name");
    }

    // prevent duplicate in database
    $checkRole = mysqli_query($dbCon, "SELECT * FROM roles WHERE name='$roleName'");
    if(mysqli_num_rows($checkRole) > 0){
        array_push($errs, $roleExistError = "");
        $emsg = "Role '$roleName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO roles (name, dc) VALUES ('$roleName', NOW())");
        if($query){
            $smsg = "Role '$roleName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Role could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit role

if(isset($_POST['updateRole'])){
    //collection and scrutiny of data from form
    $roleName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['roleName'])));
    $oldRoleName = getDBCol('roles', $id);

    // data validation
    if(empty($roleName)){
        array_push($errs, $roleNameError = "Please Input a Role Name");
    }
    
    if($oldRoleName == $roleName){
        array_push($errs, $roleExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkRole = mysqli_query($dbCon, "SELECT * FROM roles WHERE name='$roleName'");
    if(mysqli_num_rows($checkRole) > 0){
        array_push($errs, $roleExistError = "");
        $emsg = "Role '$roleName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE roles SET name='$roleName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Role '$oldRoleName' updated to '$roleName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Role could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
