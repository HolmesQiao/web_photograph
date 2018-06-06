<?php
/*显示照片评论*/
	function avatar($src, $usr, $cmt, $cmt_id){
		/*头像*/
		echo '<div style="position: relative"><span>
				<img src="'.$src.'" style="width: 30px; height: 30px; object-fit:cover; border-radius: 50%; margin: 10px 10px 0px 10px;"></img>
				<span id = "username" style="color: gray; left:80px; margin-left: 20px; text-align: left; top: 34px; position: absolute;">
			</span>';
		/*用户名*/
		echo '<span style="color: white; font-family: sans-serif; font-weight: bolder; top: 20px; position: absolute;">'.$usr.'</span></div>';
		echo '<div style="text-align:left; margin-bottom: 10px; margin-left: 20px;color:rgb(200, 200, 200); font-family:sans-serif; padding-left: 10px; padding-right: 20px; border-left: 2px solid gray;">'.$cmt.
			'<p/><a onclick=\'reply("'.$usr.'")\' style="position: absolute; right:20px; margin-left: 10px;"><img src="data/reply.png" style="height:20px;weight:20px;"/></a><hr style="margin:10px"/>
			</div>';
	}

	/*检测用户登录与否*/
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname from web_user
			where nickname=\"" . $_COOKIE["username"] . "\"");
		if (mysqli_fetch_array($result)){/*用户已登录*/ /*判断应该输出什么内容*/
			/*打印评论内容*/
			$query1 = "select * from cmt where re_photo_id=\"".$_GET["photo_id"]."\"
				and re_cmt_id IS NULL";/*query1:输出只评论相片，不是回复的评论*/

			$query2 = "select * from cmt where re_photo_id=\"".$_GET["photo_id"]."\" order by time desc";/*测试用*/
			$result1 = mysqli_query($con, $query2) or die("Cant perfom Query");
			while($row = mysqli_fetch_array($result1)){
				$query3 = "select avatar_src from web_user where nickname=\"".$row["nickname"]."\"";/*取头像*/
				$result3 = mysqli_query($con, $query3);
				$row3 = mysqli_fetch_array($result3);
				if (isset($row3["avatar_src"])){
					avatar($row3["avatar_src"], $row["nickname"], $row["cmt_inner"]);
				}else{
					avatar("data/default.jpg", $row["nickname"], $row["cmt_inner"]);
				}
			}
			mysqli_close($con);
		}
		mysqli_close($con);
	}

/*头像*/
/*作者信息*/
?>
<script>
	function reply(usr){
		var cmt_block = document.getElementById("input_comment");
		cmt_block.style.display = "block"
		document.getElementById("comment").value = "Reply "+usr+":";
	}
</script>
