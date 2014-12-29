<?php
/*
* File used to post content directly to Twitter
* Integreated with cWebConsultants CMS
*
*/
require_once('config.php');
require_once('twitteroauth/twitteroauth.php');

if(isset($_POST['post'])){
	$twitter_post=$_POST['msg'];
}else{
	header("location:".SITE_NAME);
	exit;
}

/* get access token from database */
$query="select * from social_media where `key`='twitter_access_token'";
$result=mysql_query($query, $db_connection);
if(mysql_num_rows($result)){
	$row=mysql_fetch_assoc($result);
	$access_token=unserialize($row['value']);
}

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/rate_limit_status');
echo "Current API hits remaining: {$content->remaining_hits}.<br/><br/>";


function twitteroauth_row($method, $response, $http_code, $parameters = '') {

//print_r($response);
  switch ($http_code) {
    case '200':
    case '304':
      return true;
      break;
    case '400':
    case '401':
    case '403':
    case '404':
    case '406':
      return false;
      break;
    case '500':
    case '502':
    case '503':
      return false;
      break;
    default:
       return true;
  }
}

/* statuses/update */
//date_default_timezone_set('GMT');
$module=$_POST['module'];
$parameters = array('status' =>$_POST['msg']);
$status = $connection->post('statuses/update', $parameters);
if(twitteroauth_row('statuses/update', $status, $connection->http_code, $parameters)){
	$l=make_admin_url($module);
	header("location:".$l);
	exit;
}
else{
	$l=make_admin_url($module);
	header("location:".$l);
	exit;
}
?>