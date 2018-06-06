var i = 1;
var bg_num = 9;
var ig_str="url(data/bg_i.jpg)"

function load_img(){
	for (i = 0; i < bg_num - 1; i++){
		new Image().src = "data/bg_i.jpg".replace("i", i);
	}
}

function change_bg_img(){
	var ig_ad = ig_str.replace("i", i);
	document.getElementById("body").style.backgroundImage=ig_ad;
	i = (i + 1) % bg_num;
	setTimeout("change_bg_img()", 4000)
}

load_img();
i = 0;
change_bg_img();
