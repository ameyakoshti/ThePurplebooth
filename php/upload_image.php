<?php
if (isset($_POST['upload']) && $_FILES['userfile']['size'] > 0) {

	$link = mysql_connect('localhost', 'root', 'root');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	//echo 'Connected successfully';

	// make thepurplebooth the current db
	$db_selected = mysql_select_db('thepurplebooth', $link);

	$fileName = $_FILES['userfile']['name'];
	$tmpName = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	$fileType = $_FILES['userfile']['type'];

	$fp = fopen($tmpName, 'r');
	$content = fread($fp, filesize($tmpName));
	$content = addslashes($content);
	fclose($fp);

	if (!get_magic_quotes_gpc()) {
		$fileName = addslashes($fileName);
	}
	include 'library/config.php';
	include 'library/opendb.php';

	$query = "INSERT INTO thepurplebooth.ImageInfo VALUES (DEFAULT,'1','2','$fileName',  '$fileType','$fileSize', '$content','N',NOW())";

	mysql_query($query) or die('Error, query failed');
	include 'library/closedb.php';

	print '<script type="text/javascript">'; 
	print 'alert("File successfully uploaded!")'; 
	print '</script>'; 
	
	mysql_close($link);
}
	?>
<!DOCTYPE >
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="veiwport" content="width=device-width, initial-scale=1.0 ">
		<title>Upload Picture</title>
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/bootstrap-responsive.css" />

	</head>
	<body>
		<form method="post" enctype="multipart/form-data">
			
			<script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
			<script src="../js/bootstrap.js"></script>

			<div class="navbar navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-th-list"></span> </a>
						<a href="#" class="brand">thepurplebooth</a>

						<div class="nav-collapse collapse">
							<ul class="nav pull-right">
								<li>
									<a href="../index.html">Home</a>
								</li>
								<li>
									<a href="#">Contact</a>
								</li>
								<li>
									<a href="#">About Us</a>
								</li>
								<li class="active">
									<a href="../php/upload_image.php">Start Uploading!</a>
								</li>
								<li>
									<a href="#loginModal" data-toggle="modal">Login</a>
								</li>
							</ul>

						</div>

					</div>
				</div>
			</div>

			<div class="hero-unit">
				<h1>This is where you upload the damn file!</h1>
				<p>
					Click below to select the file you want to upload
				</p>
				<p>
					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
					<input name="userfile" type="file" id="userfile" class="btn btn-success btn-small">
					<button class="btn btn-primary btn-small" id="upload" name = "upload" type="submit">
						<i class="icon-camera icon-white"> </i> Upload
					</button>
				</p>
			</div>

		</form>
	</body>
</html>

