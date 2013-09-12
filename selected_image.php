<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
ini_set('memory_limit', '-1');
$image_id = $_GET['image_id'];
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
			<script src="/codenameDS/js/selected_image/accept_bidder.js"></script>
						
			<div class="row-fluid">
				<div id="image" class="span6">
					<?php get_image_by_id($image_id,$_SESSION["codenameDS_user_id"]);?>
				</div>
				<div id="comments" class="comments">
					
				</div>
			</div>
		</div>
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/editorupload.php';
		?>
		
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/editorreview.php';
		?>
		
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
		$description = $_POST['description'];	
		$success = FALSE;
		
		$success = upload_edited_image($image_id,$file_name,$tmp_name,$file_size,$file_type);

		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/statuspopup.php';
		
	} catch(Exception $e) {
		error_log($e);
	}
}
?>