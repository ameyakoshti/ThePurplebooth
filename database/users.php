<?php
require_once "connections.php";
open_connection();

/*
 * Description : This function fetches all the user information based on the username.
 * Tables involved : users.
 */
function get_user_info($user_name) {
	$data = mysql_fetch_assoc(mysql_query("select * from `codenameDS`.`users` where `user_name` = \"$user_name\""));
	return $data;
}

/*
 * Description : This function fetches all the user information based on the userid.
 * Tables involved : users.
 */
function get_user_info_by_id($user_id) {
	$data = mysql_fetch_assoc(mysql_query("select * from `codenameDS`.`users` where `user_id` = \"$user_id\""));
	return $data;
}

/*
 * Description : This function is used to update user information based on the userid.
 * Tables involved : users.
 */
function update_user_info($user_id) {
	$user_id = (int)$user_id;
	//mysql_query("insert into `codenameDS`.`users`(`full_name`,`email`,`password`,`profile_picture`) values ()");
}

/*
 * Description : This function is to update the user profile picture.
 * Tables involved : users.
 */
function upload_profile_picture($user_id, $file_name, $tmp_name, $file_size, $file_type) {
	try {
		$file_location = $_SERVER["DOCUMENT_ROOT"] . "/codenameDS/avatars/" . $user_id . ".jpg";
		$file_location_db = "/codenameDS/avatars/" . $user_id . ".jpg";
		move_uploaded_file($tmp_name, $file_location);

		$query = "UPDATE `codenameDS`.`users` SET `profile_picture`='$file_location_db' WHERE `user_id`='$user_id'";

		mysql_query($query) or die('Error, query failed');

		return TRUE;
	} catch(exception $e) {
		return FALSE;
	}
}
?>