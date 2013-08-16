<?php
/**
 * This class for managing social authorization operations
 *
 * @author Hüseyin BABAL <turkiye.java@gmail.com>
 */

class SocialAuth
{

    public static $_NON_EXISTING_USER = '0';

    public static $_SYSTEM_USER = '1';

    public static $_SOCIAL_NETWORK_USER = '2';

    public static $_NETWORKS = array("twitter", "facebook", "google", "linkedin", "yahoo");

    public static $_EXISTING_EMAIL = '3';

    public static $_EXISTING_USERNAME = '4';

    public static $_RESULT_SUCCESS = "5";

    /**
     * This is the factory of social networks' libraries
     * @static
     * @throws Exception
     * @param $type
     * @return EpiTwitter|Facebook|LinkedIn
     */
    public static function init($type) {
        include 'configs.php';
        switch ($type) {
            case 'twitter':
                if (self::includeFiles($type)) {
                    return new EpiTwitter($conf_twitter['consumer_key'], $conf_twitter['consumer_secret']);
                } else {
                    throw new Exception('Necessary library not found for ' . $type);
                }
                break;
            case 'facebook':
                if (self::includeFiles($type)) {
                    return new Facebook(array(
                            'appId' => $conf_facebook['appId'],
                            'secret' => $conf_facebook['secret']));
                } else {
                    throw new Exception('Necessary library not found for ' . $type);
                }
                break;
            case 'linkedin':
                if (self::includeFiles($type, 'OAuth.php')) {
                    return new LinkedIn($conf_linkedin['linkedin_access'],
                                        $conf_linkedin['linkedin_secret'],
                                        $conf_linkedin['callback_url']);
                } else {
                    throw new Exception('Necessary library not found for ' . $type);
                }
                break;
            case 'google':
                if (self::includeFiles($type)) {
                    return new LightOpenID();
                } else {
                    throw new Exception('Necessary library not found for ' . $type);
                }
                break;
            case 'yahoo':
                if (self::includeFiles($type)) {
                    return new LightOpenID($conf_main['domain_name']);
                } else {
                    throw new Exception('Necessary library not found for ' . $type);
                }
                break;
            default:
               throw new Exception('Couldn\'t initialized SocialAuth.Input parameter required');
        }

    }

    /**
     * Include all files(for class including) under specified directory
     * @param string $path
     * @return void
     */
    private static function includeFiles($path = '', $excluded = '') {
        $included = 0;
        foreach (glob('src/' . $path . '/*.php') as $classes) {
            $classPath = explode("/", $classes);
            if ($excluded != $classPath[2]) {
                include_once($classes);
                $included++;
            }
        }
        return $included;
    }

    /**
     * Gets configuration value according to specified key
     * @static
     * @param $section
     * @param $key
     * @return
     */
    public static function getConfig($section, $key) {
        include 'configs.php';
        return ${"conf_" . $section}[$key];
    }

    /**
     * Sets session data
     * @static
     * @param string $key
     * @param bool $val
     * @return void
     */
    public static function setSessionData($key, $val) {
        include 'configs.php';
        if (is_array($val)) {
            setcookie($key, serialize($val), $conf_main['expire_time'], "/");
        } else {
            setcookie($key, $val, $conf_main['expire_time'], "/");
        }

    }

    /**
     * Gets stored session data
     * @static
     * @param string $key
     * @return mixed
     */
    public static function getSessionData($key) {
        if (empty($_COOKIE[$key])) {
            return false;
        }
        $data = @unserialize($_COOKIE[$key]);
        if ($data !== false) {
            return unserialize($_COOKIE[$key]);
        } else {
            return $_COOKIE[$key];
        }
    }

    public static function clearSessionData($key) {
        setcookie($key, '', -3600, "/");
		session_destroy();
		error_log($_SESSION);
    }

    /**
     * @static
     * Generate random number
     * @param integer $length
     * @return string
     */
    public static function generateRandomNumber($length = 8) {
        $random= "";

        srand((double)microtime()*1000000);

        $data = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $data .= "abcdefghijklmnopqrstuvwxyz";
        $data .= "0123456789";

        for($i = 0; $i < $length; $i++) {
            $random .= substr($data, (rand()%(strlen($data))), 1);
        }

        return md5($random);
    }

    /**
     * Redirects parent window
     * @static
     * @param $type
     */
    public static function redirectParentWindow($type, $data, $referer) {
        include 'configs.php';
        $randomNumber = SocialAuth::generateRandomNumber(15);
        $_SESSION['complete_registration_type'] = $type;
        $_SESSION['complete_registration_token'] = $randomNumber;
        $_SESSION['complete_registration_data'] = serialize($data);
        $url = $conf_main['base_path'] . '?step=2&type=' . $type . '&token=' . $randomNumber . '&ref=' . urlencode($referer);
        echo '<script type="text/javascript">opener.location.href = "' . $url . '"; window.close();</script>';
    }

