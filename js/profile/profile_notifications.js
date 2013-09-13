$(document).ready(function(){
	var show_notifications = false;
	if(typeof(loggedusername)!='undefined'){
		if(loggedusername==username){
			show_notifications = true;
		}
	}
	if(show_notifications){
		$('#myNotTab a').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show');
			});
		getRequestsMadeApproved();
		getRequestsMade();
		getRequestsGot();
		getComments();
		$('#myNotTab a[href="#reqApproved"]').tab('show');
		updateNotificationStatus();
	}
	else{
		$('#notification_link').remove();
		$('#notifications').remove();
	}
	 $(window).scrollTop(0);
});

function getComments(){
	
}

function updateNotificationStatus(){
	$.ajax({
		url : '/codenameDS/database/notifications.php',
		data : {
			'set_notifications_read' : true,
			'user_id' : userid
		},
		type : 'post',
		async: true,
		success : function(output) {
		}
	});
}

function getRequestsMade(){
	$.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'get_request_to' : true,
			'user_id' : userid
		},
		type : 'get',
		async: true,
		success : function(output) {
			displayRequests(output, "#reqGot","from");
		}
	});
}

function getRequestsMadeApproved(){
	$.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'get_request_by_approved' : true,
			'user_id' : userid
		},
		type : 'get',
		async: true,
		success : function(output) {
			displayRequests(output, "#reqApproved","approved");
		}
	});
}

function getRequestsGot(){
	$.ajax({
		url : '/codenameDS/database/edit_request.php',
		data : {
			'get_request_by' : true,
			'user_id' : userid
		},
		type : 'get',
		async: true,
		success : function(output) {
			displayRequests(output, "#reqMade","to");
		}
	});
}

function displayRequests(output,container,direction) {
	var res = jQuery.parseJSON(output);
	$(container).html("");
	var content = "<ul>";
	if (output != null || output != "") {
		$.each(res, function(id,value) {
			if(direction=="from"){
				content+="<li>You have an edit request from <a href='http://localhost:8888/codenameDS/profile.php?username="+value.user_name+"'>"+value.user_name+"</a> for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.request_image_id+"'>this image</a></li>";
			}
			else if(direction=="to"){
				content+="<li>You have made edit request for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.request_image_id+"'>this image</a> uploaded by <a href='http://localhost:8888/codenameDS/profile.php?username="+value.user_name+"'>"+value.user_name+"</a></li>"
			}
			else if(direction=="approved"){
				content+="<li>Your edit request for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.request_image_id+"'>this image</a> uploaded by <a href='http://localhost:8888/codenameDS/profile.php?username="+value.user_name+"'>"+value.user_name+"</a> has been approved</li>"
			}
		}
		)
	}
	content += "</ul>";
	$(container).html(content);
}