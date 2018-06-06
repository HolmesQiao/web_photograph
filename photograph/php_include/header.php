<!--header.php-->
<!--只包含head不包含大标题栏-->

<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />

<div class="logo">
	<img id="kkyou" class="logo" src="data/kkyou.png" height="40px" height="32px"/>
	<b><a href="main.php">主站</a></b>
	<!--<div class="dropdown">
		<img src="data/setting.png" style="height:34px; margin:3px;"></img>
		<div class="menu">
			<a href="del_graphy.php">删除相册</a><br/>
			<a href="submit_avatar.php">上传头像</a>
		</div>-->
	</div>
</div>

<!--用户界面-->
<div class="user_dropdown">
<?php
/*取出头像*/
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname
				from web_user
				where nickname=\"" . $_COOKIE["username"] . "\"");
		$query = "select avatar_src from web_user where nickname=\"".$_COOKIE["username"]."\"";
		$re = mysqli_query($con, $query);
		$row = mysqli_fetch_array($re)["avatar_src"];
		if (isset($row)){
			echo '<img src="'.$row.'" style="object-fit:cover; width: 45px; height: 45px; border-radius: 50%; margin: 0 auto"></img>';
		}else{
			echo '<img src="data/default.jpg" style="object-fit:cover; width: 45px; height: 45px; border-radius: 50%; margin: 0 auto"></img>';
		}
	}
?>
	<div class="user_menu">
		<?php
		echo '<span style="font-weight: bold; color:#0085ca">'.$_COOKIE["username"].'<span><hr style="margin:5px;"/>';
		?>
		<a href="data.php?data=fans">我的粉丝<a>
		<a href="data.php?data=watch">我的关注<a><br/>
		<a href="submit_avatar.php">上传头像</a>
		<?php echo'<a href="graphy.php?user='.$_COOKIE["username"].'">我的相册</a>';?><br/>
		<a href="data.php?type=collection">我的收藏</a>
		<a onclick="logout()">退出登录</a>
	</div>
</div>

<span style="position:fixed; top:0; right: 100px; display: flex;">
<a style = "font-weight:bold; color: white; margin-left:10px" href="hot.php?type=hot">热门作品</a>
<a style = "font-weight:bold; color: white; margin-left:10px" href="main.php">最新作品</a>
<a style = "font-weight:bold; color: white; margin-left:10px" href="submit_graphy.php">新建相册</a>
<a style = "font-weight:bold; color: white; margin-left:10px" href="del_graphy.php">删除相册</a>
<a style = "font-weight:bold; color: white; margin-left:10px" href="watch_photo.php" style="right:200px;">关注作品</a>
</span>
 <a href="submit_photo.php"><span><button class="up" style="position:fixed; top:0; right: 0;"><span class="up">投稿</span></button></span></a>
<script>
	function logout(){
		document.cookie="username=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
		window.location.reload();
	}
</script>
<!--<script src="js/check_log.js"></script>-->
