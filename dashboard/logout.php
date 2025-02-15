<?php
include 'inc/config.php';
$url = $adminURL.'redirect?dir=logout';
header("Location: $url");
