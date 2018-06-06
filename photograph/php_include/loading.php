<?php
echo'
	<script>
	setTimeout(function(){
		document.getElementById("loading").style.display="none";
	}, 3000);
	</script>
	<div id="loading" style="width:100%; height:100%; background-color:white; position: fixed; z-index:999">
	<img src="data/loading.gif" style="top:0;bottom:0;left:0;right:0;margin:auto;position:absolute;"/>
	</div>';
?>
