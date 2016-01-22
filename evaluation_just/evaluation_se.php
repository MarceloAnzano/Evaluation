<?php
/////////////////////////////////////////////////////////// back and submit are not working as intended yet
include_once('checklogin.php');
if(!$log_login_status){
	header('location:login.php');
} else {
	include_once('ckusertype.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Actual Evaluation</title>
</head>

<body>
	<a href='index.php'>Return to Evaluation List</a>
	<?php
	include_once('geteval_se.php');
	?>
</body>


<script type="text/javascript" src="static/jquery-1.11.3.js"></script>
<script type="text/javascript" src="static/jquery-ui.min.js"></script>
<script type="text/javascript">
var grandTotal = 0;
$(document).ready(function(){
	var formcount = document.getElementsByTagName('form');
	$('#form0').find('input[type=radio]')[0].focus();
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
		//~ part = 0;
		var $input = $(this).find(':input[type=radio]');
		for (var a = 0; a < $input.length; a++) {
			if ($input[a].checked) {
				part+=Number($input[a].value);
				break;
			}
		}
	});
	grandTotal+=(part/forms.length);
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
		var _sub = $src.find('input[type=hidden]#sub')[0].value;
		var st = $src.find('input[type=hidden]#st')[0].value;
		//~ var quest = $src.find('input[type=hidden]#quest')[0].value;
		
		var dataString = "gtotal=" + grandTotal + "&sub=" + _sub + "&st=" + st;
		alert(dataString);
		$.ajax({
			type: "POST",
			url: "postresult_se.php",
			data: dataString,
			cache: false,
			success: function(result){
				var result=trim(result);
				//$("#flash").hide();
				if(result=='correct'){
					window.location='index.php';
				} else {
					$('body').html(result);
					$("#status").html(result);
				}
			}
		});
	}
	//~ alert($src[0].id);
	$src.parent().hide('slide', {direction: 'left'}, 200, function(){
		var formcount = document.getElementsByTagName('form');
		var nextId = "";
		for (var a = 0; a < formcount.length; a++){
			if ($src[0].id === "form" + a){
				nextId = "#form" + ++a;
				$(nextId).parent().show('slide', {direction: 'right'}, 800);
				//~ alert($(nextId)[0].id);
				if (a !== formcount.length)
					$(nextId).find('input[type=radio]')[0].focus();
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
</script>
</html>

