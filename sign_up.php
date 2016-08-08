<?php
session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $email = mysql_real_escape_string($_POST['email']);
 $contact = mysql_real_escape_string($_POST['contact']);
 $upass = (mysql_real_escape_string($_POST['pass']));
 /*$imgdata=mysql_real_escape_string($_FILES['pic']['tmp_name']);
 $imgname=mysql_real_escape_string($_FILES['pic']['name']);
 $imgtype=mysql_real_escape_string($_FILES['pic']['type']);
*/
 $image=addslashes($_FILES['pic']['tmp_name']);
 $name=addslashes($_FILES['pic']['name']);
 $image=file_get_contents($image);
 $image=base64_encode($image);
//$scpass=  mysql_real_escape_string($_POST['sc_pass']);
    $query="INSERT INTO users(username,email,contact,password,pic) VALUES('$uname','$email','$contact','$upass','$image')";
        $result1=mysqli_query($con,$query);
    if($result1){
       ?>
        <script>alert('successfully registered ');</script>
        
        <?php
 }
    
    else{
        echo "<br>img is not uploaded";
    }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <script src="bootstrap/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
         <h1>Data Leakage Module</h1>
            
            <div class="col-lg-2"></div>
            <div class="col-lg-8" align="center">
            <div class="thumbnail">
                <h2>Login Here</h2>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
          <input type=text class="form-control" placeholder="Enter name" name="uname"/>
      </div>
    </div>
                
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control"  placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Contact:</label>
      <div class="col-sm-10">
          <input type=number class="form-control" id="contact" placeholder="Enter contact" name="contact">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Profile Pic:</label>
      <div class="col-sm-10">
          <input type=file class="form-control" id="pic" name="pic"/>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass">
      </div>
    </div>
	<div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Reenter Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pass1" />
      </div>
        </div>
      
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="btn-signup">Submit</button>
      </div>
                </div></form>
                <h3><a href="index.php">Back to Login</a></h3>
           
            </div> 
               
            </div>
    
            <div class="col-lg-2"></div>
    </body>
</html>