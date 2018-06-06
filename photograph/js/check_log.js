/*var u1 = document.getElementById("u1");
var u2 = document.getElementById("u2");
//alert(document.cookie);*/
function logout(){
	document.cookie="username=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
	window.location.reload();
}
/*if (document.cookie.length == 0){
	u1.href="user_login.php";
	u2.href="user_setup.php";
	u1.innerHTML="Login";
	u2.innerHTML="Registe";
}else{
	u1.href="#"; u2.href="#";
	u1.innerHTML=document.cookie.replace("username=", "");
	u1.style.color="#0085ca";
	u2.innerHTML="Logout";
	u2.addEventListener("mouseup", logout);
}*/
