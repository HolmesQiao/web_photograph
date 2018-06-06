<!--删除照片后端部分-->

<?php
	if (isset($_GET["del"])){
		if (isset($_COOKIE["username"])){
			$con = mysqli_connect("localhost", "root", "your_psw");
			if (!$con){
				die("Could not connect database:" .mysqli_error());
			}
			mysqli_select_db($con, "photograph");
			$query1 = "select nickname
					from photo
					where photo_id=\"" . $_GET["del"] . "\"";
			//echo $query1;
			$result = mysqli_query($con, $query1);
			$row = mysqli_fetch_array($result);
			if ($_COOKIE["username"] == $row["nickname"]){
				$query3 = "select photo_src from photo  where photo_id=\"".$_GET["del"]."\"";
				$query2 = "delete from photo where photo_id=\"".$_GET["del"]."\"";
				$result2 = mysqli_query($con, $query3);
				/*先删除外键*/
				/*删除照片*/
				mysqli_query($con, "delete from collection where photo_id=\"".$_GET["del"]."\"");
				mysqli_query($con, "delete from cmt where re_photo_id=\"".$_GET["del"]."\"");
				if(mysqli_query($con, $query2)){
					$row2 = mysqli_fetch_array($result2);
					system("rm " . $row2["photo_src"]);
					system("rm " . str_replace("photo_db/", "photo_db/compress/", $row2["photo_src"]));
					echo "success";
				}
			}
		}
		header("Location:main.php");
	}
?>
