<?php
require_once "connections.php";
open_connection();

if(isset($_GET['select_reviews'])){
	get_reviews_by_user_id($_GET['user_name_rating']);
}

function get_reviews_by_user_id($user_name_rating){
	$query = "SELECT * FROM `codenameDS`.`userrating` where `user_name` = \"$user_name_rating\"";
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