$(document).ready(function(){
	$('.editImage').click(function(event){
		make_edit_request(event.target);
	});
});

function make_edit_request(targtObj){
	console.log($(targtObj).parent().data('imageid'));
	$.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'insert_edit_request' : true,
			'request_user_id' : userid,
			'image_id' : imageid,
			'request_image_user_id':$(targtObj).parent().data('userid')
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