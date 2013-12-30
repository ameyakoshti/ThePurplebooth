<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
?>

<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="js/jNotify.jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/mosaic.1.0.1.js"></script>

<script type="text/javascript" src="js/masterpage/masterpage.js"></script>

<link href='/codenameDS/css/home.css' rel='stylesheet' type='text/css'>
<link href='/codenameDS/css/footer.css' rel='stylesheet' type='text/css'>

<script type="text/javascript">
	<?php if(isset($_SESSION["codenameDS_user_id"])) echo "var user_id=".$_SESSION["codenameDS_user_id"].";";
	else{
		?>
		$('.notification_number').hide();
	<?php 
	}
	?>
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
			data-target=".nav-collapse"> <span class="icon-th-list"></span> </a><a href="/codenameDS/index.php" class="brand"><img alt="" style="margin-right:4px" width="25px" height="25px" src="img/purplebooth.png">thepurplebooth &#153;</a>

			<div class="nav-collapse collapse">
				<ul class="nav pull-right" id="codenameDSnavigationbar">
					<!--<li><a href="/codenameDS/index.php"><i class="icon-home" style="color: #9b00F0;"></i>&nbsp;Home</a></li>-->
					<li><a href="/codenameDS/upload_image.php">Upload Image</a></li>
					<li><a href="/codenameDS/gallery.php?category=all&project=all&userid=all">Gallery</a></li>
					<li>
					<?php 	
					if(!isset($_SESSION['codenameDS_user_name'])) { ?> 
						<a href="/codenameDS/socialauth/index.php">Login</a>	
						<!--<a data-toggle="modal" href="#loginModal">Login</a>--> 
					<?php
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
						<div>
							<img src="img/notification.png" height="30px" width="30px" style="margin-top:10px"/>
							<a class="notification_number" href="profile.php?username=<?php if(isset($_SESSION["codenameDS_user_id"])) echo $_SESSION['codenameDS_user_name']; ?>#notifications">0</a>
						</div>
					</li>
				</ul>
			</div>
 		</div> <!-- end container -->
	</div>
</div>
</div>

<?php
//include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/socialauth/index.php'; 
?>

<!-- Modal Code used for Login -->
		
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	          <h4 class="modal-title">Login to thepurplebooth &#153;</h4>
	        </div>
	        <div class="modal-body">
	        	<div style="text-align: center;"><h5>Just sign-in with one of the following social networking web sites!</h5></div>
	        	<div id="social-login-links" style="margin: 30px; text-align: center;">
	        		<a style="margin: 0px 20px 0px 20px;" href="javascript:;" onclick="openLoginDialog('?action=login&type=twitter')"><img src="/codenameds/socialauth/images/twitter-login.png"/></a>
					<a style="margin: 0px 20px 0px 20px;" href="javascript:;" onclick="openLoginDialog('?action=login&type=facebook')"><img src="/codenameds/socialauth/images/facebook-login.png"/></a>
					<a style="margin: 0px 20px 0px 20px;" href="javascript:;" onclick="openLoginDialog('?action=login&type=google')"><img src="/codenameds/socialauth/images/google-login.png"/></a>
					<a style="margin: 0px 20px 0px 20px;" href="javascript:;" onclick="openLoginDialog('?action=login&type=linkedin')"><img src="/codenameds/socialauth/images/linkedin-login.png"/></a>
					<a style="margin: 0px 20px 0px 20px;" href="javascript:;" onclick="openLoginDialog('?action=login&type=yahoo')"><img src="/codenameds/socialauth/images/yahoo-login.png"/></a>
	        	</div>
	        	<div style="text-align: center; margin: 30px 0px 10px 0px;">We do not use your profile details to send messages/post to your friends.</div>
	        </div>
	      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<!-- Modal Code used for Login -->