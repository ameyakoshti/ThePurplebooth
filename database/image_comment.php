<?php
require_once "connections.php";
open_connection();

if(isset($_POST['insert_comment'])){
	insert_comment($_POST['user_id'],$_POST['user_name'],$_POST['image_id'],$_POST['comment_text']);
}

if(isset($_GET['select_comments'])){
	select_comments($_GET['image_id']);
}

if(isset($_POST['reply_comment'])){
	insert_reply_comment($_POST['user_id'],$_POST['user_name'],$_POST['image_id'],$_POST['comment_text'],$_POST['comment_id']);
}

function insert_reply_comment($user_id,$user_name,$image_id,$comment_text,$comment_id){
	try {
		$text = str_replace("\n", "<br/>", $comment_text);
		$query = "Insert into codenameDS.replycomment values (DEFAULT,".$user_id.",'".$user_name."',".$comment_id.",'".$text."',NOW())";
		error_log($query);
		mysql_query($query) or die('Error, query failed');
		return TRUE;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function insert_comment($user_id,$user_name,$image_id,$comment_text){
	try {
		$text = str_replace("\n", "<br/>", $comment_text);
		$query = "Insert into codenameDS.imagecomment values (DEFAULT,".$user_id.",'".$text."',".$image_id.",NOW(),'".$user_name."')";
		error_log($query);
		mysql_query($query) or die('Error, query failed');
		return TRUE;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}

function select_comments($image_id){
	try {
		$query = "SELECT * 
			FROM codenameDS.imagecomment
			LEFT JOIN codenameDS.replycomment ON codenameDS.imagecomment.comment_id = codenameDS.replycomment.reply_comment_id
			WHERE codenameDS.imagecomment.comment_image_id =".$image_id;
		error_log($query);
		$res = mysql_query($query);
		$result = array();
		$i = 0;
		while ($data = mysql_fetch_array($res)) {
			 $result[] = $data;
			 $i++;
		}
		$response = json_encode($result);
		error_log($response);
		echo $response;
	} catch(Exception $ex) {
		error_log($ex);
		return FALSE;
	}
}
?>