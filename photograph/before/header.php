<!--header.php-->
<!--只包含head不包含大标题栏-->

<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />

<div class="logo">
	<img id="kkyou" class="logo" src="data/kkyou.png" height="40px" height="32px"/>
	<b><a href="main.php">主站</a></b>
	<?php
		if(isset($_COOKIE["username"])){
			echo '
				<div class="dropdown">
					<img src="data/setting.png" style="height:34px; margin:3px;"></img>
					<div class="menu">
						<a href="del_graphy.php">删除相册</a><br/>
						<a href="submit_avatar.php">上传头像</a>
					</div>
				</div>';
		}
	?>
</div>

<span><b><a id="u1" href="user_login.php" style="color:white">Login</a></b></span>
<span><a id="u2" href="user_setup.php" style="color:white">Registe</a></span>
<?php
	if(isset($_COOKIE["username"])){
		echo '<span><button class="up"><a href="submit_photo.php" class="up">投稿</a></button></span>';
	}
?>
<script src="js/check_log.js"></script>
