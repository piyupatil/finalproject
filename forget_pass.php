<?php
include_once 'dbconnect.php';
if(isset($_POST['change'])){
    
$res=mysqli_query($con,"SELECT * FROM users WHERE username='".$_POST['username']."'");
$userRow=mysqli_fetch_array($res);
$myname=$userRow['username'];
$mymail=$userRow['email'];
$mypass=$userRow['password'];
echo $myname.$mymail.$mypass;
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
require 'PHPMailer-master/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
//$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "patilpiyu1231996@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "piyu@6991";
//Set who the message is to be sent from
$mail->setFrom('patilpiyu1231996@gmail.com', 'Data leakage');
//Set an alternative reply-to address
$mail->addAddress($mymail, $myname);
//Set the subject line
$mail->Subject = 'Data Leakage Password';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body = 'Your Password is:'.$mypass;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: ". $mail->ErrorInfo;
} else {
    ?><script>alert("Password sent on your registered mail.")</script>
        <?php
}
//header("Location: http://localhost/DataLeakagefinal/index.php");
//exit;
}?>
<html>
    <head>
        <title>Data Leakage</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
           
                <h1>Data Leakage Module</h1>
            
            <div class="col-lg-4"></div>
            <div class="col-lg-4" align="center">
            <div class="thumbnail">
                <h2>Login Here</h2>
                <form role="form" method="post">
                        <div class="form-group">
                            <input type="text" name="username"/>
                            <input type="submit" name="change" value="change"/>    
                        </div>
                    </form>
            </div> 
            </div> 
            <div class="col-lg-4"></div>
    </body>
</html>