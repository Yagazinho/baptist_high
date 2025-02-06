<?php

$adminMail = "chikezieyagazie74@gmail.com";
$adminPwd = "Eof8kT!nJ!#_";

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = "mail.helpmanscs.pro";
$mail->SMTPAuth = true;
$mail->Username = $adminMail;
$mail->Password = $adminPwd;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;