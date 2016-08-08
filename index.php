<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
$_SESSION['key']=  rand(0, 100000);
if(isset($_POST['btn-login']))
{
 $uemail = mysqli_real_escape_string($con,$_POST['uemail']);
 $upass = mysqli_real_escape_string($con,$_POST['pass']);
 $res=mysqli_query($con,"SELECT * FROM users WHERE email='$uemail'");
 $row=mysqli_fetch_array($res);
$passnew=$row['password'];
$useridnew=$row['user_id'];
    $passnew1=md5($upass);
    
   // echo "<script type='text/javascript'>alert('$uname.$upass.$passnew.$passnew1');</script>";
    
    
 if($row['password']==($upass))  //password que
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
        <?php
 }
 
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
                            <label>Email ID</label>
                            <input type="text" placeholder="name" name="uemail"/></div>
                        <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="password" name="pass"/><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn-login" class="btn btn-primary">Login</button></div>
                        <div class="form-group">
                            <label>No user Account??</label>
                            <a href="sign_up.php">Sign up</a></div>
                        <div class="form-group">
                            
                            <a href="forget_pass.php">Forget Password??</a></div>
                    </form>
            </div> 
            </div> 
            <div class="col-lg-4"></div>
    </body>
</html>
