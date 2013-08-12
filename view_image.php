<?php
$con = mysqli_connect('localhost', 'root', 'root', 'codenameDS');
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id = abs($_GET['id']);
$res = mysqli_query($con, "SELECT `content` FROM `codenameDS`.`imageinfo` WHERE `image_id`=$id");
$data = mysqli_fetch_array($res);

header('Content-type: image/jpg');
echo $data['content'];
mysqli_close($con);
?>