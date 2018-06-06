<!--submint_graphy.php-->
<!--新建相册页面-->

<!DOCTYPE html>
<html>
	<head>
		<title>kkyou new graphy</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
		<script>
			function check_err(){
				var file = document.getElementById("up_imgFile");
				var graphy_name = document.getElementById("graphyname")
				var us_psw = document.getElementById("password");
				try{
					if (file.value=="") throw "please upload graphy'cover!";
					if (graphy_name.value=="") throw "please input graphy name";
					if (us_psw.value=="") throw "please input password";
				}catch(err){
					alert(err);
				}
			}
		</script>
	</head>

	<body class="subpage">
		<!--header-->
		<?php include"php_include/header_main.php" ?>
		<style>
			.ct{
				text-align: center;
			}
		</style>

		<!--main-->
		<artical style="display:flex; margin: 80px;">
			<form action="new_graphy.php" method="POST" style="margin: 0 auto; " enctype="multipart/form-data">
				<h2 class="ct">New graphy</h2><hr />
				<input id="up_imgFile" type="file" name="file" accept="image/png, image/jpeg, image/jpg, image/gif" onchange="loadFile(event)"/>
				<label for="up_imgFile" class="ct"><img style="width:100px; height:100px;" src="data/upload_img.png" /></label>
				<label for="up_imgFile" class="ct">点击上传相册封面</label>
				<hr class="cneter"/>
				<span class="ct">New graphy name:</span>
					<input id="graphyname" maxlength="13" name="graphyname" type="text" ><br />
				<span class="ct">Enter password to conform:</span>
					<input id="password" name="password" type="password" />
				<hr /><br />
				<div class="a_c"><button id="button" class="submit" style="background-color:black;" onclick="check_err()">
					<b style="color:white">Submit</b></button></div>
				<script>
					var loadFile = function(event){
						var output = document.getElementById("output");
						output.src = URL.createObjectURL(event.target.files[0]);
						output.style.display="flex";
					};
				</script>
			</form>
			<div class="preview"><img id="output" class="preview"></img></div>
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>
</html>
