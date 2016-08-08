<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user']))
{
 
    ?><script>alert("session not created")</script><?php
    header("Location: index.php");
}

//Include the library
require_once 'PHP-AES-File-Encryption-master/AESCryptFileLib.php';

//Include an AES256 Implementation
require_once 'PHP-AES-File-Encryption-master/aes256/MCryptAES256Implementation.php';
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$myname=$userRow['username'];
$mymail=$userRow['email'];

//file id 
$file_query="select * from filelist where rec_id='".$_SESSION['user']."'";
$file_res = mysqli_query($con, $file_query);
/*$file_Row=mysqli_fetch_array($res);
$file_name=$file_Row['file_name'];
echo $GLOBALS['myf'];*/

function myfun(){
    ?><script>alert("u r in myfun")</script><?php
//Construct the implementation
$mcrypt = new MCryptAES256Implementation();

//Use this to instantiate the encryption library class
$lib = new AESCryptFileLib($mcrypt);

//This example encrypts and decrypts the README.md file
$file_to_encrypt = "PHP-AES-File-Encryption-master/files/".$myfile;
$encrypted_file = "PHP-AES-File-Encryption-master/files/".$myfile.".aes";
$decrypted_file = "PHP-AES-File-Encryption-master/files/".$myfile.".decrypted.txt";

//Ensure target file does not exist
@unlink($encrypted_file);
//Encrypt a file
$GLOBALS['key']=  rand(0, 10000000000);
$lib->encryptFile($file_to_encrypt, $GLOBALS['key'], $encrypted_file);

//Ensure file does not exist
@unlink($decrypted_file);
//Decrypt using same password

//mailer
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
$mail->Body = 'Your Key is:'.$GLOBALS['key'] ;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: "/* . $mail->ErrorInfo*/;
} else {
    echo "Message sent!";
}}?>
    
<?php
if(isset($_POST['sub'])){
$lib->decryptFile($encrypted_file, $GLOBALS['key'], $decrypted_file);
echo "Done";
}?>

<?php 
//from home

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title><!--
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><link rel="stylesheet" href="style.css" />
--></head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">
          <h2>Data Leakage System</h2></a>
    </div>
    <div>
      <ul class="nav navbar-nav ">
          <li class="active"><a href="home.php">Inbox</a></li>
          <li><a href="sent.php">Sent</a></li>
        <li><a href="leaked.php">Leaked</a></li>
        <li><a href="account.php">Edit Profile</a></li>
     </ul>
    </div>
  </div>
</nav><br/>
    <div class="col-lg-3 thumbnail" align="center">
        <?php
            echo '<img class="img-circle" src="data:image;base64,'.$userRow['pic'].'">';
        ?>
        <h3><?php echo $userRow['username']?></h3>
        <a href="account.php"> <button class="btn btn-primary">My Account</button></a><br><br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br><br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
 <?php
            if (mysqli_num_rows($file_res) > 0) {?>
           <table class="table table-stripped" cellspacing="2">
           <tr><th>Sender</th><th>Time</th><th>File Name</th><th>Download</th></tr>
   <?php while($row = mysqli_fetch_assoc($file_res)) {
       $my_key=$row['f_key'];
        $myfile=$row['file_name'];
        $sender1 = $row['sender_name'];?>
        
        <tr><td><?php echo $row["sender_name"]?></td>
            <td><?php echo $row["c_time"]?></td>
            <td><?php echo $row["file_name"]?></td>
            <td><button type="button" class="btn btn-info" id="downloadfile" onclick="downloadfile()">Download</button></td></tr>
            <?php }?>
            </table>
            <?php }
            else{
                echo "0 results";
            }?>
        </div>
     
<script>
                function downloadfile(){
                    <?php myfun()?>
                            
                var d_key =prompt("Enter file key","");
                <?php
                          echo "var my_key = ".json_encode($GLOBALS['key'])."; ";
                      ?>
                      if(d_key==my_key)
                      {
                          alert("file key is correct");
                      }
                      else
                      {
                          alert ("file key is wrong");
                          <?php
                          
                          $leaker1 = $userRow['username'];
                         // $file_name= $row["file_name"];
                          $l_query = "INSERT INTO leakfile(my_sender,leaker,my_file) VALUES('$sender1','$leaker1','$myfile')";
                        //  $l_query="INSERT INTO leakfile(sender,leaker,file_name) VALUES('nisha','pallavi','ToShantanuSQLInjection.txt')";
                          $result1=mysqli_query($con,$l_query);
                         /* if($result1){
                                echo "<br>data inserted successfully into leakfile";}
                          else{
                              echo "<br>data not inserted successfully into leakfile";
                          }*/
                          ?>

                          
                      }
                
                }
            </script>

</body>
</html>