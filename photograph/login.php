<?php
	/*Connect mysql and check error*/
	$con = mysqli_connect("localhost", "root", "your_psw");
	if (!$con){
		die("Could not connect database:" .mysqli_error());
	}
	mysqli_select_db($con, "photograph");
	$result = mysqli_query($con, "select nickname
			from web_user
			where nickname=\"" . $_POST["name"] . "\" and password=\"" .$_POST["password"] . "\"");
	if (!mysqli_fetch_array($result)){
//		setcookie("user_error", "Incorrect username or password");
		echo '<script>alert("Wrong username or password!"); window.location.href="user_login.php";</script>';
		//header("Location:user_login.php");
	}else{
		setcookie("username", $_POST["name"], time() + 360000);
		header("Location:main.php");
	}
?>
