$(document).ready(function(){
	$('#acceptbid').click(function(){
		if($("input[type='radio'].radioBtnClass").is(':checked')) {
	    var editor_name = $("input[type='radio'].radioBtnClass:checked").val();
	    accept_bidder(editor_name);
	    $('#bidders').hide();
	    $('#totalrequests').hide();
		}
		else{
			jError(
		    'Please select an editor',
		    {
		      autoHide : true,
		      TimeShown : 2000,
		      HorizontalPosition : 'center',
		      ShowOverlay : false
		    }
		  );
		}
	});
});

function accept_bidder(editor_name){
	$.ajax({
		url:'/thepurplebooth/database/edit_request.php',
		data:{
			'editor_found' : true,
			'editor_username':editor_name,
			'image_id' : imageid,
			'image_user_id' : $('.selectedImage').data('userid')
			 },
		type:'post',
		async:false,
		success: function(output){
			jSuccess(
			    'Editor assigned!',
			    {
			      autoHide : true,
			      TimeShown : 2000,
			      HorizontalPosition : 'center',
			      ShowOverlay : false
			    }
			);		
		}
	});
}