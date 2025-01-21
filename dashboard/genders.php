<?php
include("inc/config.php");


define("TITLE", "Manage Genders");
define("HEADER", "Manage Genders");
define("BREADCRUMB", "genders");

include('inc/head.php'); 

// page level scripts
$pageURL = $adminURL."genders";

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

<body>
    <?php include('inc/header.php'); ?>

    <?php include('inc/aside.php'); ?>

    <main id="main" class="main">
        <?php include('inc/pagetitle.php'); ?>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <?php if(isset($_GET['min'])):?>
                        <div class="col-md-4">
                            <?php if(isset($_GET['add-gender'])):?>
                            <div class="card border-0 shadow-lg">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Add Gender
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="add-gender">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="Gendername *" value="<?= isset($_POST['genderName']) ? $_POST['genderName'] : '' ?>" class="form-control mt-2" name="genderName">
                                                        <span class="text-danger"><?php if(isset($genderNameError)){echo $genderNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="addGender" class="btn btn-sm btn-success text-white w-100">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_GET['edit-gender'])):?>
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Edit Gender <span class="bg-theme ms-1"><?= $genderName?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="edit-gender">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="" value="<?= isset($_POST['genderName']) ? $_POST['genderName'] : $genderName ?>" class="form-control mt-2" name="genderName">
                                                        <span class="text-danger"><?php if(isset($genderNameError)){echo $genderNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="updateGender" class="btn btn-sm btn-primary text-white">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <?php endif ?>
                        <div class="col-md-<?= isset($_GET['min']) ? 8 : 12 ?>">
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="border-bottom py-1 mb-3 px-3">
                                    <div class="btn-group">
                                        <a href="<?= $pageURL ?>?add-gender&min" class="btn btn-theme btn-sm"><i class="bx bx-plus"></i></a>
                                    </div>
                                    <div class="btn-group float-end">
                                        <a href="<?= $pageURL ?>" class="btn btn-theme btn-sm"><i class="bx bx-refresh"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title mb-5">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">action</th>
                                                    <th class="text-center">name</th>
                                                    <th class="text-center">dc</th>
                                                    <th class="text-center">du</th>
                                                    <th class="text-center">status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($dbCon, "SELECT * FROM genders");
                                                while($row = mysqli_fetch_array($query)){
                                                    $dc = date("F jS, Y h:ia",strtotime($row['dc']));
                                                    $duFormatted = date("F jS, Y h:ia",strtotime($row['du']));
                                                    $du = $row['du'];
                                                $status = $row['status'];
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $no++; ?></td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-outline-theme dropdown-toggle" type="button" id="actnBtn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-list-check"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="actnBtn">
                                                                <h6 class="dropdown-header">Actions</h6>
                                                                <?php if($status == 'active'): ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>genders?id=<?= $row['id'] ?>&edit-gender&min"><i class="bx bx-edit me-1 text-black"></i>Edit</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>genders?id=<?= $row['id'] ?>&dact-gender"><i class="bx bx-x me-1 text-black"></i>Deactivate</a>
                                                                <?php elseif($status == 'inactive'): ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>genders?id=<?= $row['id'] ?>&del-gender"><i class="bx bx-trash me-1 text-black"></i>Delete</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>genders?id=<?= $row['id'] ?>&act-gender"><i class="bx bx-check-square me-1 text-black"></i>Activate</a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    <td class="text-center"><?= $row['name']?></td>
                                                    <td class="text-center"><?= $row['dc']?></td>
                                                    <td class="text-center">
                                                        <?php if(empty($du)){
                                                        echo $du;
                                                    }else{
                                                        echo $duFormatted;
                                                    }
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><i class="bi bi-circle-fill text-<?= formatStatus($row['status']);?>"></i></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </h6>
                                </div>
                                <div class="card-footer d-flex">
                                    <div class="btn-group ms-auto">
                                        <a href="<?= $pageURL ?>?truncate" class="btn btn-danger btn-sm"><i class="bx bx-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <?php include('inc/footer.php'); ?>
    <?php include('inc/foot.php'); ?>
