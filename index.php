<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
?>

<html>
	<head>
		<title>The Purple Booth</title>
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
		
		<div class="container" style="width: auto;">
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>
		
			<!-- Carousel ================================================== -->
			<div id="myCarousel" class="carousel slide">
				<div class="carousel-inner">
					<div class="item active">
						<img src="/codenameDS/img/home/carousel/bg_dogcat.jpg">
						<div class="container">
							<div class="carousel-caption">
								<h1>Dog & Cat</h1>
								<p class="lead">This is how you can change the way your photos look..</p>
								<a class="btn btn-large btn-primary" href="#">Sign up today</a>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="http://lorempixel.com/1280/1024/technics" alt="">
						<div class="container">
							<div class="carousel-caption">
								<h1>Another Image.</h1>
								<p class="lead">Some more caption here respective to the image</p>
								<a class="btn btn-large btn-primary" href="#">Sign up today</a>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="http://lorempixel.com/1280/1024/abstract" alt="">
						<div class="container">
							<div class="carousel-caption">
								<h1>One more</h1>
								<p class="lead">No more explanation.</p>
								<a class="btn btn-large btn-primary" href="#">Browse gallery</a>
							</div>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">&#139;</a> 
				<a class="right carousel-control" href="#myCarousel" data-slide="next">&#155;</a>
			</div>
			<!-- /.carousel -->
			<div id="category-heading">
				<div class="span3"><h3 class="featurette-heading" style="font-family: Calligraffiti"><i>Image Categories</i></h3></div>
				<div class="span9" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
			</div>
			<div id="category-container">
				<div style="margin: 20px 20px 20px 50px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
				</div>
				<div style="margin: 20px 20px 20px 50px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
				</div>
			</div>
			
			<div id="photographers-heading">
				<div class="span4"><h3 class="featurette-heading" style="font-family: Calligraffiti"><i>Featured Photographers</i></h3></div>
				<div class="span8" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
			</div>
			<div id="photographers-container">
				<div style="margin: 20px 20px 20px 50px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
				</div>
			</div>
			
			<div id="projects-heading">
				<div class="span3"><h3 class="featurette-heading" style="font-family: Calligraffiti"><i>Featured Projects</i></h3></div>
				<div class="span9" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
			</div>
			<div id="projects-container">
				<div style="margin: 20px 20px 20px 50px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
				</div>
			</div>
			
			<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
			?>
		</div>
	</body>
</html>
