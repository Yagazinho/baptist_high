<?php
include("../inc/config.php");
include '../inc/auth.php';


define("TITLE", "Manage Attendance");
define("HEADER", "Manage Attendance");
define("BREADCRUMB", "attendance");

include('../inc/head.php'); 
// page level scripts
$pageURL = $adminURL."attendance";

include '../inc/logics/attendance.php';
?>

<body>
    <?php include('../inc/header.php'); ?>

    <?php include('../inc/aside.php'); ?>

    <main id="main" class="main">
        <?php include('../inc/pagetitle.php'); ?>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 d-flex px-3">
                            <h6 class="card-title">Create Attendance</h6>
                            <a href="<?= $pageURL ?>" class="card-title ms-auto"><i class="bi bi-arrow-clockwise"></i></a>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Class</label>
                                    <div class="col-sm-4">
                                        <select class="form-select" name="class">
                                            <option value="">--Select Class--</option>
                                            <?php
                                            $q = dbSelect('classes',"*","status='active'");
                                            while($row = mysqli_fetch_array($q)){
                                            ?>
                                            <option <?php if((isset($_POST['class']) && $_POST['class'] == $row['id'])){echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <span class="text-danger"><?php if(isset($classError)){echo $classError;} ?></span>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Class Section</label>
                                    <div class="col-sm-4">
                                        <select class="form-select" name="section">
                                            <option value="">--Select Class Section--</option>
                                            <?php
                                            $q = dbSelect('sections',"*","status='active'");
                                            while($row = mysqli_fetch_array($q)){
                                            ?>
                                            <option <?php if((isset($_POST['section']) && $_POST['section'] == $row['id'])){echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <span class="text-danger"><?php if(isset($sectionError)){echo $sectionError;} ?></span>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Attendance Type</label>
                                    <div class="col-sm-4">
                                        <select class="form-select" name="attendanceType">
                                            <option value="">--Select Attendance type--</option>
                                            <?php
                                            $q = dbSelect('attendance_types',"*","status='active'");
                                            while($row = mysqli_fetch_array($q)){
                                            ?>
                                            <option <?php if((isset($_POST['attendanceType']) && $_POST['attendanceType'] == $row['id'])){echo 'selected'; } ?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <span class="text-danger"><?php if(isset($attendanceTypeError)){echo $attendanceTypeError;} ?></span>
                                </div>
                                <a href="<?= $pageURL ?>?vw-attendance" type="submit" class="btn btn-md btn-success">Go</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php if(isset($_GET['vw-attendance'])): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header border-0 d-flex">
                            <h6 class="card-title d-inline">Mark Student Attendance</h6>
                            <a href="<?= $pageURL ?>" class="ms-auto"><i class="bi bi-x fa-2x text-danger"></i></a>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <input type="hidden" name="class" value="<?= $class ?>">
                                <input type="hidden" name="section" value="<?= $section ?>">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">student ID</th>
                                            <th class="text-center">Student Name</th>
                                            <th class="text-center">Class</th>
                                            <th class="text-center">Attendance Type</th>
                                            <th class="text-center">Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    if(isset($_POST['fetchStudents'])){
                                    $class = intval($_POST['class']);
                                    $section = intval($_POST['section']);
                                    $attendanceType = intval($_POST['attendanceType']);
                                         if($class == (0 || "")){
                                            array_push($errs, $classError = "Value expected");
                                         }
                                         if($section == (0 || "")){
                                            array_push($errs, $sectionError = "Value expected");
                                         }
                                         if($attendanceType == (0 || "")){
                                            array_push($errs, $attendanceTypeError = "");
                                             $emsg = "Value expected";
                                         }
                                        $no = 1;
                                        if(count($errs) == 0){
                                        $q = mysqli_query($dbCon, "SELECT * FROM students WHERE $class=class AND $section=sectionId");
                                            }
                                        if(mysqli_num_rows($q) == 0){ $emsg = "No Students found";}
                                        while($row = mysqli_fetch_assoc($q)){
                                            $fname = $row['fname'];
                                            $lname = $row['lname'];
                                            $studentName = $fname." ".$lname;
                                            $dbClassName = getDBCol("classes", $row['class'], "name");
                                            $dbSectionName = getDBCol("sections", $row['sectionId'], "name");
                                            $attType = getDBCol("attendance_types", $attendanceType);
                                            $fullClassName = $dbClassName.$dbSectionName;
                                            $studentId = $row['userId'];
                                        if($q){
                                            $smsg = "query successfully fetched";
                                        }else{
                                            $emsg = "something went wrong ".mysqli_error($dbCon);
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo($no++);?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo($studentId); ?>
                                                <input type="hidden" name="studentIds[]" value="<?= $studentId ?>">
                                            </td>
                                            <td class="text-center">
                                                <?php echo($studentName); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo($fullClassName); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo($attType); ?>
                                                <input type="hidden" name="attendanceType" value="<?= $attendanceType ?>">
                                            </td>
                                            <td class="text-center">
                                                <label for="pre-<?= $studentId ?>">Pre</label>
                                                <input type="radio" name="attendance[<?= $studentId ?>]" id="option1" value="present">
                                                <label for="abs-<?= $studentId ?>">abs</label>
                                                <input type="radio" name="attendance[<?= $studentId ?>]" id="option2" value="absent">
                                            </td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <button class="btn btn-primary btn-md float-end" type="submit" name="submitAtt">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif ?>
        </section>

    </main><!-- End #main -->

    <?php include('../inc/footer.php'); ?>
    <?php include('../inc/foot.php'); ?>
