<?php
include '../inc/config.php';
include '../inc/auth.php';


define("TITLE", "Manage Students");
define("HEADER", "Manage Students");
define("BREADCRUMB", "students");

include('../inc/head.php'); 

// page level scripts
$pageURL = $adminURL."students";

include '../inc/logics/students.php';
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
                            <?php if(isset($_GET['add-student'])):?>
                            <div class="card border-0 shadow-lg">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Add Student</h6>
                                    <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="add-student">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" placeholder="First Name *" value="<?= isset($_POST['fName']) ? $_POST['fName'] : '' ?>" class="form-control mt-2" name="fName">
                                                        <span class="text-danger"><?php if(isset($fNameError)){echo $fNameError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" placeholder="Last Name *" value="<?= isset($_POST['lName']) ? $_POST['lName'] : '' ?>" class="form-control mt-2" name="lName">
                                                        <span class="text-danger"><?php if(isset($lNameError)){echo $lNameError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <input type="text" placeholder="Email *" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" class="form-control mt-2" name="email">
                                                        <span class="text-danger"><?php if(isset($emailError)){echo $emailError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <input type="text" placeholder="Password *" value="<?= isset($_POST['pwd']) ? $_POST['pwd'] : '' ?>" class="form-control mt-2" name="pwd">
                                                        <span class="text-danger"><?php if(isset($pwdError)){echo $pwdError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <label class="form-label">Parent</label>
                                                        <div class="input-group mb-1">
                                                            <span class="btn btn-theme1" type="submit"><i class="bx bx-user"></i></span>
                                                            <select class="form-select" name="parent">
                                                                <option value="">--select Parent--</option>
                                                                <?php
                                                                        $q = dbSelect('parents',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                                <option <?php if((isset($_POST['parent']) && $_POST['parent'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($parentError)){echo $parentError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <label class="form-label">Class</label>
                                                        <div class="input-group mb-1">
                                                            <span class="btn btn-theme1" type="submit"><i class="bx bx-group"></i></span>
                                                            <select class="form-select" name="class">
                                                                <option value="">--select Class--</option>
                                                                <?php
                                                                        $q = dbSelect('classes',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                                <option <?php if((isset($_POST['class']) && $_POST['class'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($classError)){echo $classError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <label class="form-label">Section</label>
                                                        <div class="input-group mb-1">
                                                            <span class="btn btn-theme1" type="submit"><i class="bx bx-list-ul"></i></span>
                                                            <select class="form-select" name="section">
                                                                <option value="">--select Section--</option>
                                                                <?php
                                                                        $q = dbSelect('sections',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                                <option <?php if((isset($_POST['section']) && $_POST['section'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($sectionError)){echo $sectionError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <label class="form-label">Gender</label>
                                                        <div class="input-group mb-1">
                                                            <span class="btn btn-theme1" type="submit"><i class="bx bx-female-sign"></i></span>
                                                            <select class="form-select" name="gender">
                                                                <option value="">--select Gender--</option>
                                                                <?php
                                                                        $q = dbSelect('genders',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                                <option <?php if((isset($_POST['gender']) && $_POST['gender'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($genderError)){echo $genderError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-1">
                                                        <label class="form-label">Blood Group</label>
                                                        <div class="input-group mb-1">
                                                            <span class="btn btn-theme1" type="submit"><i class="bx bx-plus-medical"></i></span>
                                                            <select class="form-select" name="bloodGroup">
                                                                <option value="">--select Class--</option>
                                                                <?php
                                                                        $q = dbSelect('blood_groups',"*","status='active'");
                                                                        while($row = mysqli_fetch_array($q)){
                                                                    ?>
                                                                <option <?php if((isset($_POST['bloodGroup']) && $_POST['bloodGroup'] == $row['id'])){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($bloodGroupError)){echo $bloodGroupError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label for="dob">Birthday</label>
                                                        <input type="date" placeholder="" value="<?= isset($_POST['dob']) ? $_POST['dob'] : '' ?>" class="form-control mt-1" name="dob">
                                                        <span class="text-danger"><?php if(isset($dobError)){echo $dobError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <input type="" placeholder="Address" value="<?= isset($_POST['address']) ? $_POST['address'] : '' ?>" class="form-control mt-1" name="address">
                                                        <span class="text-danger"><?php if(isset($addressError)){echo $addressError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <input type="" placeholder="Phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="form-control mt-1" name="phone">
                                                        <span class="text-danger"><?php if(isset($phoneError)){echo $phoneError;} ?></span>
                                                    </div>
                                                    <div class="form-group col-md-12 mt-2">
                                                        <label for="">Student Profile Image</label>
                                                        <input type="file" name="coverImage" class="form-control form-control-file" onchange="showPreview(this)">
                                                        <span class="text-danger"><?php if(isset($coverImageError)){echo $coverImageError ;} ?></span>
                                                    </div>
                                                    <div class="preview-box my-3 py-3 px-3">
                                                        <img src="<?=$uploadsURL ?>images/students/imgnam.jpg" alt="" class="imgThumb rounded">
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="addStudent" class="btn btn-md btn-success text-white w-100">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_GET['edit-student'])):?>
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Edit Student <span class="bg-theme ms-1"><?= $studentName?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="edit-student">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="" value="<?= isset($_POST['studentName']) ? $_POST['studentName'] : $studentName ?>" class="form-control mt-2" name="studentName">
                                                        <span class="text-danger"><?php if(isset($studentNameError)){echo $studentNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="updateStudent" class="btn btn-md btn-primary text-white">Update</button>
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
                                        <a href="<?= $pageURL ?>?add-student&min" class="btn btn-theme btn-sm"><i class="bx bx-plus"></i></a>
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
                                                $query = mysqli_query($dbCon, "SELECT * FROM students");
                                                while($row = mysqli_fetch_array($query)){
                                                    $dc = date("F jS, Y h:ia",strtotime($row['dc']));
                                                    $duFormatted = date("F jS, Y h:ia",strtotime($row['du']));
                                                    $du = $row['du'];
                                                    $fname = $row['fname'];
                                                    $lname = $row['lname'];
                                                    $fullName = $fname." ".$lname;
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
                                                                <a class="dropdown-item" href="<?= $adminURL ?>students?id=<?= $row['id'] ?>&edit-student&min"><i class="bx bx-edit me-1 text-black"></i>Edit</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>students?id=<?= $row['id'] ?>&dact-student"><i class="bx bx-x me-1 text-black"></i>Deactivate</a>
                                                                <?php elseif($status == 'inactive'): ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>students?id=<?= $row['id'] ?>&del-student"><i class="bx bx-trash me-1 text-black"></i>Delete</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>students?id=<?= $row['id'] ?>&act-student"><i class="bx bx-check-square me-1 text-black"></i>Activate</a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    <td class="text-center"><?= $fullName ?></td>
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
