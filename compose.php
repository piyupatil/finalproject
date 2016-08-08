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

/*$uname="pradnya";
print($_SESSION['user']);
$msg= $userRow[0].$userRow[1].$userRow[2].$userRow[3].$userRow[4];
$userid=$_SESSION['user'];
echo "<script type='text/javascript'>alert('$userid');</script>";
$res1=mysql_query("SELECT * FROM `filelist' WHERE receiver =".$userRow[1]);
*/
$query= "select * from filelist where rec_id=".$_SESSION['user'];
$res1= mysqli_query($con, $query);
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['username']; ?></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
<script src="bootstrap/js/bootstrap.min.js"></script>
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
        echo '<img class="img-circle" src="data:image;base64,'.$userRow1['pic'].'">';
        ?>
        <h3><?php echo $userRow['username']?></h3>
        <a href="account.php"> <button class="btn btn-primary">My Account</button></a><br><br>
                <a href="compose.php"><button class="btn btn-primary btn-block">Compose</button></a><br><br>
        <a href="logout.php?logout">Sign Out</a>
        </div>
        <div class="col-lg-8 thumbnail">
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="#">
                <div class="form-group">To:<input class="form-control" type="text" name="sname"/></div>
                <div class="form-group">File:
                    <input type=file class="form-control" id="f_name" name="f_name" /><br/>
                    </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="btn-signup">Upload</button></div>
                
            </form>
        </div>
</body>
</html>
<?php
if(isset($_POST['btn-signup']))
{
 $sname = mysql_real_escape_string($_POST['sname']);
 $filedata=mysql_real_escape_string($_FILES['f_name']['tmp_name']);
 $filename=mysql_real_escape_string($_FILES['f_name']['name']);
 $filetype=mysql_real_escape_string($_FILES['f_name']['type']);
$uid=$_SESSION['user'];

$target_dir = "PHP-AES-File-Encryption-master/files/";
$target_file = $target_dir . basename($_FILES['f_name']["name"]);
//$imgdata=mysql_real_escape_string($_FILES['pic']['tmp_name']);
 $target_name=mysql_real_escape_string($_FILES['f_name']['name']);
 $target_type=mysql_real_escape_string($_FILES['f_name']['type']);

$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["f_name"]["tmp_name"], $target_file)) {
		
        echo "The file ". basename( $_FILES["f_name"]["name"]). " has been uploaded.";
		//$query="INSERT INTO upload(name,type) VALUES('$target_name','$target_type')";
		//$result1=mysql_query($query);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//find id & name of receiver
$sql="Select * from users where username='$sname'";
$res2=mysqli_query($con,$sql);
 $row2=mysqli_fetch_array($res2);
$rec_id=$row2['user_id'];

$res=mysqli_query($con,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$sender_name=$userRow['username'];

    $query="INSERT INTO filelist(user_id,rec_id,f_name,rec_name,sender_name,file_name,f_type) VALUES('$uid','$rec_id','$filedata','$sname','$sender_name','$filename','$target_type')";
        $result1=mysqli_query($con,$query);
        echo "<script>result is:'$result1'</script>";
    if($result1){
        echo "<br>data inserted successfully";
        
       /*?>
        <script>alert('successfully registered ');</script>
        <?php*/
    }
    else{
        echo "<br>not file insert into DB";
    }
 /*if(mysqli_query($con,"INSERT INTO users(username,email,contact,password,pic) VALUES('$uname','$email','$contact','$upass',$pic)"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}*/
}
?>