<!--new_watching.php-->
<!--添加关注或取关信息-->
<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$query = "select watch_id from watch where nickname=\"".$_COOKIE["username"]."\" and watch_name = \"".$_POST["user"]."\"";
		$re = mysqli_query($con, $query);
		$row = mysqli_fetch_array($re)["watch_id"];
		if (isset($row)){//如果关注关系成立，则删除关注关系
			$query_ = "delete from watch where watch_id =\"".$row."\"";
		}else{//如果没有关注关系，则建立关注关系
			$query_ = "insert into watch(watch_id, nickname, watch_name)
				values(\"".$_COOKIE["username"]."_".$_POST["user"]."\",\"".
						$_COOKIE["username"]."\",\"".$_POST["user"]."\")";
		}
		mysqli_query($con, $query_);
		mysqli_close($con);
	}
?>
