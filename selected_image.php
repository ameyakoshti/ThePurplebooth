<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
?>

<html>
	<head>
		<title>Selected Image</title>
	</head>
	<body>	
	<div class="container" style="min-height: 100%;">
		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>
		<script type="text/javascript">
			<?php if(isset($_SESSION["codenameDS_user_id"]))echo "var userid = '".$_SESSION["codenameDS_user_id"]."';";?>
			<?php if(isset($_SESSION["codenameDS_user_name"]))echo "var username = '".$_SESSION["codenameDS_user_name"]."';";?>
			<?php if(isset($_GET['image_id'])) echo 'var imageid = '.$_GET['image_id'].";";?>
		</script>			
		<script src="/codenameDS/js/selected_image/selected_image.js"></script>
		<script src="/codenameDS/js/selected_image/edit_me.js"></script>
		<div class="oneImage">
			<?php
				get_image_by_id($_GET['image_id']);
			?>
			<div class="comments">
				
			</div>
		</div>	
		<!-- End Container -->
		</div>
		<div>
			<button id="editorDownload" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</button>
			<button id="photographerDownload" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</button>
			<a href="#loginModal" data-toggle="modal" class="btn btn-primary"><i class="icon-white icon-circle-arrow-up"></i>Upload</a>
		</div>	
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
		?>
		
		
	<div class="modal hide" id="loginModal" aria-hidden="true">
		<div class="modal-header">
			<h2>Upload</h2>
		</div>
	
		<div class="modal-body" style="overflow: hidden">
			<form method="POST">
				<div class="row-fluid">	
					<div class="span12">
						<div>
				     		<p>Enter some comments about the awesome work you did on the image</p>
				     		<textarea id="description" name="description" class="enterComment" placeholder="Description" required></textarea>
				     	</div>
						
						<div>
					     	<p>Click below to select edited pic</p>
							<p>							
								<input name="userfile" type="file" id="userfile"
									class="btn">
								<button class="btn btn-info btn-small" id="upload" name="upload"
									type="submit">
									<i class="icon-camera icon-white"> </i> Done
								</button>			
							</p>
						</div>
					</div>
				</div>
			</form>
		</div>
	
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">
				Close
			</button>
		</div>
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
		//$title = $_POST['title'];
		$description = $_POST['description'];
		//$category = $_POST['category'];
		
		echo "hi";
		
		$success = TRUE;//upload_image($_SESSION['codenameDS_user_id'],$file_name,$tmp_name,$file_size,$file_type,$title,$description,$category);

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