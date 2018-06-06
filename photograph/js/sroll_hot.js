var canRun = true;
var nowY = window.scrollY;
var add_num = 0;
var y;

window.addEventListener("scroll", windowSroll);
function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++){
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
}
function windowSroll(){
	if (!canRun){
		return;
	}else{
		canRun = false;
		setTimeout(function(){
			y = nowY;
			nowY = window.scrollY;
			document.cookie="main_scroll="+nowY;
			if (y == nowY){
				return;
			}
			//if (y - nowY < 5 || y - nowY > -5) return;
			if (nowY - y > 0){
				add_num = nowY / 60;
				//window.location.reload();
				//window.scroll(0, getCookie("main_scroll"));
			}
			var request = new XMLHttpRequest();
			request.open("GET", "php_include/hot_content.php?num=" + add_num);
			request.onload = function(){
				document.querySelector("artical").innerHTML = request.response;
			};
			request.send();

			canRun = true;
		}, 500);
	}
}
