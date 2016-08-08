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
$ares5=  mysqli_fetch_array($res5);
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
          <li class="active"><a href="home.php">Inbox</a></li>
          <li><a href="sent.php">Sent</a></li>
        <li><a href="leaked.php">Leaked</a></li>
        <li><a href="accinfo.php">Profile</a></li>
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
 <?php
            if (mysqli_num_rows($res5) > 0) {?>
           <table class="table table-stripped" cellspacing="2">
           <tr><th>Sender</th><th>Time</th><th>File Name</th><th>Download</th></tr>
   <?php while($row = mysqli_fetch_assoc($res5)) {
       $my_key=$row['f_key'];
        $myfile=$row['file_name'];
        $sender1 = $row['sender_name'];?>
      
        <tr><td><?php echo $row["sender_name"]?></td>
            <td><?php echo $row["c_time"]?></td>
            <td><?php echo $row["file_name"]?></td>
            <td>
                <form action="example_usage.php" method="post">
                    <button id="downloadfile" class="btn btn-primary" type="submit" name="btn-download">Download</button>
                </form>
                </td></tr>
            
                    <?php 
                    }?>
            </table>
            <?php }
            else{
                echo "0 results";
            }?>
        </div>
</body>
</html>