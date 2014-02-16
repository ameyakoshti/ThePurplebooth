<?php
include $_SERVER['DOCUMENT_ROOT'] . '/thepurplebooth/includes/links.php';
?>

<html>
	<head>
		<title>Contact</title>
	</head>
	<body>

		<?php
			include $_SERVER['DOCUMENT_ROOT'] . '/thepurplebooth/includes/masterpage.php';
		?>

		<div class="hero-unit">
			<h1>Contact us</h1>
			<p>
				Send us what you like about the website or how we can improve it more!
			</p>
			<form method="post" enctype="multipart/form-data">
				
				<div>
					<p>
						Your email address
					</p>
					<input type="email" id="email" name="email" class="enterEmailContactUs" placeholder="Email" value="<?php if(isset($_SESSION['thepurplebooth_email'])) echo $_SESSION['thepurplebooth_email']?>" required/>
				</div>
				
				<div>
					<p>
						Choose a title for the message
					</p>
					<textarea id="title" name="title" class="enterComment" placeholder="Title" required></textarea>
				</div>

				<div>
					<p>
						Your comments
					</p>
					<textarea id="message" name="message" class="enterCommentContactUs" placeholder="Description" required></textarea>
				</div>

				<div>
					<p>
						<button class="btn btn-primary btn-small" id="send" name="send"
						type="submit">
							<i class="icon-envelope icon-white"> </i> Send
						</button>
					</p>
				</div>
			</form>
		</div>
			<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/thepurplebooth/includes/footer.php';
		?>
	</body>
</html>
<?php 
if (isset($_POST['send'])) {
	try {
		$to = "ameyakoshti@gmail.com";
		$subject = "thepurplebooth Feedback";
		$email_field = $_POST['email'];
		$title_field = $_POST['title'];
		$message = $_POST['message'];
			
		require_once 'swift/lib/swift_required.php';

		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
		  ->setUsername('thepurplebooth@gmail.com')
		  ->setPassword('thepurplebooth2013');
		
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject." Title: ".$title_field)
		  ->setFrom(array($email_field => 'Feedback'))
		  ->setTo(array('thepurplebooth@gmail.com'))
		  ->setBody("Mail from : ".$email_field."\nOriginal message : ".$message);
		
		$result = $mailer->send($message);
		$success = TRUE;	
	} catch(Exception $e) {
		error_log($e);
		$success = FALSE;
	}
	
	if ($success === TRUE){?>
		<script type="text/javascript">
			jSuccess(
				    'Mail sent!',
				    {
				      autoHide : true,
				      TimeShown : 2000,
				      HorizontalPosition : 'center',
				      ShowOverlay : false
				    }
				   );
		</script>	
		<?php 
	 }
	 else {?>
	 	<script type="text/javascript">
	 		 jError(
 				    'Oops, something went wrong!',
 				    {
 				      autoHide : true,
 				      TimeShown : 2000,
 				      HorizontalPosition : 'center',
 				      ShowOverlay : false
 				    }
 				  );
	 	</script>
	 		<?php }	
}
?>
