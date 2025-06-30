<?php
include("../inc/config.php");
include '../inc/auth.php';


define("TITLE", "Manage Teachers");
define("HEADER", "Manage Teachers");
define("BREADCRUMB", "teachers");

include('../inc/head.php'); 

// page level scripts
$pageURL = $adminURL."teachers";

include '../inc/logics/teachers.php';
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
                            <?php if(isset($_GET['add-teacher'])):?>
                            <div class="card border-0 shadow-lg">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Add Teacher</h6>
                                    <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="add-teacher">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-floating">
                                                            <input type="text" id="fname" placeholder="first name *" value="<?= isset($_POST['fname']) ? $_POST['fname'] : '' ?>" class="form-control" name="fname">
                                                            <label for="fname">First Name</label>
                                                        </div>
                                                        <?php if(isset($fnameError)): ?><span class="text-danger"><?= $fnameError ?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-floating">
                                                            <input type="text" id="lname" placeholder="last name *" value="<?= isset($_POST['lname']) ? $_POST['lname'] : '' ?>" class="form-control" name="lname">
                                                            <label for="lname">Last Name</label>
                                                        </div>
                                                        <?php if(isset($lnameError)): ?><span class="text-danger"><?= $lnameError ?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                            <input type="number" id="phone" placeholder="Phone *" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="form-control" name="phone">
                                                            <label for="phone">Phone</label>
                                                        </div>
                                                        <?php if(isset($usernameError)): ?><span class="text-danger"><?= $usernameError ?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                                                            <label for="email">Email Address</label>
                                                        </div>
                                                        <?php if(isset($emailError)): ?><span class="text-danger"><?= $emailError ?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                            <select name="gender" id="gender" class="form-select">
                                                                <?php
                                                            $q = mysqli_query($dbCon, "SELECT * FROM genders");
                                                             while($row = mysqli_fetch_array($q)){
                                                         ?>
                                                                <option <?php if(isset($_POST['gender']) && $_POST['gender'] == $row['id']){echo 'selected' ;} ?> value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="gender">Gender</label>
                                                        </div>
                                                        <?php if(isset($genderError)):?><span class="text-danger"><?= $genderError?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                            <input type="password" placeholder="password" class="form-control" id="password" name="pwd" value="<?php if(isset($_POST['pwd'])){ echo $_POST['pwd']; } ?>">
                                                            <label for="password">Password</label>
                                                        </div>
                                                        <?php if(isset($pwdError)): ?><span class="text-danger"><?= $pwdError ?></span><?php endif ?>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                            <input type="password" placeholder="confirm password" class="form-control" id="password" name="pwd1" value="<?php if(isset($_POST['pwd1'])){ echo $_POST['pwd1']; } ?>">
                                                            <label for="password">Confirm Password</label>
                                                        </div>
                                                        <?php if(isset($pwd1Error)): ?><span class="text-danger"><?= $pwd1Error ?></span><?php endif ?>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="addTeacher" class="btn btn-md btn-success text-white w-100">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_GET['edit-teacher'])):?>
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Edit Teacher <span class="bg-theme ms-1"><?= $teacherName?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                        <div class="edit-teacher">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" placeholder="" value="<?= isset($_POST['teacherName']) ? $_POST['teacherName'] : $teacherName ?>" class="form-control mt-2" name="teacherName">
                                                        <span class="text-danger"><?php if(isset($teacherNameError)){echo $teacherNameError;} ?></span>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="updateTeacher" class="btn btn-md btn-primary text-white">Update</button>
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
                                        <a href="<?= $pageURL ?>?add-teacher&min" class="btn btn-theme btn-sm"><i class="bx bx-plus"></i></a>
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
                                                $query = mysqli_query($dbCon, "SELECT * FROM teachers");
                                                while($row = mysqli_fetch_array($query)){
                                                    $dc = date("F jS, Y h:ia",strtotime($row['dc']));
                                                    $duFormatted = date("F jS, Y h:ia",strtotime($row['du']));
                                                    $du = $row['du'];
                                                $status = $row['status'];
                                                    $fname = $row['fname'];
                                                    $lname = $row['lname'];
                                                    $name = $fname." ".$lname;
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
                                                                <a class="dropdown-item" href="<?= $adminURL ?>teachers?id=<?= $row['id'] ?>&edit-teacher&min"><i class="bx bx-edit me-1 text-black"></i>Edit</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>teachers?id=<?= $row['id'] ?>&dact-teacher"><i class="bx bx-x me-1 text-black"></i>Deactivate</a>
                                                                <?php elseif($status == 'pending' || 'inactive'): ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>teachers?id=<?= $row['id'] ?>&del-teacher"><i class="bx bx-trash me-1 text-black"></i>Delete</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>teachers?id=<?= $row['id'] ?>&act-teacher"><i class="bx bx-check-square me-1 text-black"></i>Activate</a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    <td class="text-center"><?= $name; ?></td>
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
