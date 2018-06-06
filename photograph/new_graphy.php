<!--new_graphy.php-->
<!--新建相册的后端部分-->

<?php
	if($_FILES["file"]["size"]==0){//判断是否没有上传文件
		header("Location:submit_photo.php");
	}
	if (!file_exists("avatar/" .$_FILES["file"]["name"])){
		$img_src = "avatar/" . $_COOKIE["username"] . "_" . 
			str_replace(" ", "", $_POST["graphyname"]) . $_FILES["file"]["name"];
		echo $img_src;
		move_uploaded_file($_FILES["file"]["tmp_name"], $img_src);
		system("jpegoptim --size=75k -d".$img_src);
		system("pngquant --quality=60 ".$img_src);
		if (isset($_COOKIE["username"])){
			$con = mysqli_connect("localhost", "root", "your_psw");
			if (!$con){
				die("Could not connect database:" .mysqli_error());
			}
			mysqli_select_db($con, "photograph");
			$result = mysqli_query($con, "select nickname
					from web_user
					where nickname=\"" . $_COOKIE["username"] . "\" and password=\"" . $_POST["password"].
					"\"");
			echo $img_src;
			if (mysqli_fetch_array($result)){
				$query = "insert into graphy(graphy_id, nickname, graphy_name, graphy_avatar)
					values(\"".$_COOKIE["username"]."_".$_POST["graphyname"]."\",\"".
							$_COOKIE["username"]."\",\"".$_POST["graphyname"]."\",\"".$img_src.
							"\")";
				mysqli_query($con, $query);
				header("Location:graphy.php?user=".$_COOKIE["username"]);
			}else{
				echo "<script>alert(\"密码错误\"); window.location.href=\"graphy.php?user=".$_COOKIE["username"]."\"; </script>";
			}
		}
	}
?>
