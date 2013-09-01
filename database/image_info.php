<?php
require_once "connections.php";
require_once 'edit_request.php';
open_connection();

function upload_image($user_id, $file_name, $tmp_name, $file_size, $file_type, $title, $description, $category) {
	try {
		//console.log($category);
		$cached_file_name = $_SERVER["DOCUMENT_ROOT"] . "/codenameDS/temp/" . $file_name;
		//move the uploaded file to temp folder
		move_uploaded_file($tmp_name, $cached_file_name);
		//create image from the temp file
		$img = imagecreatefromjpeg($cached_file_name);
		//compress the temp image by 50% and save it as test.jpg
		imagejpeg($img, $_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $file_name, 50);
		//open and upload the compressed test image
		$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $file_name, 'r');
		$content = fread($fp, filesize($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $file_name));
		$content = addslashes($content);
		if (!get_magic_quotes_gpc()) {
			$file_name = addslashes($file_name);
		}
		fclose($fp);

		$query = "INSERT INTO codenameDS.imageinfo VALUES (DEFAULT,'$user_id',NULL,'$file_name','$file_type','$file_size','$content',NULL,'$title','$description','$category','N',NOW(),NOW(),'0')";
		//empty the temp folder
		$files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $file_name);
		// get all file names
		foreach ($files as $file) {// iterate files
			if (is_file($file))
				unlink($file);
			// delete file
		}

		mysql_query($query) or die('Error, query failed');

		return TRUE;
	} catch(exception $e) {
		console.log($e);
		return FALSE;
	}
}

function get_image_by_id($id) {
	$query = "SELECT * FROM `codenameDS`.`imageinfo` where `image_id`=" . $id;
	$res = mysql_query($query);
	$imageHTML = "";
	while ($data = mysql_fetch_array($res)) {
		$imageHTML = $imageHTML.'<div data-imageid="'.$data['image_id'].'" data-userid="'.$data['user_id'].'" class="selectedImage"><img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
	}
	error_log($id);
	$imageHTML = $imageHTML.'<div class="requests">'.get_requests_for_image($id).'</div>';
	error_log($imageHTML);
	$imageHTML = $imageHTML.'<button class="btn btn-primary btn-small editImage">Edit Me!</button></div>';
	echo $imageHTML;
}

function get_all_images() {
	$query = "SELECT `image_id` FROM `codenameDS`.`imageinfo`";
	$res = mysql_query($query);
	while ($data = mysql_fetch_array($res)) {
		echo '<li class="span3">';
		echo '<div class="thumbnail">';
		echo '<a class="imageClick" href="view_image.php?id=' . $data['image_id'] . '">';
		echo '<img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
		echo '</a>';
		echo '<div><button data-imgid="' . $data['image_id'] . '" class="btn btn-primary btn-small goToImage">Go To Image</button></div>';
		echo '</div>';
		echo '</li>';
	}
}

function get_filtered_images($filter) {
	$query = "SELECT `image_id` FROM `codenameDS`.`imageinfo` where `category`=\"$filter\"";
	$res = mysql_query($query);
	while ($data = mysql_fetch_array($res)) {
		echo '<li class="span3">';
		echo '<div class="thumbnail">';
		echo '<a class="imageClick" href="view_image.php?id=' . $data['image_id'] . '">';
		echo '<img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
		echo '</a>';
		echo '<div><button data-imgid="' . $data['image_id'] . '" class="btn btn-primary btn-small goToImage">Go To Image</button></div>';
		echo '</div>';
		echo '</li>';
	}
}

function get_my_images($user_id) {
	$query = "SELECT `image_id` FROM `codenameDS`.`imageinfo` where `user_id`=\"$user_id\"";
	$res = mysql_query($query);
	while ($data = mysql_fetch_array($res)) {
		echo '<li class="span3">';
		echo '<div class="thumbnail">';
		echo '<a class="imageClick" href="view_image.php?id=' . $data['image_id'] . '">';
		echo '<img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
		echo '</a>';
		echo '<div><button data-imgid="' . $data['image_id'] . '" class="btn btn-primary btn-small goToImage">Go To Image</button></div>';
		echo '</div>';
		echo '</li>';
	}
}
?>