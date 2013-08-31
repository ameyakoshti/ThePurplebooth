<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
?>

<html>
	<head>
		<title>Gallery</title>
	</head>
	<body>
		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
			$category = $_GET['category'];
		?>
		
		</br>
		</br>
		</br>
		
		<div class="btn-group">
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				Category <?php echo "- ".ucfirst($category); ?>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=all">All</a> </li>
				<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=portraits">Portraits</a> </li>
				<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=landscapes">Landscapes</a> </li>
				<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=myimages">My Images</a> </li>
			</ul>
		</div>		

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
				echo '<div class="row">';
				echo '<div class="span12">';
				echo '<ul class="thumbnails">';
				
				if($category=='all'){
					get_all_images();
				}
				else if($category=='myimages'){
					get_my_images($_SESSION['codenameDS_user_id']);
				}
				else {
					get_filtered_images($category);
				}
	
				echo '</div>';
				echo '</div>';
				echo '</ul>';			
			?>
		</div>
		<script src="/codenameDS/js/blueimp-gallery.min.js"></script>
		<script src="/codenameDS/js/gallery/gallery.js"></script>
	</body>
</html>
