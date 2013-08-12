<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
?>

<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {
	try {
		$link = mysql_connect('localhost', 'root', 'root');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		$db_selected = mysql_select_db('codenameDS', $link);

		$fileName = $_FILES['userfile']['name'];
		$tmpName = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		
		//error_log("***********************".$fileName."**************************");

		$cachedFileName = $_SERVER["DOCUMENT_ROOT"] . "/codenameDS/temp/" . $_FILES["userfile"]["name"];
		//move the uploaded file to temp folder
		move_uploaded_file($_FILES["userfile"]["tmp_name"], $cachedFileName);
		//create image from the temp file
		$img = imagecreatefromjpeg($cachedFileName);
		//compress the temp image by 50% and save it as test.jpg
		imagejpeg($img, $_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $_FILES["userfile"]["name"], 50);
		//open and upload the compressed test image
		$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $_FILES["userfile"]["name"], 'r');
		$content = fread($fp, filesize($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $_FILES["userfile"]["name"]));
		$content = addslashes($content);
		if (!get_magic_quotes_gpc()) {
			$fileName = addslashes($fileName);
		}
		fclose($fp);

		$query = "INSERT INTO codenameDS.imageinfo VALUES (DEFAULT,'1','2','$fileName',  '$fileType','$fileSize', '$content','N',NOW())";
		//empty the temp folder
		/* $files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $_FILES["userfile"]["name"]);
		// get all file names
		foreach ($files as $file) {// iterate files
			if (is_file($file))
				unlink($file);
			// delete file
		}
 */
		mysql_query($query) or die('Error, query failed');
	} catch(Exception $e) {
		error_log($e);
	}
?>
<script type="text/javascript">
	alert("File successfully uploaded!");
	history.back(); 
</script>
<?php
	mysql_close($link);
	header("Location: http://localhost:8888/codenameDS/gallery.php");
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
			<h1>This is where you upload the damn file!</h1>
			<p>
				Click below to select the file you want to upload
			</p>
			<p>
				<form method="post" enctype="multipart/form-data">
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					<input name="userfile" type="file" id="userfile" class="btn btn-success btn-small">
					<button class="btn btn-primary btn-small" id="upload" name = "upload" type="submit">
						<i class="icon-camera icon-white"> </i> Upload
					</button>
				</form>
			</p>
		</div>
	</body>
</html>

