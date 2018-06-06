<!--disp_photo.php-->
<!--从数据库中取出相片，分类打印到屏幕-->

<div id="loading" style="margin:0 auto;"> </div>
<script src="js/del_photo.js"></script>

<?php
	/*检测用户登录与否*/
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "qiaopengju");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname
				from web_user
				where nickname=\"" . $_COOKIE["username"] . "\"");
		if (mysqli_fetch_array($result)){/*用户已登录*/ /*判断应该输出什么内容*/
			$query;
			if(isset($_GET["user"])){
				if(isset($_GET["graphy"])){
					if(isset($_GET["photo"])){/*打印user用户的graphy相册的单张photo*/
					}else{/*打印所有user用户的graphy相册中的所有photo*/
						$query = "select photo_src, nickname, photo_id from photo where nickname=
							\"" . $_GET["user"] . "\" and graphy_id=\"" . $_GET["user"] . "_" . $_GET["graphy"] . "\"
							order by time desc";
					}
				}else{/*打印出user用户的所有photo*/
					$query = "select photo_src, nickname, photo_id from photo where nickname=
						\"" . $_GET["user"] . "\" order by time desc";
				}
			}else{/*打印出所有photo*/
				$query = "select photo_src, nickname, photo_id from photo order by time desc";
			}
			$result = mysqli_query($con, $query) or die("Cant perfom Query");
			while($row = mysqli_fetch_array($result)){
				echo ' 
					<span class="kkyou_photo"  ng-repeat="img in imgs" style="width:{{img.width*200/img.height}}px;flex-grow:{{img.width*200/img.height}}">
						<img class="disp" src="' . $row["photo_src"] . '"> </img>
						<a class="author" href="graphy.php?user='.$row["nickname"].'">
							From '.$row["nickname"].
						'</a>
						<span class="img_mask"></span>';
					if($_COOKIE["username"] == $row["nickname"]){
						echo '<a href="#" onclick=\'del_photo("'.$row["photo_id"].'")\'><img class="delete_icon" src="data/delete.png"></img></a>';
					}
					echo '<a class="eye" href="photo.php?user='.$row["nickname"].'&photo_id='.$row["photo_id"].'"><img class="eye_icon" src="data/eye.png"></img></a>';
					echo '</span>';
			}
			mysqli_close($con);
		}
	}
?>
