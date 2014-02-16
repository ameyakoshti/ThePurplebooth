<?php
require_once "connections.php";
require_once 'edit_request.php';
require_once 'users.php';
open_connection();

/*
 * Description : This function is used to insert an image uploaded by the photographer into the database along with it's metadata.
 * Its does a 50% image compression.
 * Tables involved : image_info
 */
function upload_image($user_id, $file_name, $tmp_name, $file_size, $file_type, $title, $description, $category) {
	try {	
		// Get the image id for the image name
		$res = mysql_query("SELECT MAX(image_id) as count FROM thepurplebooth.imageinfo");
		$data = mysql_fetch_array($res);
		$image_id = $data['count'];
		if($image_id < 1){
			$image_id = 1;
		}
		// Move the uploaded image to original_images folder 
		$file_location = $_SERVER["DOCUMENT_ROOT"] . "/thepurplebooth/original_images/" . $image_id . ".jpg";
		$file_location_db = "/thepurplebooth/original_images/" . $image_id . ".jpg";
		move_uploaded_file($tmp_name, $file_location);
		
		$result = mysql_query("INSERT INTO `thepurplebooth`.`imageinfo` VALUES (DEFAULT,'$user_id',0,'$file_name','$file_type','$file_size','$file_location_db',NULL,'$title','$description',NULL,'$category','N',NOW(),NOW(),'0')");
		if(!$result){
			error_log(mysql_error());
		}
		
		return TRUE;
	} catch(exception $e) {
		error_log($e);
		return FALSE;
	}
}

/*
 * Description : This function is used to insert an image which is uploaded by the editor into the database along with it's metadata. 
 * Tables involved : image_info
 */
function upload_edited_image($image_id, $file_name, $tmp_name, $file_size, $file_type, $description) {
	try {
		$file_location = $_SERVER["DOCUMENT_ROOT"] . "/thepurplebooth/edited_images/" . $image_id . ".jpg";
		$file_location_db = "/thepurplebooth/edited_images/" . $image_id . ".jpg";
		move_uploaded_file($tmp_name, $file_location);

		$query = "UPDATE `thepurplebooth`.`imageinfo` SET `edited_img_link`='$file_location_db', `editor_description`='$description' WHERE `image_id`=$image_id";
		mysql_query($query) or die('Error, query failed');

		return TRUE;
	} catch(exception $e) {
		return FALSE;
	}
}

/*
 * Description : This function is used to fetch image based on the imageid.
 * It checks the following :
 * 1. If the photographer is seeing his own image then its gives an option for accepting bids from editors if any.
 * 2. If others are viwing the image then its gives them an option to place a bid.
 * 3. If an editor's bid is accepted then it gives an option to download the RAW image.
 * 4. If an editor's bid is accepted then it displays a upload button for the editor to upload his version of the edited image.
 * 5. If the editor has uploaded his version of the image then it displays a download button for the photographer to download the
 * 	  edited image. 
 * 6. Show all the comments and replies for this image.
 * 7. If the project is closed then it hides bids information 
 * Tables involved : image_info.
 */
function get_image_by_id($id,$logged_in_user_id,$status) {
	$query = "SELECT * FROM `thepurplebooth`.`imageinfo` where `image_id`=" . $id;
	$res = mysql_query($query);
	$imageHTML = "";
	$downloadHTML = "";
	$imagename = "";
	$edited_img_link = "";
	$owner_user_id ="";
	$closed_project = "";
	
	while ($data = mysql_fetch_array($res)) {
		$owner_user_id = $data['user_id'];
		$editor_user_id = $data['editor_id'];
		$editor_img_link = $data['edited_img_link'];
		$photographer = get_user_info_by_id($data['user_id']);
		$imagename = $data['name'];
		$edited_img_link = $data['edited_img_link'];
		$closed_project = $data['closed_project'];
		$original_image_location = $data['content'];
		
		if($status == "1"){
	    	//file_put_contents('./original_images/'.$imagename, $data['content']);
			$imageHTML = $imageHTML . '<div id="image" data-imageid="' . $data['image_id'] . '" data-userid="' . $data['user_id'] . '" class="selectedImage"><img class="galleryImage" src="' . $original_image_location . '">';
			$imageHTML = $imageHTML . '<div id="imagetitle" class="title">' . "<h4>Title : " . $data["title"] . '</h4></div>';
			$imageHTML = $imageHTML . '<div id="imagedescription" class="desc">' . "<h4>Description : " . $data["description"] . '</h4></div>';
			$imageHTML = $imageHTML . '<div id="imageuploader" class="profileLink">Image uploaded by <a href="profile.php?username='.$photographer["user_name"].'">'.$photographer['user_name'].'</a></div>';
		}
		else{
			$editor = get_user_info_by_id($data['editor_id']);
			$imageHTML = $imageHTML . '<div id="image" data-imageid="' . $data['image_id'] . '" data-userid="' . $data['user_id'] . '" class="selectedImage"><img class="galleryImage" src="' . $edited_img_link . '">';
			$imageHTML = $imageHTML . '<div id="imagetitle" class="title">' . "<h4>Title : " . $data["title"] . '</h4></div>';
			$imageHTML = $imageHTML . '<div id="imagedescription" class="desc">' . "<h4>Description : " . $data["editor_description"] . '</h4></div>';
			$imageHTML = $imageHTML . '<div id="imageuploader" class="profileLink">Image edited by <a href="profile.php?username='.$editor["user_name"].'">'.$editor['user_name'].'</a></div>';
		}		
			
	}

	// if the project is closed then no need to show the bids info and the edit me button
	if($closed_project === "0"){
		$imageHTML = $imageHTML . '<div id="imagebids" class="requests">' . get_requests_for_image($id) . '</div>';
		if ($owner_user_id != $logged_in_user_id){
			$imageHTML = $imageHTML . '<div id="buttonbids"><button class="btn btn-primary btn-small editImage">Edit Me!</button></div></br>';
		}
	
		$downloadHTML .= '<div id="downloads"><p>';
		if ($owner_user_id === $logged_in_user_id){
			if($editor_img_link != ''){
				$_SESSION['edited_img_link'] = $edited_img_link;
				$downloadHTML .= '<a href="#ratingModal" data-toggle="modal" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Photographer\'s Download</a>';
			}
		}
		if ($editor_user_id === $logged_in_user_id){
			$downloadHTML .= '<a href="http://localhost:8888/thepurplebooth/original_images/'.$imagename.'" download="'.$imagename.'" class="btn btn-inverse"><i class="icon-white icon-circle-arrow-down"></i> Editor\'s Download</a>&nbsp';
			$downloadHTML .= '<a href="#uploadModal" data-toggle="modal" class="btn btn-primary"><i class="icon-white icon-circle-arrow-up"></i> Editor\'s Upload</a>';
		}
		$downloadHTML .= '</p></div>';
	}
	
	echo $imageHTML;
	echo $downloadHTML;
	
	// if the project is closed then no need to show the bids info
	if (($owner_user_id == $logged_in_user_id) && $closed_project == 0){
			get_all_bids($id);
	}
	echo "</div>";
}

