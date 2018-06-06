<!--new_avatar.php-->
<!--上传头像的后端部分-->

<?php
	if($_FILES["file"]["size"]==0){//判断是否没有上传文件
		header("Location:submit_photo.php");
	}
	if (!file_exists("avatar/" .$_FILES["file"]["name"])){
		$img_src = "avatar/" . str_replace(" ", "", $_COOKIE["username"]) . "_" . 
			str_replace(" ", "", $_FILES["file"]["name"]);
		//echo $img_src;
		move_uploaded_file($_FILES["file"]["tmp_name"], $img_src);
		system("jpegoptim --size=60k ".$img_src);
		system("pngquant --quality=60 ".$img_src);
		system("mv ".str_replace(".png","-fs8.png", $img_src)." ".$img_src);
		if (isset($_COOKIE["username"])){
			$con = mysqli_connect("localhost", "root", "your_psw");
			if (!$con){
				die("Could not connect database:" .mysqli_error());
			}
			mysqli_select_db($con, "photograph");
			$result = mysqli_query($con, "select nickname, avatar_src
					from web_user
					where nickname=\"" . $_COOKIE["username"] . "\" and password=\"" . $_POST["password"].
					"\"");
			if ($row = mysqli_fetch_array($result)){
				system("rm ".$row["avatar_src"]);
				$query = "update web_user set avatar_src = \"" . $img_src . "\"
					where nickname = \"" . $_COOKIE["username"] . "\"";
				mysqli_query($con, $query);
				echo "<script>alert(\"上传成功\"); window.location.href=\"main.php\"; </script>";
			}else{
				echo "<script>alert(\"密码错误\"); window.location.href=\"main.php\"; </script>";
			}
		}
	}
?>
