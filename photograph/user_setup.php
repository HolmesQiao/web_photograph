<!DOCTYPE html>
<html>
	<head>
		<title>kkyou_photograph</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="assets/css/main.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
		<script src="js/check_pc.js"></script>
		<script>
			function check_err(){
				var us_name = document.getElementById("username")
				var us_psw = document.getElementById("password");
				var us_eml = document.getElementById("email");
				var us_psw_data = us_psw.value.toString();
				try{
					if (us_name.value=="") throw "please input username";
					if (us_psw_data.length < 6) throw "密码不要少于6位";
					if (us_psw.value=="") throw "please input password";
					if (us_eml.value=="") throw "please input email";
					document.getElementById("button").type="submit";
				}catch(err){
					alert(err);
				}
			}
		</script>
		<?php include"php_inlcude/load_bg.php"; ?>
		<?php include"php_include/check_verify.php"; ?>
	</head>

	<body id="body" class="subpage" style="background-image: url('data/bg_0.jpg'); 
		background-attachment: fixed;
		background-size: cover;
		background-position: center;
		transition-duration: 2s;
		overflow: hidden">

		<!--loading-->
		<?php include"php_include/loading.php" ?>

		<!--header-->
		<header id="header">
			<?php include"php_include/header2.php"; ?>
		</header>
		<img id="introduce" src="data/introduce.png" width=0px
			style="position: absolute; top: 43px; left: 0; z-index: 1;"></img>

		<form id="log_form" action="setup.php" method="POST" class="container">
			<div class="setup_center">
				<br /><div class="a_c"><img src="data/kkyou.png" width=130px /></div>
				<div class="a_c text"><span>欢迎来到kkyou.</span><p/></div>
				<div class="a_c">E-mail</div><input id="email" name="email" maxlength="30" type="email" required/><br />
				<div class="a_c">Username</div><input required maxlength="10" id="username" name="name" type="text" /><br />
				<div class="a_c">Password</div><input required minlength="6" maxlength="20" id="password" name="password" type="password" /><br />
				<div class="a_c"><button id="button" class="submit" onclick="check_err()">
					<b>Submit</b></button></div>
			</div>
		</form>

		<!-- Footer -->
		<?php include"php_include/footer.php"?>

		<!-- Script -->
		<script src="js/event.js"></script>
		<script src="js/change_bg_img.js"></script>
	</body>


</html>
