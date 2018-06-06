function collection(obj, photo_id){
	var request = new XMLHttpRequest();
	var dataform = new FormData();
	dataform.append("photo_id", photo_id);
	request.open("POST", "new_collection.php");
	request.onload = function(){
		var new_request = new XMLHttpRequest();
		var new_dataform = new FormData();
		new_dataform.append("photo_id", photo_id);
		new_request.open("POST", "php_include/check_collection.php");
		new_request.onload = function(){
			obj.src = new_request.response;
			var num_request = new XMLHttpRequest();
			num_request.open("POST", "php_include/check_collection_num.php");
			num_request.onload = function(){
				var cmt_num = document.querySelector("span.cmt_num");
				var num = num_request.response;
				num += " collections";
				cmt_num.innerHTML= num;
			}
			num_request.send(new_dataform);
		}
		new_request.send(new_dataform);
	}
	request.send(dataform);
}
