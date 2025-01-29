<?php
//manage administrators
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $userName = getDBCol('administrators', $id, 'username');
    $dbEmail = getDBCol('administrators', $id, 'email');
    $dbRole = getDBCol('adminsitrators', $id, 'role');
    $dbRoleName = getDBCol('roles', $dbRole);
    
    
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
    
    if(isset($_GET['edit-administrator'])){
        if(isset($_POST['updateAdministrator'])){
            //collection and scrutiny of data from form
            $userName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['userName'])));
            $oldUserName = getDBCol('administrators', $id, 'username');
        
            // data validation
            if(empty($userName)){
                array_push($errs, $userNameError = "Please Input a Administrator Name");
            }
            
            if($oldUserName == $userName){
                array_push($errs, $administratorExistError = "Modification is required to continue");
            }
        
            // prevent duplicate in database
            $checkAdministrator = mysqli_query($dbCon, "SELECT * FROM administrators WHERE username='$userName'");
            if(mysqli_num_rows($checkAdministrator) > 0){
                array_push($errs, $administratorExistError = "");
                $emsg = "Administrator '$userName' already exist please choose another";
            }
        
            // proceed to data storage when there is no error
            if(count($errs) == 0){
                $query = mysqli_query($dbCon, "UPDATE administrators SET username='$userName', du=NOW() WHERE id=$id");
                if($query){
                    $smsg = "Administrator '$oldUserName' updated to '$userName' successfully";
                    pageReload(2000, $pageURL);
                }else{
                    $emsg = "Administrator could not be saved ".mysqli_error($dbCon);
                    pageReload(2000, $pageURL);
                }
            }
        
        }

        if(isset($_POST['updateEmail'])){    
            $email = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['email'])));
        
            if(empty($email)){
                array_push($errs, $emailError = "Please Input an Email");
            }
            if($dbEmail == $email){
                array_push($errs, $emailError = "Modification is required to continue");
            }
        
            $checkEmail = mysqli_query($dbCon, "SELECT * FROM administrators WHERE email='$email'");
            if(mysqli_num_rows($checkEmail) > 0){
                array_push($errs, $emailError = "");
                $emsg = "Email '$email' already exists please choose another";
            }
        
            if(count($errs) == 0){
                $query = mysqli_query($dbCon, "UPDATE administrators SET email='$email', du=NOW() WHERE id=$id");
                if($query){
                    $smsg = "Email '$dbEmail' updated successfully to '$email'";
                    pageReload(2000, $pageURL);
                }else{
                    $emsg = "Email could not be saved ".mysqli_error($dbCon);            
                    pageReload(2000, $pageURL);
                }
            }
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
    $userName = trim(mysqli_real_escape_string($dbCon, $_POST['userName']));
    $email = trim(mysqli_real_escape_string($dbCon, $_POST['email']));
    $role = intval(trim($_POST['role']));

    // data validation
    if(empty($userName)){
        array_push($errs, $userNameError = "Please Input a Username");
    }
    if(empty($email)){
        array_push($errs, $emailError = "Please Input Your Email");
    }
    if($role == (0 || "")){
        array_push($errs, $roleError = "Please Select a Role");
    }

    // prevent duplicate in database
    $checkAdministrator = mysqli_query($dbCon, "SELECT * FROM administrators WHERE username='$userName'");
    if(mysqli_num_rows($checkAdministrator) > 0){
        array_push($errs, $administratorExistError = "");
        $emsg = "Administrator '$userName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        while(true){
            $randVal = "SMA-".rand(000,999);
            if(preventDuplicateID('administrators',$randVal) == 'ok'){
                break;
            }
        }
        $query = mysqli_query($dbCon, "INSERT INTO administrators (userID, username, email, role, dc) VALUES ('$randVal','$userName', '$email', $role, NOW())");
        if($query){
            $smsg = "Administrator '$userName' saved successfully";
		    // pageReload(2000, $pageURL);
        }else{
            $emsg = "Administrator could not be saved".mysqli_error($dbCon);
		    // pageReload(2000, $pageURL);
        }
    }

}

//edit administrator



?>
