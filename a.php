<?php
include_once 'dbconnect.php';
$res="select * from filelist";
/*while($row=(mysqli_query($con,$res))->fetch_assoc()){
    echo "fname".$row[f_name];
}*/
while($res1=mysqli_query($con,$res))
{
    $userRow=mysqli_fetch_array($res1);
    echo $userRow['f_name'];
    
}
?>
<html>
    
</html>