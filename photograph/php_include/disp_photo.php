<!--disp_photo.php-->
<!--从数据库中取出相片，分类打印到屏幕-->

<div id="loading" style="margin:0 auto;"> </div>
<script src="js/del_photo.js"></script>
<script src="js/collection.js"></script>

<?php
	/*检测用户登录与否*/
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
			}else if (isset($_GET["type"])){
				if ($_GET["type"] == "collection"){//收藏界面
					$query = "select photo_src, photo.nickname as nickname, photo.photo_id as photo_id from photo, collection where collection.nickname=
						\"" . $_COOKIE["username"] ."\" and photo.photo_id = collection.photo_id";
				}else{//热门界面
				$query = "select * from photo natural join (
					select photo_id , count(nickname) as p_num from collection group by photo_id) as pd 
					where photo.photo_id = pd.photo_id order by p_num desc, time desc";
				//	$query = "select photo_src, nickname, photo_id from photo order by time desc";
				}
			}else{/*打印出所有photo*/
				$query = "select photo_src, nickname, photo_id from photo order by time desc";
			}
			$result = mysqli_query($con, $query) or die("Cant perfom Query");
			$row = mysqli_fetch_array($result);
			$disp_num;
			if (!isset($_GET['user'])) $disp_num = $_GET['num'] + 14;
			else $disp_num = 999;  //max graphy photo num
			for ($i = 0; $row && $i < $disp_num; $i++, $row = mysqli_fetch_array($result)){
				echo ' 
					<span class="kkyou_photo"  ng-repeat="img in imgs" style="width:{{img.width*200/img.height}}px;flex-grow:{{img.width*200/img.height}}">
						<img class="disp" src="' . str_replace("photo_db/", "photo_db/compress/", $row["photo_src"]) . '"> </img>
						<a class="img_link" href="photo.php?user='.$row["nickname"].'&photo_id='.$row["photo_id"].'"></a>
						<a class="author" href="graphy.php?user='.$row["nickname"].'">
							From '.$row["nickname"].
						'</a>
						<span class="img_mask"></span>';
				echo '<a class="collection">';
				//检查是否收藏,对图片收藏进行相关操作
				$collection_status = "select * from collection where nickname = \"" . $_COOKIE["username"] . "\"
					and photo_id = \"" . $row["photo_id"] . "\"";
				$status_result = mysqli_query($con, $collection_status);
				$status_row = mysqli_fetch_array($status_result);
				if (isset($status_row["nickname"])){//如果关注关系存在
					echo "<img src='data/collection_2.png' class='collection' onclick=\"collection(this, '".$row["photo_id"]."')\"></img>";
				}else{//如果没有关注关系
					echo "<img src='data/collection_1.png' class='collection' onclick=\"collection(this, '".$row["photo_id"]."')\"></img>";
				}
				echo '</a>';
					if($_COOKIE["username"] == $row["nickname"]){
						echo '<a href="#" onclick=\'del_photo("'.$row["photo_id"].'")\'><img class="delete_icon" src="data/delete.png"></img></a>';
					}
					//echo '<a class="eye" href="photo.php?user='.$row["nickname"].'&photo_id='.$row["photo_id"].'"><img class="eye_icon" src="data/eye.png"></img></a>';
					echo '</span>';
			}
			mysqli_close($con);
		}
	}
?>
