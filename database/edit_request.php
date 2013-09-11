<?php
require_once "connections.php";
require_once 'users.php';

open_connection();

if(isset($_POST['insert_edit_request'])){
	insert_edit_request($_POST['request_user_id'],$_POST['image_id'],$_POST['request_image_user_id']);
}

if(isset($_GET['check_valid_request'])){
	check_valid_requester($_GET['request_user_id'],$_GET['image_id']);
}

if(isset($_GET['get_request_to'])){
	get_requests_got_by($_GET['user_id']);
}

if(isset($_GET['get_request_by'])){
	get_requests_made_by($_GET['user_id']);
}

if(isset($_POST['editor_found'])){
	update_editor($_POST['editor_username'],$_POST['image_id']);
}

function insert_edit_request($req_usr_id,$req_img_id,$req_img_usr_id){
	try {
		$query = "Insert into codenameDS.editrequest values (DEFAULT,".$req_usr_id.",".$req_img_usr_id.",".$req_img_id.",DEFAULT,NOW())";
		//error_log($query);
		mysql_query($query) or die('Error, query failed');
		$res = get_requests_for_image($req_img_id);
		echo $res;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function get_requests_got_by($userid){
	try{
		$query = "Select codenameDS.editrequest.*,codenameDS.users.user_name from codenameDS.editrequest LEFT join
				  codenameDS.users ON codenameDS.editrequest.request_user_id = codenameDS.users.user_id 
				  where codenameDS.editrequest.request_image_user_id=".$userid;
		$res = mysql_query($query);
		$result = array();
		while ($data = mysql_fetch_array($res)) {
			$result[] = $data;
		}
		$response = json_encode($result);
		//error_log($response);
		echo $response;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function get_requests_made_by($userid){
	try{
		$query = "Select codenameDS.editrequest.*,codenameDS.users.user_name from codenameDS.editrequest LEFT join
				  codenameDS.users ON codenameDS.editrequest.request_image_user_id = codenameDS.users.user_id
				  where codenameDS.editrequest.request_user_id=".$userid;
		$res = mysql_query($query);
		$result = array();
		while ($data = mysql_fetch_array($res)) {
			$result[] = $data;
		}
		$response = json_encode($result);
		//error_log($response);
		echo $response;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function check_valid_requester($user_id,$imgid){
	$query = "SELECT COUNT(  `request_id` ) AS editRequests FROM editrequest WHERE  `request_user_id` =".$user_id ." and `request_image_id`=".$imgid;
	//error_log($query);
	$reqs = mysql_query($query);
	while ($data = mysql_fetch_array($reqs)) {
		$result = $data['editRequests'];
	}
	echo $result;
}

function get_requests_for_image($id){
	$getRequests = "SELECT COUNT(`request_id`) AS editRequests FROM editrequest WHERE `request_image_id` =".$id;
	//error_log($getRequests);
	$reqs = mysql_query($getRequests);
	$result="";
	while ($data = mysql_fetch_array($reqs)) {
		$result = 'This image has '.$data['editRequests'].' requests.';
	}
	return $result;
}

function update_editor($editor_username,$image_id){		
	try {
		$data = get_user_info($editor_username);
		$editor_id = $data['user_id'];
		
		$query = "UPDATE `codenameDS`.`imageinfo` SET `editor_id`=".$editor_id." WHERE `image_id`=".$image_id;
		//error_log($query);
		mysql_query($query) or die('Error, query failed');
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}
?>