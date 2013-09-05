<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
ini_set('memory_limit', '-1');
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
			
			<script type="text/javascript">
				$(document).ready(function (){
					$("#photographerDownload").click(function(){
						e.preventDefault();
    					window.location.href = 'edited_images/10.jpg';
						
					});
					
					$("#editorDownload").click(function(){
						<?php
						
						?>
					});
				});
			</script>
			
			<div class="oneImage">
				<?php
					get_image_by_id($_GET['image_id']);
				?>
				<div class="comments">
					
				</div>
			</div>
		</div>
		
		<div>
			<div id="photographer" style="background-color:#eee;border: 1px solid #888; border-radius:3px;">
				<h4>Editor has finished editing your image, here you go : <button id="photographerDownload" name="photographerDownload" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</button></h4>
			</div>
			</br>
			<div id="editor" style="background-color:#eee;border: 1px solid #888; border-radius:3px;">
				<h4>Your bid is accepted! Download high quality image here : <button id="editorDownload" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Download</button></h4>
				<h4>If you are done working on the image, you can upload it here : <a href="#loginModal" data-toggle="modal" class="btn btn-primary"><i class="icon-white icon-circle-arrow-up"></i> Upload</a></h4>
			</div>
		</div>	
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/footer.php';
		?>
		
		<div class="modal hide" id="loginModal" aria-hidden="true">
			<div class="modal-header">
				<h2>Upload</h2>
			</div>
		
			<div class="modal-body" style="overflow: hidden">
				<form method="POST" enctype="multipart/form-data">
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
		$description = $_POST['description'];	
		$success = FALSE;
		
		$success = upload_edited_image($_GET['image_id'],$file_name,$tmp_name,$file_size,$file_type);

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
	} catch(Exception $e) {
		error_log($e);
	}
}
?>