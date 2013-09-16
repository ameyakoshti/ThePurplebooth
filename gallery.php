<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
require_once "database/users.php";
?>

<html>
	<head>
		<title>Gallery</title>
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="js/gallery/jquery.wookmark.js"></script>
		<script type="text/javascript" src="js/gallery/imagesloaded.pkgd.js"></script>
		<script type="text/javascript" src="js/gallery/gallery.js"></script>
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
			
			<div id="gallery-categories" style="margin: 80px 0px 30px 50px;">
				<span style="color: #525252; width: 150px; float: left;"><h4>Image Filters: </h4></span>
				<div class="btn-group" style="margin-top: 5px;">
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
				
				<div class="btn-group" style="margin-top: 5px;">
					<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" style="border-radius: 0px;">
						Project <?php echo "- ".ucfirst($project);?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li></li>
						<li></li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=all&userid=<?php echo $user_id;?>">All</a> </li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=new&userid=<?php echo $user_id;?>">New</a></li>
						<li> <a href="http://localhost:8888/codenameDS/gallery.php?category=<?php echo $category;?>&project=completed&userid=<?php echo $user_id;?>">Completed</a></li>
					</ul>
				</div>
			</div>
			
			<div>
				<?php
				if ($user_id !="all"){
					echo "<h4>You are viewing ".$user_data['user_name']."'s gallery</h4>";
					?><p>Click <a href="/codenameDS/gallery.php?category=all&project=all&userid=all">here</a> to view complete gallery</p>
				<?php } ?>
			</div>
			
			<div id="images-container" style="width: 100%; margin: 10px; position: relative;">
				<img src="http://lorempixel.com/400/200" />
				<img src="http://lorempixel.com/200/400" />
				<img src="http://lorempixel.com/400/250" />
				<img src="http://lorempixel.com/400/250" />
				<img src="http://lorempixel.com/300/300" />
				<img src="http://lorempixel.com/200/400" />
				<img src="http://lorempixel.com/400/250" />
				<img src="http://lorempixel.com/400/200" />
				<img src="http://lorempixel.com/150/300" />
				<img src="http://lorempixel.com/400/250" />
				<img src="http://lorempixel.com/300/300" />
				<img src="http://lorempixel.com/150/300" />
				<img src="http://lorempixel.com/150/300" />
				<img src="http://lorempixel.com/400/250" />
				<img src="http://lorempixel.com/300/300" />
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
					
					get_filtered_images($category,$project,$user_id);
	
					echo '</div>';
					echo '</div>';
					echo '</ul>';			
				?>
			</div>
			<script src="/codenameDS/js/blueimp-gallery.min.js"></script>
			<script src="/codenameDS/js/gallery/gallery.js"></script>
		
	</div>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
		?>
	</body>
</html>
