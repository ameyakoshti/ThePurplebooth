<?php
function upload_single_image($fileName,$tmpName,$fileSize,$fileType){
	try{
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
		$files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $fileName);
		 // get all file names
		foreach ($files as $file) {// iterate files
		if (is_file($file))
			unlink($file);
		// delete file
		}

		mysql_query($query) or die('Error, query failed');
		
		return TRUE;
	}
	catch(exception $e){
		return FALSE;
	}
}

function upload_multiple_image($fileName,$tmpName,$fileSize,$fileType){
	try{
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
		
		return TRUE;
	}
	catch(exception $e){
		return FALSE;
	}
}

function get_all_images(){
}

function get_filtered_images(string $filter){
}

function get_user_images(int $user_id){
}
?>