<?php
session_start();

$loginUrl = $adminURL.'login';
if(isset($_SESSION['msmAdmin'])){
    $uId = $_SESSION['msmAdmin'];
    $q = dbSelect('administrators',"*","id=$uId");
    $userData = mysqli_fetch_array($q);
    $cuUserName = $userData['username'];
    $cuUserID = $userData['userID'];
    $cuFName = $userData['fname'];
    $cuLName = $userData['lname'];
    $cuEmail = $userData['email'];
    $cuPhone = $userData['phone'];
    $cuCountry = $userData['country'];
    $cuState = $userData['state'];
    $cuGender = $userData['gender'];
    $cuBio = $userData['bio'];
    $cuDesignation = $userData['designation'];
    $cuAddress = $userData['address'];
    $cuPassword = $userData['password'];
    $cuImage = $userData['image'];
    $cuFbURL = $userData['fbURL'];
    $cuTwURL = $userData['twURL'];
    $cuLkURL = $userData['lkURL'];
    $cuIgURL = $userData['igURL'];
    
    $cuDC = $userData['dc'];
    $cuDU = $userData['du'];
    $cuStatus = $userData['status'];
    
    $cuRoleId = $userData['role'];
    $cuRole = getDBCol('roles',$cuRoleId);
}
 else{
     $url = $adminURL.'redirect?dir=not_logged_in';
     header("Location: $url");
}
