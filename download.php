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
//$res1=  mysqli_query($con,"select pic from users where user_id='$id'");
//$userRow1=  mysqli_fetch_assoc($res1);

$query= "select * from filelist where rec_id=".$_SESSION['user'];
$res5= mysqli_query($con, $query);
?>