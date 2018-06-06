<!--submit_file.php-->
<!--用于上传photo的表单，表单将被提供给new_img.php-->

<link href="assets/css/kkyou.css" rel="stylesheet" type="text/css" />
<link href="assets/css/main.css" rel="stylesheet" type="text/css" />

<form id="file_form" action="new_img.php" method="POST" enctype="multipart/form-data">
	<br /><div class="f_c"><img src="data/kkyou.png" width=130px /></div>
	<div class="f_c text"><span>分享你的灵感</span></p></div>
	<div class="f_c">
		<label id="button" class="submit">
			<input id="up_imgFile" type="file" name="file[]" multiple accept="image/png, image/jpeg, image/jpg, image/gif">
		</label>
		<b>Upload images</b><br/>
		<select id="graphy" name="graphy" style="color:black; width: 50%; margin: 0 auto; border: 5px solid: black;">
			<option value="">请选择相册</option>
			<?php include"graphy_list.php"?>
		</select><br /><br />
		<button id="sub_button" class="submit" style="margin-bottom:10px; background-color: rgba(20, 20, 20, 0.9); border-radius: 10px;"><b style="color:white">Submit</b></button><br />
	</div>
</form>

<script>
	document.getElementById("sub_button").addEventListener("mousedown", check_error);
	function check_error(){
		var file = document.getElementById("up_imgFile");
		var graphy = document.getElementById("graphy");
		try{
			if (file.value=="") throw "please upload image";
			if (graphy.value=="") throw "please select graphy";
		}catch(err){
			alert(err);
		}
	}
</script>

