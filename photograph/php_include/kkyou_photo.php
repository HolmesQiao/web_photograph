<!--kkyou_photo.php-->
<!--展示单张照片-->
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
		if (mysqli_fetch_array($result)){/*用户已登录*/ /*判断应该输出什么内容*/
			if(isset($_GET["photo_id"])){
				$query = "select photo_src from photo where photo_id=\"".$_GET["photo_id"]."\"";
				$result = mysqli_query($con, $query) or die("Cant perfom Query");
				$row = mysqli_fetch_array($result);
				echo '<div>
						<img src="'.$row["photo_src"].'" style="position:relative; max-width:100%; max-height:900px;"></img>
					</div>';
				if($_COOKIE["username"] == $row["nickname"]){
					echo '<a href="#" onclick=\'del_photo("'.$row["photo_id"].'")\'><img class="delete_icon" src="data/delete.png"></img></a>';
				}
			}
		}
		mysqli_close($con);
	}
?>
