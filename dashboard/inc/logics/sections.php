<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sectionName = getDBCol('sections', $id);
    
    
    if(isset($_GET['act-section'])){
        if(changeStatus('sections', $id, 'active') == 'ok'){
            $smsg = "section $sectionName activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-section'])){
        if(changeStatus('sections', $id, 'inactive')){
            $smsg = "section $sectionName deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-section'])){
        $app_config['promptMsg'] = "You are about to delete section '$sectionName', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('sections', 'id='.$id)){
                $smsg = "Section $sectionName deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete sections table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('sections') == 'success'){
		$smsg = 'Sections table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add sections
// logics
if(isset($_POST['addSection'])){
    //collection and scrutiny of data from form
    $sectionName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['sectionName'])));

    // data validation
    if(empty($sectionName)){
        array_push($errs, $sectionNameError = "Please Input a Section Name");
    }

    // prevent duplicate in database
    $checkSection = mysqli_query($dbCon, "SELECT * FROM sections WHERE name='$sectionName'");
    if(mysqli_num_rows($checkSection) > 0){
        array_push($errs, $sectionExistError = "");
        $emsg = "Section '$sectionName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO sections (name, dc) VALUES ('$sectionName', NOW())");
        if($query){
            $smsg = "Section '$sectionName' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Section could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}

//edit section

if(isset($_POST['updateSection'])){
    //collection and scrutiny of data from form
    $sectionName = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['sectionName'])));
    $oldSectionName = getDBCol('sections', $id);

    // data validation
    if(empty($sectionName)){
        array_push($errs, $sectionNameError = "Please Input a Section Name");
    }
    
    if($oldSectionName == $sectionName){
        array_push($errs, $sectionExistError = "Modification is required to continue");
    }

    // prevent duplicate in database
    $checkSection = mysqli_query($dbCon, "SELECT * FROM sections WHERE name='$sectionName'");
    if(mysqli_num_rows($checkSection) > 0){
        array_push($errs, $sectionExistError = "");
        $emsg = "Section '$sectionName' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE sections SET name='$sectionName', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Section '$oldSectionName' updated to '$sectionName' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Section could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}





?>
