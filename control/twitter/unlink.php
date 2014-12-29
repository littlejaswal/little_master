<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
require_once('config.php');
require_once('twitteroauth/twitteroauth.php');

$linked=false;
$query="delete from social_media where `key`='twitter_access_token'";
$result=mysql_query($query, $db_connection);
if(mysql_affected_rows()){
	header('location:connect.php');
}