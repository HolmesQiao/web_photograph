<!--new_img.php-->
<!--上传photo的后端部分-->

<?php
	//print_r($_FILES["file"]);
	$file_len = count($_FILES["file"]["name"]);
	if ($file_len == 0){//判断是否没有上传图片
		header("Location:submit_photo.php");
	}
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw") or die("Could not connect database:" .mysqli_error());
		mysqli_select_db($con, "photograph");
		for ($i = 0; $i < $file_len; $i++){//循环添加文件
			if (!file_exists("photo_db/" .$_FILES["file"]["name"][$i])){
				$img_src = "photo_db/" . str_replace(" ", "", $_COOKIE["username"]) . "_" . 
					str_replace(" ", "", $_POST["graphy"]) . "_" . str_replace(" ", "", $_FILES["file"]["name"][$i]);
				$img_compress_src = str_replace("photo_db/", "photo_db/compress/", $img_src);
				/*压缩图片*/
				move_uploaded_file($_FILES["file"]["tmp_name"][$i], $img_src);
				system("cp ".$img_src." ".$img_compress_src);
				system("jpegoptim --size=70k ".$img_compress_src);
				system("pngquant -f --quality=50-53".$img_compress_src);
				system("mv ".str_replace(".png","-fs8.png", $img_compress_src)." ".$img_compress_src);

				$result = mysqli_query($con, "select nickname
						from web_user
						where nickname=\"" . $_COOKIE["username"] . "\"");
				if (mysqli_fetch_array($result)){
					$time = date('Y_m_d_H_i_s');
					mysqli_query($con, "insert into photo(photo_id, nickname, photo_name, photo_src, graphy_id, time)
							values(\"" . $_COOKIE["username"] ."_".$_POST["graphy"]."_".$_FILES["file"]["name"][$i] . "\",\"" .
								$_COOKIE["username"] . "\",\"" . $_FILES["file"]["name"][$i] . "\",\"" .
								$img_src . "\",\"" . $_COOKIE["username"] . "_" . $_POST["graphy"] . "\", \"".$time."\")");
				}
			}
			header("Location:graphy.php?user=".$_COOKIE["username"]);
		}
	}
?>
