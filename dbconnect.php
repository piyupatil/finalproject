<?php
$con=mysqli_connect("localhost","root","");
if(!mysqli_connect("localhost","root",""))
{
     die('oops connection problem ! --> '.mysqli_error());
}
if(!mysqli_select_db($con,"final"))
{
     die('oops database selection problem ! --> '.mysqli_error());
}
?>