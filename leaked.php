<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$res=  mysqli_query($con,"select pic from users where user_id=".$_SESSION['user']);
$userRow1=  mysqli_fetch_assoc($res);
$uname=$userRow['username'];
$my_user=$userRow['username'];
echo $my_user;
$query= "SELECT * FROM leakfile WHERE my_sender='$my_user'";
//$query= "select * from filelist where user_id=".$_SESSION['user'];
$res1= mysqli_query($con, $query);


/*$uname="pradnya";
print($_SESSION['user']);
$msg= $userRow[0].$userRow[1].$userRow[2].$userRow[3].$userRow[4];
$userid=$_SESSION['user'];
echo "<script type='text/javascript'>alert('$userid');</script>";
$res1=mysql_query("SELECT * FROM `filelist' WHERE receiver =".$userRow[1]);
*/
$query= "select * from filelist where rec_id=".$_SESSION['user'];
$res= mysqli_query($con, $query);


?>
<!DOCTYPE html >
<html>
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
          <li><a href="home.php">Inbox</a></li>
          <li><a href="sent.php">Sent</a></li>
        <li  class="active"><a href="leaked.php">Leaked</a></li>
        <li><a href="accinfo.php">Profile</a></li>
     </ul>
    </div>
  </div>
</nav><br/>
       <div class="col-lg-3 thumbnail" align="center">
        <?php
        echo '<img class="img-circle" src="data:image;base64,'.$userRow1['pic'].'">';
        ?>
        <h3><?php echo $userRow['username']?></h3>
        <a href="accinfo.php"> <button class="btn btn-primary">My Account</button></a><br></br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br></br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            
<?php
          if($res1)
            {
              echo "<table class=\"table table-stripped\" cellspacing=\"2\">";
                echo "<tr><th>Sender</th><th>Time</th><th>File Name</th></td>";
    
            while($row = mysqli_fetch_assoc($res1)) {
        echo "<tr><td>". $row["leaker"]. "</td><td>" .$row["t_stamp1"]. "</td><td>" . $row["my_file"]. "</td>
  </tr>";
                
            }
            echo "</table>";
            }
              else{
                  echo "0 results";
              }
              
              
              ?>  
        </div>
</body>
</html>
