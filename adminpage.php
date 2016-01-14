<?php
include_once('checklogin.php');
if(!$log_login_status){
	header('location:login.php');
} else {
	if ($_SESSION['utype'] !== 'admin') {
		echo "Unauthorized!";
		exit();
	}
}

if(isset($_GET['up'])) {
	$sql="SELECT users.id, utype, dept FROM users WHERE utype='faculty' OR utype='head'";
	$query=mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	$faculty=array();
	if ($numrows == 0){
		echo "No faculty around";
		exit();
	} else {
		while ($row = mysqli_fetch_row($query)) {
			$faculty[]=$row;
		}
		$count=count($faculty);
		echo $count;
		//NOTE THIS WORKS IF THE FIRST ENTRY IS NOT A DEPT HEAD
		$sql="INSERT INTO faculty_results (year, evtype, evaluator, toevaluate) VALUES (1516, 'self', '".$faculty[0][0]."','".$faculty[0][0]."')";
		for ($i = 1; $i < $count; $i++){
			if ($faculty[$i][1] == 'faculty'){
				$sql.=", (1516, 'self', '".$faculty[$i][0]."','".$faculty[$i][0]."')";
			} else if ($faculty[$i][1] == 'head') {
				for ($j = 0; $j < $count; $j++){
					if ($faculty[$i][2] == $faculty[$j][2] and $i != $j) {
						$sql.=", (1516, 'subtohead', '".$faculty[$j][0]."','".$faculty[$i][0]."')";
						$sql.=", (1516, 'headtosub', '".$faculty[$i][0]."','".$faculty[$j][0]."')";
					}
				}
			}
		}
		//~ $sql="SELECT users.id FROM users WHERE utype=''";
		$query=mysqli_query($con, $sql);
	}
	mysqli_close($con);
	header('location:adminpage.php');
}

////// WARNING THIS CODE WILL TRUNCATE FACULTY_RESULTS TABLE
if(isset($_GET['down'])) {
	$sql="truncate table faculty_results";
	$query=mysqli_query($con, $sql);
	mysqli_close($con);
	header('location:adminpage.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Administrator's Page</title>
</head>
<body>
	Do administrative tasks here:<br><br>
	<a href="?up=1">Open Evaluation</a>
	(creates new entries in the database for upcoming evaluation)
	<br><br>
	<a href="?down=1">Close Evaluation</a>
	(disables evaluation) *not sure about this feature yet.
	<br><br>
	<a href="importcsv.php">Import Files</a>
</body>
</html>
