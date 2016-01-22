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
		echo '
		<div class="row">
			<div class="col l5 m3 offset-l4 s8 push-l4" id="teacher1">';
		if ($temp[$i][3] > 0){
			echo '
			<div class="card disabledCard">
				<a class="card-content">';
		} else {
			echo '
			<div class="card hoverable">
				<a class="waves-effect card-content" href=evaluation_se.php?sub='.$temp[$i][1].'&st=$name>';
		}
		echo '					
			<div class="row" style="margin-bottom: 0px !important">
				<div class="col m4 l4 avatar">
					<img src=".\static\images\avatar-01.svg">
				</div>
				<div class="col m8 l8">
					<h5 class="name flow-text">'.$temp[$i][2].'</h5>
					<p class="bodyText flow-text subj">'.$temp[$i][1].'</p>
				</div>
			</div>
			</a>
			</div>
		</div>
		</div>';
		continue;
		// if ($temp[$i][3] > 0){
		// 	echo "<br><br>
		// 	Evaluate ".$temp[$i][2]."<br>
		// 	Subject: ".$temp[$i][1].", Done";
		// } else {
		// 	echo "<br><br>
		// 	<a href=evaluation_se.php?sub=".$temp[$i][1]."&st=$name>
		// 	Evaluate ".$temp[$i][2]."<br>
		// 	Subject: ".$temp[$i][1]."
		// 	</a>";
		// }
		// continue;
	}
	if ($temp[$i][1] == 'self'){
		echo '
		<div class="row">
			<div class="col l3 m3 offset-m2 s8 push-s1" id="teacher1">';
					if ($temp[$i][3] > 0){
						echo '
						<div class="card disabledCard">
							<a class="card-content">';
					} else {
						echo '
						<div class="card hoverable">
							<a class="waves-effect card-content" href=evaluation.php?evtype=self&eval=self&q=tcompetencies>';
					}
					echo '					
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 l4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8 l8">
								<h5 class="name flow-text">Self Evaluation</h5>
								<p class="bodyText flow-text">Teaching Competencies</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="col l3 m3 s8 push-s1" id="teacher1">';
				if ($temp[$i][4] > 0){
						echo '
						<div class="card disabledCard">
							<a class="waves-effect card-content" href="#">';
					} else {
						echo '
						<div class="card hoverable">
							<a class="waves-effect card-content" href=evaluation.php?evtype=self&eval=self&q=eattitude>';
					}
					echo '
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 l4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8 l8">
								<h5 class="name flow-text">Self Evaluation</h5>
								<p class="bodyText flow-text">Efficiency and Attitude</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="col l3 m3 s8 push-s1" id="teacher1">';
				if ($temp[$i][5] > 0){
						echo '
						<div class="card disabledCard">
							<a class="card-content">';
					} else {
						echo '
						<div class="card hoverable">
							<a class="waves-effect card-content" href=evaluation.php?evtype=self&eval=self&q=apunctuality>';
					}
					echo '
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 l4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8 l8">
								<h5 class="name flow-text">Self Evaluation</h5>
								<p class="bodyText flow-text">Attendance and Punctuality</p>
							</div>
						</div>
					</a>
				</div>
			</div>

		</div>';
	} else {
		$sql="SELECT uname FROM users WHERE users.id='".$temp[$i][2]."'";
		$query=mysqli_query($con, $sql);
		$name=mysqli_fetch_row($query);
		$urlname[0]=urlencode($name[0]);
		echo "
		<div class='row'>
			<div class='col l3 m3 offset-m1 s8 push-s1' id='teacher1'>";
				if ($temp[$i][3] > 0){
						echo "
						<div class='card disabledCard'>
							<a class='waves-effect card-content'>";
					} else {
						echo "
						<div class='card hoverable'>
							<a class='waves-effect card-content' href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=tcompetencies>";
					}
					echo "
						<div class='row' style='margin-bottom: 0px !important'>
							<div class='col m4 avatar'>
								<img src='.\static\images\avatar-01.svg'>
							</div>
							<div class='col m8'>
								<h5 class='name flow-text'>".$name[0]."</h5>
								<p class='bodyText flow-text'>Teaching Competencies</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class='col l3 m3 s8 push-s1' id='teacher1'>";
				if ($temp[$i][4] > 0){
						echo "
						<div class='card disabledCard'>
							<a class='waves-effect card-content'>";
					} else {
						echo "
						<div class='card hoverable'>
							<a class='waves-effect card-content' href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=eattitude>";
					}
					echo "
						<div class='row' style='margin-bottom: 0px !important'>
							<div class='col m4 avatar'>
								<img src='.\static\images\avatar-01.svg'>
							</div>
							<div class='col m8'>
								<h5 class='name flow-text'>".$name[0]."</h5>
								<p class='bodyText flow-text'>Efficiency and Attitude</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class='col l3 m3 s8 push-s1' id='teacher1'>";
				if ($temp[$i][5] > 0){
						echo "
						<div class='waves-effect card-content'>
							<a class='card-content disabled'>";
					} else {
						echo "
						<div class='card hoverable'>
							<a class='waves-effect card-content' href=evaluation.php?evtype=".$temp[$i][1]."&eval=$urlname[0]&q=apunctuality>";
					}
					echo "
						<div class='row' style='margin-bottom: 0px !important'>
							<div class='col m4 avatar'>
								<img src='.\static\images\avatar-01.svg'>
							</div>
							<div class='col m8'>
								<h5 class='name flow-text'>".$name[0]."</h5>
								<p class='bodyText flow-text'>Attendance and Punctuality</p>
							</div>
						</div>
					</a>
				</div>
			</div>

		</div>";
	}
}
?>
