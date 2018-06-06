<script src="js/event.js"></script>
<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
<script src="js/collection.js"></script>

<?php
/*头像*/
/*作者信息*/
if (isset($_COOKIE["username"])){
	$con = mysqli_connect("localhost", "root", "your_psw");
	if (!$con){
		die("Could not connect database:" .mysqli_error());
	}
	mysqli_select_db($con, "photograph");
	$result = mysqli_query($con, "select nickname
			from web_user
			where nickname=\"" . $_COOKIE["username"] . "\"");
	if (mysqli_fetch_array($result)){/*用户已登录*/ /*判断应该输出什么内容*/
		if(isset($_GET["photo_id"])){
			$query = "select nickname from photo where photo_id=\"".$_GET["photo_id"]."\"";
			$result = mysqli_query($con, $query) or die("Cant perfom Query");
			$row = mysqli_fetch_array($result);
			$query3 = "select avatar_src from web_user where nickname=\"".$_GET["user"]."\"";/*取头像*/
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_array($result3);
			echo '<div>';
			if (isset($row3["avatar_src"])){
				echo '<a href="graphy.php?user='.$_GET["user"].'"><img src="'.$row3["avatar_src"].'" style="object-fit: cover; width: 70px; height: 70px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img></a>';
			}else{
				echo '<a href="graphy.php?user='.$_GET["user"].'"><img src="data/default.jpg" style="object-fit: cover; width: 70px; height: 70px; border-radius: 50%; margin: 10px 10px 0px 10px;"></img></a>';
			}
				echo '<span id = "username" style="color: white; left:80px; margin-left: 20px; text-align: left; top: 37px; position: absolute;">
				</span>';
			echo '<span style="font-size:30px; color: #0085ca; font-family: sans-serif; font-weight: bolder; top: 20px; position: absolute;">'.$row["nickname"].'</span></div><hr style="backgroud-color:rgb(255, 255, 255)" />';
			/*评论*/
				/*评论图标*/
				echo '<span style="margin-bottom: 10px">
						<img src="data/comment.png"; style="width:25px; margin-left: 10px;"></img>
						<span style="color:rgb(200, 200, 200)">Comments</span>';
			/*收藏数量*/
			$collection_num = "select count(nickname) from collection where photo_id = \"" . $_GET["photo_id"] . "\" group by(photo_id)";
			$num_result = mysqli_query($con, $collection_num);
			$num_row = mysqli_fetch_array($num_result);
			//收藏图标
			$collection_status = "select * from collection where nickname = \"" . $_COOKIE["username"] . "\"
				and photo_id = \"" . $_GET["photo_id"] . "\"";
			$status_result = mysqli_query($con, $collection_status);
			$status_row = mysqli_fetch_array($status_result);
			if (isset($status_row["nickname"])){//如果关注关系存在
				echo "<img src='data/collection_2.png'style='height:18px; width:21px; margin-left:20px;' onclick=\"collection(this, '".$_GET["photo_id"]."')\"></img>";
			}else{//如果没有关注关系
				echo "<img src='data/collection_1.png' style='height:18px; width:21px; margin-left:20px;' onclick=\"collection(this, '".$_GET["photo_id"]."')\"></img>";
			}
			echo '<span class="cmt_num">'.$num_row["count(nickname)"].' collections</span>
		  </span>';
		}
	}
	mysqli_close($con);
}
?>
<!--评论输入框-->
<div class="add_comment">
	<img src="data/add_comment.png" style="width:40px;" onclick="change_status()" onmouseover="cmt_on()"></img>
	<div id="input_comment" class="input_comment">
		<form method="POST" style="text-align: center" accept-charset="ISO-8859-1">
			<textarea id="comment" name="comment" maxlength="399" minlength="1" rows="5" cols="20"></textarea>
			<button style="height: 35px; text-align: center;">发表评论</button> 
		</form>
	</div>
</div>
<?php include"php_include/comment.php" ?>

<?php /*异步上传评论*/ ?>
<script>
	function cmt_on(){
		var cmt = document.getElementById("input_comment");
		cmt.style.display = "block";
	}
	function change_status(){
		var cmt = document.getElementById("input_comment");
		if (cmt.style.display = "block"){
			cmt.style.display = "none";
		}else{
			cmt.style.display = "block";
		}
	}
	function getGet(name){//获取get信息
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if(r != null) {
			return decodeURI(r[2]);
		}
		return null;
	}
	var formElement = document.querySelector("form");
	formElement.addEventListener("submit", function(ev){
		if (document.getElementById("comment").value.length < 3){
			alert("评论至少要有三个字!");
		}else{
			var photo_id = getGet("photo_id");
			var formData = new FormData(formElement);
			formData.append("photo_id", photo_id);
			var request = new XMLHttpRequest();
			request.open("POST", "new_comment.php", true);
			request.send(formData);
			ev.preventDefault();
			request.addEventListener("load", function(event) {
				alert("评论成功~");
				window.location.reload();
			});
		}
	}, false);
</script>
