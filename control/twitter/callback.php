<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
require_once('config.php');
require_once('twitteroauth/twitteroauth.php');

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
		$key='twitter_access_token';
		$value=serialize($access_token);
		$query="insert into social_media set `key`='".$key."', `value`='".$value."'";
		mysql_query($query, $db_connection);
		//Array ( [oauth_token] => 174299302-d6ymNuTYtO9Dr520ggACZKqY981rxk8bOO1G8xU4 [oauth_token_secret] => EhN6dmFbNDFpw18xVz8US2LeuFQVf03Pf7oZLHXmc [user_id] => 174299302 [screen_name] => cwebconsultants )
		header('Location: ./connect.php');
} else {
		/* Save HTTP status for error dialog on connnect page.*/
		header('Location: ./clearsessions.php');
}
