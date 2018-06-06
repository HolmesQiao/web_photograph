<?php
	if (isset($_COOKIE["username"])){
		$con = mysqli_connect("localhost", "root", "your_psw");
		if (!$con){
			die("Could not connect database:" .mysqli_error());
		}
		mysqli_select_db($con, "photograph");
		$result = mysqli_query($con, "select nickname
				from web_user
				where nickname=\"" . $_COOKIE["username"] . "\"");
		if (mysqli_fetch_array($result)){
			$query = "select graphy_name from graphy where nickname=\"" . $_COOKIE["username"] . "\"";
			$result = mysqli_query($con, $query) or die("Cant perfom Query");
			while($row = mysqli_fetch_array($result)){
				echo "<option value=\"". $row["graphy_name"] ."\">" . $row["graphy_name"] . "</option>";
			}
		}
		mysqli_close($con);
	}
?>
