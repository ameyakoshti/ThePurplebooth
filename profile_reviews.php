<div id="user-reviews" style="margin: 30px 10px 10px 10px;">
	<script type="text/javascript"><?php
		if ($user_name_profile_view != "")
			echo "var username = '" . $user_name_profile_view . "';";
	?><?php
	if (isset($_SESSION['codenameDS_user_name']))
		echo "var loggedusername = '" . $_SESSION['codenameDS_user_name'] . "';";
?></script>
	<script src="/codenameDS/js/profile/profile.js"></script>
	<div class="reviews"></div>
</div>