<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="js/jNotify.jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/mosaic.1.0.1.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var pathname = window.location.pathname;
		if (pathname.search('index') !== -1) {
			$('li:nth-child(1)').addClass('active');
		} else if (pathname.search('contact') !== -1) {
			$('li:nth-child(2)').addClass('active');
		} else if (pathname.search('about') !== -1) {
			$('li:nth-child(3)').addClass('active');
		} else if (pathname.search('upload') !== -1) {
			$('li:nth-child(4)').addClass('active');
		} else if (pathname.search('gallery') !== -1) {
			$('li:nth-child(5)').addClass('active');
		} else {
			$('li:nth-child(0)').addClass('active');
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
						<?php 	
						
						if(!isset($_SESSION['codenameDS_user_name'])) {
							?> <a href="/codenameDS/socialauth/index.php">Login</a>	<?php
						}
						else{ 
						?>
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<?php echo $_SESSION['codenameDS_user_name']; ?>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li>
								</li>
								<li>
									<a href="profile.php">Profile</a>
								</li>
								<li>
									<a href="/codenameDS/socialauth/index.php?action=logout">Logout</a>
								</li>
							</ul>
						</div>						
						<?php }?>				
					</li>
				</ul>
			</div>

		</div>
	</div>
</div>