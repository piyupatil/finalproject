<?php
session_start();
include_once 'dbconnect.php';
error_reporting(E_ALL ^ E_WARNING); 
if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$myname=$userRow['username'];
$res=  mysqli_query($con,"select pic from users where user_id=".$_SESSION['user']);
$userRow1=  mysqli_fetch_assoc($res);

if(isset($_POST['submit1']))
{
    
        
 $nemail = mysqli_real_escape_string($con,$_POST['nemail']);
 $ncontact = mysqli_real_escape_string($con,$_POST['ncontact']);
 $oldpass = (mysqli_real_escape_string($con,$_POST['oldpass']));
 $newpass = (mysqli_real_escape_string($con,$_POST['newpass']));
 $repass = (mysqli_real_escape_string($con,$_POST['repass'])); 
 $image=addslashes($_FILES['pic']['tmp_name']);
 $name=addslashes($_FILES['pic']['name']);
 $image=file_get_contents($image);
 $image=base64_encode($image);

 
 if($_POST['nemail']=="")
    {
        $nemail=$userRow['email'];
    }
    if($_POST['ncontact']=="")
    {
        $ncontact=$userRow['contact'];
    }
    if($_POST['oldpass']=="")
    {
        $oldpass=$userRow['password'];
    }
    if($_POST['newpass']=="")
    {
        $newpass=$userRow['password'];
        $repass=$userRow['password'];
    }
    if (is_uploaded_file($_FILES['pic']['tmp_name'])) {
        $query2="Update users SET pic='$image' WHERE username='$myname'";
        $result1=mysqli_query($con,$query2);
    /*    if($result1){
       ?>
        <script>alert('image changed');</script>
        
        <?php
    }
    
    else{
        ?>
        <script>alert('image not changed');</script>
        
        <?php  }*/
       // $image=$userRow['pic'];
    }
 
    if($userRow['password']==$oldpass)
{
    $query="Update users SET email='$nemail' , contact='$ncontact' , password='$newpass' WHERE username='$myname' ";
    // $query="Update users SET pic='$image' WHERE username='$myname'";
        $result1=mysqli_query($con,$query);
    if($result1){
       ?>
        <script>alert('profile changed');</script>
        
        <?php
    }
    
    else{
        ?>
        <script>alert('profile not changed');</script>
        
        <?php  }
}
header("Refresh:0");
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script src="bootstrap/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">
          <h2>Data Leakage System</h2></a>
    </div>
    <div>
      <ul class="nav navbar-nav nav-pills">
          <li ><a href="home.php">Inbox</a></li>
          <li><a href="sent.php">Sent</a></li>
        <li><a href="leaked.php">Leaked</a></li>
       <li class="active"><a href="accinfo.php">Profile</a></li>
     </ul>
    </div>
  </div>
</nav><br/>
       <div class="col-lg-3 thumbnail" align="center">
        <?php
        echo '<img class="img-circle" src="data:image;base64,'.$userRow1['pic'].'">';
        ?>
        <h3><?php echo $userRow['username']?></h3>
        <a href="accinfo.php"> <button class="btn btn-primary">My Account</button></a><br><br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br><br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="#">
                    
                    <div class="form-group">
                        <p>E-mail:</p>
                        <input class="form-control" type="email" name="nemail" placeholder=<?php echo $userRow['email']?> >
                    </div>
                    <div class="form-group">
                        <p>Contact:</p>
                        <input class="form-control" name="ncontact" placeholder=<?php echo $userRow['contact']?>>
                    </div>
                <div class="form-group">
                        <p>Old Password:</p>
                        <input class="form-control" type="password" name="oldpass">
                </div>
                <div class="form-group">
                        <p>New Password:</p>
                        <input class="form-control" type="password" name="newpass">
                </div>
                <div class="form-group">
                        <p>Re-enter Password:</p>
                        <input class="form-control" type="password" name="repass">
                </div>
    <div class="form-group">
        <p>Profile Pic:</p>
          <input type=file class="form-control" id="pic" name="pic"/>
      
    </div>
                        <button class="form-control btn btn-primary" name="submit1">Submit</button>
                    
                </form>
       
        </div>
</body>
</html>
