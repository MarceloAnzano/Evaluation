<?php
//CHECKS IF THE USER IF HE/SHE IS A STUDENT OR FACULTY ETC...
	switch ($_SESSION['utype']){
		case "admin":
			echo "admin";
			break;
		case "faculty":
			echo "faculty";
			break;
		case "head";
			echo "head";
			break;
		case "student":
			echo "seito";
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
