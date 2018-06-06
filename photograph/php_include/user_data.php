<!--user/data.php-->
<!--用于打印用户左侧的菜单栏-->

<script src="js/event.js"></script>
<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
<div>
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
			echo '<img src="'.$row.'" style="object-fit:cover; width: 70px; height: 70px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img>';
		}else{
			echo '<img src="data/default.jpg" style="object-fit:cover; width: 70px; height: 70px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img>';
		}
	}
?>
	<span id = "username" style="color: white; left:80px; margin-left: 20px; text-align: left; top: 37px; position: absolute;"></span>
	<ul style="margin: 0 auto margin: 20px; color: grey;">
		<hr>
		<li><a href="data.php?data=fans">粉丝<a></li>
		<li><a href="data.php?data=watch">关注<a></li>
		<hr>
		<li><a id="graphy_link" href="graphy.php">我的相册</a></li>
		<li><a href="watch_photo.php">关注作品</a></li>
		<hr>
		<li><a href="hot.php?type=hot">近期热门</a></li>
		<li><a href="main.php">最新作品</a></li>
		<hr>
		<li><a href="submit_graphy.php">新建相册</a></li>
		<li><a href="submit_photo.php">上传相片</a></li>
	</ul>
</div>
<script>
	function getCookie(cname){
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++){
			var c = ca[i].trim();
			if (c.indexOf(name)==0) return c.substring(name.length,c.length);
		}
		return "";
	}
	document.getElementById("username").innerHTML = getCookie("username");
	document.getElementById("graphy_link").href = "graphy.php?user=" + getCookie("username");
</script>
