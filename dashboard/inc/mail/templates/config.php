<?php

$adminMail = "chikezieyagazie74@gmail.com";
$adminPwd = "Eof8kT!nJ!#_";

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = $adminMail;
$mail->Password = $adminPwd;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;