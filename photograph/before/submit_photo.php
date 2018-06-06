<!--上传照片的前端部分-->

<!DOCTYPE html>
<html>
	<head>
		<title>kkyou_submit</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
		<script>
			var loadFile = function(event){
				var output = document.getElementById("output");
				output.src = URL.createObjectURL(event.target.files[0]);
				output.style.display="flex";
			};
		</script>
	</head>

	<body class="subpage" style="
		background-image: url(data/bg_4.jpg); 
		resize: both;
		overflow: scroll;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center">

		<!--header-->
		<?php include"php_include/header_main.php" ?>

		<!--main-->
		<main class="submit_img">
		<artical style="display:flex">
			<div class="submit_img">
				<p class="submit_img">
					<div class="submit_center"><?php include"php_include/submit_file.php" ?></div>
				</p>
				<p class="comment">
					<div style="border:5px solid black; position:absolute; bottom:0; height: 25%; max-width: 25%; margin: 0 auto">
						<img id="output" class="preview_load"></img>
					</div>
				</p>
			</div>
			<div class="nab_bar" id="nab_bar">
				<?php include"php_include/user_data.php" ?>
			</div>
		</artical>
		</main>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>
</php>
