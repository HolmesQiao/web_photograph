<!DOCTYPE html>
<!--photo.php-->
<!--前端展示单张photo-->

<?php
	if (!isset($_COOKIE["username"])){
		header("Location:user_setup.php");
	}
?>

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
		position: relative;
		overflow: scroll;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center">

		<!--header-->
		<header id="header">
			<?php include "php_include/header.php"; ?>
		</header>

		<!--main-->
		<artical id="photo_show" style="display:flex; width: 100%; overflow-x: hidden">
			<section class="disp_photo"><?php include"php_include/kkyou_photo.php"; ?></section>
			<div class="comment_bar" id="nab_bar" style="min-height: 800px; max-height: 1000px; overflow:scroll; overflow-x:hidden">
				<?php include"php_include/comment_bar.php"?>
			</div>
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php" ?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>
</php>
