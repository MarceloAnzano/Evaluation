<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register	</title>
</head>

<body>
	<form onsubmit="return validLogin();">
	<div>User ID:</div>
	<input type="text" id="logid" onfocus="emptyElement()" maxlength="88">
	<div>Password:</div>
	<input id="password" type="password" onfocus="emptyElement()" maxlength="100">
	<div>Retype Password:</div>
	<input id="repassword" type="password" onfocus="emptyElement()" maxlength="100">
	<br/><br/>
	<input id="loginbtn" type="submit" value="Log In"></input>
	</form>
	<p id="status"></p>
</body>

<script type="text/javascript" src="static/jquery-1.11.3.js"></script>
<script type="text/javascript">
	function emptyElement(){
		$('#status').html("");
	}
	function validLogin(){
		var logid=$('#logid').val();
		var password=$('#password').val();
		var repassword=$('#repassword').val();
		$('#password').val("");
		$('#repassword').val("");
		if (logid === "" && password === ""){
			$('#status').html("Please, fill out the form.");
		} else {
			var dataString = 'logid='+ logid + '&password='+ password + '&repass=' + repassword;
			$.ajax({
				type: "POST",
				url: "regpass.php",
				data: dataString,
				cache: false,
				success: function(result){
					var result=trim(result);
					//$("#flash").hide();
					if(result=='correct'){
						window.location='login.php';
					} else {
						$("#status").html(result);
					}
				}
			});
		}
		return false;
	}

	function trim(str){
		var str=str.replace(/^\s+|\s+$/,'');
		return str;
	}
</script>
</html>
