$(document).ready(function() {
	$('.ratings_stars').hover(function() {
		$(this).prevAll().andSelf().addClass('ratings_over');
	},

	function() {
		$(this).prevAll().andSelf().removeClass('ratings_over');
	});
	
	$('#download').bind('click', function() {
		comments = $("#reviewcomments").val(); 
		
		if(!comments){
			$('#reviewcomments').tooltip({'trigger':'focus', 'title': 'Password tooltip'});
		}
		else{
			$.ajax({
				url:'/thepurplebooth/database/user_rating.php',
				data:{
				'update_comments' : true,
				'editor_user_id':editor_id,
				'comments':comments,
				'rated_by' : $('.selectedImage').data('userid')
				},
				type:'post',
				async:false,
				success: function(output){
				jSuccess(
				    'Review submitted!',
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
	});

	$('.ratings_stars').bind('click', function() {
		var id = $(this).parent().attr("id");
		var num = $(this).attr("class");
		var rated_by = $(this).attr("id");
		var poststr = "id=" + id + "&stars=" + num + "&rated_by="+ rated_by;
		$.ajax({
			url : "/thepurplebooth/database/ratings.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				document.getElementById(id).innerHTML = result;
			}
		});
	});
});

