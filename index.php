<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
if ( in_array( strtolower( ini_get( 'magic_quotes_gpc' ) ), array( '1', 'on' ) ) ) {
    $_POST = array_map( 'stripslashes', $_POST );
    $_GET = array_map( 'stripslashes', $_GET );
    $_COOKIE = array_map( 'stripslashes', $_COOKIE );
}
?>

<html>
	<head>
		<title>The Purple Booth</title>
		<style>
			@font-face { font-family: Raleway; src: url('/codenameds/font/raleway_thin.ttf'); } 
		</style>
	</head>
	
	<body>
		
		<div class="container-fluid" style="width: auto; min-height: 100%;">
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>
		
			<!-- Carousel ================================================== -->
			<div id="myCarousel" class="carousel slide">
				<div class="carousel-inner">
					<div class="item active">
						<img src="/codenameDS/img/home/carousel/DSC_0001.jpg">
						<div class="container">
							<div class="carousel-caption">
								<h1>Griffith Observatory</h1>
								<p class="lead">This is how you can change the way your photos look..</p>
								<a class="btn btn-large btn-primary" href="#">Sign up today</a>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="/codenameDS/img/home/carousel/DSC_0002.jpg">
						<div class="container">
							<div class="carousel-caption">
								<h1>Way to Cape Town</h1>
								<p class="lead">Some more caption here respective to the image</p>
								<a class="btn btn-large btn-primary" href="#">Sign up today</a>
							</div>
						</div>
					</div>
					<div class="item">
						<img src="/codenameDS/img/home/carousel/DSC_0003.jpg">
						<div class="container">
							<div class="carousel-caption">
								<h1>Grand Canyon</h1>
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
			
			<div id="category-container">
				<div id="category-heading">
					<div class="row-fluid">
						<div class="span3"><h3 class="featurette-heading" style="font-family: Raleway;">Image Categories</h3></div>
						<div class="span9" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
					</div>
				</div>
				<div>
					<ul id="category-list">
						<li>
							<p>Abstract</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/abstract.jpg"></a>
						</li>
						<li>
							<p>Landscape</p>
							<a href="/codenameDS/gallery.php?category=landscape&project=all&userid=all"><img src="/codenameDS/img/home_catergories/landscape.jpg"></a>
						</li>
						<li>
							<p>Street</p>
							<a href="/codenameDS/gallery.php?category=street&project=all&userid=all"><img src="/codenameDS/img/home_catergories/street.jpg"></a>
						</li>
						<li>
							<p>Portrait</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/portrait.jpg"></a>
						</li>
						<li>
							<p>Wildlife</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/wildlife.jpg"></a>
						</li>
						<li>
							<p>Architecture</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/architecture.jpg"></a>
						</li>
						<li>
							<p>Macro</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/macro.jpg"></a>
						</li>
						<li>
							<p>HDR</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/hdr.jpg"></a>
						</li>
						<li>
							<p>Event</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/event.jpg"></a>
						</li>
						<li>
							<p>Product</p>
							<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/product.jpg"></a>
						</li>
					</ul>
				</div>
			</div>
			
			
			<div id="photographers-container">
				<div id="photographers-heading">
					<div class="row-fluid">
						<div class="span4"><h3 class="featurette-heading" style="font-family: Raleway;">Featured Photographers</h3></div>
						<div class="span8" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
					</div>
				</div>
				<div>
					<ul id="photographers-list">
						<li><p>Photographer 1</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Photographer 2</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Photographer 3</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Photographer 4</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Photographer 5</p><a href="#"><img src="img/200X150.gif"></a></li>
					</ul>
				</div>
			</div>
			
			<div id="projects-container">
				<div id="projects-heading">
					<div class="row-fluid">
						<div class="span4"><h3 class="featurette-heading" style="font-family: Raleway;">Featured Projects</h3></div>
						<div class="span8" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
					</div>
				</div>
				<div>
					<ul id="projects-list">
						<li><p>Project 1</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Project 2</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Project 3</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Project 4</p><a href="#"><img src="img/200X150.gif"></a></li>
						<li><p>Project 5</p><a href="#"><img src="img/200X150.gif"></a></li>
					</ul>
				</div>
			</div>

		</div>
		
			<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
			?>
	</body>
</html>
