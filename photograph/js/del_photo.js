function del_photo(photo_id){
	if(confirm("确定要删除这张照片吗?")){
		var hre = "Location:http:118.24.109.65/new_del_photo.php?del="+photo_id;
		window.location.href="new_del_photo.php?del="+photo_id;
	}
}
