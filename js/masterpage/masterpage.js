$(document).ready(function(){
	if(typeof(user_id)!='undefined')
		get_live_notifications();
	else
		$('.notification_number').hide();
});

function get_live_notifications(){
	$.ajax({
		type : 'Get',
		url  : '/thepurplebooth/database/notifications.php',
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
			console.log(error);
					setTimeout('get_live_notifications()', 15000);
		}		
	});
}