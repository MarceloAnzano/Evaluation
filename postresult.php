<?php
////////////////NOTE PUT REAL ESCAPE STRING HERE EXAMPLE AT VALIDATE.PHP
session_start();
include_once('php_inc/connect.php');

$evtype=$_POST['evtype'];
$eval=$_POST['eval'];
$quest=$_POST['q'];
$gtotal=$_POST['gtotal'];
$logid=$_SESSION['logid'];
$sql="";

//LAST PIECE OF PROTECTION FROM EDITS
function preventEdit($con, $logid, $evtype, $quest){
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid' AND evtype='$evtype' AND $quest > 0";
	$query=mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	if ($numrows > 0){
		echo "That evaluation was completed";
		exit();
	}
}

preventEdit($con, $logid, $evtype, $quest);

if ($eval == 'self') {
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator AND users.id=faculty_results.toevaluate WHERE users.logid='$logid';";
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
	echo "YOU GOT IT!";
}

//mysqli_close($con);

?>
