<?php
////////////////NOTE PUT REAL ESCAPE STRING HERE EXAMPLE AT VALIDATE.PHP
session_start();
include_once('php_inc/connect.php');
if (!isset($_POST['evtype']) or !isset($_POST['eval']) or !isset($_POST['q']) or !isset($_POST['gtotal'])) {
	echo "ERROR";
	exit();
}

//LAST PIECE OF PROTECTION FROM EDITS
function preventEdit($con, $logid, $evtype, $quest){
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid' AND evtype='$evtype' AND $quest > 0;";
	$query=mysqli_query($con, $sql);
	if ($query){
		$numrows = mysqli_num_rows($query);
		if ($numrows > 0){
			echo "This evaluation is complete";
			exit();
		}
	}
}
function validUrl($con, $evtype, $eval){
	if ($evtype=="self" and $eval=="self"){
		return true;
	}
	$sql="SELECT * FROM faculty_results JOIN users ON users.uname='$eval' WHERE evtype='$evtype'";
	$query=mysqli_query($con, $sql);
	$numrows=mysqli_num_rows($query);
	if ($numrows > 0){
		return true;
	}
	echo "ERROR";
	exit();
}

$evtype=mysqli_real_escape_string($con, $_POST['evtype']);
$eval=mysqli_real_escape_string($con, $_POST['eval']);
$quest=mysqli_real_escape_string($con, $_POST['q']);
$gtotal=mysqli_real_escape_string($con, $_POST['gtotal']);
$logid=$_SESSION['logid'];
$sql="";
if (validUrl($con, $evtype, $eval, $quest)) {
	preventEdit($con, $_SESSION['logid'], $evtype, $quest);
}
if ($gtotal > 100 or $gtotal < 0){
	echo "Wrong input!";
	exit();
} 



if ($eval == 'self') {
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator AND users.id=faculty_results.toevaluate WHERE users.logid='$logid';";
} else {
	$sql="SELECT users.id FROM users WHERE uname='$eval'";
	$query=mysqli_query($con, $sql);
	$row=mysqli_fetch_row($query);
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid' AND faculty_results.toevaluate='$row[0]';";
}
//OPTIMIZED FOR FACULTY
//~ $sql = "SELECT faculty.id FROM faculty JOIN users ON users.id=faculty.userkey WHERE users.logid='$logid';";
//~ $sql = "SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty. WHERE users.logid='$logid';";
$query=mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "Don't try to hack";
	exit();
} else {
	$row=mysqli_fetch_row($query);
	$sql="UPDATE faculty_results SET $quest='".$gtotal."' WHERE faculty_results.id='$row[0]';";
	$query=mysqli_query($con, $sql);
	echo 'correct';
}

mysqli_close($con);

?>
