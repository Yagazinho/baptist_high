<?php
include("../inc/config.php");

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
                                <img src="" alt="" class="rounded-circle">
                                <h2></h2>
                                <h3></h3>

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
                                    <a href="" class="nav-link">Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">Edit Info</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">Edit Image</a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">Change Password</a>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="d-flex justify-content-end">
                                    <p class="text-info">Recent Updates</p>
                                </div>
                                <?php include "../inc/alerts.php"; ?>

                                <div class="tab-pane fade show active">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic"></p>

                                    <h5 class="card-details">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">State of Origin</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Designation</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Gender</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Country</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active">

                                <form action="" method="post">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img src="" alt="">
                                            <div class="pt-2">
                                                <a href="" class="btn-primary btn-sm" title="Upload new profile image"><i class="bx bx-upload"></i></a>
                                                <a href="" class="btn-danger btn-sm" title="Reset Image to default"><i class="bx bx-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">About</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">State of Origin</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fName" type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="gender" id="" class="form-select">
                                                <option selected value="">please choose</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fName" class="col-md-4 col-lg-3 col-form-label">Country</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select name="country" id="" class="form-select">
                                                <option selected value="">please choose</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="address" type="text" class="form-control" id="Address" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="phone" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="text" class="form-control" id="email" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="twitter" type="text" class="form-control" id="twitter" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="facebook" type="text" class="form-control" id="facebook" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="linkedin" class="col-md-4 col-lg-3 col-form-label">LinkedIn Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="linkedin" type="text" class="form-control" id="linkedin" value="">
                                        </div>
                                    </div>

                                    
                                    <div class="row mb-3">
                                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="instagram" type="text" class="form-control" id="instagram" value="">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" name="updateInfo" class="btn btn-primary">Save Changes</button>
                                    </div>
                                 </form>
                                </div>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col-md-7">
                                            <label for="">Profile Image <span class="text-info">jpg/png files expected not more than 600kb</span></label>
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control form-control-lg">
                                                <button class="btn btn-primary btn-lg" name="updateImage" type="submit"></button>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="img-preview-box rounded shadow-sm p-3 d-inline-block">
                                                <img src="" alt="" class="imgPreviewBox img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show active pt-3">
                                <form action="" method="post">

                                <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>

                                <div class="col-md-8 col-lg-9">
                                    <div class="input-group">
                                        <input type="password" name="currentPassword" class="form-control" id="currentPassword">
                                        <button id="show" class="btn btn-light"><i class="bx bx-hide"></i></button>
                                        <button id="hide" class="btn btn-light"><i class="bx bx-show"></i></button>
                                    </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>

                                    <div class="col-md-8 col-lg-9">
                                        <div class="input-group">
                                        <input type="password" name="newPassword" class="form-control" id="newPassword">
                                        <button id="show" class="btn btn-light"><i class="bx bx-hide"></i></button>
                                        <button id="hide" class="btn btn-light"><i class="bx bx-show"></i></button>
                                         </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword2" class="col-md-4 col-lg-3 col-form-label">Retype New Password</label>

                                    <div class="col-md-8 col-lg-9">
                                        <div class="input-group">
                                            <input type="password" name="newPassword2" class="form-control" id="newPassword2">
                                            <button id="show" class="btn btn-light"><i class="bx bx-hide"></i></button>
                                            <button id="hide" class="btn btn-light"><i class="bx bx-show"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="updatePassword" class="btn btn-primary">Change Password</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</section>

	</main><!-- End #main -->

	<?php include('../inc/footer.php'); ?>
	<?php include('../inc/foot.php'); ?>
