<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
require_once "database/image_info.php";
?>

<html>
	<head>
		<title>Selected Image</title>
	</head>
	<body>	
		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		?>
		<script type="text/javascript">
			<?php if(isset($_SESSION["codenameDS_user_id"]))echo "var userid = '".$_SESSION["codenameDS_user_id"]."';";?>
			<?php if(isset($_SESSION["codenameDS_user_name"]))echo "var username = '".$_SESSION["codenameDS_user_name"]."';";?>
			<?php if(isset($_GET['image_id'])) echo 'var imageid = '.$_GET['image_id'].";";?>
		</script>			
		<script src="/codenameDS/js/selected_image/selected_image.js"></script>
		<div class="oneImage">
			<?php
				get_image_by_id($_GET['image_id']);
			?>		
			<div class="comments">
				
			</div>
		</div>
	</body>
</html>