function introduce(){
    document.getElementById("introduce").style.transitionDuration = "1s";
    document.getElementById("introduce").style.width = "200px";
}
function nointroduce(){
    document.getElementById("introduce").style.transitionDuration = "1s";
    document.getElementById("introduce").style.width = "0px";
}
function getCookie(cname){
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++){
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
}
function getGet(name){
	//构造一个含有目标参数的正则表达式对象
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
	//匹配目标参数
	var r = window.location.search.substr(1).match(reg);
	//返回参数值
	if(r != null) {
		return decodeURI(r[2]);
	}
	return null;
}
var kkyou = document.getElementById("kkyou");
kkyou.addEventListener("mouseover", introduce);
kkyou.addEventListener("mouseout", nointroduce);
