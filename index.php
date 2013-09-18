<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
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
			<div id="category-heading">
				<div class="row-fluid">
					<div class="span3"><h3 class="featurette-heading" style="font-family: Raleway;">Image Categories</h3></div>
					<div class="span9" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
				</div>
			</div>
			
			<div id="category-container">
				<div class="row-fluid">
					<div class="span1"></div>
					<div class="category-row span2">
						<p>Abstract</p>
						<a href="/codenameDS/gallery.php?category=abstract&project=all&userid=all"><img src="/codenameDS/img/home_catergories/abstract.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Landscape</p>
						<a href="/codenameDS/gallery.php?category=landscape&project=all&userid=all"><img src="/codenameDS/img/home_catergories/landscape.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Street</p>
						<a href="/codenameDS/gallery.php?category=street&project=all&userid=all"><img src="/codenameDS/img/home_catergories/street.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Portrait</p>
						<a href="/codenameDS/gallery.php?category=portrait&project=all&userid=all"><img src="/codenameDS/img/home_catergories/portrait.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Wildlife</p>
						<a href="/codenameDS/gallery.php?category=wildlife&project=all&userid=all"><img src="/codenameDS/img/home_catergories/wildlife.jpg"></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span1"></div>
					<div class="category-row span2">
						<p>Architecture</p>
						<a href="/codenameDS/gallery.php?category=architecture&project=all&userid=all"><img src="/codenameDS/img/home_catergories/architecture.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Macro</p>
						<a href="/codenameDS/gallery.php?category=macro&project=all&userid=all"><img src="/codenameDS/img/home_catergories/macro.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>HDR</p>
						<a href="/codenameDS/gallery.php?category=hdr&project=all&userid=all"><img src="/codenameDS/img/home_catergories/hdr.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Event</p>
						<a href="/codenameDS/gallery.php?category=event&project=all&userid=all"><img src="/codenameDS/img/home_catergories/event.jpg"></a>
					</div>
					<div class="category-row span2">
						<p>Product</p>
						<a href="/codenameDS/gallery.php?category=product&project=all&userid=all"><img src="/codenameDS/img/home_catergories/product.jpg"></a>
					</div>
				</div>
			</div>
			
			<div id="photographers-heading">
				<div class="row-fluid">
					<div class="span4"><h3 class="featurette-heading" style="font-family: Raleway;">Featured Photographers</h3></div>
					<div class="span8" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
				</div>
			</div>
			<div id="photographers-container">
				<div class="row-fluid">
					<div class="span1"></div>
					<div class="photographers-row span2"><p>Photographer 1</p><img src="img/200X150.gif"></div>
					<div class="photographers-row span2"><p>Photographer 2</p><img src="img/200X150.gif"></div>
					<div class="photographers-row span2"><p>Photographer 3</p><img src="img/200X150.gif"></div>
					<div class="photographers-row span2"><p>Photographer 4</p><img src="img/200X150.gif"></div>
					<div class="photographers-row span2"><p>Photographer 5</p><img src="img/200X150.gif"></div>
				</div>
			</div>
			
			<div id="projects-heading">
				<div class="row-fluid">
					<div class="span3"><h3 class="featurette-heading" style="font-family: Raleway;">Featured Editors</h3></div>
					<div class="span9" style="margin: 10px 0px 30px 0px"><hr class="featurette-divider"></div>
				</div>
			</div>
			<div id="projects-container">
				<div class="row-fluid">
					<div class="span1"></div>
					<div class="projects-row span2"><p>Project 1</p><img src="img/200X150.gif"></div>
					<div class="projects-row span2"><p>Project 2</p><img src="img/200X150.gif"></div>
					<div class="projects-row span2"><p>Project 3</p><img src="img/200X150.gif"></div>
					<div class="projects-row span2"><p>Project 4</p><img src="img/200X150.gif"></div>
					<div class="projects-row span2"><p>Project 5</p><img src="img/200X150.gif"></div>
				</div>
			</div>

		</div>
		
			<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
			?>
	</body>
</html>
