<?php
	/*Connect mysql and check error*/
	$con = mysqli_connect("localhost", "root", "your_psw");
	if (!$con){
		die("Could not connect database:" .mysqli_error());
	}

	/**/
	//echo "select nickname, email from web_user where nickname=\"" . $_POST["name"] . "\" and email=\"" . $_POST["email"] . "\"";

	mysqli_select_db($con, "photograph");
	$result = mysqli_query($con, "select nickname, email
			from web_user
			where nickname=\"" . $_POST["name"] . "\" or email=\"" . $_POST["email"] . "\"");
	if (!mysqli_fetch_array($result)){//无重复信息,可以发送验证码
		$bytes = openssl_random_pseudo_bytes(16, $crypto_strong);//生成乱序2进制串
		$code = bin2hex($bytes);//将二进制串转为16进制
		mysqli_query($con, "insert into tmp_user(nickname, email, password, code)
				values(\"" . $_POST["name"] . "\",\"" . $_POST["email"] . "\",\"" . $_POST["password"] . "\",\"" . $code. "\")");
		include"php_include/mail.php";
		echo "<script>alert('已发送验证码,请在1小时内前往邮箱完成验证~'); window.location.href='user_setup.php';</script>";
		//setcookie("username", $_POST["name"], time() + 36000);
		//header("Location:../main.php");
	}else{
		$result_name = mysqli_query($con, "select nickname from web_user where nickname=\"" . $_POST["name"]."\"");
		if (mysqli_fetch_array($result_name)){
			echo "<script>alert('User already exist!'); window.location.href='user_setup.php';</script>";
			//header("Location:../user_setup.php");
		}else{
			echo "<script> alert('email already exist!'); window.location.href='user_setup.php';</script>";
			//header("Location:../user_setup.php");
		//	setcookie("email_error", "email adress exist");
		}
		//header("Location:../user_setup.php");
	}
?>

<script>
	//document.cookie="error=" + $error;
</script>

<?php
//	header("Location:user_setup.php");
?>
