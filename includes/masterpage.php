<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
<script src="js/bootstrap.js"></script>
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

<div class="navbar-wrapper" >
<div class="navbar navbar-default navbar-inverse" >
	<div class="navbar-inner" id="navbar">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
			data-target=".nav-collapse"> <span class="icon-th-list"></span> </a><a href="/codenameDS/index.php" class="brand">The Purple Booth &#153;</a>

			<div class="nav-collapse collapse">
				<ul class="nav pull-right" id="codenameDSnavigationbar">
					<li><a href="/codenameDS/index.php"><i class="icon-home icon-white"></i>Home</a></li>
					<li><a href="/codenameDS/contact.php">Contact</a></li>
					<li><a href="/codenameDS/about_us.php">About Us</a></li>
					<li><a href="/codenameDS/upload_image.php">Upload Image</a></li>
					<li><a href="/codenameDS/gallery.php">Gallery</a></li>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['codenameDS_user_name']; ?> <b class="caret"></b></a>
                    	<ul class="dropdown-menu">
	                    	<?php 	
							if(!isset($_SESSION['codenameDS_user_name'])) {
							?> 
							<li><a href="/codenameDS/socialauth/index.php">Login</a></li>
							<?php
							} else{ 
							?>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a href="/codenameDS/socialauth/index.php?action=logout">Logout</a></li>
                            <?php }?>
                		</ul>
                	</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>