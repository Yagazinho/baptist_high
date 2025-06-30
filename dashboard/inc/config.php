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

//$authPage = false;

//Base url
$baseURL = ($app_config['env'] != 'dev') ? "" : "https://localhost/projects/baptist-high/baptist-high/";
$adminURL = $baseURL."dashboard/";
$userURL = $baseURL."user/";
$uploadsURL = $adminURL."uploads/";
$clientBase = "https://localhost/projects/baptist-high/baptist-high/";


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
$now = date("Y-m-d h:i");
$defPwd = '';

$adminDefaultImg = 'default.png';

// APP CONSTANTS
const APP_NAME = "My School Manager";


include("methods.php");

$studentTypeId = getColumnValNoID("user_types", "LCASE(name) LIKE 'stude%'", 'id');
$parentTypeId = getColumnValNoID("user_types", "LCASE(name) LIKE 'paren%'", 'id');
$teacherTypeId = getColumnValNoID("user_types", "LCASE(name) LIKE 'teach%'", 'id');
$accountantTypeId = getColumnValNoID("user_types", "LCASE(name) LIKE 'accountan%'", 'id');
$librarianTypeId = getColumnValNoID("user_types", "LCASE(name) LIKE 'libraria%'", 'id');



?>
