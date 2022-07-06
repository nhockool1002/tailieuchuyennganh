function abc(){
	var url = $('.getAdminList').data('url');
	var list = $('.userlist tbody');
	$.ajax({
		url : url,
		type: 'get',
	}).done(function(data){
		for (var i = 0; i < data.length; i++) {
			list.html('<tr><td>'+ data[i].id +'</td><td>'+ data[i].username +'</td><td>'+ data[i].email +'</td><td>'+ data[i].created_at +'</td><td>'+ 'vl' +'</td></tr>');
		}
	});
}

function cpc() {
	var copyText = document.getElementById("newLink");
  	copyText.select();
  	document.execCommand("copy");
  	alert("Đã sao chép liên kết : " + copyText.value);
}