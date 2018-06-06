<!--header_main.php-->
<!--包含了最上的head和一个大标题栏-->

<?php
	if (!isset($_COOKIE["username"])){
		header("Location:user_login.php");
	}
?>

<header id="header">
	<?php include"php_include/header.php"; ?>
	<!--login and logout-->
</header>

<!--tittle-->
<section id="One" class="wrapper style3" style="opacity: 1;">
	<div class="inner">
		<header class="align-center">
			<p id="title1">Let here appear bright</p>
			<h2 id="title">PHOTOGRAPH</h2>
		</header>
	</div>
</section>
<!--introduce-->
<img id="introduce" src="data/introduce.png" width=0px
	style="position: fixed; top: 43px; left: 0; z-index: 999;"></img>

<!--修改标题栏-->
<script>
	function change_title(title, user){
		var v = document.getElementById("title").textContent;
		var v2 = document.getElementById("title1").textContent;
		document.getElementById("title").textContent = title;
		document.getElementById("title1").textContent = user;
	}
</script>
<?php 
	if(isset($_GET["graphy"])){
		echo '<script>change_title("'.$_GET["graphy"].'","'.$_GET["user"].'");</script>';
	}
?>
