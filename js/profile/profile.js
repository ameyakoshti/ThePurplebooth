$(document).ready(function() {
	$("#img_container").click(function() {
		$("#userfile").show();
	});
	
	if(document.location.hash!='') {
	    //get the index from URL hash
	    tabSelect = document.location.hash.substr(1,document.location.hash.length);
	    console.log(tabSelect);
	    $('#myTab a[href="#'+tabSelect+'"]').tab('show');
	    $('.container-fluid').scrollTop(0);
	}
	
	$('#myTab a').click(function (e) {
		  e.preventDefault();
		  $(this).tab('show');
		});
	getAllReviews();
});

function getAllReviews() {
	var resp = $.ajax({
		url : '/codenameDS/database/user_rating.php',
		data : {
			'select_reviews' : true,
			'user_name_rating' : username
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
		$.each(res, function(id, value) {
			content += "<li> Rating " + value.stars + "</li>";
			content += "<li>" + value.reviews + " (rated by: <a href=http://localhost:8888/codenameDS/profile.php?username=" + value.rated_by_user_name + ">" + value.rated_by_user_name + "</a> ) </li>";
		});
	}
	content += '</ul>';
	$('.reviews').html(content);
}