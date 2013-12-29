<?php
header("Cache-Control: no-cache");
header("Pragma: nocache");
require_once "connections.php";

// this gets called from selected image page when the photographer rates the editor before downloading the image

// $id_sent is the editor's id who is getting the rating.
$id_sent = preg_replace("/[^0-9]/", "", $_REQUEST['id']);
$vote_sent = preg_replace("/[^0-9]/", "", $_REQUEST['stars']);
$rated_by = preg_replace("/[^0-9]/", "", $_REQUEST['rated_by']);
$units = 5; //max number of stars 

open_connection();

mysql_query("insert into `codenameDS`.`ratings` (id,user_id,rated_by,rating,date) values (DEFAULT,$id_sent,$rated_by,$vote_sent,curdate())");

// this is a new queries to get the new values
$newdataquery = "SELECT count(id) as total_votes, sum(rating) as total_value FROM `codenameDS`.`ratings` WHERE user_id='$id_sent' ";
$newtotals = mysql_query($newdataquery);
$numbers = mysql_fetch_assoc($newtotals);
$count = $numbers['total_votes'];
//how many votes total
$current_rating = $numbers['total_value'];
error_log($newdataquery);
//total number of rating added together and stored
$tense = ($count == 1) ? "vote" : "votes";

$new_back = array();
for ($i = 0; $i < 5; $i++) {
	$j = $i + 1;
	if ($i < @number_format($current_rating / $count, 1) - 0.5)
		$class = "ratings_stars ratings_vote";
	else
		$class = "ratings_stars ratings_blank";
	$new_back[] .= '<div class="star_' . $j . ' ' . $class . '"></div>';
}

$new_back[] .= ' <div class="total_votes"><p class="voted"> Rating: <strong>' . @number_format($current_rating / $count, 1) . '</strong>/' . $units . ' (' . $count . ' ' . $tense . ' cast) ';
$new_back[] .= '<br><span class="thanks">Thanks for rating!</span></p>';
$output = join("\n", $new_back);

echo $output;
?>