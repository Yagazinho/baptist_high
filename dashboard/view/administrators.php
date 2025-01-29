<?php
include("../inc/config.php");

define("TITLE", "Administrators");
define("HEADER", "Manage Administrators");
define("BREADCRUMB", "administrators");

include('../inc/head.php'); 

// page level scripts
$pageURL = $adminURL."administrators";

include '../inc/logics/administrators.php';
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
                            <?php if(isset($_GET['add-administrator'])):?>
                            <div class="card border-0 shadow-lg">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline"><?= (isset($cardTitle)) ? $cardTitle : "Add New"?></h6>
                                    <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                </div>
                                <div class="card-body">
                                    <form action="" class="form form-vertical" method="post">
                                        <div class="add-administrator">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="form-floating">
                                                        <input type="text" id="userName" placeholder="Username *" value="<?= isset($_POST['userName']) ? $_POST['userName'] : '' ?>" class="form-control" name="userName">
                                                        <label for="userName">Username</label>
                                                    </div>
                                                    <?php if(isset($userNameError)): ?><span class="text-danger"><?= $userNameError ?></span><?php endif ?>
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
                                                        <select name="role" id="userRole" class="form-select">
                                                        <?php
                                                            $q = mysqli_query($dbCon, "SELECT * FROM roles");
                                                             while($row = mysqli_fetch_array($q)){
                                                         ?>
                                                            <option <?php if(isset($_POST['role']) && $_POST['role'] == $row['id']){echo 'selected' ;} ?> value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="userRole">Role</label>
                                                    </div>        
                                                    <?php if(isset($roleError)):?><span class="text-danger"><?= $roleError?></span><?php endif ?>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="my-4">
                                                <button type="submit" name="addAdministrator" class="btn btn-md btn-success text-white ">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endif ?>
                            <?php if(isset($_GET['edit-administrator'])):?>
                            <div class="card border-0 shadow-lg px-2 py-3">
                                <div class="card-header border-0">
                                    <h6 class="card-title d-inline">Edit Administrator <span class="bg-theme ms-1"><?= $userName?></span>
                                        <a href="<?= $pageURL ?>" class=""><i class="bx bx-x text-danger float-end"></i></a>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <form action="" class="form form-vertical" method="post">
                                        <div class="edit-administrator">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" id="username" placeholder="" value="<?= isset($_POST['userName']) ? $_POST['userName'] : $userName ?>" class="form-control mt-2" name="userName">
                                                            <label for="username">Edit Username</label>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($userNameError)){echo $userNameError;} ?></span>
                                                    </div>
                                                </div>
                                            <div class="my-1">
                                                <button type="submit" name="updateAdministrator" class="btn btn-md btn-primary text-white">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="" class="form form-vertical" method="post">
                                        <div class="edit-email">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <input type="text" id="email" placeholder="" value="<?= isset($_POST['email']) ? $_POST['email'] : $dbEmail ?>" class="form-control mt-2" name="email">
                                                            <label for="email">Email</label>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($emailError)){echo $emailError;} ?></span>
                                                    </div>
                                                </div>
                                            <div class="my-1">
                                                <button type="submit" name="updateEmail" class="btn btn-md btn-primary text-white">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="" class="form form-vertical" method="post">
                                        <div class="edit-role">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-floating">
                                                            <select name="role" id="userRole" class="form-select">
                                                                <?php 
                                                                $q = mysqli_query($dbCon, "SELECT * FROM roles");
                                                                while($row = mysqli_fetch_array($q)){
                                                                ?>
                                                                <option <?php if(isset($_POST['role']) && $_POST['role'] == $row['id'] || $dbRole == $row['id']){echo 'selected' ;} ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label for="userRole">Role</label>
                                                        </div>
                                                        <span class="text-danger"><?php if(isset($emailError)){echo $emailError;} ?></span>
                                                    </div>
                                                </div>
                                            <div class="my-1">
                                                <button type="submit" name="updateRole" class="btn btn-md btn-primary text-white">Update</button>
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
                                        <a href="<?= $pageURL ?>?add-administrator&min" class="btn btn-theme btn-sm"><i class="bx bx-plus"></i></a>
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
                                                    <th class="text-center"><i class="bx bx-toggle-left"></i></th>
                                                    <th class="text-center">username</th>
                                                    <th class="text-center">email</th>
                                                    <th class="text-center">role</th>
                                                    <th class="text-center">dc</th>
                                                    <th class="text-center">du</th>
                                                    <th class="text-center">status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($dbCon, "SELECT * FROM administrators");
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
                                                                <a class="dropdown-item" href="<?= $adminURL ?>administrators?id=<?= $row['id'] ?>&edit-administrator&min"><i class="bx bx-edit me-1 text-black"></i>Edit</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>administrators?id=<?= $row['id'] ?>&dact-administrator"><i class="bx bx-x me-1 text-black"></i>Deactivate</a>
                                                                <?php else: ?>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>administrators?id=<?= $row['id'] ?>&del-administrator"><i class="bx bx-trash me-1 text-black"></i>Delete</a>
                                                                <a class="dropdown-item" href="<?= $adminURL ?>administrators?id=<?= $row['id'] ?>&act-administrator"><i class="bx bx-check-square me-1 text-black"></i>Activate</a>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    </td>
                                                    <td class="text-center"><?= $row['username']?></td>
                                                    <td class="text-center"><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></td>
                                                    <td class="text-center"><?= getDBCol('roles',$row['role'])?></td>
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
