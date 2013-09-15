<?php
require_once "connections.php";
require_once "users.php";
open_connection();

// this gets called from the user profile page to display comments and rating
if(isset($_GET['select_reviews'])){
	get_reviews_by_user_id($_GET['user_name_rating']);
}

if(isset($_POST['update_comments'])){
	update_user_comments($_POST['editor_user_id'],$_POST['rated_by'],$_POST['comments']);
}

function get_reviews_by_user_id($user_name_rating){
	$user_data = get_user_info($user_name_rating);
	$user_id = $user_data['user_id'];
	$query = "SELECT * FROM `codenameDS`.`ratings` where `user_id` = \"$user_id\"";
	$res = mysql_query($query);
	$result = array();

	while ($data = mysql_fetch_array($res)) {
		 $result[] = $data;
	}
	$response = json_encode($result);
	echo $response;
}

function get_ratings_info($id){
	$ratingquery="SELECT count(id) as total_votes, sum(rating) as total_value FROM `codenameDS`.`ratings` WHERE user_id=$id";
	return mysql_query($ratingquery);
}

function update_user_comments($editor_user_id,$rated_by,$comments){
	$query = "UPDATE `codenameDS`.`ratings` SET `comments`=\"".$comments."\" WHERE `user_id`=$editor_user_id AND `rated_by`=$rated_by order by id desc limit 1;";
	mysql_query($query);
}
?>