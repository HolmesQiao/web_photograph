<!--del_graphy.php-->
<!--删除相册，表单交由new_del_graphy.php处理-->

<!DOCTYPE html>
<html>
	<head>
		<title>kkyou new graphy</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
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
			<form action="new_del_graphy.php" method="POST" style="margin: 0 auto; " enctype="multipart/form-data">
				<h2 class="ct">Delete graphy</h2>
				<hr class="cneter"/>
				<span style="color:red">相册内的照片都会被删除</span>
				<select id="graphy" name="graphy" style="color:black; width: 100%; margin: 0 auto; border: 5px solid: black;">
					<option value="">请选择相册</option>
					<?php include"php_include/graphy_list.php" ?>
				</select>
				<hr />
				<span class="ct">Enter password to conform:</span>
					<input id="password" name="password" type="password" /><br /><hr />
				<div class="a_c"><button id="button" class="submit" style="background-color:black;">
					<b style="color:white">Submit</b></button></div>
			</form>
			<!--<div class="preview"><img id="output" class="preview"></img></div>-->
			<!--preview-->
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>
</html>
