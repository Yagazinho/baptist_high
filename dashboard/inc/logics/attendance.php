<?php

if(isset($_GET) && $_GET === 'vw-attendance'){
    
}


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
        array_push($errs, $attendanceTypeError = "Value expected");
    }
}


if(isset($_POST['submitAtt'])){
    include '../inc/auth.php';
    $classId = intval($_POST['class']);
    $sectionId = intval($_POST['section']);
    $attendanceType = intval($_POST['attendanceType']);
    $date = date('Y-m-d');
    
    
    if($classId == (0 || "")){
        array_push($errs, $classError = "Value expected");
    } 
    if($sectionId == (0 || "")){
        array_push($errs, $sectionError = "Value expected");
    }
    if($attendanceType == (0 || "")){
        array_push($errs, $attendanceTypeError = "Value expected");
    }
    
    
    $checkAttendance = mysqli_query($dbCon, "SELECT * FROM attendance WHERE date='$date' AND teacherID='$cuUserID' AND className=$classId AND classSection=$sectionId");
    
    if(mysqli_num_rows($checkAttendance) > 0){
        array_push($errs, $attendanceExistsError = "");
        $emsg = "Sorry, attendance has already been taken for this day";
    }
    if($classID != 0 && $sectionId != 0 && $attendanceType != 0){
    foreach($_POST['attendance'] as  $studentId => $status){
        $studentId = mysqli_real_escape_string($dbCon, $studentId);
        $status = mysqli_real_escape_string($dbCon, $_POST['attendance'][$studentId]);
    }
    if(count($errs) == 0){
        $q = mysqli_query($dbCon, "INSERT INTO attendance (teacherID, studentID, date, className, classSection, attendanceType, dc, status) VALUES ('$cuUserID','$studentId','$date',$classId,$sectionId,$attendanceType,'$now','$status')");
        
        if($q){
            $smsg = "Attendance saved successfully";
        }
        else{
            $emsg = "Something went wrong ".mysqli_error($dbCon);
        }
    }
    }
    else{
        $emsg = "Error, please make sure to select all fields";
    }
}
