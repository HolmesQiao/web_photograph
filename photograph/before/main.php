<!DOCTYPE html>
<html>
	<head>
		<title>kkyou_photograph</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
		<script src="js/check_pc.js"></script>
	</head>

	<body class="subpage" style="
		background-image: url(data/bg_7.jpg); 
		resize: both;
		overflow: scroll;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center">
		<!--loading-->

		<!--header-->
		<?php include"php_include/header_main.php" ?>

		<!--main-->
		<artical style="display:flex">
			<div class="nab_bar" id="nab_bar">
				<?php include"php_include/user_data.php" ?>
			</div>
			<section class="disp"><?php include"php_include/disp_photo.php" ?></section>
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>

</php>
