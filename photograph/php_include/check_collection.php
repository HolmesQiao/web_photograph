<?php
	$con = mysqli_connect("localhost", "root", "your_psw") or 
		die("Could not connect database:" .mysqli_error());
	mysqli_select_db($con, "photograph");
	//检查是否收藏,对图片收藏进行相关操作
	$collection_status = "select * from collection where nickname = \"" . $_COOKIE["username"] . "\"
		and photo_id = \"" . $_POST["photo_id"] . "\"";
	$status_result = mysqli_query($con, $collection_status);
	$status_row = mysqli_fetch_array($status_result);
	mysqli_close($con);
	if (isset($status_row["nickname"])){//如果关注关系存在
		echo 'data/collection_2.png';
	}else{//如果没有关注关系
		echo 'data/collection_1.png';
	}
?>
