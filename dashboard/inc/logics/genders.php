<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $genderName = getDBCol('genders', $id);
    
    
    if(isset($_GET['act-gender'])){
        if(changeStatus('genders', $id, 'active') == 'ok'){
            $smsg = "gender $genderName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-gender'])){
        if(changeStatus('genders', $id, 'inactive')){
            $smsg = "gender $genderName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-gender'])){
        $app_config['promptMsg'] = "You are about to delete gender '$genderName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('genders', 'id='.$id)){
                $smsg = "Gender $genderName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete genders table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('genders') == 'success'){
		$smsg = 'Genders table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add genders
// logics
if(isset($_POST['addGender'])){
    //collection and scrutiny of data from form
    $genderName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['genderName'])));

    // data validation
    if(empty($genderName)){
        array_push($errs, $genderNameError = "Please Input a Gender Name");
    }

    // prevent duplicate in database
    $checkGender = mysqli_query($dbCon, "SELECT * FROM genders WHERE name='$genderName'");
    if(mysqli_num_rows($checkGender) > 0){
        array_push($errs, $genderExistError = "");
        $emsg = "Gender '$genderName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO genders (name, dc) VALUES ('$genderName', NOW())");
        if($query){
            $smsg = "Gender '$genderName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Gender could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit gender

if(isset($_POST['updateGender'])){
    //collection and scrutiny of data from form
    $genderName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['genderName'])));
    $oldGenderName = getDBCol('genders', $id);

    // data validation
    if(empty($genderName)){
        array_push($errs, $genderNameError = "Please Input a Gender Name");
    }
    
    if($oldGenderName == $genderName){
        array_push($errs, $genderExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkGender = mysqli_query($dbCon, "SELECT * FROM genders WHERE name='$genderName'");
    if(mysqli_num_rows($checkGender) > 0){
        array_push($errs, $genderExistError = "");
        $emsg = "Gender '$genderName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE genders SET name='$genderName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Gender '$oldGenderName' updated to '$genderName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Gender could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
