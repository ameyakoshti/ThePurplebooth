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
}

function startUp() {
	$('.enterComment').keyup(
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
						async: false,
						success : function(output) {
							getAllComments();
						}
					});
				}
			});
	
	$(document).keyup(function(e) {
		  if (e.keyCode == 27) { 
			  $('.enterReply').hide();
			  $('.replyComment').show();
		  }   // esc
		});
	
	$('.replyComment').click(function(e){
		$(this).parent('li').append('<textarea class="enterReply" placeholder="Enter reply here...">');
		$(this).hide();
		$('.enterReply').keyup(
				function(event) {
					if (event.keyCode == 13 && event.shiftKey) {
						event.stopPropagation();
						var content = this.value;
						var caret = getCaret($(this));
						this.value = content.substring(0, caret) + "\n"
								+ content.substring(caret, content.length);
					} else if (event.keyCode == 13) {
						console.log($(this).parent('li').data('commentid'));
						$.ajax({
							url : '/codenameDS/database/image_comment.php',
							data : {
								'reply_comment' : true,
								'user_id' : userid,
								'image_id' : imageid,
								'comment_text' : this.value,
								'comment_id' : $(this).parent('li').data('commentid')
							},
							type : 'post',
							async: false,
							success : function(output) {
								getAllComments();
							}
						});
					}
				});
	});
}

function displayComments(output) {
	var res = jQuery.parseJSON(output);
	$('.comments').html("");
	var content = "<ul>";
	if (output != null || output != "") {
		var replied = [];
		$.each(res, function(id,value) {
			var cmntid = value.comment_id;
			if(replied.indexOf(cmntid)==-1)
				content += "<li data-commentid="+value.comment_id+">"+value.comment_text+" "+value.comment_timestamp+"<br/><a class='replyComment' >Reply</a></li>";
			
			if(value.reply_id != null && replied.indexOf(cmntid)==-1){
				$.each(res, function(id,val) {
					if(cmntid == val.reply_comment_id){
						content += "<li class='threadedComment' data-replyid="+val.reply_id+">"+val.reply_text+" "+val.reply_timestamp+"</li>";
					}
				});
				replied.push(cmntid);
			}
		});
		

	}
	content += '</ul><textarea class="enterComment" placeholder="Enter comment here..."></textarea>';
	$('.comments').html(content);
	startUp();
}