<?php
include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/links.php';
?>

<html>
	<head>
		<title>Gallery</title>
	</head>
	<body>
		<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/includes/masterpage.php';
		include $_SERVER['DOCUMENT_ROOT'] . '/codenameDS/database/users.php';

		$user_data = get_user_info($_SESSION['codenameDS_user_id']);
		print_r($user_data);
		?>
		<div class="container">
			<div class="row-fluid">
				<div class="span8">
					<p>
						<?php
						echo $user_data['user_id']." ";
						echo $user_data['user_name']." ";
						echo $user_data['full_name']." ";
						echo $user_data['email']." ";
						?>
					</p>

				</div>
			</div>
		</div>

	</body>
</html>