$(document).ready(function(){
	$('.goToImage').click(function(event){
		event.preventDefault();
		document.location.href='http://localhost:8888/codenameDS/selected_image.php?image_id='+$(this).data('imgid');
	});
});