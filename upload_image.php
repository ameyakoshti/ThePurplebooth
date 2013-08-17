<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
ini_set('memory_limit', '-1');
ob_start();

if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
	try {
		require_once "database/connections.php";

		$fileName = $_FILES['userfile']['name'];
		$tmpName = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];

		$success = upload_single_image($fileName,$tmpName,$fileSize,$fileType);

		if ($success === TRUE){?>		
			<div id="upload_notification" align="center" class="navbar navbar-fixed-bottom">
        		<p>File successfully uploaded!</p>
    		</div>		
		<?php }
		
		mysql_close($link);
		header("Location: http://localhost:8888/codenameDS/gallery.php");

	} catch(Exception $e) {
		error_log($e);
	}
}

if (isset($_POST['uploadmany']) && $_FILES['uploadedfiles']['size'] > 0) {
	try {
		require_once "database/connections.php";
		
		for($i=0;$i<sizeof($_FILES["uploadedfiles"]["name"]);$i++) {
			$fileName =$_FILES["uploadedfiles"]['name'][$i];
			$tmpName = $_FILES["uploadedfiles"]['tmp_name'][$i];
			$fileSize = $_FILES["uploadedfiles"]['size'][$i];
			$fileType = $_FILES["uploadedfiles"]['type'][$i];
			
			$success = upload_single_image($fileName,$tmpName,$fileSize,$fileType);
		
		}
		if ($success === TRUE){?>			
		<div id="upload_notification" align="center" class="navbar navbar-fixed-bottom">
        	<p>File successfully uploaded!</p>
    	</div>	
		<?php }
		
		mysql_close($link);
		header("Location: http://localhost:8888/codenameDS/gallery.php");

	} catch(Exception $e) {
		error_log($e);
	}
}
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
<?php ob_end_flush(); ?>