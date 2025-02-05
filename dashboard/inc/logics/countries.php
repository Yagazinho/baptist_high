<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $countryName = getDBCol('countries', $id);
    
    
    if(isset($_GET['act-country'])){
        if(changeStatus('countries', $id, 'active') == 'ok'){
            $smsg = "country $countryName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-country'])){
        if(changeStatus('countries', $id, 'inactive')){
            $smsg = "country $countryName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-country'])){
        $app_config['promptMsg'] = "You are about to delete country '$countryName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('countries', 'id='.$id)){
                $smsg = "Country $countryName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete countries table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('countries') == 'success'){
		$smsg = 'Countries table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add countries
// logics
if(isset($_POST['addCountry'])){
    //collection and scrutiny of data from form
    $countryName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['countryName'])));

    // data validation
    if(empty($countryName)){
        array_push($errs, $countryNameError = "Please Input a Country Name");
    }

    // prevent duplicate in database
    $checkCountry = mysqli_query($dbCon, "SELECT * FROM countries WHERE name='$countryName'");
    if(mysqli_num_rows($checkCountry) > 0){
        array_push($errs, $countryExistError = "");
        $emsg = "Country '$countryName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO countries (name, dc) VALUES ('$countryName', NOW())");
        if($query){
            $smsg = "Country '$countryName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Country could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit country

if(isset($_POST['updateCountry'])){
    //collection and scrutiny of data from form
    $countryName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['countryName'])));
    $oldCountryName = getDBCol('countries', $id);

    // data validation
    if(empty($countryName)){
        array_push($errs, $countryNameError = "Please Input a Country Name");
    }
    
    if($oldCountryName == $countryName){
        array_push($errs, $countryExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkCountry = mysqli_query($dbCon, "SELECT * FROM countries WHERE name='$countryName'");
    if(mysqli_num_rows($checkCountry) > 0){
        array_push($errs, $countryExistError = "");
        $emsg = "Country '$countryName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE countries SET name='$countryName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Country '$oldCountryName' updated to '$countryName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Country could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
