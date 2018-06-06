<?php
	function hot_block($top, $usr, $usr_avatar, $time, $photo_src, $photo_id){
		$photo_src = str_replace("photo_db/", "photo_db/compress/", $photo_src);
		$top++;
		$R = rand(155, 255);
		$G = rand(155, 255);
		$B = rand(155, 255);
		$color = "rgb(".$R.",".$G.",".$B.")";
		echo '<div style="width:60%; border: 5px solid black; margin: 0 auto; background-color: rgba(30, 30, 30, 0.9); margin-botton: 10px;">
				<div style="background-color: rgba(3, 3, 3, 0.8); position: relative;">
					<span style="font-size:40px; margin-right: 20px; position: absolute; left: 3%; top: -4px; font-family: fantasy; color:'.$color.'">'.$top.'.</span>
					<a href="graphy.php?user='.$usr.'">';
				if (isset($usr_avatar)){
					echo '<img src="'.$usr_avatar.'" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;"></img>';
				}else{
					echo '<img src="data/default.jpg" style="object-fit:cover; width: 50px; height: 50px; border-radius: 50%; margin: 0 auto;"></img>';
				}
					echo '</a>
					<span style="color:rgb(180, 180, 180)">'.$usr.'</span>
				</div>
				<a href="photo.php?user='.$usr.'&photo_id='.$photo_id.'">
				<img src="'.$photo_src.'" style="width:60%; max-height:450px; object-fit: cover"></img>
				</a>
				<div style="color:rgba(180, 180, 180); background-color: rgba(30, 30, 30, 0.9); height: 40px;">'.$time.'</div>
			</div>';
	}
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
			$query = "select * from photo natural join web_user natural join (
				select photo_id , count(nickname) as p_num from collection group by photo_id) as pd 
				where photo.photo_id = pd.photo_id and web_user.nickname = photo.nickname order by p_num desc, time desc";
			$result = mysqli_query($con, $query);
			//while($row = mysqli_fetch_array($result)){
			$row = mysqli_fetch_array($result);
			for ($i = 0; isset($row) && $i < $_GET['num'] + 3; $i++, $row = mysqli_fetch_array($result)){
				hot_block($i, $row["nickname"], $row["avatar_src"], $row["time"], $row["photo_src"], $row["photo_id"]);
			}
		}
	}
?>
