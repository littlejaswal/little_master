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

if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://twitter.com/apps">https://twitter.com/apps</a>';
  exit;
}

$linked=false;
$query="select * from social_media where `key`='twitter_access_token'";
$result=mysql_query($query, $db_connection);
if(mysql_num_rows($result)){
	$row=mysql_fetch_assoc($result);
	$linked=true;
	$user=unserialize($row['value']);
}

/* Include HTML to display on the page. */
include('html.inc');