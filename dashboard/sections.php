<?php
include("inc/config.php");


define("TITLE", "Manage Sections");
define("HEADER", "Manage Sections");
define("BREADCRUMB", "sections");

include('inc/head.php'); 

// page level scripts
$pageURL = $adminURL."sections";

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
                            <?php if(isset($_GET['add-section'])):?>
                            <div class="card border-0 shadow-lg">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Add Section</h6>
                                    <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="add-section">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="Sectionname *" value="<?= isset($_POST['sectionName']) ? $_POST['sectionName'] : '' ?>" class="form-control mt-2" name="sectionName">
                                                        <span class="text-danger"><?php if(isset($sectionNameError)){echo $sectionNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="addSection" class="btn btn-md btn-success text-white w-100">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_GET['edit-section'])):?>
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Edit Section <span class="bg-theme ms-1"><?= $sectionName?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="edit-section">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="" value="<?= isset($_POST['sectionName']) ? $_POST['sectionName'] : $sectionName ?>" class="form-control mt-2" name="sectionName">
                                                        <span class="text-danger"><?php if(isset($sectionNameError)){echo $sectionNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="updateSection" class="btn btn-md btn-primary text-white">Update</button>
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
                                        <a href="<?= $pageURL ?>?add-section&min" class="btn btn-theme btn-sm"><i class="bx bx-plus"></i></a>
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
                                                $query = mysqli_query($dbCon, "SELECT * FROM sections");
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
                                                                <a class="dropdown-item" href="<?= $adminURL ?>sections?id=<?= $row['id'] ?>&edit-section&min"><i class="bx bx-edit me-1 text-black"></i>Edit</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>sections?id=<?= $row['id'] ?>&dact-section"><i class="bx bx-x me-1 text-black"></i>Deactivate</a>
                                                                <?php elseif($status == 'inactive'): ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>sections?id=<?= $row['id'] ?>&del-section"><i class="bx bx-trash me-1 text-black"></i>Delete</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>sections?id=<?= $row['id'] ?>&act-section"><i class="bx bx-check-square me-1 text-black"></i>Activate</a>
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
