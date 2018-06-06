<?php
	function watch_block($usr, $usr_avatar, $time, $photo_src, $photo_id){
		$photo_src = str_replace("photo_db/", "photo_db/compress/", $photo_src);
		echo '<div style="width:60%; border: 5px solid black; margin: 0 auto; background-color: rgba(30, 30, 30, 0.7); margin-botton: 10px;">
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
				<a href="photo.php?user='.$usr.'&photo_id='.$photo_id.'">
				<img src="'.$photo_src.'" style="width:60%; max-height:450px; object-fit: cover"></img>
				</a>
				<div style="color:rgba(180, 180, 180); background-color: rgba(30, 30, 30, 0.8); height: 40px;">'.$time.'</div>
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
			$query = "select nickname, avatar_src, time, photo_src, photo_id
				from web_user natural join photo
				where nickname in (select watch_name from watch
						where watch.nickname = \"".$_COOKIE["username"].
						"\")";
			$result = mysqli_query($con, $query);
			//while($row = mysqli_fetch_array($result)){
			$row = mysqli_fetch_array($result);
			for ($i = 0; isset($row) && $i < $_GET['num'] + 3; $i++, $row = mysqli_fetch_array($result)){
				watch_block($row["nickname"], $row["avatar_src"], $row["time"], $row["photo_src"], $row["photo_id"]);
			}
		}
	}
?>
