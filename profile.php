<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/users.php";
require_once "database/user_rating.php";
?>

<html>
	<head>
		<title>User Profile</title>
	</head>
	<body>
		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
			$user_name_profile_view = $_GET['username'];
			$user_name_session = $_SESSION['codenameDS_user_name'];
			
			if ($user_name_profile_view != "") {
				$user_data = get_user_info($user_name_profile_view);	
					
				// current user is viewing his/her own profile				
				if(strcmp($user_name_profile_view,$user_name_session) == 0){
						$allow_edit = TRUE;
				}
			}
			else{
				// redirect to user not found page
			}
		?>
		<script type="text/javascript">
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
				<!--<section id="left">-->
				<div class="span-6 centerOfTheScreen">
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
	
					<h2>About Me:</h2>
					<p>
						I need to create a new columm to store data for about me. i just realised that will have to drop the complete table are create it again! #dumb
					</p>
					
					<h2>Review:</h2>
					<script type="text/javascript">
						<?php if($user_name_profile_view != "")echo "var username = '".$user_name_profile_view."';";?>
					</script>			
					<script src="/codenameDS/js/profile/profile.js"></script>
					<div class="reviews">						
					</div>
									
				</div>
				<!--</section>-->
				<!--
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
				</section>-->
			</div>
		</body>
</html>

<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
	try {
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
	} catch(Exception $e) {
		error_log($e);
	}
}
?>