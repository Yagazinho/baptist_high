<?php

function dbInsert($table,$param=array()){
    global $dbCon;
    $table_columns = implode(',', array_keys($param));
    $table_value = implode("','", $param);

    $query = mysqli_query($dbCon, "INSERT INTO $table($table_columns) VALUES('$table_value')");
    if($query){
        return 'success';
    }
    else{
        return 'error';
    }
}

function logAction($msg, $user, $userType = 'admin', $color = 'success'){
    global $now;
    if(!empty($msg) && ($user != '' || $user > 0)){
        $q = dbInsert('act_logs',['user'=>$user, 'log'=>$msg, 'userType'=>$userType, 'color'=>$color, 'dc'=>$now]);
        if($q == 'success'){
            return 'logged';
        }
        else{
            return null;
        }
    }
    else{
        return null;
    }
}

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


function dbUpdate($table,$param=array(),$id){
    $args = array();
    global $dbCon;

    foreach ($param as $key => $value) {
        $args[] = "$key = '$value'";
    }

    $sql="UPDATE  $table SET " . implode(',', $args);

    $sql .=" WHERE $id";

    $query = mysqli_query($dbCon,$sql);
    if($query){
        return 'success';
    }
    else{
        return 'error '.mysqli_error($dbCon);
    }
}

function cntRows($tbl,$col,$where=null){
    global $dbCon;
    if($where != null)
        $q = mysqli_query($dbCon, "SELECT $col FROM $tbl WHERE $where");
    else
        $q = mysqli_query($dbCon, "SELECT $col FROM $tbl");
    
    if($q)
        return mysqli_num_rows($q);
    else
        return 0;
}

function getDBCol($tbl, $id, $col = 'name'){
    global $dbCon;
    $q = mysqli_query($dbCon, "SELECT $col FROM $tbl WHERE id='$id'");
    $row = mysqli_fetch_array($q);
    return $row[$col];
}

function getColumnValNoID($table,$where,$col='name'){
    global $dbCon;
    if (!empty($table) && !empty($where)) {
        $q = mysqli_query($dbCon,"SELECT $col FROM $table WHERE $where");
        if(mysqli_num_rows($q) > 0){
            $row = mysqli_fetch_array($q);
            return $row[$col];
        }
        else{
            return null;
        }
    }
    else{
        return null;
    }
}


function changeStatus($table, $id, $newStatus = 'active'){
    global $now;
    if(!empty($table) && !empty($id)){
        $q = dbUpdate($table,['status'=>$newStatus, 'du'=>$now],"id=".$id);
        if($q == 'success'){
            return 'changed';
        }
        else{
            return 'failed';
        }
    }
    else{
        return 'failed';
    }
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

    $query = mysqli_query($dbCon,$sql);
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

// function changeStatus($tbl, $id, $newStatus){
//     global $dbCon;
//     $q = mysqli_query($dbCon, "UPDATE $tbl SET status='$newStatus', du=NOW() WHERE id=$id");
//     if($q){return 'ok';}else{return 'fail';}
// }

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
