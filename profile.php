<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/connections.php";
?>
<html>
	<head>
		<title>User Profile</title>
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

				$("#img_container").click(function() {
					$("#userfile").show();
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
						
						<div id="img_container" class="pic">
							<?php if(!isset($user_data['profile_picture'])) {?>
						   		<a href="#"><img src="img/user_avatar.jpg" width="150" height="150"/></a>
						    <?php } else {
						    	$location = $user_data['profile_picture'];
								//console.log($location);
						    	echo "<img src='$location' width='150' height='150'>";
						    } ?>
						    <form method="post" enctype="multipart/form-data">
	 							<input type="file" style="display: none;" id="userfile" name="userfile" class="buttonProfilePic" >
							    <button class="buttonProfilePicSave" id="upload" name="upload" type="submit">
								 Save
								</button>
							</form>
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

<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
	try {
		open_connection();

		$file_name = $_FILES['userfile']['name'];
		$tmp_name = $_FILES['userfile']['tmp_name'];
		$file_size = $_FILES['userfile']['size'];
		$file_type = $_FILES['userfile']['type'];

		$success = upload_profile_picture($_SESSION['codenameDS_user_id'],$file_name,$tmp_name,$file_size,$file_type);

		if ($success === TRUE){?>
			<script type="text/javascript">
				jSuccess(
					    'Upload Image Sucessful!',
					    {
					      autoHide : true,
					      TimeShown : 2000,
					      HorizontalPosition : 'center',
					      ShowOverlay : false
					    }
					   );
			</script>	
			<?php 
		 }
		 else {?>
		 	<sript type="text/javascript">
		 		 jError(
		 				    'Upload Image Failed!',
		 				    {
		 				      autoHide : true,
		 				      TimeShown : 2000,
		 				      HorizontalPosition : 'center',
		 				      ShowOverlay : false
		 				    }
		 				  );
		 	</script>
		 		<?php }
		
			echo '<script type="text/javascript">';
	        echo 'location.reload(false)';
	        echo '</script>';
	        echo '<noscript>';
	        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
	        echo '</noscript>';		
		
		//close_connection();
	} catch(Exception $e) {
		error_log($e);
	}
}
?>