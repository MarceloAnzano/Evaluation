<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="/static/css/reset.css">
	<!--
	<link rel="stylesheet" href="http://reset5.googlecode.com/hg/reset.min.css"/>
-->
<!--Import materialize.css-->
<link rel="stylesheet" href="/static/css/materialize.css">
<link rel="stylesheet" href="/static/css/main.css"/>
	<!--
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
-->
</head>

<body>
	<div class="navbar-fixed">
		<div class="navbar-wrapper">
			<!-- <header class="nav-wrapper"> -->
			<header class="nav-wrapper z-depth-3">
				<center class="navImg">
					<img src="/static/images/badge.png"/>
					<img src="/static/images/Logo.png"/>
				</center>
			</header>
			<nav>
				<div class="nav-wrapper">
					<a href="#" class="brand-logo"></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a class="custom-btn waves-effect waves-light" href="#"></a></li>
						<li><a class="custom-btn waves-effect waves-light" href="\login.php">LOG IN</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<div class="pageContent valign-wrapper">
		<div class="valign">
			<center class="contentWidth">
				<div class="cardContainer loginCard">
					<form class="card" onsubmit="return validLogin();">
						<center class="card-content">
							<center class="card-title loginTitle">FACULTY EVALUATION SYSTEM</center>
							<center class="row">
								<center class="input-field">
									<input type="text" id="logid" onfocus="emptyElement()" maxlength="88">
									<label for="logid">Username</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input id="password" type="password" onfocus="emptyElement()" maxlength="100">
									<label for="password">Password</label>
								</center>
							</center>
							<center class="row">
								<center class="input-field">
									<input id="repassword" type="password" onfocus="emptyElement()" maxlength="100">
									<label for="repassword">Retype Password</label>
								</center>
							</center>
							<center class="row">
								<button id="loginbtn" class="btn waves-effect waves-light right" type="submit" name="action">LOG IN</button>
							</center>
							<center id="status">
							</center>
						</center>
					</form>
				</div>
			</center>
		</div>
	</div>

	<footer class="page-footer z-depth-3">
	</footer>
	<script type="text/javascript" src="/static/js/jquery-1.11.3.js"></script>
	<!--
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
-->
<script type="text/javascript" src="/static/js/materialize.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>
</body>

<script type="text/javascript" src="static/js/jquery-1.11.3.js"></script>
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
