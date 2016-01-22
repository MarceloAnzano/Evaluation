<?php
include_once('php_inc/connect.php');
$message=array();
if(isset($_POST['logid']) && !empty($_POST['logid'])){
	$logid=mysqli_real_escape_string($con, $_POST['logid']);
} else { 
	$message[]='Please enter username';
}

if(isset($_POST['password']) && !empty($_POST['password'])){
	if(isset($_POST['repass']) && !empty($_POST['repass'])){
		if ($_POST['password'] == $_POST['repass']){
				$password=md5($_POST['password']);
		} else {
			$message[]='Passwords do not match';
		}
	} else {
		$message[]='Please enter the password twice';
	}
} else {
	$message[]='Please enter password';
}

//CHECKS IF USER HAS ALREADY SET THE PASSWORD
$sql="SELECT activation FROM users WHERE logid='$logid' AND activation=1";
$query=mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows > 0){
	echo 'Password has already been set';
	exit();
}

$countError=count($message);
if($countError > 0){
	for($i=0;$i<$countError;$i++){
		echo ucwords($message[$i]).'<br/><br/>';
	}
} else {
	$sql="UPDATE users SET password='".$password."', activation=1 WHERE logid='$logid'";
	$query=mysqli_query($con, $sql);
	if (!$query) {
		die('Invalid query: ' . mysql_error());
	} else {
		echo "correct";
		exit();
	}
}

mysqli_close($con);
?>

