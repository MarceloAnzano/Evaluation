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
<!-- <script type="text/javascript" src="/static/js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="/static/js/materialize.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script> -->
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
		<div class="row">
		<div class="col l3 avatarHead">
			<img src=".\static\images\avatar-02.svg">
		</div>
		<div class="col l9">
			<span class="brand-logo"><?php
									$eval=mysqli_real_escape_string($con, $_GET['eval']);
									echo $eval ?></span>
			<span class="subBrand"><?php
									if($_GET["q"]== "eattitude"){
										echo 'Efficiency and Attitude';
									}elseif($_GET["q"] == "tcompetencies"){
										echo 'Teaching Competencies';
									}elseif($_GET["q"] == "apunctuality"){
										echo 'Attendace and Punctuality';
									}
									?></span>
		</div>
		</div>
	</div>

		<div class="pageContent valign-wrapper">
		<div class="valign" style="width:100%">
			<div class="row cont">
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
<!-- <script type="text/javascript" src="/static/js/main.js"></script> -->
</body>


<script type="text/javascript" src="static/js/jquery-ui.min.js"></script>
<script type="text/javascript">
var grandTotal = 0;
$(document).ready(function(){
	var formcount = document.getElementsByTagName('form');
	$('#form0').find('input[type=number]')[0].focus();
	var myId = "";
	for (var a = 1; a < formcount.length; a++){
		myId = "#form" + a;
		$(myId).parent().hide();
	}
});

function calculateScore(){
	var part = 0;
	var total=0;
	var forms = $('form');
	forms.each(function(i) {
		part = 0;
		var $input = $(this).find(':input[type=number]');
		for (var a = 0; a < $input.length; a++) {
			part+=Number($input[a].value);
		}
		total+=(part/$input.length)*(Number($(this).find('input[type=hidden]')[0].value) / 100);
	});
	grandTotal+=total;
}

$('form').submit(fadeToTheLeft);
function fadeToTheLeft(event){
	var $src = $(this);
	//~ var total = 0;
	//~ var part = $src.find('input[type=number]');
	//~ for (var a = 0; a < part.length; a++){
		//~ total = total + Number(part[a].value);
	//~ }
	//~ total = (total/part.length )* (Number($src.find('input[type=hidden]')[0].value) / 100);
	//~ grandTotal += total;
	if ($src.find('input[type=submit]')[0].id === 'totalbtn'){
		calculateScore();
		var evtype = $src.find('input[type=hidden]#evtype')[0].value;
		var _eval = $src.find('input[type=hidden]#eval')[0].value;
		var quest = $src.find('input[type=hidden]#quest')[0].value;
		
		var dataString = "gtotal=" + grandTotal + "&evtype=" + evtype + "&eval=" + _eval + "&q=" + quest;
		$.ajax({
			type: "POST",
			url: "postresult.php",
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
	}
	$src.parent().hide('slide', {direction: 'left'}, 200, function(){
		var formcount = document.getElementsByTagName('form');
		var nextId = "";
		for (var a = 0; a < formcount.length; a++){
			if ($src[0].id === "form" + a){
				nextId = "#form" + ++a;
				resizeCard();
				$(nextId).parent().show('slide', {direction: 'right'}, 800);
				if (a !== formcount.length)
					$(nextId).find('input[type=number]')[0].focus();
					resizeCard();
				break;
			}
		}
	});
	return false;
}

$('input[type=button]').click(pressBack);
function pressBack(){
	var $src = $(this).parent();
	$src.parent().hide('slide', {direction: 'right'}, 200, function(){
		var formcount = document.getElementsByTagName('form');
		var prevId = "";
		for (var a = 0; a < formcount.length; a++){
			if ($src[0].id === "form" + a){
				prevId = "#form" + --a;
				$(prevId).parent().show('slide', {direction: 'left'}, 800);
				resizeCard();
				if (a !== formcount.length)
					$(prevId).find('input[type=number]')[0].focus();
				break;
			}
		}
	});
}

function emptyElement(){
	$('#status').html("");
}

function trim(str){
	var str=str.replace(/^\s+|\s+$/,'');
	return str;
}

function forceNumeric(){
	var $input = $(this);
	$input.val($input.val().replace(/[^\d]+/g,''));
}

function resizeCard(){
	if($(".pageContent div.row").outerHeight() <= ($(window).height()- $(".navbar-fixed").height() - $(".subNav").height() - $("footer").height() - $("footer").css("padding"))){
		$(".pageContent").css("height",($(window).height()- $(".navbar-fixed").height() - $(".subNav").height() - $("footer").height()-$("footer").css("padding"))+"px");
	}else{
		$(".pageContent").css("height",$(".pageContent div.row").outerHeight()+$("footer").outerHeight()+"px");
		$(".pageContent").css("margin","20px 0px");
		$(".pageContent div.row.cont").css("margin","0px");
	}
}

$(document).ready(function(e){
	$(".subNav").css("height","70px");
});

$('body').on('propertychange input', 'input[type="number"]', forceNumeric);
</script>
<script type="text/javascript" src="/static/js/main.js"></script>
</html>

