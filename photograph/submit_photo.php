<!--上传照片的前端部分-->

<!DOCTYPE html>
<html>
	<head>
		<title>kkyou_submit</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
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
					<div id="output" style="overflow-x: scroll; overflow-y:hidden; border:5px solid black; position:absolute; bottom:0; height: 25%; width: 100%; display:flex">
						<!--<img id="output" class="preview_load"></img>-->
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
		<script>
			var input = document.getElementById("up_imgFile");
			var preview = document.getElementById("output");
			input.addEventListener('change', updateImageDisplay);
			function updateImageDisplay(){
				while(preview.firstChild){
					preview.removeChild(preview.firstChild);
				}
				var curFiles = input.files;
				if (curFiles.length === 0){
					var para = document.createElement('p');
					para.textContent = 'No files current selected';
					preview.appendChild(para);
				}else{
					if (curFiles.length > 12){
						alert("上传的图片个数不要大于12哦~");
						window.location.reload();
					}
					for (var i = 0; i < curFiles.length; i++){
						var image = document.createElement('img');
						image.style.height = "100%";
						image.style.position = "relative";
						image.src = window.URL.createObjectURL(curFiles[i]);
						preview.appendChild(image);
					}
				}
			}
		</script>
		<script src="js/event.js"></script>
	</body>
</php>
