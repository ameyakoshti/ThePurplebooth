<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
ini_set('memory_limit', '-1');
ob_start();
?>

<html>
	<head>
		<title>Upload Picture</title>
		<link href='/codenameDS/css/upload_image.css' rel='stylesheet' type='text/css'>
	</head>
	<body>
			<?php
				include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
			?>
			<div id="upload-signup" class="container-fluid">
				<div class="row-fluid">
					<div class="span10 offset1" style="padding-top: 100px;">
						<h2 style="font-family: Raleway;">This is where you upload the raw pics!</h2>
						<?php
							if(!isset($_SESSION['codenameDS_user_name'])){
				      	?>
				      	<p>
				        	... but before you do, we need you to <a href="http://localhost:8888/codenameDS/socialauth/index.php">sign-in or sign-up</a>.
				      	</p>
				    </div>
			    </div>
		    </div>
		   	<?php } else { ?>
		    <div class="container-fluid" style="min-height: 100%">
		        <form method="post" enctype="multipart/form-data">
		     	<div>
		     		<p>Choose a title for the image</p>
		     		<textarea id="title" name="title" class="enterComment" placeholder="Title" required></textarea>
		     	</div>
		
		     	<div>
					<p>Choose a category for the image</p>			
					<select name="category">
					    <?php include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/categories.php'; ?>
					</select>
					<!--<div class="btn-group">
						<button id="catergory" name='category' type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							Categories
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?php include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/categories.php'; ?>
						</ul>
					</div>	-->
				</div>
				
				<div>
		     		<p>What kind of work would you like to be done on your image?</p>
		     		<textarea id="description" name="description" class="enterComment" placeholder="Description" required></textarea>
		     	</div>
				
				<div>
			     	<p>Click below to select the pic you want to upload</p>
					<p>
					
						<input name="userfile" type="file" id="userfile"
							class="btn">
						<button class="btn btn-primary btn-small" id="upload" name="upload"
							type="submit">
							<i class="icon-camera icon-white"> </i> Upload
						</button>			
					</p>
				</div>
				</form>
				<!--<form method="post" enctype="multipart/form-data">
					<input type="file" name="uploadedfiles[]" multiple id="uploadedfiles[]"
						class="btn">
					<button class="btn btn-primary btn-small" id="uploadmany"
						name="uploadmany" type="submit">
						<i class="icon-camera icon-white"> </i> Upload Multiple Files
					</button>
				</form>-->		
			</div>
		<!-- 	End Container -->
			<?php } ?>
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
		$title = $_POST['title'];
		$description = $_POST['description'];
		$category = $_POST['category'];
		
		$success = upload_image($_SESSION['codenameDS_user_id'],$file_name,$tmp_name,$file_size,$file_type,$title,$description,$category);

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
	} catch(Exception $e) {
		error_log($e);
	}
}

if (isset($_POST['uploadmany']) && $_FILES['uploadedfiles']['size'] > 0) {
	try {
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
	} catch(Exception $e) {
		error_log($e);
	}
}
?>
<?php ob_end_flush(); ?>