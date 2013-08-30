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
			var userid = <?php echo $_SESSION["codenameDS_user_id"];?>;
			var username = <?php echo "'".$_SESSION["codenameDS_user_name"]."'";?>;
			var imageid = <?php echo $_GET['image_id'];?>
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