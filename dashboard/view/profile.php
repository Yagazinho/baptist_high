<?php
include "../inc/config.php";
include "../inc/auth.php";

define("TITLE", "Profile");
define("HEADER", "Profile");
define("BREADCRUMB", "profile");


// page level scripts
$pageURL = $adminURL."profile";

include '../inc/logics/profile.php';

include('../inc/head.php'); 
?>


<body>
<?php include('../inc/header.php'); ?>


	<main id="main" class="main">
	<?php include('../inc/pagetitle.php'); ?>

		<section class="section profile">
            <div class="card">
                <div class="card-body overflow-auto pt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="<?= $uploadsURL ?>images/administrators/<?= $cuImage ?>" alt="Profile" class="rounded-circle">
                            <h2><?= strtoupper($cuUserName) ?></h2>
                            <h3><?= ucfirst($cuRole) ?></h3>

                                <div class="social-links mt-2">
                                    <a href="" class="twitter"></a>
                                    <a href="" class="facebook"></a>
                                    <a href="" class="linkedin"></a>
                                    <a href="" class="instagram"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <a href="<?= $adminURL ?>profile?vw=overview" class="nav-link <?php if(isset($_GET['vw']) && $_GET['vw'] == 'overview'){ echo 'active'; } ?>">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $adminURL ?>profile?vw=e-info" class="nav-link <?php if(isset($_GET['vw']) && $_GET['vw'] == 'e-info'){ echo 'active'; } ?>" >Edit Info</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $adminURL ?>profile?vw=e-image" class="nav-link <?php if(isset($_GET['vw']) && $_GET['vw'] == 'e-image'){ echo 'active'; } ?>">EditImage</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= $adminURL ?>profile?vw=c-pwd" class="nav-link <?php if(isset($_GET['vw']) && $_GET['vw'] == 'c-pwd'){ echo 'active'; } ?>">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="d-flex justify-content-end">
                                    <p class="text-info">Recent Updates</p>
                                </div>
                                <?php include "../inc/alerts.php"; ?>

                   
                                <?php if(isset($_GET['vw']) && $_GET['vw'] == 'overview'): ?>
                            <div class="tab-pane fade show active pt-3">
                                <h5 class="card-title">About</h5>
                                <p class="small fst-italic text-bl"><?= $cuBio ?></p>

                                <h5 class="card-title">Profile Details</h5>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= $cuFName." ".$cuLName ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Designation</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= getDBCol('designations',$cuDesignation) ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= getDBCol('genders',$cuGender) ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Nationality</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= getDBCol('countries',$cuCountry) ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= $cuAddress ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= $cuPhone ?></div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8 text-bl"><?= $cuEmail ?></div>
                                </div>

                            </div>
                            <?php endif ?>

                            <?php if(isset($_GET['vw']) && $_GET['vw'] == 'e-info'): ?>
                            <div class="tab-pane fade show active pt-3">

                                <!-- Profile Edit Form -->
                                <form action="" method="post">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="<?= $uploadsURL ?>images/administrators/<?= $cuImage ?>" width="100" alt="Profile">
                                            <div class="pt-2">
                                                <a href="<?= $adminURL ?>profile?vw=e-image" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                                <?php if($cuImage != $adminDefaultImg): ?>
                                                <a href="<?= $adminURL ?>profile?vw=e-info&do=reset-image" class="btn btn-danger btn-sm" title="Reset image to default"><i class="bi bi-trash"></i></a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="<?= $cuFName ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="lName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="lName" type="text" class="form-control" value="<?= $cuLName ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="about" class="col-md-4 col-lg-3 col-form-label">Bio</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="bio" class="form-control" id="about" style="height: 100px"><?= $cuBio ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="designation" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="designation"  class="form-select">
                                                <option value="">Select Designation</option>
                                                <?php
                                                $q = dbSelect('designations',"*","status='active'");
                                                while($row=mysqli_fetch_array($q)){
                                                ?>
                                                <option <?php if($cuDesignation == $row['id']) {echo 'selected'; } ?> value="<?= $row['id']?>"><?= $row['name']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3  col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="gender">
                                                <option selected="">Please Choose</option>
                                                <?php
                                                $q = dbSelect('genders',"*","status='active'");
                                                while($row=mysqli_fetch_array($q)){
                                                ?>
                                                <option <?php if($cuGender == $row['id']){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3  col-form-label">Nationality</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="country">
                                                <option selected="">Please Choose</option>
                                                <?php
                                                $q = dbSelect('countries',"*","status='active'");
                                                while($row=mysqli_fetch_array($q)){
                                                ?>
                                                <option <?php if($cuCountry == $row['id']){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-md-4 col-lg-3  col-form-label">State of Origin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" name="state">
                                                <option selected="">Please Choose</option>
                                                <?php
                                                $q = dbSelect('states',"*","status='active'");
                                                while($row=mysqli_fetch_array($q)){
                                                ?>
                                                <option <?php if($cuGender == $row['id']){ echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address" value="<?= $cuAddress ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone" value="<?= $cuPhone ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="<?= $cuEmail ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="text" class="form-control" id="Twitter" value="<?= $cuTwURL ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="Facebook" value="<?= $cuFbURL ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="text" class="form-control" id="Instagram" value="<?= $cuIgURL ?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedIn" type="text" class="form-control" id="LinkedIn" value="<?= $cuLkURL ?>">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="updateInfo" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>
                            <?php endif ?>

                            <?php if(isset($_GET['vw']) && $_GET['vw'] == 'e-image'): ?>
                            <div class="tab-pane fade show active pt-3">

                                <!-- Settings Form -->
                                <form action="" method="post" enctype="multipart/form-data">

                                    <div class="row mb-3">
                                        <div class="col-md-7">
                                            <label for="">Profile Image <span class="text-info">jpg/png expected not more than 500kb</span></label>
                                            <div class="input-group mb-3">
                                                <input type="file" name="userImage" class="form-control form-control-lg" onChange="doPreview(this);">
                                                <button class="btn btn-primary btn-lg" name="updateImage" type="submit"><?= ($cuImage == 'default.png') ? 'Upload' : 'Update' ?></button>
                                            </div>
                                            <?php if(isset($userImageError)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $userImageError ?></span><?php endif ?>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="img-preview-box rounded shadow-sm p-3 d-inline-block">
                                                <img src="<?= $uploadsURL ?>images/administrators/<?= $cuImage ?>" alt="" class="imgPreviewBox img-fluid rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>
                            <?php endif ?>

                            <?php if(isset($_GET['vw']) && $_GET['vw'] == 'c-pwd'): ?>
                            <div class="tab-pane fade show active pt-3">
                                <!-- Change Password Form -->
                                <form action="" method="post">

                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="password" type="password" class="form-control" id="currentPassword" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>">
                                                <button id="show" class="btn btn-light" type="button"><i class="bi bi-eye"></i></button>
                                                <button id="hide" class="btn btn-light" type="button"><i class="bi bi-eye-slash"></i></button>
                                            </div>
                                            <?php if(isset($passwordError)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $passwordError ?></span><?php endif ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="newPassword" type="password" class="form-control" id="newPassword" value="<?php if(isset($_POST['newPassword'])){ echo $_POST['newPassword']; } ?>">
                                                <button id="show2" class="btn btn-light" type="button"><i class="bi bi-eye"></i></button>
                                                <button id="hide2" class="btn btn-light" type="button"><i class="bi bi-eye-slash"></i></button>
                                            </div>
                                            <?php if(isset($newPasswordError)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $newPasswordError ?></span><?php endif ?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword2" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="input-group">
                                                <input name="newPassword2" type="password" class="form-control" id="newPassword2" value="<?php if(isset($_POST['newPassword2'])){ echo $_POST['newPassword2']; } ?>">
                                                <button id="show3" class="btn btn-light" type="button"><i class="bi bi-eye"></i></button>
                                                <button id="hide3" class="btn btn-light" type="button"><i class="bi bi-eye-slash"></i></button>
                                            </div>
                                            <?php if(isset($newPassword2Error)): ?><span class="d-inline-block bg-danger text-white px-2 rounded mt-1"><?= $newPassword2Error ?></span><?php endif ?>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="updatePassword" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
		</section>

	</main><!-- End #main -->

	<?php include('../inc/footer.php'); ?>
	<?php include('../inc/foot.php'); ?>
