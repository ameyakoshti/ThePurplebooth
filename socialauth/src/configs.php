<?php
/**
 * Configurations for social network applications
 * @author Hüseyin BABAL <turkiye.java@gmail.com>
 */
/** General configurations */

//Base path of socialauth application. You must give full path!
$conf_main['base_path'] = 'http://localhost:8888/thepurplebooth/socialauth/index.php';
//Base path of your application. You must give full path!
$conf_main['base_path_thepurplebooth'] = 'http://localhost:8888/thepurplebooth/index.php';
//Default cookie expire time
$conf_main['expire_time'] = time() + 60*60*24*30;//1 month
//Domain name
$conf_main['domain_name'] = 'localhost';

//DB Configurations
//Db server e.g. 'localhost'
$conf_db['db_server'] = "localhost";
//Db name : e.g. 'CustomerDb'
$conf_db['db_name'] = "thepurplebooth";
//Db username : e.g. 'root'
$conf_db['db_username'] = "root";
//Db password
$conf_db['db_password'] = "root";
//Db table name. e.g. 'tbl_users'
$conf_db['db_user_table_name'] = "users";
//Id field of user table . e.g. 'id'
$conf_db['db_user_field_id'] = "user_id";
//Name field of user table . e.g. 'name'
$conf_db['db_user_field_name'] = "full_name";
//Id field of user table . e.g. 'username'
$conf_db['db_user_field_username'] = "user_name";
//Id field of user table . e.g. 'password'
$conf_db['db_user_field_password'] = "password";
//Id field of user table . e.g. 'email'
$conf_db['db_user_field_email'] = "email";
//Id field of user table . e.g. 'network_type'
$conf_db['db_user_field_social_network_type'] = "provider_id";
//Password stored as md5?
$conf_db['password_md5'] = true;



/** Twitter configurations */

//Twitter credentials
$conf_twitter['consumer_key'] = 'oHUZj0bHik5Fv6ha3NPw';
$conf_twitter['consumer_secret'] = 'G8sUTLrrsUjtj6fkxcPURLIh7znc10oVdpkq43GDqg';
//Callback url for twitter.
$conf_twitter['oauth_callback'] = 'http://localhost:8888/thepurplebooth/socialauth/callback.php?type=twitter';

/** Facebook configurations */

//Facebook credentials
$conf_facebook['appId'] = '199598153533305';
$conf_facebook['secret'] = '810e2fa8399466dbbb2a065628c01e6c';
//Callback url for facebook.
$conf_facebook['redirect_uri'] = 'http://localhost:8888/thepurplebooth/socialauth/callback.php?type=facebook';
//Facebook callback fields(default values, it can be empty)
$conf_facebook['fields'] = 'id,name,first_name,last_name,email';
//Facebook permissions(default values)
$conf_facebook['permissions'] = 'email,publish_stream,user_status';

/** Linked configurations */

//Linkedin credentials
$conf_linkedin['linkedin_access'] = '1jhv381v2lsu';
$conf_linkedin['linkedin_secret'] = 'xMzQ3tlMNGYm0iDz';
//Callback url for linkedin.
$conf_linkedin['callback_url'] = 'http://localhost:8888/thepurplebooth/socialauth/callback.php?type=linkedin';
$conf_linkedin['base_url'] = $conf_main['base_path'];

/** Google configurations */

//Callback url for google.
$conf_google['return_url'] = 'http://localhost:8888/thepurplebooth/socialauth/callback.php?type=google';

/** Yahoo configurations */

//Yahoo credentials

//Callback url for yahoo.
$conf_yahoo['return_url'] = 'http://localhost:8888/thepurplebooth/socialauth/callback.php?type=yahoo';
