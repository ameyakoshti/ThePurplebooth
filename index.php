<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
?>

<html>
	<head>
		<title>The Purple Booth</title>
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
		<link href='/codenameDS/css/home.css' rel='stylesheet' type='text/css'>
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
			
			<div id="img-container">
				<div style="margin: 20px 20px 20px 50px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
					<img src="http://placehold.it/200X150" class="img-polaroid" style="margin-left:10px;">
				</div>
			</div>
			
			<hr class="featurette-divider">
			
			<!-- FOOTER -->
			<footer>
				<p class="pull-right"> <a href="#">Back to top</a> </p>
				<p> Copyright 2013, The Purple Booth, Inc. | <a href="#">Privacy</a> | <a href="#">Terms</a> </p>
			</footer>
		</div>
	</body>
</html>
