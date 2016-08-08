 <?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$sc_pass=$userRow['sc_pass'];
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
        <li><a href="leaked.php">Leaked</a></li>
        <li  class="active"><a href="lock.php">Lock it</a></li>
        <li><a href="account.php">Edit Profile</a></li>
     </ul>
    </div>
  </div>
</nav><br/>
    <div class="col-lg-3 thumbnail" align="center">
        <img class="img-circle" style="width:70%; height:70%" src="img/p.jpg" />
        <h3><?php echo $userRow['username']?></h3>
        <a href="account.php"> <button class="btn btn-primary">My Account</button></a><br></br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br></br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            
            <?php
            if (mysqli_num_rows($res) > 0) {
    // output data of each row
                echo "<table class=\"table table-stripped\" cellspacing=\"2\">";
                echo "<tr><th>Sender</th><th>Time</th><th>File Name</th><th>key</th><th>Download</th></td>";
    while($row = mysqli_fetch_assoc($res)) {
       // echo "   " . $row["sender_name"]. "      " . $row["c_time"]. "   " . $row["f_name"]. "<br>";
        $my_key=$row['f_key'];
        echo "<tr><td>". $row["sender_name"]. "</td><td>" .$row["c_time"]. "</td><td>" . $row["file_name"]. "</td><td>";
        echo '<button class="btn btn-success" id="sckey" type="button" onclick="lockit()">Lock</button>';
        echo "</td><td>";
        echo '<button class="btn btn-success" id="downloadfile" type="button" onclick="unlockit()">Unlock</button>';
        echo '</td></tr>';
      
    }
} else {
    echo "0 results";
}
        echo "</table>";
        
         ?>   
        </div>
            <script>
                function viewsckey(){
                    var sckey = prompt("Enter Secret Key", "");   
            
                    <?php
                   echo "var my_data = ".json_encode($userRow)."; ";
                      ?>
                      
                    if(my_data[6]==sckey){
                          alert("key is correct");
                          <?php
                          echo "var my_key = ".json_encode($my_key)."; ";
                      ?>
                                  alert("Key for File is:"+my_key);
                      }
                      else{
                          alert ("Secret key is wrong");
                      }
                      
                    
                }
                
                function downloadfile(){
                var d_key =prompt("Enter file key","");
                <?php
                          echo "var my_key = ".json_encode($my_key)."; ";
                      ?>
                      if(d_key==my_key)
                      {
                          alert("file key is correct");
                      }
                      else
                      {
                          alert ("file key is wrong");
                          que="insert into leakfile(sender)values()"
                      }
                
                }
            </script>
</body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

