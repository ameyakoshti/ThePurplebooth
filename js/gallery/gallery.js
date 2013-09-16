document.getElementById('links').onclick = function(event) {
				event = event || window.event;
				var target = event.target || event.srcElement, link = target.src ? target.parentNode : target, options = {
					index : link,
					event : event
				}, links = this.getElementsByTagName('a');
				if(target.classname !== 'goToImage')
					blueimp.Gallery(links, options);
			};

	$(document).ready(function(){
//		$('.goToImage').click(function(event){
//			event.preventDefault();
//			document.location.href='http://localhost:8888/codenameDS/selected_image.php?image_id='+$(this).data('imgid');
//		});

		// Trying out some gallery styles to show images..
		
		imagesLoaded( '#images-container', function() {
			var options = {
	          itemWidth: 200, // Optional min width of a grid item
	          autoResize: true, // This will auto-update the layout when the browser window is resized.
	          resizeDelay: 10,
	          direction: left,
	          fillEmptySpace: true,
	          container: $('#images-container'), // Optional, used for some extra CSS styling
	          offset: 10, // Optional, the distance between grid items
	          outerOffset: 20, // Optional the distance from grid to parent
	          flexibleWidth: true // Optional, the maximum width of a grid item
	        };

	        // Get a reference to your grid items.
	        var handler = $('#images-container img');

	        // Call the layout function.
	        handler.wookmark(options);
	        
		});
		
		
//		$('#images-container').wookmark({
//			itemWidth: 100, // Optional min width of a grid item
//	        autoResize: true, // This will auto-update the layout when the browser window is resized.
//	        container: $('#images-container'), // Optional, used for some extra CSS styling
//	        offset: 10, // Optional, the distance between grid items
//	        outerOffset: 20, // Optional the distance from grid to parent
//	        flexibleWidth: 250 // Optional, the maximum width of a grid item
//		});
		
	}
);