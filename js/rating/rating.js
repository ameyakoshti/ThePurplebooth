$(document).ready(function() {
	$('.ratings_stars').hover(function() {
		$(this).prevAll().andSelf().addClass('ratings_over');
	},

	function() {
		$(this).prevAll().andSelf().removeClass('ratings_over');
	});

	$('.ratings_stars').bind('click', function() {

		var id = $(this).parent().attr("id");
		var num = $(this).attr("class");
		var poststr = "id=" + id + "&stars=" + num;
		$.ajax({
			url : "/codenameDS/rate.php",
			cache : 0,
			data : poststr,
			success : function(result) {
				document.getElementById(id).innerHTML = result;
			}
		});
	});
});

