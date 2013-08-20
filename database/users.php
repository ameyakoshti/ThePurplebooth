<?php

function get_user_info($user_id){
		$user_id = (int)$user_id;
		//database_connect();
		$data = mysql_fetch_assoc(mysql_query("select * from `codenameDS`.`users` where `user_id` = $user_id"));
		return $data;
}

function update_user_info($user_id){
		$user_id = (int)$user_id;
		//database_connect();
		//mysql_query("insert into `codenameDS`.`users`(`full_name`,`email`,`password`,`profile_picture`) values ()");
}

?>