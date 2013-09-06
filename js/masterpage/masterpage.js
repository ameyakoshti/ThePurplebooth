$(document).ready(function(){
	get_live_notifications();
});

function get_live_notifications(){
	$.ajax({
		type : 'Get',
		url  : '/codenameDS/database/notifications.php',
		async : true,
		cache : false,
		data : {
			'userid' : user_id,
			'get_unread_notifications' : true
		},
		success : function(data) {
					var json = jQuery.parseJSON(data);
					$.each(json,function(id,value) {
						$('.notification_number').text(value.unread_notifications);
					});
					setTimeout('get_live_notifications()', 1000);
		},
		error : function(XMLHttpRequest, textstatus, error) { 
					alert(error);
					setTimeout('get_live_notifications()', 15000);
		}		
	});
}