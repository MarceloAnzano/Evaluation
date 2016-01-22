<?php
////////////////NOTE PUT REAL ESCAPE STRING HERE EXAMPLE AT VALIDATE.PHP
session_start();
include_once('php_inc/connect.php');
if (!isset($_POST['gtotal']) or !isset($_POST['sub']) or !isset($_POST['st'])) {
	echo "ERROR";
	exit();
}

//LAST PIECE OF PROTECTION FROM EDITS
function preventEdit($con, $logid, $sub, $st){
	$sql="SELECT student_results.id FROM student_results JOIN users ON users.id=student_results.studentkey 
	WHERE users.logid='$logid' AND subj='$sub' AND subjteacher='$st' AND score > 0";
	$query=mysqli_query($con, $sql);
	$numrows=mysqli_num_rows($query);
	if ($numrows > 0){
		echo "This evaluation is complete.
		<br><br>
		<a href='index.php'>Click here to go back</a>";
		exit();
	}
}

function validUrl($con, $logid, $sub, $st){
	$sql="SELECT * FROM student_results JOIN users ON users.logid='$logid' WHERE subj='$sub' AND subjteacher='$st'";
	$query=mysqli_query($con, $sql);
	$numrows=mysqli_num_rows($query);
	if ($numrows > 0){
		return true;
	}
	echo "ERROR";
	exit();
}

$sub=mysqli_real_escape_string($con, $_POST['sub']);
$st=mysqli_real_escape_string($con, $_POST['st']);
$gtotal=mysqli_real_escape_string($con, $_POST['gtotal']);
$logid=$_SESSION['logid'];
$userid=$_SESSION['userid'];
$sql="";

if (validUrl($con, $_SESSION['logid'], $sub, $st)) {
	preventEdit($con, $_SESSION['logid'], $sub, $st);
}
$sql="UPDATE student_results SET score=".$gtotal." WHERE subj='$sub' AND subjteacher='$st' AND studentkey='$userid'";
$query=mysqli_query($con, $sql);
echo 'correct';

mysqli_close($con);

?>
