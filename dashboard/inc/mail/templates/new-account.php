<?php

global $mail;
require "config.php";

$mail->Sender=$adminMail;
$mail->setFrom($adminMail);
$mail->addAddress($targetEmail);
$mail->addReplyTo("No Reply", "School Manager Admin");
$mail->isHTML(true);
$mail->Subject = "Welcome To My School Manager";
$mail->Body = "
<body style='background-color: whitesmoke; padding: 10px; border: none;font-family:;'>
<div class='shadow rounded-lg'>
<div style='margin: 0px 20px 50px 20px;'>
<h3 style= 'color:#21325b; font-size:16px; color:#1162DB; margin-bottom: 0; padding-top: 20px;'>Hello $targetName</h3>
</div>
<div style='margin: 0px 20px 0px 20px; display:inline-block; justify-content: center; line-height: 30px;'>
<p style='font-size: 13px;'>
Congrats on Creating a $tag account with My School Manager, Kindly use the link below to verify and activate your
new
account, Also note that your login credentials will be sent to this email once you have verified your
account,
and you cannot create two $tag accounts
</p>
</div>
</div>
<div style='margin: 0px 20px 0px 20px;'>
<p style='padding: 8px; border-radius: 10px; width: 150px; background-color: #21325b;'>
<a href=' $verificationURL'
    style='font-size:18px;text-decoration: none; color: #fff; text-indent: 5px;'>Click here to verify</a>
</p>
</div>
<div style='margin-top: 60px; border-top: 1px solid #1162DB'>
<h3 style='margin: 10px 20px 10px 20px; font-style:italic;'>School Manager Admin</h3>
</div>
</body>

";

$mail->AltBody = "
Hi $targetName,

Congrats on Creating a $tag account with School Manager, Kindly use the link below to verify and activate your new account, Also note that your login credentials will be sent to this email once you have verified your account, and you cannot create two $tag accounts

$verificationURL

Fxeconomyy Admin
";

if(!$mail->send()){
    $smsg = "Congrats '$userName', You have been registered successfully as a $tag on ".APP_NAME;
}
