<?php
include_once('php_inc/connect.php');
$date = date("y"). date("y")+1;
$date = "SY". $date;
echo $date;
mysqli_close($con);
?>
