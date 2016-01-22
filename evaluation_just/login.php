<?php
//error_reporting(0); <<<<<<<<<<<<<<<< READ THIS: PUT THIS ON ALL PHP FILES

include_once('checklogin.php');
if($log_login_status){
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
	<form onsubmit="return validLogin();">
	<div>User ID:</div>
	<input type="text" id="logid" onfocus="emptyElement()" maxlength="88">
	<div>Password:</div>
	<input id="password" type="password" onfocus="emptyElement()" maxlength="100">
	<br/><br/>
	<input id="loginbtn" type="submit" value="Log In"></input>
	</form>
	<p id="status"></p>
	
	<a href="register.php">Click here to set your password.</a>
</body>

<script type="text/javascript" src="static/jquery-1.11.3.js"></script>
<script type="text/javascript">
	function emptyElement(){
		$('#status').html("");
	}
	function validLogin(){
		var logid=$('#logid').val();
		var password=$('#password').val();
		$('#password').val("");
		//~ if (logid === "" && password === ""){
			//~ $('#status').html("Please, fill out the form.");
		//~ } else {
			var dataString = 'logid='+ logid + '&password='+ password;
			//$("#flash").show();
			//$("#flash").fadeIn(400).html('<img src="image/loading.gif" />');
			$.ajax({
				type: "POST",
				url: "validate.php",
				data: dataString,
				cache: false,
				success: function(result){
					var result=trim(result);
					//$("#flash").hide();
					if(result=='correct'){
						window.location='index.php';
					} else {
						$("#status").html(result);
					}
				}
			});
		//~ }
		return false;
	}

	function trim(str){
		var str=str.replace(/^\s+|\s+$/,'');
		return str;
	}
</script>
</html>
