<?php
session_start();
include_once('php_inc/connect.php');
$message=array();
if(isset($_POST['logid']) && !empty($_POST['logid'])){
	$logid=mysqli_real_escape_string($con, $_POST['logid']);
} else { 
	$message[]='Please enter username';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
	$password=md5($_POST['password']);
	//$password=mysql_real_escape_string($_POST['password']);
} else {
	$message[]='Please enter password';
}

$countError=count($message);
if($countError > 0){
	for($i=0;$i<$countError;$i++){
		echo ucwords($message[$i]).'<br/><br/>';
	}
} else {
	$sql="SELECT * FROM users WHERE logid='$logid' AND password='$password' AND activation=1";
	$query=mysqli_query($con, $sql);
	$checkUser=mysqli_num_rows($query);
	if($checkUser > 0){
		$row=mysqli_fetch_row($query);
		$_SESSION['login_status']=true;
		$_SESSION['logid']=$logid;
		$_SESSION['password']=$password;
		$_SESSION['uname']=$row[2];
		$_SESSION['utype']=$row[4];
		echo 'correct';
	} else {
		echo ucwords('Incorrect credentials');
	}
}

mysqli_close($con);
?>
