<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jNotify.jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/mosaic.1.0.1.js"></script>

<link href='/codenameDS/css/home.css' rel='stylesheet' type='text/css'>
<link href='/codenameDS/css/footer.css' rel='stylesheet' type='text/css'>

<script type="text/javascript">
	$(document).ready(function() {
		var pathname = window.location.pathname;
		if (pathname.search('upload') !== -1) {
			$('li:nth-child(1)').addClass('active');
		} else if (pathname.search('gallery') !== -1) {
			$('li:nth-child(2)').addClass('active');
		} else {
			$('li:nth-child(0)').addClass('active');
		}
	})
</script>

<div class="navbar-wrapper" >
<div class="navbar navbar-default navbar-inverse navbar-static-top" >
	<div class="navbar-inner" id="navbar">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse"
			data-target=".nav-collapse"> <span class="icon-th-list"></span> </a><a href="/codenameDS/index.php" class="brand">thepurplebooth &#153;</a>

			<div class="nav-collapse collapse">
				<ul class="nav pull-right" id="codenameDSnavigationbar">
					<!--<li><a href="/codenameDS/index.php"><i class="icon-home" style="color: #9b00F0;"></i>&nbsp;Home</a></li>
					<li><a href="/codenameDS/contact.php">Contact</a></li>
					<li><a href="/codenameDS/about_us.php">About Us</a></li>-->
					<li><a href="/codenameDS/upload_image.php">Upload Image</a></li>
					<li><a href="/codenameDS/gallery.php?category=all&project=all&userid=all">Gallery</a></li>
					<li>
					<?php 	
					if(!isset($_SESSION['codenameDS_user_name'])) {
						?> <a href="/codenameDS/socialauth/index.php">Login</a>	<?php
					}
					else{ 
					?>
					<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['codenameDS_user_name']; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li></li>
							<li></li>
							<li><a href="profile.php?username=<?php echo $_SESSION['codenameDS_user_name']; ?>">Profile</a></li>
							<li><a href="/codenameDS/socialauth/index.php?action=logout">Logout</a></li>
						</ul>
					<?php } ?>
					</li>
					<li>
						<img src="img/notification.ico" height="30px" width="30px" style="margin-top:10px"/>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>