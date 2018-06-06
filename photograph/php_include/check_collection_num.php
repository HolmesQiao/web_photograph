<?php
	$con = mysqli_connect("localhost", "root", "your_psw") or 
		die("Could not connect database:" .mysqli_error());
	mysqli_select_db($con, "photograph");
	//检查是否收藏,对图片收藏进行相关操作
	$collection_status = "select count(nickname) from collection where photo_id = \"" . $_POST["photo_id"] . "\" group by(photo_id)";
	$status_result = mysqli_query($con, $collection_status);
	$status_row = mysqli_fetch_array($status_result);
	mysqli_close($con);
	echo $status_row["count(nickname)"];
?>
