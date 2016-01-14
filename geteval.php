
<?php
error_reporting(0);
function preventEdit($con, $logid, $evtype, $quest){
	$sql="SELECT faculty_results.id FROM faculty_results JOIN users ON users.id=faculty_results.evaluator WHERE users.logid='$logid' AND evtype='$evtype' AND $quest > 0";
	$query=mysqli_query($con, $sql);
	$numrows=mysqli_num_rows($query);
	if ($numrows > 0){
		echo "This evaluation is complete.
		<br><br>
		<a href='index.php'>Click here to go back</a>
		";
		exit();
	}
}

//ONLY OPTIMIZED FOR FACULTY; PLEASE CHANGE LATER ACCORDINGLY E.G. ADD CHECKS FOR UTYPE
if (isset($_GET['evtype']) and isset($_GET['eval']) and isset($_GET['q'])) {
	$evtype=$_GET['evtype'];
	$eval=$_GET['eval'];
	$q=$_GET['q'];
	$sql = "SELECT percent, content FROM teachcomp";
	$query = mysqli_query($con, $sql);
	$numrows = mysqli_num_rows($query);
	if ($numrows == 0){
		echo "No questions";
		exit();
	}
	
	$category = "";
	$count = 0;
	preventEdit($con, $_SESSION['logid'], $evtype, $q);
	while($row = mysqli_fetch_array($query)){
		if ($row[0] > 0){
			if ($row[1] != $category){
				if ($category != ""){
					echo "
					</tbody>
					</table>
					<div class='row' style='margin-top:20px;'>
						<button id='partialbtn' class='btn waves-effect waves-light right' type='submit' value='Submit'>Next</button>
					</div>
					</form>
					<p id='status'></p>
					</div>";
				}
				$category = $row[1];
				echo "<div id='maindiv$count' class='maindiv'>
				<form id=form$count onsubmit='return false;'>
				<input type='hidden' value=$row[0]>
				<h5 class='name flow-text'>$category</h5>
				<table class='striped'>
				<thead>
					<tr>
						<th class='center-align' data-field='competencies'>Teaching Competencies</th>
						<th class='rating center-align' data-field='rating'>Rating</th>
					</tr>
				</thead>
				<tbody>";
				$count += 1;
				continue;
			}
		}
		echo "
		<tr>
			<td>$row[1]</td>
			<td><input id='rating1' type='text'></td>
		</tr>";
	}
	echo "
	</tbody>
	</table>
	<br/><br/>
	<input id='evtype' type='hidden' value=$evtype>
	<input id='eval' type='hidden' value=$eval>
	<input id='quest' type='hidden' value=$q>
	<input id='totalbtn' type='submit' value='Submit'>
	</form>
	<p id='status'></p>
	</div>";
}
?>
