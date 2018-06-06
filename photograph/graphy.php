<!--graphy.php-->
<!--相册页面-->

<!DOCTYPE html>
<html>
	<head>
		<title>kkyou_photograph</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
	</head>

	<body class="subpage" style="
		background-image: url(data/bg_5.jpg); 
		resize: both;
		overflow: scroll;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center">

		<!--header-->
		<?php include"php_include/header_main.php" ?>

		<!--main-->
		<artical style="display:flex">
			<div class="graphy_bar" id="nab_bar"><?php include"php_include/graphy_data.php" ?></div>
			<?php include"php_include/graphy_bar.php"?>
			<section class="disp"><?php include"php_include/disp_photo.php" ?></section>
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>
</php>