/*
 * Description : This function is used to fetch all the bids on a image based on the imageid. 
 * Tables involved : image_info, editrequest.
 */
function get_all_bids($id){
	// check if an editor is already selected for this image. if yes then disable the editors selection buttons
	$querycheck = "SELECT editor_id FROM `thepurplebooth`.`imageinfo` where `image_id`=" . $id;
	$data = mysql_fetch_array(mysql_query($querycheck));
	
	// if the editor has not been selected then show all the options available
	if($data['editor_id'] == 0){	
		$query = "SELECT * FROM `thepurplebooth`.`editrequest` where `request_image_id`=" . $id;
		$res = mysql_query($query);
		$bidsfound = FALSE;
		
		$biddersHTML = '<div id="bidders"><br>';
		$biddersHTML .= '<p>The following editors have bidded on your image : </p>';
		
		while ($data = mysql_fetch_array($res)) {
			$bidsfound = TRUE;
			$user_data = get_user_info_by_id($data['request_user_id']);
			$username = $user_data['user_name'];		
			$biddersHTML .= '<input type="radio" name="bidders" class="radioBtnClass" value='.$user_data["user_name"].'> <a href="profile.php?username='.$user_data["user_name"].'">'.$user_data['user_name'].'</a>';
		}
		// check if there are some bidders for the this image, if yes then show the accept bid button.
		if($bidsfound){
			$biddersHTML .= '<a href="#" id="acceptbid" class="btn btn-success"><i class="icon-white icon-ok"></i> Accept Bid</a>';
		}
		else {
			$biddersHTML .='<p>No bids yet!</p>';	
		}
		$biddersHTML .= '</div>';
		echo $biddersHTML;
	}
	else{
		// show the editor that has been selected for this image
		$_SESSION['editor_id'] = $data['editor_id'];
		$editor_data = get_user_info_by_id($data['editor_id']);
		echo '<div id="assignededitor"><p> You have already selected <a href="profile.php?username='.$editor_data["user_name"].'">'.$editor_data['user_name'].'</a> as the editor</p></div>';
	}
}

/*
 * Description : This function is used to fetch all the images for the gallery page. 
 * Tables involved : image_info.
 */
function get_all_images() {
	$query = "SELECT `image_id`,`content` FROM `thepurplebooth`.`imageinfo`";
	$res = mysql_query($query);
	while ($data = mysql_fetch_array($res)) {
		echo '<li class="span3">';
		echo '<div class="thumbnail">';
		echo '<a class="imageClick" href="view_image.php?id=' . $data['image_id'] . '">';
		echo '<img class="galleryImage" src="' . $data['content'] . '">';
		echo '</a>';
		echo '<div><button data-imgid="' . $data['image_id'] . '" class="btn btn-primary btn-small goToImage">Go To Image</button></div>';
		echo '</div>';
		echo '</li>';
	}
}

/*
 * Description : This function is used to fetch all the images for the gallery page based on the filter applied. 
 * Tables involved : image_info.
 */
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
	$query = "SELECT `image_id`,`content`,`closed_project` FROM `thepurplebooth`.`imageinfo` $where_clause";
	//echo $query;
	$res = mysql_query($query);
	
	$empty_result = TRUE;  
	while ($data = mysql_fetch_array($res)) {
		$empty_result = FALSE;		
		echo '<li>';
		echo '<img src="' . $data['content'] . '">';
		echo '<p><button data-imgid="' . $data['image_id'] . '" data-imgstatus="'.$data['closed_project'].'" class="btn btn-primary btn-small goToImage">Go To Image</button></p>';
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