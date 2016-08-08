<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
/*$uname="pradnya";
print($_SESSION['user']);
$msg= $userRow[0].$userRow[1].$userRow[2].$userRow[3].$userRow[4];
$userid=$_SESSION['user'];
echo "<script type='text/javascript'>alert('$userid');</script>";
$res1=mysql_query("SELECT * FROM `filelist' WHERE receiver =".$userRow[1]);
*/
$query= "select * from filelist where user_id=".$_SESSION['user'];
$res= mysqli_query($con, $query);


?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script src="bootstrap/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<link rel="stylesheet" href="style.css" >
</head>
<body>
    <nav class="nav navbar-fixed-top navbar-inverse">
         <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="home.php"/><h2>Data Leakage Detection</h2>
                </div>
                 <ul class="nav navbar-nav">
                     <li><a href="sent.php"/>Sent</li>
                     <li><a href="leaked.php"/>Leaked</li>
                </ul>
            </div>
    </nav><br><br>
    <div class="col-lg-3 thumbnail" align="center">
        <img class="img-circle" width="70%" height="70%" src="img/p.jpg"/>
        <h3><?php echo $userRow['username']?></h3>
        <button onclick="account.php" class="btn btn-primary">My Account</button><br><br>
        <button class="btn btn-primary btn-block">Compose</button><br><br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            <h3><?php echo $userRow['username']?></h3>
            <?php
            if (mysqli_num_rows($res) > 0) {
    // output data of each row
                echo "<table border=1px>";
    while($row = mysqli_fetch_assoc($res)) {
       // echo "   " . $row["sender_name"]. "      " . $row["c_time"]. "   " . $row["f_name"]. "<br>";
        echo "<tr><td>". $row["rec_name"]. "</td><td>" .$row["c_time"]. "</td><td><file>" . $row["f_name"]. "</file></td><tr>";
    }
} else {
    echo "0 results";
}
        echo "</table>";
         ?>   
        </div>
</body>
</html>
