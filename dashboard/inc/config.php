<?php
// App Config
// Environment [development, live]
$app_config = [
    'env'=>'dev',
    'today'=>date("Y-m-d"),
	'prompt' => false,
	'promptMsg' => "",
	'promptType' => ""
];


//Base url
$baseURL = ($app_config['env'] != 'dev') ? "" : "http://localhost/projects/baptist-high/";
$adminURL = $baseURL."dashboard/";
$userURL = $baseURL."user/";
$uploadsURL = $adminURL."uploads/";


const DB_HOST = 'localhost';
if($app_config['env'] != 'dev'){
    define("USER", "");
    define("PWD", "");
    define("DB", "");
}
else{
    define("USER", "root");
    define("PWD", "");
    define("DB", "bh_db");

    # error logs enable/disable
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

$dbCon = mysqli_connect(DB_HOST, USER, PWD, DB);
$smsg = $emsg = $imsg = "";
$errs = [];




// $host = 'localhost';
// $user = 'root';
// $pwd = '';
// $db = 'bh_db';

// $con = mysqli_connect($host, $user, $pwd, $db);

include("methods.php");




?>
