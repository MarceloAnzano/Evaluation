
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

//ONLY OPTIMIZED FOR FACULTY; PLEASE CHANGE LATER ACCORDINGLY E.G. ADD CHECKS FOR UTYPE
if (!isset($_GET['evtype']) or !isset($_GET['eval']) or !isset($_GET['q'])) {
	echo "ERROR";
	exit();
} 
$evtype=mysqli_real_escape_string($con, $_GET['evtype']);
$eval=mysqli_real_escape_string($con, $_GET['eval']);
$quest=mysqli_real_escape_string($con, $_GET['q']);
if (validUrl($con, $evtype, $eval, $quest)) {
	preventEdit($con, $_SESSION['logid'], $evtype, $quest);
}
$sql = "SELECT percent, content FROM $quest";
$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "No questions";
	exit();
}

$category = "";
$count = 0;

$eval=urlencode($eval);
$putbackbtn=0;
while($row = mysqli_fetch_array($query)){
	if ($row[0] > 0){
		if ($row[1] != $category){
			if ($category != ""){
				echo "</table>
				<br/><br/>";
				if ($putbackbtn==1){
					echo "<input id='backbtn' type='button' value='Back'>";
				}
				$putbackbtn=1;
				echo "<input id='partialbtn' type='submit' value='Submit'>
				</form>
				<p id='status'></p>
				</div>";
			}
			$category = $row[1];
			echo "<div id='maindiv$count' class='maindiv' style='margin:auto;width:70%'>
			<form id=form$count onsubmit='return false;' onshow='focusOnFirst()'>
			<input id='percent' type='hidden' value=$row[0]>
			<table>
			<tr><td>$category</td></tr>";
			$count += 1;
			continue;
		}
	}
	echo "<tr>
	<td>$row[1]</td>
	<td><input type='number' min='1' max='100' required></td>
	</tr>";
}
echo "</table>
<br/><br/>
<input id='evtype' type='hidden' value=$evtype>
<input id='eval' type='hidden' value=$eval>
<input id='quest' type='hidden' value=$quest>
<input id='totalbtn' type='submit' value='Submit'>
</form>
<p id='status'></p>
</div>";

?>
