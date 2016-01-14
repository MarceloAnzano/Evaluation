<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Evaluation</title>
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
					<a href="#" class="brand-logo">FACULTY EVALUATION SYSTEM</a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<li><a class="custom-btn waves-effect waves-light" href="#">
							<?php
								include_once('checklogin.php');
								if(!$log_login_status){
									header('location:login.php');
								} else {
									include_once('ckusertype.php');
								}?>
							</a></li>
						<li><a class="custom-btn waves-effect waves-light" href=".\index.php">LIST</a></li>
						<li><a class="custom-btn waves-effect waves-light" href=".\logout.php">LOGOUT</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<div class="nav-wrapper subNav">
		<span class="brand-logo">Evaluation</span>
	</div>

		<div class="pageContent valign-wrapper">
		<div class="valign" style="width:100%">
			<div class="row">
				<div class="col m8 push-m2 s8 push-s2" id="teacher1">
					<div class="card">
						<div class="card-content">
							<?php
							include_once('geteval.php');
							?>
						</div>
					</div>
				</div>
			</div>
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


<script type="text/javascript" src="static/js/jquery-ui.min.js"></script>
<script type="text/javascript">
	var grandTotal = 0;
	$(document).ready(function(){
		var formcount = document.getElementsByTagName('form');
		var myId = "";
		for (var a = 1; a < formcount.length; a++){
			myId = "#form" + a;
			$(myId).parent().hide();
		}
	});
	
	$('form').submit(fadeToTheLeft);
	function fadeToTheLeft(event){
		var $src = $(this);
		var total = 0;
		var part = $src.find('input[type=text]');
		for (var a = 0; a < part.length; a++){
			total = total + Number(part[a].value);
		}
		total = (total/part.length )* (Number($src.find('input[type=hidden]')[0].value) / 100);
		grandTotal += total;
		if ($src.find('input[type=submit]')[0].id === 'totalbtn'){
			var evtype = $src.find('input[type=hidden]#evtype')[0].value;
			var _eval = $src.find('input[type=hidden]#eval')[0].value;
			var quest = $src.find('input[type=hidden]#quest')[0].value;
			var dataString = 'gtotal='+ grandTotal + '&evtype=' + evtype + '&eval=' + _eval + '&q=' + quest;
			$.ajax({
				type: "POST",
				url: "postresult.php",
				data: dataString,
				cache: false,
				success: function(result){
					var result=trim(result);
					//$("#flash").hide();
					if(result=='correct'){
						window.location='success.php';
					} else {
						$("#status").html(result);
					}
				}
			});
		}
		$src.hide('slide', {direction: 'left'}, 200, function(){
			var formcount = document.getElementsByTagName('form');
			var nextId = "";
			for (var a = 0; a < formcount.length; a++){
				if ($src[0].id === "form" + a){
					nextId = "#form" + ++a;
					$(nextId).parent().show('slide', {direction: 'right'}, 800);
					break;
				}
			}
		});
		part.val("");
		return false;
	}
	
	function emptyElement(){
		$('#status').html("");
	}
	
	function trim(str){
		var str=str.replace(/^\s+|\s+$/,'');
		return str;
	}
</script>
</html>

