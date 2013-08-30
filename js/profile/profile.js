$(document).ready(function(){
		getAllReviews();
});

function getAllReviews() {
		var resp = $.ajax({
		url : '/codenameDS/database/user_rating.php',
		data : {
			'select_reviews' : true,
			'user_id' : userid
		},
		type : 'get',
		success : function(output) {
			displayReviews(output);
		}
	});
}

function displayReviews(output) {
	var res = jQuery.parseJSON(output);
	$('.reviews').html("");
	var content = "<ul>";
	// if no reviews then handle the foreach loop
	if (output != null || output != "") {
		$.each(res, function(id,value) {
			content+="<li>"+value.reviews+"</li>";			
		});
	}
	content += '</ul>';
	$('.reviews').html(content);
}