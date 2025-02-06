<?php

global $mail;
require "config.php";
if(!isset($replyToEmail)){ $replyToEmail = "No Reply" ; }
if(!isset($replyToName)){ $replyToName = "My School Manager Pro" ; }

$mail->Sender=$adminMail;
$mail->setFrom($adminMail);
$mail->addAddress($targetEmail);
$mail->addReplyTo($replyToEmail, $replyToName);
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = "
<body style='background-color: whitesmoke; padding: 10px; border: none;font-family:;'>
    <div class='shadow rounded-lg'>
    <div style='margin:0px 10px 30px 10px;'>
    <h3 style= 'color:#21325b; font-size:16px; margin-bottom: 0; padding-top: 10px;'>Hello $targetName</h3>
    </div>
    <div style='margin: 0px 10px 0px 10px; display: inline-block; justify-content: center; line-height: 30px;'>
    <p style='font-size:13px;'>
    $body
    </p>
    </div>
    <div style='margin-top: 20px; border-top: 1px solid #1162DB'>
    <h3 style='margin:5px 10px 5px 10px;'>School Manager Admin</h3>
    </div>
    </div>
</body>
";

$mail->AltBody = "
Hi $targetName,

$altBody

My School Manager Admin
";

if(!$mail->send()){
    $emsg = "Email could not be sent due to this error -> ".$mail->ErrorInfo;
}