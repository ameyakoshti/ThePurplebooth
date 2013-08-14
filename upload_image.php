<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
ini_set('memory_limit', '-1');
ob_start();

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

		$query = "INSERT INTO codenameDS.imageinfo VALUES (DEFAULT,'1','0','$fileName','$fileType','$fileSize', '$content','N',NOW(),NOW())";
		//empty the temp folder
		$files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $_FILES["userfile"]["name"]);
		 // get all file names
		foreach ($files as $file) {// iterate files
		if (is_file($file))
			unlink($file);
		// delete file
		}
		
		mysql_query($query) or die('Error, query failed');
		?>
		<script type="text/javascript">
		alert("File successfully uploaded!");
		//history.back();
		</script>
		<?php
		mysql_close($link);
		header("Location: http://localhost:8888/codenameDS/gallery.php");
		
	} catch(Exception $e) {
		error_log($e);
	}
}
	
	if (isset($_POST['uploadmany'])) {
		error_log("Reached multiple upload");
		try {
			$link = mysql_connect('localhost', 'root', 'root');
			if (!$link) {
				die('Could not connect: ' . mysql_error());
			}
			$db_selected = mysql_select_db('codenameDS', $link);
			//print_r($_FILES["uploadedfiles"]);
			for($i=0;$i<sizeof($_FILES["uploadedfiles"]["name"]);$i++) {
				//print_r($_FILES["uploadedfiles"][$i]);
				$fileName =$_FILES["uploadedfiles"]['name'][$i];
				$tmpName = $_FILES["uploadedfiles"]['tmp_name'][$i];
				$fileSize = $_FILES["uploadedfiles"]['size'][$i];
				$fileType = $_FILES["uploadedfiles"]['type'][$i];

				//var_dump("***********************".$fileName."**************************");

				$cachedFileName = $_SERVER["DOCUMENT_ROOT"] . "/codenameDS/temp/" . $fileName;
				//move the uploaded file to temp folder
				move_uploaded_file($tmpName, $cachedFileName);
				//create image from the temp file
				$img = imagecreatefromjpeg($cachedFileName);
				//compress the temp image by 50% and save it as test.jpg
				imagejpeg($img, $_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $fileName, 50);
				//open and upload the compressed test image
				$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $fileName, 'r');
				$content = fread($fp, filesize($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $fileName));
				$content = addslashes($content);
				if (!get_magic_quotes_gpc()) {
					$fileName = addslashes($fileName);
				}
				fclose($fp);
				$query = "INSERT INTO codenameDS.imageinfo VALUES (DEFAULT,'1','0','$fileName','$fileType','$fileSize', '$content','N',NOW(),NOW())";
				//empty the temp folder
				$files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $_FILES["userfile"]["name"]);
				 // get all file names
				foreach ($files as $file) {// iterate files
				if (is_file($file))
					unlink($file);
				// delete file
				}
				
				mysql_query($query) or die('Error, query failed');
			}
			?>
			<script type="text/javascript">
			alert("File successfully uploaded!");
			//history.back();
			</script>
			<?php 
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
		<h1>This is where you upload the damn file!</h1>
		<p>Click below to select the file you want to upload</p>
		<p>
		
		
		<form method="post" enctype="multipart/form-data">
			<input name="userfile" type="file" id="userfile"
				class="btn btn-success btn-small">
			<button class="btn btn-primary btn-small" id="upload" name="upload"
				type="submit">
				<i class="icon-camera icon-white"> </i> Upload
			</button>
		</form>

		<form method="post" enctype="multipart/form-data">
			<input type="file" name="uploadedfiles[]" multiple id="uploadedfiles[]"
				class="btn btn-success btn-small">
			<button class="btn btn-primary btn-small" id="uploadmany"
				name="uploadmany" type="submit">
				<i class="icon-camera icon-white"> </i> Upload Multiple Files
			</button>
		</form>
		</p>
	</div>
</body>
</html>
<?php ob_end_flush(); ?>