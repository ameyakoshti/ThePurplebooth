<div id="content" class="clearfix">
			<!--<section id="left">-->
			<div class="span-6 centerOfTheScreen">
				<div id="userStats" class="clearfix">

					<div id="img_container" class="pic">
						<?php if(!isset($user_data['profile_picture'])) {?>
						<a href="#"><img src="img/user_avatar.jpg" width="150"
							height="150" /> </a>
						<?php } else {
							$location = $user_data['profile_picture'];
							//console.log($location);
							echo "<img src='$location' width='150' height='150'>";
						}
						    if ($allow_edit == TRUE){?>
						<form method="post" enctype="multipart/form-data">
							<input type="file" style="display: none;" id="userfile"
								name="userfile" class="buttonProfilePic">
							<button class="buttonProfilePicSave" id="upload" name="upload"
								type="submit">Save</button>
						</form>
						<?php }?>
					</div>

					<div class="data" id="user_data">
						<h3>
							<?php if($user_found) {
								echo $user_data['user_name'];
							}else{echo "Invalid User";
							}?>
						</h3>
						<p>
							<?php if($user_found) {
								echo $user_data['email'];
							}?>
						</p>
						<div class="socialMediaLinks">
							<a href="#">
								<img src="img/twitter.png"/>
							</a>
							<a href="#">
								<img src="img/flickr.png"/>
							</a>
						</div>
						<div class="sep"></div>
						<ul class="numbers clearfix">
							<li>Rating<strong><?php if($user_found) {
								echo $user_data['rating'];
							}?>
							</strong>
							</li>
							<li>Creativity<strong><?php if($user_found) {
								echo $user_data['creativity'];
							}?>
							</strong>
							</li>
							<li class="nobrdr">Class<strong><?php if($user_found) {
								echo $user_data['class'];
							}?>
							</strong>
							</li>
						</ul>
					</div>
				</div>

				<h2>About Me:</h2>
				<p>
					<?php if($user_found) {
						echo $user_data['about_me'];
					}?>
				</p>
				<p>
					Check out my gallery<a
						href="http://localhost:8888/codenameDS/gallery.php?category=all&project=all&userid=<?php echo $user_data_profile_view["user_id"];?>">
						here</a>
				</p>

				<h2>Review:</h2>
				<script type="text/javascript">
						<?php if($user_name_profile_view != "")echo "var username = '".$user_name_profile_view."';";?>
						<?php if(isset($_SESSION['codenameDS_user_name']))echo "var loggedusername = '".$_SESSION['codenameDS_user_name']."';";?>
				</script>
				<script src="/codenameDS/js/profile/profile.js"></script>
				<div class="reviews"></div>

			</div>
</div>