    /**
     * @static
     * @param null $username
     * @param null $email
     * @param $type
     */
    public static function checkUser($username = null, $email = null, $type) {
        include 'configs.php';
        $link = SocialAuth::connectDb();
        if (!empty($email)) {
            $sql = "SELECT * FROM " . $conf_db['db_user_table_name'] . " WHERE " . $conf_db['db_user_field_email'] ."='" . $email . "'";
            $result = mysql_query($sql);
            if (!$result) {
                die("Could not successfully run query ($sql) from DB: " . mysql_error());
            }
            if (mysql_num_rows($result) == 0) {
                return array("data" => null,
                             "resultType" => SocialAuth::$_NON_EXISTING_USER);
            } else {
                $rowResult = null;
                while ($row = mysql_fetch_assoc($result)) {
                    $rowResult = $row;
                }
                if (in_array($rowResult[$conf_db['db_user_field_social_network_type']], SocialAuth::$_NETWORKS)) {
                    return array("data" => $rowResult,
                                 "resultType" => SocialAuth::$_SOCIAL_NETWORK_USER);
                } else {
                    return array("data" => $rowResult,
                        "resultType" => SocialAuth::$_SYSTEM_USER);
                }
            }
            mysql_free_result($result);
        } elseif (!empty($username)) {
            $sql = "SELECT * FROM " . $conf_db['db_user_table_name'] . " WHERE " . $conf_db['db_user_field_username'] ."='" . $username . "' AND " . $conf_db['db_user_field_social_network_type'] . "='" . $type . "'";
            $result = mysql_query($sql);
            if (!$result) {
                die("Could not successfully run query ($sql) from DB: " . mysql_error());
            }
            if (mysql_num_rows($result) == 0) {
                return array("data" => null,
                             "resultType" => SocialAuth::$_NON_EXISTING_USER);
            } else {
                $rowResult = null;
                while ($row = mysql_fetch_assoc($result)) {
                    $rowResult = $row;
                }
                return array("data" => $rowResult,
                             "resultType" => SocialAuth::$_SOCIAL_NETWORK_USER);
            }
        }
        mysql_close($link);
    }

    /**
     * @static
     * @return resource
     */
    public static function connectDb() {
        include 'configs.php';
        $link = mysql_connect($conf_db['db_server'], $conf_db['db_username'], $conf_db['db_password']);
        if (!$link) {
            die('Could not connect: ' . mysql_error());
        }
        if (!mysql_select_db($conf_db['db_name'])) {
            die('Could not select database: ' . mysql_error());
        }
        return $link;
    }

    /**
     * Checks data and saves user information
     * @static
     * @param $username
     * @param $email
     * @param $password
     * @param $networkType
     * @return array
     */
    public static function loginUser($username, $email, $password, $networkType) {
        include 'configs.php';
        $link = SocialAuth::connectDb();
        //Email check
        $sql = "SELECT * FROM " . $conf_db['db_user_table_name'] . " WHERE " . $conf_db['db_user_field_email'] ."='" . $email . "'";
        $result = mysql_query($sql);
        if (!$result) {
            die("Could not successfully run query ($sql) from DB: " . mysql_error());
        }
        if (mysql_num_rows($result) > 0) {
            return array("data" => null,
                "resultType" => SocialAuth::$_EXISTING_EMAIL);
        }
        mysql_free_result($result);
        //Username check
        $sql = "SELECT * FROM " . $conf_db['db_user_table_name'] . " WHERE " . $conf_db['db_user_field_username'] ."='" . $username . "'";
        $result = mysql_query($sql);
        if (!$result) {
            die("Could not successfully run query ($sql) from DB: " . mysql_error());
        }
        if (mysql_num_rows($result) > 0) {
            return array("data" => null,
                "resultType" => SocialAuth::$_EXISTING_USERNAME);
        }
        mysql_free_result($result);
        if ($conf_db['password_md5']) {
            $password = md5($password);
        }
        $data = unserialize($_SESSION['complete_registration_data']);
        $sql = "INSERT INTO " . $conf_db['db_user_table_name'] . " (" . $conf_db['db_user_field_username'] . ", " . $conf_db['db_user_field_email'] . ", " . $conf_db['db_user_field_name'] . ", " . $conf_db['db_user_field_password'] . ", " . $conf_db['db_user_field_social_network_type'] . ")"
            . " VALUES ('" . $username . "', '" . $email . "', '" . $data['name'] . "', '" . $password . "', '" . $networkType . "')";
        $result = mysql_query($sql);
        if (!$result) {
            die('Error: ' . mysql_error());
        } else {
            $sql = "SELECT * FROM " . $conf_db['db_user_table_name'] . " WHERE " . $conf_db['db_user_field_email'] ."='" . $email . "'";
            $result = mysql_query($sql);
            $i = 0;
            while ($row = mysql_fetch_assoc($result)) {
                $rows[$i] = $row;
                $i++;
            }
            SocialAuth::setSessionData('SocialAuth', $rows[0]);
            SocialAuth::refreshSession();
            return array("data" => $data,
                "resultType" => SocialAuth::$_RESULT_SUCCESS);
        }
        mysql_close($link);
    }

    public static function refreshSession() {
        unset($_COOKIE['ref'], $_SESSION['complete_registration_type'], $_SESSION['complete_registration_token'], $_SESSION['complete_registration_data']);
    }
}
 
