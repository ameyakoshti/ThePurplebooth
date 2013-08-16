<?php
//Check session start
if (empty($_SESSION)) {
	session_start();
}
ob_start();

//This is main class, this must be included!
include 'src/SocialAuth.php';
//Check cookie first, if it is not set it means you are not logged in yet.
if (empty($_COOKIE['SocialAuth'])) {
	//action = login, logout ; type = twitter, facebook, google, linkedin
	if (!empty($_GET['action']) && $_GET['action'] == "login") {
		switch ($_GET['type']) {
			case 'twitter' :
				//Initialize twitter by using factory pattern over main class(SocialAuth)
				$twitterObj = SocialAuth::init('twitter');
				//Get login url according to configurations you specified in configs.php
				$twitterLoginUrl = $twitterObj -> getAuthenticateUrl(null, array('oauth_callback' => SocialAuth::getConfig('twitter', 'oauth_callback')));
				header("Location:" . $twitterLoginUrl);
				break;
			case 'facebook' :
				//Initialize facebook by using factory pattern over main class(SocialAuth)
				$facebookObj = SocialAuth::init('facebook');
				//Get login url according to configurations you specified in configs.php
				$facebookLoginUrl = $facebookObj -> getLoginUrl(array('scope' => SocialAuth::getConfig('facebook', 'permissions'), 'canvas' => 1, 'fbconnect' => 0, 'redirect_uri' => SocialAuth::getConfig('facebook', 'redirect_uri')));
				header("Location:" . $facebookLoginUrl);
				break;
			case 'google' :
				//Initialize google by using factory pattern over main class(SocialAuth)
				$googleObj = SocialAuth::init('google');
				if (!$googleObj -> mode) {
					$googleObj -> identity = 'https://www.google.com/accounts/o8/id';
					$googleObj -> required = array('namePerson/first', 'namePerson/last', 'contact/email');
					$googleObj -> returnUrl = SocialAuth::getConfig('google', 'return_url');
					//Get login url according to configurations you specified in configs.php and redirect to that url
					header('Location: ' . $googleObj -> authUrl());
				}
				break;
			case 'linkedin' :
				//Initialize linkedin by using factory pattern over main class(SocialAuth)
				$linkedinObj = SocialAuth::init('linkedin');
				$linkedinObj -> getRequestToken();
				$_SESSION['requestToken'] = serialize($linkedinObj -> request_token);
				//Get login url according to configurations you specified in configs.php
				$linkedinLoginUrl = $linkedinObj -> generateAuthorizeUrl();
				header("Location:" . $linkedinLoginUrl);
				break;
			case 'yahoo' :
				$yahooObj = SocialAuth::init('yahoo');
				$yahooObj -> identity = 'https://me.yahoo.com';
				$yahooObj -> required = array('namePerson', 'namePerson/first', 'namePerson/last', 'contact/email');

				$yahooObj -> returnUrl = SocialAuth::getConfig('yahoo', 'return_url');
				//Get login url according to configurations you specified in configs.php and redirect to that url
				header('Location: ' . $yahooObj -> authUrl());
				break;
			default :
				//If any login system found, warn user
				echo "Invalid Login system";
		}
	}
} else {
	if (!empty($_GET['action']) && $_GET['action'] == "logout") {
		//If action is logout, just expire the cookie
		SocialAuth::clearSessionData('SocialAuth');
		//var_dump($_COOKIE);exit;
		header("Location:" . SocialAuth::getConfig('main', 'base_path'));
	}
}
?>
<!DOCTYPE HTML>
<html>

	<head>
		<title>Login</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="js/popup.js"></script>
		<script src="js/common.js"></script>
	</head>

	<body>
		<div id="main">
			<div id="site_content">
				<div id="content" align="center">
					<h1>Just sign-in with one of the following social networking web sites!</h1>
					<?php
					$data = SocialAuth::getSessionData('SocialAuth');
					//If user not logged in by any social network, show login urls
					if (!$data):
					?>
					<table width="100%">
						<tr>
							<td width="20%"><a href="javascript:;" onclick="openLoginDialog('?action=login&type=twitter')"><img src="images/twitter-login.png"/></a></td>
							<td width="20%"><a href="javascript:;" onclick="openLoginDialog('?action=login&type=facebook')"><img src="images/facebook-login.png"/></a></td>
							<td width="20%"><a href="javascript:;" onclick="openLoginDialog('?action=login&type=google')"><img src="images/google-login.png"/></a></td>
							<td width="20%"><a href="javascript:;" onclick="openLoginDialog('?action=login&type=linkedin')"><img src="images/linkedin-login.png"/></a></td>
							<td width="20%"><a href="javascript:;" onclick="openLoginDialog('?action=login&type=yahoo')"><img src="images/yahoo-login.png"/></a></td>
							<td width="20%"><a href="/codenameDS/index.php""><img src="images/login.png" title="Your login system"/></a></td>
							</tr>						
							</table>
							<p>
							</br>
								We do not use your profile details to send messages/post to your friends.
							</p>
							<?php else:
								$_SESSION['codenameDS_user_id'] = $data['user_id'];
								$_SESSION['codenameDS_user_name'] = $data['user_name'];
								header("Location: http://localhost:8888/codenameDS/index.php?username=".$data['user_name'], TRUE);
							?>
							<!-- If user logged in by any social network, print details-->
							<p>Welcome, your details are:</p>
							<p><pre><?=var_dump($data) ?></pre></p>
							<p>You signed-in with <?=$data['provider_id'] ?>, <a href="?action=logout">Logout?</a></p>
							<?php endif ?>
							</div>
							</div>
							<!-- Modal Start-->
							<div class="modal hide fade in" id="myModal">
							<div class="modal-header">
							<h3>Complete Your Registration</h3>
							</div>
							<div class="modal-body">
							<div class="row">
							<div class="span4">
							<form class="form-horizontal">
							<fieldset>
							<div class="control-group" id="group-email">
							<label for="email" class="control-label">Email</label>
							<div class="controls">
							<input type="text" value="" id="email" name="email" class="input-xlarge">
							</div>
							</div>
							<div class="control-group" id="group-username">
							<label for="username" class="control-label">Username</label>
							<div class="controls">
							<input type="text" value="" id="username" name="username" class="input-xlarge">
							</div>
							</div>
							<div class="control-group" id="group-password">
							<label for="password" class="control-label">Password</label>
							<div class="controls">
							<input type="password" value="" id="password" name="password" class="input-xlarge">
							</div>
							</div>
							<div class="control-group" id="group-password-repeat">
							<label for="password-repeat" class="control-label">Repeat Password</label>
							<div class="controls">
							<input type="password" value="" id="password-repeat" name="password-repeat" class="input-xlarge">
							</div>
							</div>
							<input type="hidden" name="network-type" id="network-type" value=""/>
							<input type="hidden" name="ref" id="ref" value="<?php echo $_COOKIE['ref']; ?>"/>
							</fieldset>
							</form>
							</div>
							</div>
							</div>
							<div class="modal-footer">
							<a data-dismiss="modal" class="btn" href="#">Cancel</a>
							<a class="btn btn-primary" href="#" onclick="loginUser();">Complete Registration</a>
							</div>
							</div>
							<!-- Modal End -->
							</div>
							<!-- Do not remove! These are for modal popup of user confirmation -->
							<script src="js/bootstrap-transition.js"></script>
							<script src="js/bootstrap-modal.js"></script>

							<?php
							if (!empty($_GET['step']) && !empty($_GET['type']) && !empty($_GET['token']) && !empty($_GET['ref'])) {
								if (empty($_SESSION['complete_registration_type']) || empty($_SESSION['complete_registration_token'])) {
									SocialAuth::refreshSession();
									header("Location:" . SocialAuth::getConfig('main', 'base_path'));
								} else if ($_SESSION['complete_registration_type'] != $_GET['type'] || $_SESSION['complete_registration_token'] != $_GET['token'] || $_COOKIE['ref'] != urldecode($_GET['ref'])) {
									header("Location:" . SocialAuth::getConfig('main', 'base_path'));
									SocialAuth::refreshSession();
								} else {
									$userData = unserialize($_SESSION['complete_registration_data']);
									$username = ($userData["username"] != null) ? $userData["username"] : "";
									$email = ($userData["email"] != null) ? $userData["email"] : "";
									$disable = "";
									if (!empty($email)) {
										$disable = '$("#email").attr("disabled", "disabled");';
									}
									$checkResult = SocialAuth::checkUser($userData['username'], $userData['email'], $userData['type']);
									if ($checkResult['resultType'] == SocialAuth::$_NON_EXISTING_USER) {
										echo '<script type="text/javascript">$("#myModal").modal({ keyboard: false, backdrop: "static", toggle: "modal" });$("#username").val("' . preg_replace('/[^\00-\255]+/u', '', strtolower($username)) . '");$("#email").val("' . $email . '");$("#network-type").val("' . $_SESSION['complete_registration_type'] . '");' . $disable . '$("#email").focus();</script>';
									} else {
										SocialAuth::setSessionData('SocialAuth', $checkResult["data"]);
										$ref = $_COOKIE['ref'];
										SocialAuth::refreshSession();
										header("Location:" . $ref);
									}
								}
							}
							?>
	</body>
</html>
<?php ob_end_flush(); ?>