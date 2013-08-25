$(document).ready(function(){
		startUp();
		getAllComments();
});

function getAllComments() {
	var resp = $.ajax({
						url : '/codenameDS/database/image_comment.php',
						data : {
							'select_comments' : true,
							'image_id' : imageid
						},
						type : 'get',
						success : function(output) {
							displayComments(output);
						}
					});
	console.log(resp);
}

function startUp() {
	$('textarea').keyup(
			function(event) {
				if (event.keyCode == 13 && event.shiftKey) {
					event.stopPropagation();
					var content = this.value;
					var caret = getCaret(this);
					this.value = content.substring(0, caret) + "\n"
							+ content.substring(caret, content.length);
				} else if (event.keyCode == 13) {
					$.ajax({
						url : '/codenameDS/database/image_comment.php',
						data : {
							'insert_comment' : true,
							'user_id' : userid,
							'image_id' : imageid,
							'comment_text' : this.value
						},
						type : 'post',
						success : function(output) {
							getAllComments();
						}
					});
				}
			});
}

function displayComments(output) {
	var res = jQuery.parseJSON(output);
	$('.comments').html("");
	var content = "<ul>";
	if (output != null || output != "") {
		//console.log(output.length);
		/*for(var i = 0; i < output.length; i++){
			content += "<li>"+output[i].comment_text+" "+output[i].comment_timestamp+"</li>";
		}*/
		$.each(res, function(id,value) {
			content += "<li>"+value.comment_text+" "+value.comment_timestamp+"</li>";
		});
		

	}
	content += '</ul><textarea class="enterComment" placeholder="Enter comment here..."></textarea>';
	$('.comments').html(content);
	startUp();
}