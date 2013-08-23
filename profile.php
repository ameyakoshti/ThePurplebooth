<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/connections.php";
?>
<html>
	<head>
		<title>Gallery</title>
	</head>
	<body>
		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
			open_connection();
			$user_data = get_user_info($_SESSION['codenameDS_user_id']);
		?>
		<script type="text/javascript">
			//console.log("the current time is:", Date.now());
			$(document).ready(function () { 

				$("#target").click(function() {

				
				});
			});			
		</script>	
		</br>
		</br>
		</br>
		</br>
			<div id="content" class="clearfix">
				<section id="left">
					<div id="userStats" class="clearfix">
						<div class="pic" id="target">
							<a href="#"><img src="img/user_avatar.jpg" width="150" height="150"/></a>
						</div>
	
						<div class="data" id="user_data">
							<h3><?php echo $user_data['user_name'];?></h3>
							<p><?php echo $user_data['email'];?></p>
							<div class="socialMediaLinks">
								<a href="http://twitter.com/jakerocheleau" rel="me" target="_blank"><img src="img/twitter.png" alt="@jakerocheleau" /></a>
								<a href="http://gowalla.com/users/JakeRocheleau" rel="me" target="_blank"><img src="img/gowalla.png" /></a>
							</div>
							<div class="sep"></div>
							<ul class="numbers clearfix">
								<li>
									Reputation<strong>185</strong>
								</li>
								<li>
									Checkins<strong>344</strong>
								</li>
								<li class="nobrdr">
									Days Out<strong>127</strong>
								</li>
							</ul>
						</div>
					</div>
	
					<h1>About Me:</h1>
					<p>
						I need to create a new columm to store data for about me. i just realised that will have to drop the complete table are create it again! #dumb
					</p>
				</section>
	
				<section id="right">
					<div class="gcontent">
						<div class="head">
							<h1>Badges</h1>
						</div>
						<div class="boxy">
							<p>
								Badges you have earned!
							</p>
	
							<div class="badgeCount">
								<a href="#"><img src="img/foursquare-badge.png" /></a>
								<a href="#"><img src="img/foursquare-badge.png" /></a>
								<a href="#"><img src="img/foursquare-badge.png" /></a>
							</div>
						</div>
					</div>
	
					<div class="gcontent">
						<div class="head">
							<h1>Something</h1>
						</div>
						<div class="boxy">
							<p>
								Some other stuff about you
							</p>
						</div>
					</div>
				</section>
			</div>
		</body>
</html>