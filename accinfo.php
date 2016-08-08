<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$id=$_SESSION['user'];
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id='$id'");
$userRow=mysqli_fetch_array($res);
$myname=$userRow['username'];
$mymail=$userRow['email'];
//$res1=  mysqli_query($con,"select pic from users where user_id='$id'");
//$userRow1=  mysqli_fetch_assoc($res1);

$query= "select * from filelist where rec_id=".$_SESSION['user'];
$res5= mysqli_query($con, $query);

?>





<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script><link rel="stylesheet" href="style.css" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="home.php">
          <h2>Data Leakage System</h2></a>
    </div>
    <div>
      <ul class="nav navbar-nav ">
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
            echo '<img class="img-circle" src="data:image;base64,'.$userRow['pic'].'">';
        ?>
        <h3><?php echo $userRow['username']?></h3>
        <a href="accinfo.php"> <button class="btn btn-primary">My Account</button></a><br><br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br><br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            <table class="table table-stripped" cellspacing="2">
                <tr>
                    <th>Name:</th>
                    <td><?php echo $userRow['username']?></td>
                </tr>
                <tr>
                    <th>email:</th>
                    <td><?php echo $userRow['email']?></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><?php echo $userRow['contact']?></td>
                </tr>
                
            </table>
            <form action="account.php" mrthod="post">
            <button type="submit" class="btn btn-info" >Edit Profile</button>
            </form>
        </div>     
</body>
</html>