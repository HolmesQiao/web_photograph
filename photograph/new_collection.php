<!--改变收藏选项-->
<!--new_comment.php-->

<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw") or
			die("Could not connect database:" .mysqli_error());
		mysqli_select_db($con, "photograph");
		$query = "select * from collection where nickname=\"".$_COOKIE["username"]."\" 
			 and photo_id=\"" .$_POST["photo_id"]. "\"";
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		if ($row["nickname"]){//如果当前是收藏的,则取消收藏
			$query_collection = "delete from collection where nickname=\"".$_COOKIE["username"]."\" 
				 and photo_id=\"" .$_POST["photo_id"]. "\"";
		}else{//如果当前没有收藏,则收藏
			$query_collection = "insert into collection values(\"".$_COOKIE["username"]."\" 
				 ,\"" .$_POST["photo_id"]. "\")";
		}
		mysqli_query($con, $query_collection);
		mysqli_close($con);
	}
?>
