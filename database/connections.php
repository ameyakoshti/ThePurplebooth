<?php
$link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db('codenameDS', $link);

require_once "users.php";
require_once "image_info.php";
?>