<?php
	/*Connect mysql and check error*/
	$con = mysqli_connect("localhost", "root", "qiaopengju");
	if (!$con){
		die("Could not connect database:" .mysqli_error());
	}

	/**/
	//echo "select nickname, email from web_user where nickname=\"" . $_POST["name"] . "\" and email=\"" . $_POST["email"] . "\"";

	mysqli_select_db($con, "photograph");
	$result = mysqli_query($con, "select nickname, email
			from web_user
			where nickname=\"" . $_POST["name"] . "\" or email=\"" . $_POST["email"] . "\"");
	if (!mysqli_fetch_array($result)){
		mysqli_query($con, "insert into web_user(nickname, email, password)
				values(\"" . $_POST["name"] . "\",\"" . $_POST["email"] . "\",\"" . $_POST["password"] . "\")");
		setcookie("username", $_POST["name"], time() + 36000);
		header("Location:../main.php");
	}else{
		$result_name = mysqli_query($con, "select nickname from web_user where nickname=" . $_POST["name"]);
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
