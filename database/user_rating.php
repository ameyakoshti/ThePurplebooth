<?php
require_once "connections.php";
require_once "users.php";
open_connection();

if(isset($_GET['select_reviews'])){
	get_reviews_by_user_id($_GET['user_name_rating']);
}

function get_reviews_by_user_id($user_name_rating){
	$user_data = get_user_info($user_name_rating);
	$user_id = $user_data['user_id'];
	$query = "SELECT * FROM `codenameDS`.`ratings` where `id` = \"$user_id\"";
	$res = mysql_query($query);
	$result = array();
	$i = 0;
	while ($data = mysql_fetch_array($res)) {
		 $result[] = $data;
		 $i++;
	}
	$response = json_encode($result);
	echo $response;
}
?>