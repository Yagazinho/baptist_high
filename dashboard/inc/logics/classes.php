<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $className = getDBCol('classes', $id);
    
    
    if(isset($_GET['act-class'])){
        if(changeStatus('classes', $id, 'active') == 'ok'){
            $smsg = "class $className activated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['dact-class'])){
        if(changeStatus('classes', $id, 'inactive')){
            $smsg = "class $className deactivated successfully";
		    pageReload(3000, $pageURL);
        }
    }
    
    if(isset($_GET['del-class'])){
        $app_config['promptMsg'] = "You are about to delete class '$className', are you really sure?";
        $app_config['prompt'] = true;
        $app_config['promptType'] = 'dark';
        if(isset($_POST['doPrompt'])){
            $app_config['prompt'] = false;
            if(dbDelete('classes', 'id='.$id)){
                $smsg = "Class $className deleted successfully";
		        pageReload(3000, $pageURL);
            }
            else{
                $emsg = "Something went wrong".mysqli_error($dbCon);
            }
        }
    }
}

if(isset($_GET['truncate'])){
	$app_config['promptMsg'] = "You are about to delete classes table are you sure?";
	$app_config['prompt'] = true;
	$app_config['promptType'] = 'dark';
	if(isset($_POST['doPrompt'])){
	$app_config['prompt'] = false;
	if(dbTruncate('classes') == 'success'){
		$smsg = 'Classes table truncated successfully';
	}
	else{
		$emsg = "Something went wrong";
        }
    }
}


// add classes
// logics
if(isset($_POST['addClass'])){
    //collection and scrutiny of data from form
    $className = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['className'])));

    // data validation
    if(empty($className)){
        array_push($errs, $classNameError = "Please Input a Classe Name");
    }

    // prevent duplicate in database
    $checkClass = mysqli_query($dbCon, "SELECT * FROM classes WHERE name='$className'");
    if(mysqli_num_rows($checkClass) > 0){
        array_push($errs, $classExistError = "");
        $emsg = "Class '$className' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "INSERT INTO classes (name, dc) VALUES ('$className', NOW())");
        if($query){
            $smsg = "Class '$className' saved successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Class could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }
 }


//edit class

if(isset($_POST['updateClass'])){
    //collection and scrutiny of data from form
    $className = trim(stripslashes(mysqli_real_escape_string($dbCon, $_POST['className'])));
    $oldClassName = getDBCol('classes', $id);
    // data validation
    if(empty($className)){
        array_push($errs, $classNameError = "Please Input a Class Name");
    }
    
    if($oldClassName == $className){
        array_push($errs, $classExistError = "");
        $emsg = "No changes made to class '$oldClassName'";
    }

    // prevent duplicate in database
    $checkClass = mysqli_query($dbCon, "SELECT * FROM classes WHERE name='$className'");
    if(mysqli_num_rows($checkClass) > 0){
        array_push($errs, $classExistError = "");
        $emsg = "Class '$className' already exist please choose another";
    }

    // proceed to data storage when there is no error
    if(count($errs) == 0){
        $query = mysqli_query($dbCon, "UPDATE classes SET name='$className', du=NOW() WHERE id=$id");
        if($query){
            $smsg = "Class '$oldClassName' updated to '$className' successfully";
		    pageReload(2000, $pageURL);
        }else{
            $emsg = "Class could not be saved".mysqli_error($dbCon);
		    pageReload(2000, $pageURL);
        }
    }

}
