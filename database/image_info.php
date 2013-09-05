<?php
require_once "connections.php";
require_once 'edit_request.php';
require_once 'users.php';
open_connection();

function upload_image($user_id, $file_name, $tmp_name, $file_size, $file_type, $title, $description, $category) {
	try {
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
		$content = mysql_real_escape_string($content);
		if (!get_magic_quotes_gpc()) {
			$file_name = mysql_real_escape_string($file_name);
		}
		unlink($_SERVER['DOCUMENT_ROOT'] . "/codenameDS/temp/" . $file_name);
		fclose($fp);
		
		$query = "INSERT INTO codenameDS.imageinfo VALUES (DEFAULT,'$user_id','$file_name','$file_type','$file_size','$content',NULL,'$title','$description','$category','N',NOW(),NOW(),'0')";
		//$files = glob($_SERVER["DOCUMENT_ROOT"] . '/codenameDS/temp/' . $file_name);
		mysql_query($query) or die('Error, query failed');

		return TRUE;
	} catch(exception $e) {
		error_log($e);
		return FALSE;
	}
}

function upload_edited_image($image_id, $file_name, $tmp_name, $file_size, $file_type) {
	try {
		$file_location = $_SERVER["DOCUMENT_ROOT"] . "/codenameDS/edited_images/" . $image_id . ".jpg";
		$file_location_db = "/codenameDS/edited_images/" . $image_id . ".jpg";
		move_uploaded_file($tmp_name, $file_location);

		$query = "UPDATE `codenameDS`.`imageinfo` SET `edited_img_link`='$file_location_db' WHERE `image_id`=$image_id";

		mysql_query($query) or die('Error, query failed');

		return TRUE;
	} catch(exception $e) {
		return FALSE;
	}
}

function get_image_by_id($id) {
	$query = "SELECT * FROM `codenameDS`.`imageinfo` where `image_id`=" . $id;
	$res = mysql_query($query);
	$imageHTML = "";
	while ($data = mysql_fetch_array($res)) {
		$user_data = get_user_info_by_id($data['user_id']);
		var_dump($data['user_id']);
		$imageHTML = $imageHTML . '<div data-imageid="' . $data['image_id'] . '" data-userid="' . $data['user_id'] . '" class="selectedImage"><img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
		$imageHTML = $imageHTML . '<div class="title">' . "<h4>Title : " . $data["title"] . '</h4></div>';
		$imageHTML = $imageHTML . '<div class="desc">' . "<h4>Description : " . $data["description"] . '</h4></div>';
		$imageHTML = $imageHTML . '<div class="profileLink">Image uploaded by <a href="profile.php?username='.$user_data["user_name"].'">'.$user_data['user_name'].'</a></div>';	
	}
	//error_log($id);
	$imageHTML = $imageHTML . '<div class="requests">' . get_requests_for_image($id) . '</div>';
	//error_log($imageHTML);
	$imageHTML = $imageHTML . '<button class="btn btn-primary btn-small editImage">Edit Me!</button></div>';
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

function get_filtered_images($category, $project, $user_id) {

	$where_clause = "";
	if ($category != "all" || $project != "all" || $user_id != "all") {
		$where_clause = "where ";
	}

	if ($user_id != "all")
		$where_clause = $where_clause . "`user_id`=\"$user_id\" and ";

	if ($category != "all")
		$where_clause = $where_clause . "`category`=\"$category\" and ";

	if ($project != "all") {
		if ($project == "new") {
			$where_clause = $where_clause . "`closed_project`=0 and ";
		} else if ($project == "completed") {
			$where_clause = $where_clause . "`closed_project`=1 and ";
		}
	}
	
	$where_clause = substr($where_clause, 0, -4);;
	$query = "SELECT `image_id` FROM `codenameDS`.`imageinfo` $where_clause";
	//echo $query;
	$res = mysql_query($query);
	
	$empty_result = TRUE;  
	while ($data = mysql_fetch_array($res)) {
		$empty_result = FALSE;		
		echo '<li class="span3">';
		echo '<div class="thumbnail">';
		//echo '<a class="imageClick" href="view_image.php?id=' . $data['image_id'] . '">';
		echo '<img class="galleryImage" src="view_image.php?id=' . $data['image_id'] . '">';
		echo '</a>';
		echo '<div><button data-imgid="' . $data['image_id'] . '" class="btn btn-primary btn-small goToImage">Go To Image</button></div>';
		echo '</div>';
		echo '</li>';
	}
	if ($empty_result){
		if ($user_id != "all"){
			echo "<h4>This user has not uploaded or worked on any images</h4>";
		}
		else {
			echo "<h4>There are no images in this category yet!</h4>";
		}
	}
}
?>