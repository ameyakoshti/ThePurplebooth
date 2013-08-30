<?php
require_once "connections.php";
open_connection();

function get_reviews_by_user_id($id){
	$query = "SELECT * FROM `codenameDS`.`userrating` where `user_id`=".$id;
	$res = mysql_query($query);

	$result = array();
	$i = 0;
	while ($data = mysql_fetch_array($res)) {
		 $result[] = $data;
		 $i++;
	}
	$response = json_encode($result);
	//error_log($response);
	echo $response;
}
?>