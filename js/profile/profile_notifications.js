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
		getRequests();
		getComments();
		$('#myNotTab a[href="#requests"]').tab('show');
		updateNotificationStatus();
	}
	else{
		$('#notification_link').remove();
		$('#notifications').remove();
	}

    $('.container-fluid').scrollTop(0);
});

function getComments(){
	
}

function getRequests(){
	$.ajax({
		url : '/codenameDS/database/notifications.php',
		data : {
			'get_requests' : true,
			'user_id' : userid
		},
		type : 'get',
		async: true,
		success : function(output) {
			displayNotifications(output, "#requests");
		}
	});
}

function getComments(){
	$.ajax({
		url : '/codenameDS/database/notifications.php',
		data : {
			'get_comments' : true,
			'user_id' : userid
		},
		type : 'get',
		async: true,
		success : function(output) {
			displayNotifications(output, "#comments");
		}
	});
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

function displayNotifications(output,container) {
	var res = jQuery.parseJSON(output);
	$(container).html("");
	var content = "<ul>";
	if (output != null || output != "") {
		$.each(res, function(id,value) {
			if(value.notification_type=="REQUEST_NEW"){
				content+="<li>You have an edit request for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.notification_image_id+"'>this image</a></li>";
			}
			else if(value.notification_type=="REQUEST_DENIED"){
				content+="<li>Your edit request for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.notification_image_id+"'>this image</a> has been denied.</li>";
			}
			else if(value.notification_type=="REQUEST_APPROVED"){
				content+="<li>Your edit request for <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.notification_image_id+"'>this image</a> has been approved</li>";
			}
			else if(value.notification_type=="COMMENT"){
				content+="<li>Your <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.notification_image_id+"'>image</a> has got a comment.</li>";
			}
			else if(value.notification_type=="REPLY"){
				content+="<li>Your comment on <a href='http://localhost:8888/codenameDS/selected_image.php?image_id="+value.notification_image_id+"'>image</a> has got a reply.</li>";
			}
		}
		)
	}
	content += "</ul>";
	$(container).html(content);
}