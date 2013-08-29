<?php

function get_user_info($user_id) {
	$user_id = (int)$user_id;
	//database_connect();
	$data = mysql_fetch_assoc(mysql_query("select * from `codenameDS`.`users` where `user_id` = $user_id"));
	return $data;
}

function update_user_info($user_id) {
	$user_id = (int)$user_id;
	//database_connect();
	//mysql_query("insert into `codenameDS`.`users`(`full_name`,`email`,`password`,`profile_picture`) values ()");
}

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