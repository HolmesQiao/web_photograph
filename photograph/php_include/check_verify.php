<?php
	if (isset($_GET["verify"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con) die("Could not connect database:" .mysqli_error());
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select *
				from tmp_user
				where code=\"" . $_GET["verify"] . "\"");
		if ($row = mysqli_fetch_array($result)){//找到验证信息
			mysqli_query($con, "insert into web_user(nickname, email, password)
					values(\"" . $row["nickname"] . "\",\"" . $row["email"] . "\",\"" . $row["password"] . "\")");
			mysqli_query($con, "delete from tmp_user where code = \"".$_GET["verify"]."\"");//验证成功删除临时信息
			setcookie("username", $row["nickname"], time() + 36000);
			echo '<script>alert("你吼, 已验证成功(:3|__|)"); window.location.href="main.php";</script>';
			//header("Location:../main.php");
		}
	}
?>
