<?php
include_once('checklogin.php');
if(!$log_login_status){
	header('location:login.php');
} 
//~ else {
	//~ include_once('ckusertype.php');
//~ }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Main Page</title>
</head>

<body>
	<a href='logout.php'>Logout</a>
	<?php
	include_once('getcontent.php');
	?>
	<br><br>
</body>


<script type="text/javascript" src="static/jquery-1.11.3.js"></script>
<script type="text/javascript" src="static/jquery-ui.min.js"></script>
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
			var dataString = 'gtotal='+ grandTotal;
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

