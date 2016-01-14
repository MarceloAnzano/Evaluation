<?php
session_start();
include_once('php_inc/connect.php');
$log_login_status=false;
$log_logid="";
$log_uname="";
$log_password="";
$log_utype="";

function evalLoggedUser($con, $logid, $uname, $pass, $ut){
	$sql = "SELECT * FROM users WHERE logid='$logid' AND password='$pass' AND utype='$ut'";
	$query = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	//~ mysqli_close($con);
	if ($numrows > 0){
		return true;
	}
}

if (isset($_SESSION['logid']) && isset($_SESSION['uname']) && isset($_SESSION['password']) && isset($_SESSION['utype'])){
	$log_logid = preg_replace('#[^a-z0-9]#', '', $_SESSION['logid']);
	//~ $log_uname = preg_replace('#[^a-z0-9]#', '', $_SESSION['uname']);
	$log_password = preg_replace('#[^a-z0-9]#', '', $_SESSION['password']);
	$log_utype = preg_replace('#[^a-z0-9]#', '', $_SESSION['utype']);
	$log_login_status = evalLoggedUser($con, $log_logid, $log_uname, $log_password, $log_utype);
} else {
	//~ echo "Login status incorrect";
	//~ mysqli_close($con);
	//~ exit();
}
?>
