<?php

//~ THIS CODE IS FOR TESTING PURPOSES
include_once('php_inc/connect.php');
function import($case, $con){
	//~ if (($handle = fopen("teaching-competencies.csv", "r")) !== FALSE) {
	switch ($case){
		case 1:
			$upload="faculty-example.csv";
			break;
		case 2:
			$upload="students-example.csv";
			break;
		case 3:
			$upload="sections-example.csv";
			break;
		case 4:
			$upload="users-example.csv";
			break;
	}	
	if (($handle = fopen($upload, "r")) !== FALSE) {
		$temp="";
		$temp2="";
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			switch ($case){
				case 1:
					$sql="INSERT INTO faculty (firstname, middlename, lastname, dept) VALUES ('".$data[0]."', '".$data[1]."')";
					break;
				case 2:
					$sql="INSERT INTO students (percent, content) VALUES ('".$data[0]."', '".$data[1]."')";
					break;
				case 3:
					$sql="INSERT INTO teachcomp (percent, content) VALUES ('".$data[0]."', '".$data[1]."')";
					break;
				case 4:
					$temp=$data[0] . $data[2] . $data[3];
					$temp2=$data[0] . "_". $data[1] . "_" . $data[2];
					$sql="INSERT INTO users (logid, uname, utype, dept) VALUES ('".$temp."', '".$temp2."', '".$data[4]."', '".$data[5]."')";
					break;
			}
			$query=mysqli_query($con, $sql);
		}
	mysqli_close($con);
	fclose($handle);
	}
}

if(isset($_GET['up']))
{
	import($_GET['up'], $con);
	header('location:importcsv.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Import Files</title>
</head>
<body>
<a href="?up=1&">Upload Faculty</a>
<br>
<a href="?up=2&">Upload Students</a>
<br>
<a href="?up=3&">Upload Sections</a>
<br>
<a href="?up=4&">Upload Users</a>
</body>
</html>
