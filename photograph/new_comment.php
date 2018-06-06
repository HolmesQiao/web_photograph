<!--添加评论的后端-->
<!--new_comment.php-->

<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$msg_len = strlen($_POST["comment"]);
		$cmt_id = $_COOKIE["username"]."_".$_POST["photo_id"]."_".$msg_len."_".rand(0, 100);
		$time = date('Y_m_d_H_i_s');
		$query = "insert into cmt(cmt_id, nickname, cmt_inner, re_photo_id, time)
			values(\"".$cmt_id."\",\"".$_COOKIE["username"]."\",\"".$_POST["comment"]."\",\"".
					$_POST["photo_id"]."\",\"".$time."\")";
		system("echo " . $query ." > photo_db/query");
		if (mysqli_query($con, $query)){
			system("echo " . $cmt_len ." > photo_db/query");
		}
	}
?>
