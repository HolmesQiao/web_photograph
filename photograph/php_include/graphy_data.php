<!--graphy_data.php-->
<!--打印出相册左侧的图标，并进行点击跳转-->

<script>
	function change_graphy(graphy, user){
		var href="http://118.24.109.65/graphy.php?user=";
		var new_href = href+user+"&graphy="+graphy;
		window.location.href=new_href;
	}
</script>

<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname
				from web_user
				where nickname=\"" . $_COOKIE["username"] . "\"");
		if (mysqli_fetch_array($result)){
			/*打出用户头像及信息*/
			$query1 = "select avatar_src from web_user where nickname=\"".$_GET["user"]."\"";
			$re = mysqli_query($con, $query1);
			$row1 = mysqli_fetch_array($re)["avatar_src"];
			if (isset($row1)){
				echo '<div><img src="'.$row1.'" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img>';
			}else{
				echo '<div><img src="data/default.jpg" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img>';
			}
			echo "<span style=\"color:rgb(200, 200, 200)\">".$_GET["user"]."</span>";
			/*关注按钮*/
			if ($_COOKIE["username"]!=$_GET["user"]){
				include"php_include/watch_judge.php";
			}
			echo "</div>";

			/*打出相册列表*/
			echo '<div style="text-align: center; margin-top: 20px; color: white; font-family: sans-sarif; font-size: 13px;">
			GALLERY FOLDERS
			</div>';
			$query = "select graphy_avatar, graphy_name from graphy where nickname=
				\"" . $_GET["user"] . "\"";
			$result = mysqli_query($con, $query) or die("Cant perfom Query");
			while($row = mysqli_fetch_array($result)){
				echo "<div style='width=130px; height=130px; position: relative;'>
						<img class='graphy_bar' src=" . $row["graphy_avatar"] . " onclick='change_graphy(\"".$row["graphy_name"]."\", \"".$_GET["user"]."\")'></img>
						<b class='graphy_bar' style='color:white; z-index:3; postion:absolute;'>" . $row["graphy_name"] . "</b>
					</div>";
			}

			if($_COOKIE["username"]==$_GET["user"]){
				echo "<div style='width=130px; height=130px'>
							<img class='graphy_bar'></img>
							<a href='submit_graphy.php'><b style='color:#0085ca; z-index:3; postion:absolute;'>添加新相册</b></a>
					  </div>";
			}
			
			mysqli_close($con);
		}
	}
?>

<?php /*异步关注*/ ?>
<script>
	function getGet(name){//获取get信息
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if(r != null) {
			return decodeURI(r[2]);
		}
		return null;
	}
	function watch(){
		var formData = new FormData();
		var user = getGet("user");
		formData.append("user", user);
		var request = new XMLHttpRequest();
		request.open("POST", "new_watching.php", true);
		request.send(formData);
		request.addEventListener("load", function(event) {
			window.location.reload();
		});
	}
</script>
