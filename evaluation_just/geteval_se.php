
<?php
error_reporting(0);
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
function invalidUrl($con, $logid, $sub, $st){
	$sql="SELECT * FROM student_results JOIN users ON users.logid='$logid' WHERE subj='$sub' AND subjteacher='$st'";
	$query=mysqli_query($con, $sql);
	$numrows=mysqli_num_rows($query);
	if ($numrows > 0){
		return true;
	}
	echo "ERROR";
	exit();
}

//ONLY OPTIMIZED FOR FACULTY; PLEASE CHANGE LATER ACCORDINGLY E.G. ADD CHECKS FOR UTYPE
if (!isset($_GET['sub']) or !isset($_GET['st'])) {
	echo "ERROR";
	exit();
} 
$sub=mysqli_real_escape_string($con, $_GET['sub']);
$st=mysqli_real_escape_string($con, $_GET['st']);
if (invalidUrl($con, $_SESSION['logid'], $sub, $st)) {
	preventEdit($con, $_SESSION['logid'], $sub, $st);
}
$sql = "SELECT percent, content FROM st_evaluation";
$query = mysqli_query($con, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows == 0){
	echo "No questions";
	exit();
}

echo "id is ". $_SESSION['userid'];
$category = "";
$count = 0;

$eval=urlencode($eval);
$putbackbtn=0;
//~ $numrows=mysqli_num_rows($query);
$numrows=4;

while($row = mysqli_fetch_array($query)){
	if ($count == 3)
		break;
	// selects the title of the question section
	if ($row[0] > 0){
		if ($row[1] != $category){
			$category = $row[1];
			$numrows-=1;
			continue;
		}
	}
	echo "<div id='maindiv$count' class='maindiv' style='margin:auto;width:70%'>
	<form id=form$count onsubmit='return false;' onshow='focusOnFirst()'>
	<input id='percent' type='hidden' value=$row[0]>
	<table>
	<tr><td>$category</td></tr>";
	$count += 1;
	echo "<tr>
	<tr><td>$row[1]</td></tr>
	<tr><td><input type='radio' name='score' value='5' checked='checked' /> Very Satisfactory
	<input type='radio' name='score' value='4'/> Satisfactory
	<input type='radio' name='score' value='3'/> Good
	<input type='radio' name='score' value='2'/> Fair
	<input type='radio' name='score' value='1'/> Poor
	</td></tr>";
	echo "</table>
	<br/><br/>";
	if ($putbackbtn==1){
		echo "<input id='backbtn' type='button' value='Back'>";
	}
	$putbackbtn=1;
	if ($count < $numrows) {
		echo "<input id='partialbtn' type='submit' value='Submit'>
		</form>
		<p id='status'></p>
		</div>";
	}
}
$sub=urlencode($sub);
$st=urlencode($st);
echo "</table>
<input id='totalbtn' type='submit' value='Submit'>
<input id='sub' type='hidden' value='$sub'>
<input id='st' type='hidden' value='$st'>
</form>
<p id='status'></p>
</div>";

?>
