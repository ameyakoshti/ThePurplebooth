<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script src="/codenamDS/js/bootstrap.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var pathname = window.location.pathname;
		if (pathname.search('contact') !== -1) {
			$('li:nth-child(2)').addClass('active');
		} else if (pathname.search('about') !== -1) {
			$('li:nth-child(3)').addClass('active');
		} else if (pathname.search('upload') !== -1) {
			$('li:nth-child(4)').addClass('active');
		} else if (pathname.search('gallery') !== -1) {
			$('li:nth-child(5)').addClass('active');
		} else {
			$('li:nth-child(1)').addClass('active');
		}
	})
</script>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
			data-target=".nav-collapse"> <span class="icon-th-list"></span> </a><a href="/codenameDS/index.php" class="brand">codenameDS</a>

			<div class="nav-collapse collapse">
				<ul class="nav pull-right" id="codenameDSnavigationbar">
					<li>
						<a href="/codenameDS/index.php">Home</a>
					</li>
					<li>
						<a href="/codenameDS/contact.php">Contact</a>
					</li>
					<li>
						<a href="/codenameDS/about_us.php">About Us</a>
					</li>
					<li>
						<a href="/codenameDS/upload_image.php">Upload Image</a>
					</li>
					<li>
						<a href="/codenameDS/gallery.php">Gallery</a>
					</li>
					<li>
						<a href="/codenameDS/socialauth/index.php">Login</a>
					</li>
				</ul>
			</div>

		</div>
	</div>
</div>