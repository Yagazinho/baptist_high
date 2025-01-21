<?php

function formatStatus($status){
    if($status == 'active'){
        $color = 'success';
    }
    elseif($status == 'inactive'){
        $color = 'danger';
    }
    return $color;
}


function getDBCol($tbl, $id, $col = 'name'){
    global $dbCon;
    $q = mysqli_query($dbCon, "SELECT $col FROM $tbl WHERE id='$id'");
    $row = mysqli_fetch_array($q);
    return $row[$col];
}


function pageReload($time,$location){
    echo '<script> setTimeout(function() { window.location = "'.$location.'"; }, '.$time.'); </script>';
}

function changeStatus($tbl, $id, $newStatus){
    global $dbCon;
    $q = mysqli_query($dbCon, "UPDATE $tbl SET status='$newStatus', du=NOW() WHERE id=$id");
    if($q){return 'ok';}else{return 'fail';}
}
function dbDelete($table,$id){
    global $dbCon;
    $sql="DELETE FROM $table WHERE $id";
    $query = mysqli_query($dbCon,$sql);
    if($query){
        return 'success';
    }
    else{
        return 'error';
    }
}


function dbTruncate($table){
    global $dbCon;
    $query = mysqli_query($dbCon, "TRUNCATE TABLE $table");
    if($query){
        return 'success';
    }
    else{
        return 'error';
    }
}
 

?>
