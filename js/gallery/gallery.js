//	document.getElementById('links').onclick = function(event) {
//				event = event || window.event;
//				var target = event.target || event.srcElement, link = target.src ? target.parentNode : target, options = {
//					index : link,
//					event : event
//				}, links = this.getElementsByTagName('a');
//				if(target.classname !== 'goToImage')
//					blueimp.Gallery(links, options);
//			};

	$(document).ready(function(){
		$('.goToImage').click(function(event){
			event.preventDefault();
			document.location.href='http://localhost:8888/codenameDS/selected_image.php?image_id='+$(this).data('imgid');
		});
	}
	
);