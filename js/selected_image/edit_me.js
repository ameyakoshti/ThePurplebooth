$(document).ready(function(){
	if(userid==$('.selectedImage').data('userid')){
		$('.editImage').hide();
	}
	$('.editImage').click(function(event){
		make_request(event.target);
	});
});

function make_request(trgtObj){
	var res = $.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'check_valid_request' : true,
			'request_user_id' : userid,
			'image_id' : imageid
		},
		type : 'get',
		async: false,
		success : function(output) {
			//console.log(output);
			if(output==0){
				make_edit_request(trgtObj);
			}
			else{
				alert("You have already made a request");
			}
		}
	});
}

function make_edit_request(targtObj){
	$.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'insert_edit_request' : true,
			'request_user_id' : userid,
			'image_id' : imageid,
			'request_image_user_id':$('.selectedImage').data('userid')
		},
		type : 'post',
		async: false,
		success : function(output) {
			updateRequests(output);
		}
	});
}

function updateRequests(op){
	$('.requests').html(op);
}