<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
require_once "database/users.php";
?>

<html>
	<head>
		<title>Gallery</title>
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="js/gallery/imagesloaded.pkgd.js"></script>
		<script type="text/javascript" src="js/gallery/jquery.wookmark.js"></script>
		<script type="text/javascript" src="js/gallery/gallery.js"></script>
		<link rel="stylesheet" type="text/css" href="css/gallery.css" />
		
		<!--  Styling code.. Do Not Touch.. -->
	
		<script type="text/javascript">
			(function ($){
				imagesLoaded('#images-container', function() {
					alert('Loaded images..');
		        	var options = {
			        autoResize: true, // This will auto-update the layout when the browser window is resized.
		            container: $('#tiles'), // Optional, used for some extra CSS styling
		            offset: 10, // Optional, the distance between grid items
		          	outerOffset: 40, // Optional the distance from grid to parent
		          	flexibleWidth: 450, // Optional, the maximum width of a grid item
		          	resizeDelay: 0
		        	};
		
			        var handler = $('#tiles li');
			        handler.wookmark(options);
	    		});
				})(jQuery);
		</script>	
  
	</head>
	<body>
		
		<div class="container" style="width: auto; min-height: 100%;">
			<?php
				include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
				$category = $_GET['category'];
				$project = $_GET['project'];
				$user_id = $_GET['userid'];
				$user_data = get_user_info_by_id($user_id);
				if(isset($_SESSION['codenameDS_user_id']))
					$logged_user_id = $_SESSION['codenameDS_user_id'];			
			?>
			
			<div id="gallery-categories">
				<span id="image-filter-heading"><h4>Image Filters: </h4></span>
				<div class="btn-group project-filters">
					<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
						Category <?php 
						if($category == 'myimages'){
							echo "- "."My Images";
						}
						else{
							echo "- ".ucfirst($category);
						} 
						?>
						<span class="caret"></span>
					</button>
					
					<ul class="dropdown-menu">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=all&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">All</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=portrait&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Portrait</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=landscape&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Landscape</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=wildlife&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Wildlife</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=architecture&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Architecture</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=street&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Street</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=wedding&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Wedding</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=macro&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Macro</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=abstract&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Abstract</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=hdr&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">HDR</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=event&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Event</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=sport&project=<?php echo $project;?>&userid=<?php echo $user_id;?>">Sport</a> </li>
					</ul>
				</div>
				
				<div class="btn-group project-filters">
					<a class="btn btn-inverse" style="border-radius: 0px;" href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=all&userid=<?php echo $user_id;?>">All</a>
					<a class="btn btn-inverse" style="border-radius: 0px;" href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=new&userid=<?php echo $user_id;?>">Open</a>
					<a class="btn btn-inverse" style="border-radius: 0px;" href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=new&userid=<?php echo $user_id;?>">In Progress</a>
					<a class="btn btn-inverse" style="border-radius: 0px;" href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=completed&userid=<?php echo $user_id;?>">Completed</a>
				</div>
				
			</div>
			
			<div>
				<?php
				if ($user_id !="all"){
					echo "<h4>You are viewing ".$user_data['user_name']."'s gallery</h4>";
					?><p>Click <a href="/codenameDS/gallery.php?category=all&project=all&userid=all">here</a> to view complete gallery</p>
				<?php } ?>
			</div>
			
			<!--<div id="images-container">
				<ul id="tiles">
					<li><img src="http://lorempixel.com/600/500"/><p>Uploaded by: Ameya Koshti</p></li>
					<li><img src="http://lorempixel.com/500/600"/><p>Uploaded by: Ameya Joshi</p></li>
					<li><img src="http://lorempixel.com/600/550"/><p>Uploaded by: Sheetal Paranjpe</p></li>
					<li><img src="http://lorempixel.com/600/550"/><p>Uploaded by: Sushim Koshti</p></li>
					<li><img src="http://lorempixel.com/800/800"/><p>Uploaded by: Ameya Koshti</p></li>
					<li><img src="http://lorempixel.com/500/600"/><p>Uploaded by: Sheetal Paranjpe</p></li>
					<li><img src="http://lorempixel.com/600/550"/><p>Uploaded by: Sushim Koshti</p></li>
					<li><img src="http://lorempixel.com/600/500"/><p>Uploaded by: Ameya Joshi</p></li>
					<li><img src="http://lorempixel.com/450/800"/><p>Uploaded by: Sushim Koshti</p></li>
					<li><img src="http://lorempixel.com/600/550"/><p>Uploaded by: Ameya Koshti</p></li>
					<li><img src="http://lorempixel.com/800/800"/><p>Uploaded by: Ameya Joshi</p></li>
					<li><img src="http://lorempixel.com/450/800"/><p>Uploaded by: Sushim Koshti</p></li>
					<li><img src="http://lorempixel.com/450/800"/><p>Uploaded by: Ameya Koshti</p></li>
					<li><img src="http://lorempixel.com/600/550"/><p>Uploaded by: Sheetal Paranjpe</p></li>
					<li><img src="http://lorempixel.com/800/800"/><p>Uploaded by: Professor</p></li>
				</ul>
			</div>-->
	
				<?php		
// 					echo '<div class="row">';
 					echo '<div class="images-container">';
 					echo '<ul  id="tiles">'; //echo '<ul class="thumbnails">';
					
 					get_filtered_images($category,$project,$user_id);
					
					echo '</ul>';
 					echo '</div>';
// 					echo '</div>'; 				
				?>
		
	</div>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
		?>
	</body>
</html>
