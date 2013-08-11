<?php
//Check session start
if (empty($_SESSION)) {
    session_start();
}

//This is main class, this must be included!
include 'src/SocialAuth.php';

//Check callback type(twitter, facebook, google, linkedin)
if (!empty($_GET['type'])) {
    $cookieArr = array();
    switch ($_GET['type']) {
        case 'twitter':
 			try {
            //Initialize twitter by using factory pattern over main class(SocialAuth)
            $twitterObj = SocialAuth::init('twitter');

            $twitterObj->setToken($_GET['oauth_token']);
            $token = $twitterObj->getAccessToken();
            $twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

            // save to cookies
            SocialAuth::setSessionData('oauth_token', $token->oauth_token);
            SocialAuth::setSessionData('oauth_token_secret', $token->oauth_token_secret);

            $twitterInfo= $twitterObj->get_accountVerify_credentials();

            /**
             * Prepare data inorder to send it to the complete registration page
             **/
            $dataArr = array(
                'type' => 'twitter',
                'name' => $twitterInfo->name,
                'username' => $twitterInfo->screen_name,
                'email' => null
            );
            //Redirect main page for user data ceck from db
            SocialAuth::redirectParentWindow('twitter', $dataArr, $_COOKIE['ref']);
			} catch (Exception $e) {
              error_log($e);
            }
            break;
        case 'facebook':
            //Initialize facebook by using factory pattern over main class(SocialAuth)
            $facebookObj = SocialAuth::init('facebook');
            $facebookInfo = $facebookObj->getUser();
            if ($facebookInfo) {
              try {
                $url = '';
                //Check if any field value specified in configs.php
                $fields = SocialAuth::getConfig('facebook', 'fields');
                if (!empty($fields)) {
                    $url = '?fields=' . $fields;
                }
                // Get detailed user info.
                $facebookUserInfo = $facebookObj->api('/me');
                  /**
                   * Prepare data inorder to send it to the complete registration page
                   **/
                  $dataArr = array(
                      'type' => 'facebook',
                      'name' => $facebookUserInfo['name'],
                      'username' => $facebookUserInfo['username'],
                      'email' => $facebookUserInfo['email']
                  );
                  //Redirect main page for user data ceck from db
                  SocialAuth::redirectParentWindow('facebook', $dataArr, $_COOKIE['ref']);
              } catch (FacebookApiException $e) {
                error_log($e);
                $facebookInfo = null;
              }
            }
            break;
        case 'google':
                //Initialize google by using factory pattern over main class(SocialAuth)
                $googleObj = SocialAuth::init('google');
                if ($googleObj->validate()) {
                    $identity = $googleObj->identity;
                    $attributes = $googleObj->getAttributes();
                    $email = $attributes['contact/email'];
                    $first_name = $attributes['namePerson/first'];
                    $last_name = $attributes['namePerson/last'];
                }
                /**
                 * Prepare data inorder to send it to the complete registration page
                 **/
                $dataArr = array(
                    'type' => 'google',
                    'name' => $first_name . ' ' . $last_name,
                    'username' => null,
                    'email' => $email
                );
                //Redirect main page for user data ceck from db
                SocialAuth::redirectParentWindow('google', $dataArr, $_COOKIE['ref']);
                break;
        case 'linkedin':
            //Initialize linkedin by using factory pattern over main class(SocialAuth)
            $linkedinObj = SocialAuth::init('linkedin');
            if (isset($_REQUEST['oauth_verifier'])) {
                $_SESSION['oauth_verifier'] = $_REQUEST['oauth_verifier'];

                $linkedinObj->request_token = unserialize($_SESSION['requestToken']);
                $linkedinObj->oauth_verifier = $_SESSION['oauth_verifier'];
                $linkedinObj->getAccessToken($_REQUEST['oauth_verifier']);

                $_SESSION['oauth_access_token'] = serialize($linkedinObj->access_token);
                header("Location: " . SocialAuth::getConfig('linkedin', 'callback_url'));
                exit;
            } else {
                $linkedinObj->request_token = unserialize($_SESSION['requestToken']);
                $linkedinObj->oauth_verifier = $_SESSION['oauth_verifier'];
                $linkedinObj->access_token = unserialize($_SESSION['oauth_access_token']);
            }
            $response = (array)simplexml_load_string($linkedinObj->getProfile("~:(id,first-name,last-name,headline,picture-url)"));
            /**
             * Prepare data inorder to send it to the complete registration page
             **/
            $dataArr = array(
                'type' => 'linkedin',
                'name' => $response['first-name'] . ' ' . $response['last-name'],
                'username' => preg_replace('/[^\00-\255]+/u', '', preg_replace('/\s+/', '', strtolower($response['first-name'] . ' ' . $response['last-name']))),
                'email' => null
            );
            //Redirect main page for user data ceck from db
            SocialAuth::redirectParentWindow('linkedin', $dataArr, $_COOKIE['ref']);

            break;
        case 'yahoo':
            //Initialize yahoo by using factory pattern over main class(SocialAuth)
            $yahooObj = SocialAuth::init('yahoo');
            if ($yahooObj->validate()) {
                $identity = $yahooObj->identity;
                $attributes = $yahooObj->getAttributes();
                $email = $attributes['contact/email'];
                $name = $attributes['namePerson'];
            }
            /**
             * Prepare data inorder to send it to the complete registration page
             **/
            $dataArr = array(
                'type' => 'yahoo',
                'name' => $name,
                'username' => null,
                'email' => $email
            );
            //Redirect main page for user data ceck from db
            SocialAuth::redirectParentWindow('yahoo', $dataArr, $_COOKIE['ref']);
            break;
        default:
            header("Location:" . SocialAuth::getConfig('main', 'base_path'));

    }
}