I use this all the time so I am pasting a basic structure here 

try {
	
} catch(Exception $ex) {
	echo $ex;
}


<li>
	<a href="#loginModal" data-toggle="modal">new Login</a>
</li>


<div class="modal hide" id="loginModal" aria-hidden="true">
	<div class="modal-header">
		<h2>codenameDS Login</h2>
	</div>

	<div class="modal-body" style="overflow: hidden">
		<form method="POST" action="login.php">
			<div class="row-fluid">

				<div class="span12">
					<?php include $_SERVER["DOCUMENT_ROOT"].'/codenameDS/socialauth/index.php'?>
				</div>
			</div>
		</form>
	</div>

	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">
			Close
		</button>
	</div>
</div>