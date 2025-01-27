<?php

function formatStatus($status){
    if($status == 'active'){
        $color = 'success';
    }
    elseif($status == 'pending'){
        $color = 'warning';
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


function dbSelect($table,$cols="*",$where = null, $order = null, $limit = null, $offset = null){
    global $dbCon;
    if ($where != null) {
        $sql="SELECT $cols FROM $table WHERE $where";
    }else{
        $sql="SELECT $cols FROM $table";
    }
    if($order != null){
        $sql .= ' ORDER BY '.$order;
    }
    if($limit != null){
        $sql .= ' LIMIT '.$limit;
    }
    if($offset != null){
        $sql .= ' OFFSET '.$offset;
    }

    $query = mysqli_query($conn,$sql);
    if($query){
        return $query;
    }
    else{
        return 'error';
    }
}

function preventDuplicateID($tbl,$idVal,$col='userID'){
    $q = dbSelect($tbl,$col,"$col='$idVal'");
    if(mysqli_num_rows($q) > 0){
        return 'exist';
    }
    else{
        return 'ok';
    }
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
