<?php
	if (isset($_COOKIE["username"])){
		$query_judge = "select watch_id from watch where nickname=\"".$_COOKIE["username"]."\" and watch_name = \"".$_GET["user"]."\"";
		$re_judge = mysqli_query($con, $query_judge);
		$row_judge = mysqli_fetch_array($re_judge);
		if (isset($row_judge["watch_id"])){//如果关注关系成立
			echo '<div style="margin-left:18px; color:#0085ca; font-weight: bold" onclick="watch()">关注中</div>';
		}else{//如果关注关系不成立
			echo '<div style="margin-left:18px; color:#0085ca; font-weight: bold" onclick="watch()">关注</div>';
		}
	}
?>
