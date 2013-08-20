<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/connections.php";
?>

<html>
	<head>
		<title>Gallery</title>
	</head>
	<body>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>

		<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
			<div class="slides"></div>
			<h3 class="title"></h3>
			<a class="prev"><</a>
			<a class="next">></a>
			<a class="close">x</a>
			<a class="play-pause"></a>
			<ol class="indicator"></ol>
		</div>

		<div class="imgGallery" id="links">
			<?php
			open_connection();

			echo '<div class="row">';
			echo '<div class="span12">';
			echo '<ul class="thumbnails">';
			
			get_all_images();

			echo '</div>';
			echo '</div>';
			echo '</ul>';
			
			//close_connection();
			?>
		</div>
		<script src="/codenameDS/js/blueimp-gallery.min.js"></script>
		<script>
			document.getElementById('links').onclick = function(event) {
				event = event || window.event;
				var target = event.target || event.srcElement, link = target.src ? target.parentNode : target, options = {
					index : link,
					event : event
				}, links = this.getElementsByTagName('a');
				blueimp.Gallery(links, options);
			};
		</script>
	</body>
</html>
