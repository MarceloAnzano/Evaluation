<?php
//CHECKS IF THE USER IF HE/SHE IS A STUDENT OR FACULTY ETC...

	switch ($_SESSION['utype']){
		case "admin":
			echo "Current User Type: Admin<br>";
			echo " <a href='adminpage.php'>Administrator's page</a>";
			break;
		case "Current User Type: Faculty<br>";
			echo "faculty";
			break;
		case "Current User Type: Department Head<br>";
			echo "head";
			break;
		case "Current User Type: Student<br>":
			echo "student";
			break;
	}
	//ONLY OPTIMIZED FOR FACULTY
	//CHECKS IF USER HAS ALREADY COMPLETED ALL EVALUATION FORMS
	//~ $logid = $_SESSION['logid'];
	//~ $sql = "SELECT cmplself,cmpleval FROM faculty JOIN users ON users.id=faculty.userkey WHERE users.logid='$logid';";
//~ 
	//~ $query = mysqli_query($con, $sql);
	//~ $numrows = mysqli_num_rows($query);
	//~ $row = mysqli_fetch_row($query);
	//~ if ($numrows == 0){
		//~ echo "Unable to find user. May also be not using a faculty account";
		//~ exit();
	//~ } 
	//~ if ($row[0] == 1 && $row[1] == 1){
		//~ echo "You have completed all evaluation forms. Thank you!";
		//~ exit();
	//~ }
?>
