<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
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

			$con = mysqli_connect('localhost', 'root', 'root', 'codenameDS');
			// Check connection
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$res = mysqli_query($con, "SELECT `image_id` FROM `codenameDS`.`imageinfo`");

			echo '<div class="row">';
			echo '<div class="span12">';
			echo '<ul class="thumbnails">';

			while ($data = mysqli_fetch_array($res)) {
				echo '<li class="span3">';
				echo '<div class="thumbnail">';
				echo '<a href="view_image.php?id=' . $data['image_id'] . '">';
				echo '<img src="view_image.php?id=' . $data['image_id'] . '">';
				echo '</a>';
				echo '</div>';
				echo '</li>';
			}

			echo '</div>';
			echo '</div>';
			echo '</ul>';
			
			mysqli_close($con);
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
