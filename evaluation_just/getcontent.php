<?php
//ONLY OPTIMIZED FOR FACULTY; PLEASE CHANGE LATER ACCORDINGLY E.G. ADD CHECKS FOR UTYPE
$logid=$_SESSION['logid'];
$utype=$_SESSION['utype'];
if ($utype == 'faculty') {
	//note the increased index versus student_results
	$sql="SELECT faculty_results.id, evtype, toevaluate, tcompetencies, eattitude, apunctuality FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid';";
}
else {
	$sql="SELECT student_results.id, subj, subjteacher, score FROM student_results JOIN users ON users.id=student_results.studentkey WHERE users.logid='$logid';";
}

$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "<br>Error:<br>Cannot retrieve evaluation";
	exit();
}
$temp=array();
//~ $tempName=array();
$count=0;

while($row = mysqli_fetch_array($query)){
	$temp[]=$row;
}

$count=count($temp);
for ($i=0; $i < $count; $i++){
	if ($_SESSION['utype'] == 'student'){
		$name=urlencode($temp[$i][2]);
		if ($temp[$i][3] > 0){
			echo "<br><br>
			Evaluate ".$temp[$i][2]."<br>
			Subject: ".$temp[$i][1].", Done";
		} else {
			echo "<br><br>
			<a href=evaluation_se.php?sub=".$temp[$i][1]."&st=$name>
			Evaluate ".$temp[$i][2]."<br>
			Subject: ".$temp[$i][1]."
			</a>";
		}
		continue;
	}
	if ($temp[$i][1] == 'self'){
		if ($temp[$i][3] > 0){
			echo "Self Evaluation: Teaching Competencies, Done";
		} else {
			echo "<br><br>
			<a href=evaluation.php?evtype=self&eval=self&q=tcompetencies>
			Self Evaluation: Teaching Competencies
			</a>";
		}
		if ($temp[$i][4] > 0){
			echo "<br>Self Evaluation: Efficiency and Attitude, Done";
		} else {
			echo "<br><a href=evaluation.php?evtype=self&eval=self&q=eattitude>
			Self Evaluation: Efficiency and Attitude
			</a>";
		}
		if ($temp[$i][5] > 0){
			echo "<br>Self Evaluation: Attendance and Punctuality, Done";
		} else {
			echo "<br><a href=evaluation.php?evtype=self&eval=self&q=apunctuality>
			Self Evaluation: Attendance and Punctuality
			</a><br>";
		}
	} else {
		$sql="SELECT uname FROM users WHERE users.id='".$temp[$i][2]."'";
		$query=mysqli_query($con, $sql);
		$name=mysqli_fetch_row($query);
		$urlname[0]=urlencode($name[0]);
		if ($temp[$i][3] > 0){
			echo "<br>Evaluate $name[0] on Teaching Competencies, Done";
		} else {
			echo "<br><a href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=tcompetencies>
			Evaluate $name[0] on Teaching Competencies
			</a>";
		}
		if ($temp[$i][4] > 0){
			echo "<br>Evaluate $name[0] on Efficiency and Attitude, Done";
		} else {
			echo "<br><a href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=eattitude>
			Evaluate $name[0] on Efficiency and Attitude
			<br><br>
			</a>";
		}
		if ($temp[$i][5] > 0){
			echo "<br>Evaluate $name[0] on Efficiency and Attitude, Done";
		} else {
			echo "<br><a href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=apunctuality>
			Evaluate $name[0] on Attendance and Punctuality
			<br><br>
			</a>";
		}
	}
}
?>
