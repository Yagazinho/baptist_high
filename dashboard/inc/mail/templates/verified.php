<?php

global $mail;
require "config.php";

$mail->Sender=$adminMail;
$mail->setFrom($adminMail);
$mail->addAddress($targetEmail);
$mail->addReplyTo("No Reply", "My School Manager Admin");
$mail->isHTML(true);
$mail->Subject = "Account Verified Succesfully";
$mail->Body = "
<body style='background-color: whitesmoke; padding: 10px; border: none;font-family:;'>
    <div class='shadow rounded-lg'>
    <h3 style= 'color:#21325b; font-size:16px; margin-bottom: 0; padding-top: 10px;'>Hello $targetName</h3>
    </div>
    <div style='margin: 0px 10px 0px 10px; display: inline-block; justify-content: center; line-height: 30px;'>
    <p> Congrats on verifying your $tag account with My School Manager, below is your Access Credentials, this will enable you to have easy login subsequently.
    <pre>
    Username   :  $username
    Name       :  $targetName
    Email      :  $targetEmail
    Phone      :  $phone
    Password   :  <small>The password you used when creating your account</small>
    </pre>
    </p>
    </div>
    <div style='margin-top: 20px; border-top: 1px solid #1162DB'>
    <h3 style='margin-bottom: 0;'>My School Manager Admin</h3>
    </div>
</body>
";

$mail->AltBody = "
Hi $targetName,

Congrats on verifying your $tag account with My School Manager, below is your Access Credentials, this will enable you to have easy login subsequently.


Userame    :   $username
Name       :   $targetName
Email      :   $targetEmail
Phone      :   $phone
Password   :   The password you used when creating your account.

My School Manager Admin
";

if(!$mail->send()){
    $emsg = "Email could not be sent due to this error -> ".$mail->ErrorInfo;
}
