<!--new_del_graphy.php-->
<!--删除相册的后端部分-->

<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname
				from web_user
				where nickname=\"" . $_COOKIE["username"] . "\"and password=\"" . 
				$_POST["password"] . "\"");
		if (mysqli_fetch_array($result)){
			$query2 = "select graphy_avatar from graphy where graphy_id=\"".$_COOKIE["username"]."_".$_POST["graphy"]."\"";
			$query = "delete from graphy where graphy_id=\"".$_COOKIE["username"]."_".$_POST["graphy"]."\"";
			$result2 = mysqli_query($con, $query2);
			/*删除相册*/
			if (mysqli_query($con, $query)){
				$row = mysqli_fetch_array($result2);
				$cmd = "rm " . $row["graphy_avatar"];
				echo $cmd;
				system($cmd);
				/*删除相册内的照片*/
				$query_del_1 = "select photo_src, photo_id from photo  where graphy_id=\"".$_COOKIE["username"]."_".$_POST["graphy"]."\"";
				$result_del_2 = mysqli_query($con, $query_del_1);
				while($row_del_2 = mysqli_fetch_array($result_del_2)){
					mysqli_query($con, "delete from cmt where re_photo_id=\"".$row_del_2["photo_id"]."\"");
					mysqli_query($con, "delete from collection where photo_id=\"".$row_del_2["photo_id"]."\"");
					$query_del_2 = "delete from photo where graphy_id=\"".$_COOKIE["username"]."_".$_POST["graphy"]."\"";
					/*删除照片*/
					//mysqli_query($con, $query_del_2);
					if(mysqli_query($con, $query_del_2)){
						system("rm " . $row_del_2["photo_src"]);
						system("rm " . str_replace("data/", "data/compress/", $row_del_2["photo_src"]));
					}
				}
			}
			header("Location:graphy.php?user=".$_COOKIE["username"]);
		}else{
			echo "<script>alert(\"密码错误\"); window.location.href=\"graphy.php?user=".$_COOKIE["username"]."\"; </script>";
		}
	}
?>
