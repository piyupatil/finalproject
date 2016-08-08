<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$servername = "localhost";
$username = "data";
$password = "data";
$dbname="dataleakage";
$conn=mysqli_connect($servername,$username,$password,$dbname);
$sql="insert into user_info values('pradnya','pradnyapatilv@outlook.com',8626054596,'piyu')";
//$sql="select * from user_info where name='/"+'pradnya'+"'/";
if($sql)
{
    echo "Welcome Pradnya";
}
die("mand");
?>

