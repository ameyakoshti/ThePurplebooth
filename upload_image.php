<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>

<script type="text/javascript" src="js/jNotify.jquery.js"></script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/connections.php";
ini_set('memory_limit', '-1');
ob_start();
?>

<html>
<head>
<title>Upload Picture</title>
</head>
<body>
	<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
	?>
	<div class="hero-unit">
		<h1>This is where you upload the raw pics!</h1>
		<?php
			if(!isset($_SESSION['codenameDS_user_name'])){
      	?>
      	<p>
        	... but before you do, we need you to <a href="http://localhost:8888/codenameDS/socialauth/index.php">sign-in or sign-up</a>.
      	</p>
    </div>
    	<?php }
    	else { ?>
     	<p>
      		Click below to select the pic you want to upload
    	</p>
		<p>	
		<form method="post" enctype="multipart/form-data">
			<input name="userfile" type="file" id="userfile"
				class="btn">
			<button class="btn btn-primary btn-small" id="upload" name="upload"
				type="submit">
				<i class="icon-camera icon-white"> </i> Upload
			</button>
		</form>

		<form method="post" enctype="multipart/form-data">
			<input type="file" name="uploadedfiles[]" multiple id="uploadedfiles[]"
				class="btn">
			<button class="btn btn-primary btn-small" id="uploadmany"
				name="uploadmany" type="submit">
				<i class="icon-camera icon-white"> </i> Upload Multiple Files
			</button>
		</form>
		</p>
	</div>
	<?php } ?>
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

		$success = upload_image($_SESSION['codenameDS_user_id'],$file_name,$tmp_name,$file_size,$file_type);

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
		
		//close_connection();
	} catch(Exception $e) {
		error_log($e);
	}
}

if (isset($_POST['uploadmany']) && $_FILES['uploadedfiles']['size'] > 0) {
	try {
		open_connection();
		
		for($i=0;$i<sizeof($_FILES["uploadedfiles"]["name"]);$i++) {
			$file_name =$_FILES["uploadedfiles"]['name'][$i];
			$tmp_name = $_FILES["uploadedfiles"]['tmp_name'][$i];
			$file_size = $_FILES["uploadedfiles"]['size'][$i];
			$file_type = $_FILES["uploadedfiles"]['type'][$i];
			
			$success = upload_image($_SESSION['codenameDS_user_id'],$file_name,$tmp_name,$file_size,$file_type);
		}
		
		if ($success === TRUE){?>			
		<script type="text/javascript">
			jSuccess(
				    'Upload Images Sucessful!',
				    {
				      autoHide : true,
				      TimeShown : 2000,
				      HorizontalPosition : 'center',
				      ShowOverlay : false
				    }
				   );
		</script>	
		<?php }
		else {?>
		<script type="text/javascript">
				jError(
					    'Upload Images Failed!',
					    {
					      autoHide : true,
					      TimeShown : 2000,
					      HorizontalPosition : 'center',
					      ShowOverlay : false
					    }
					  );
		</script>	
		<?php }
		
		//close_connection();
	} catch(Exception $e) {
		error_log($e);
	}
}
?>
<?php ob_end_flush(); ?>