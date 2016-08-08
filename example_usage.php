<?php

session_start();
include_once 'dbconnect.php';
include_once 'home.php';
if(!isset($_SESSION['user']))
{
    ?><script>alert("session not created")</script><?php   
    //header("Location: index.php");
}?>
    
<?php
//Include the library
require_once 'PHP-AES-File-Encryption-master/AESCryptFileLib.php';

//Include an AES256 Implementation
require_once 'PHP-AES-File-Encryption-master/aes256/MCryptAES256Implementation.php';
//echo "".$myfile;
   
$keyfi= $_SESSION['key'];
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$myname=$userRow['username'];
$mymail=$userRow['email'];

//file id 
//$file_query="select * from filelist where rec_id='".$_SESSION['user']."'";
/*$file_res = mysqli_query($con, $file_query);
$file_Row=mysqli_fetch_array($res);
$file_name=$file_Row['file_name'];*/

//Construct the implementation
$mcrypt = new MCryptAES256Implementation();

//Use this to instantiate the encryption library class
$lib = new AESCryptFileLib($mcrypt);

//This example encrypts and decrypts the README.md file
$file_to_encrypt = "PHP-AES-File-Encryption-master/files/".$myfile;
$encrypted_file = "PHP-AES-File-Encryption-master/efiles/".$myfile.".aes";
$decrypted_file = "PHP-AES-File-Encryption-master/dfiles/".$myfile;

//Ensure target file does not exist
@unlink($encrypted_file);
//Encrypt a file
  //  $_SESSION['key'] =  rand(0, 10000000000);
$lib->encryptFile($file_to_encrypt, $_SESSION['key'], $encrypted_file);

//Ensure file does not exist
@unlink($decrypted_file);
//Decrypt using same password

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
$mail->Subject = 'Security Key';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->Body = 'Your Key is:'.$_SESSION['key'] ;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: "/* . $mail->ErrorInfo*/;
} else {
    echo "Message sent!";
}?>
    <form method="post">
    <label>Enter Key:</label>
    <input type="password" name="key1"/>
    <button type="submit" name="sub" onclick="mysubfun()">Submit</button>
    </form>
   
    <script>
        function mysubfun(){
             <?php
if(isset($_POST['sub'])){
    $key1 = mysql_real_escape_string($_POST['key1']);
    echo $key1."\t".$keyfi;
    if($key1==$keyfi){
    $lib->decryptFile($encrypted_file, $keyfi, $decrypted_file);
   // echo '<script>alert("file decripted")</script>';
    echo '<a href=\"PHP-AES-File-Encryption-master\dfiles\"'.$myfile.'>File Link</a>';
    }
    else{
        echo "key is wrong";
        $leaker1=$userRow['username'];
        $l_query="INSERT INTO leakfile(my_sender,leaker,my_file) VALUES('$sender1','$leaker1','$myfile')";
       $leak_result=  mysqli_query($con, $l_query);
       if($leak_result){
           echo "insert scuuess";
       }
       else{
           echo "fail";
       }
    }
}?>
        }
    </script>