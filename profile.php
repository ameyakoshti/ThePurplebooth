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
<script type="text/javascript">
<?php if(isset($_SESSION["codenameDS_user_id"]))echo "var userid = '".$_SESSION["codenameDS_user_id"]."';";?>
</script>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="/codenameDS/js/profile/profile.js"></script>
	<div class="container" style="min-height: 100%;">
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		$user_name_profile_view = $_GET['username'];
		$user_name_session = $_SESSION['codenameDS_user_name'];
		$user_data_profile_view = get_user_info($user_name_profile_view);
			
		if ($user_name_profile_view != "") {
			$user_found = TRUE;
			$user_data = get_user_info($user_name_profile_view);

			// current user is viewing his/her own profile
			if(strcmp($user_name_profile_view,$user_name_session) == 0){
					$allow_edit = TRUE;
				}
				else{
					$allow_edit = FALSE;
				}
		}
		else{
				$allow_edit = FALSE;
				$user_found = FALSE;
				// redirect to user not found page
			}
			?>
		</br> </br> </br> </br>

		<ul class="nav nav-tabs" id="myTab">
			<li class="active"><a href="#profile">Profile</a></li>
			<li><a href="#notifications">Notifications</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="profile"><?php include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/profile_home.php';?></div>
			<div class="tab-pane" id="notifications"><?php include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/profile_notifications.php';?></div>
		</div>
	</div>


	<!--  End container -->
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
	?>

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
			<script type="text/javascript"> 
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
		 <?php 
		 }

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