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
		<artical style="display:flex; text-align: left">
			<div class="nab_bar" id="nab_bar">
				<?php include"php_include/user_data.php" ?>
			</div>
			<section class="disp" style="position:relative;">
			<?php 
			function data_block($usr, $usr_avatar){
				$width=rand(60, 70);
				$color_num=rand(0, 2);
				if ($color_num > 1){$color = "rgba(30, 30, 30, 0.5)";}
				else {$color = "rgb(255, 255, 255)";}
				echo '<div style="position:relative; width:'.$width.'%; border: 5px solid black; left:0; background-color:'.$color.'; margin-botton: 10px;">
						<div style="background-color: rgba(30, 30, 30, 0.8)">
							<a href="graphy.php?user='.$usr.'">';
						if (isset($usr_avatar)){
							echo '<img src="'.$usr_avatar.'" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;"></img>';
						}else{
							echo '<img src="data/default.jpg" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;"></img>';
						}
							echo '</a>
							<span style="color:rgb(180, 180, 180)">'.$usr.'</span>
						</div>
					</div>';
			}
				/*检测用户登录与否*/
				if (isset($_COOKIE["username"])){
					$con = mysqli_connect("localhost", "root", "your_psw");
					if (!$con){die("Could not connect database:" .mysqli_error());}
					mysqli_select_db($con, "photograph");
					$result = mysqli_query($con, "select nickname
							from web_user
							where nickname=\"" . $_COOKIE["username"] . "\"");
					if (mysqli_fetch_array($result)){/*用户已登录*/ /*判断应该输出什么内容*/
						if (isset($_GET["data"])){
							if ($_GET["data"]=="fans"){//如果要求输出粉丝信息
								$query = "select nickname, avatar_src from web_user where nickname in (
									select nickname from watch where watch_name = \"".$_COOKIE["username"]."\")";
							}else{//如果要求输出关注信息
								$query = "select nickname, avatar_src from web_user where nickname in (
									select watch_name from watch where watch.nickname = \"".$_COOKIE["username"]."\")";
							}
							$result = mysqli_query($con, $query);
							while($row = mysqli_fetch_array($result)){
								data_block($row["nickname"], $row["avatar_src"]);//传给函数，让函数打印信息
							}
						}else if(isset($_GET["type"])){
							include"php_include/disp_photo.php";
						}
					}
				}
			?>
			</section>
		</artical>

		<!-- Footer -->
		<?php include"php_include/footer2.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
	</body>

</php>

