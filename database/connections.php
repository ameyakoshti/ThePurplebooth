<?php

$link;
function open_connection(){
	$link = mysql_connect('localhost', 'root', 'root');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	$db_selected = mysql_select_db('codenameDS', $link);
}

function close_connection(){
	mysql_close($link);
}

require_once "users.php";
require_once "image_info.php";
?>