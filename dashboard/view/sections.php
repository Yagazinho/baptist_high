<?php
include("../inc/config.php");
include '../inc/auth.php';


define("TITLE", "Manage Sections");
define("HEADER", "Manage Sections");
define("BREADCRUMB", "sections");

include('../inc/head.php'); 

// page level scripts
$pageURL = $adminURL."sections";

include '../inc/logics/sections.php';
?>

<body>
    <?php include('../inc/header.php'); ?>

    <?php include('../inc/aside.php'); ?>

    <main id="main" class="main">
        <?php include('../inc/pagetitle.php'); ?>

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
                                                    <div class="form-group col-md-6">
                                                        <select class="form-select" name="className">
                                                            <option value="">--select Class--</option>
                                                            <?php
                                                                        $q = dbSelect('classes',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                            <option <?php if((isset($_POST['className']) && $_POST['className'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="text-danger"><?php if(isset($classNameError)){echo $classNameError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" placeholder="Section*" value="<?= isset($_POST['sectionName']) ? $_POST['sectionName'] : '' ?>" class="form-control mt-2" name="sectionName">
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
                                    <h6 class="card-title d-inline">Edit Section <span class="bg-theme ms-1"><?= $dbClassName.$sectionName ?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="edit-section">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <select class="form-select" name="className">
                                                            <option value="">--Select Class--</option>
                                                            <?php
                                                                        $q = dbSelect('classes',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                            <option <?php if(isset($_POST['className']) && $_POST['className'] == $row['id'] || $dbClass == $row['id']) {echo 'selected';}?>value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="text-danger"><?php if(isset($classNameError)){echo $classNameError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
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
                                                    <th class="text-center">Class Section</th>
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
                                                $class = getDBCol('classes', $row['classID']);
                                                $section = $row['name'];
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
                                                    <td class="text-center"><?= $class.$section?></td>
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

    <?php include('../inc/footer.php'); ?>
    <?php include('../inc/foot.php'); ?>
