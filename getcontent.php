<?php
//ONLY OPTIMIZED FOR FACULTY; PLEASE CHANGE LATER ACCORDINGLY E.G. ADD CHECKS FOR UTYPE
$logid=$_SESSION['logid'];
$sql="SELECT faculty_results.id, evtype, toevaluate FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid';";
$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "Cannot find your stuff";
	exit();
}
$temp=array();
$tempName=array();
$count=0;

while($row = mysqli_fetch_array($query)){
	$temp[]=$row;
}

//~ $sql="SELECT users.id, uname FROM users WHERE users.id='$row[]';";
//~ $query = mysqli_query($con, $sql);
//~ 
//~ while($row = mysqli_fetch_array($query)){
	//~ $tempName[]=$row;
//~ }

$count=count($temp);
for ($i=0; $i < $count; $i++){
	if ($temp[$i][1] == 'self'){
		echo '
		<div class="row">
			<div class="col m4 offset-m2 s8 push-s2" id="teacher1">
				<div class="card hoverable">
					<a class="waves-effect card-content" href=evaluation.php?evtype=self&eval=self&q=tcompetencies>
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8">
								<h5 class="name flow-text">Self Evaluation</h5>
								<p class="bodyText flow-text">Teaching Competencies</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="col m4 s8 push-s2" id="teacher1">
				<div class="card hoverable">
					<a class="waves-effect card-content" href=evaluation.php?evtype=self&eval=self&q=eattitude>
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8">
								<h5 class="name flow-text">Self Evaluation</h5>
								<p class="bodyText flow-text">Efficiency and Attitude</p>
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
		echo '
		<div class="row">
			<div class="col m4 offset-m2 s8 push-s2" id="teacher1">
				<div class="card hoverable">
					<a class="waves-effect card-content" href=evaluation.php?evtype="'.$temp[$i][1].'"&eval=$name[0]&q=tcompetencies>
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8">
								<h5 class="name flow-text">'.$name[0].'</h5>
								<p class="bodyText flow-text">Teaching Competencies</p>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="col m4 s8 push-s2" id="teacher1">
				<div class="card hoverable">
					<a class="waves-effect card-content" href=evaluation.php?evtype="'.$temp[$i][1].'"&eval=self&q=eattitude>
						<div class="row" style="margin-bottom: 0px !important">
							<div class="col m4 avatar">
								<img src=".\static\images\avatar-01.svg">
							</div>
							<div class="col m8">
								<h5 class="name flow-text">'.$name[0].'</h5>
								<p class="bodyText flow-text">Efficiency and Attitude</p>
							</div>
						</div>
					</a>
				</div>
			</div>

		</div>';
	}
}
?>
