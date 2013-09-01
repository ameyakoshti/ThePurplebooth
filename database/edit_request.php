<?php
require_once "connections.php";
open_connection();

if(isset($_POST['insert_edit_request'])){
	insert_edit_request($_POST['request_user_id'],$_POST['image_id'],$_POST['request_image_user_id']);
}

function insert_edit_request($req_usr_id,$req_img_id,$req_img_usr_id){
	try {
		$query = "Insert into codenameDS.editrequest values (DEFAULT,".$req_usr_id.",".$req_img_usr_id.",".$req_img_id.",NOW())";
		error_log($query);
		mysql_query($query) or die('Error, query failed');
		$res = get_requests_for_image($req_img_id);
		echo $res;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function get_requests_for_image($id){
	$getRequests = "SELECT COUNT(  `request_id` ) AS editRequests FROM editrequest WHERE  `request_image_id` =".$id;
	error_log($getRequests);
	$reqs = mysql_query($getRequests);
	$result="";
	while ($data = mysql_fetch_array($reqs)) {
		$result = 'This image has '.$data['editRequests'].' requests.';
	}
	return $result;
}

?>