<?php
//  Content Post App
//
// Name: cWebConsultants CMS - Facebook API 
//
/////////////////////////////////////////////// **************  include project config file here based on folder location
require_once '../../include/config/config.php';
require_once 'inc/facebook-db.php';




/* Create our Application instance. */
$facebook = new Facebook(
/* facebook app details */
array(
  'appId' =>FACEBOOK_APP_CODE,    //'145615732189187',
  'secret' =>FACEBOOK_APP_SECRET, // '84d129ccf98800170e559da7617727ad',
  'cookie' => false,
));


if(isset($_GET['d']) && $_GET['d']==1){
	$facebook->clearPersistentData('user_id');
	$facebook->clearPersistentData('access_token');
	$facebook->clearPersistentData('code');
	$facebook->clearPersistentData('state');
	header('location:get-code.php');
	exit;
}

/* Create our Application instance. */
$facebook = new Facebook(
/* facebook app details */
array(
  'appId' =>FACEBOOK_APP_CODE,    //'145615732189187',
  'secret' =>FACEBOOK_APP_SECRET, // '84d129ccf98800170e559da7617727ad',
  'cookie' => false,
));


// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	//print_r($user_profile);
	echo '<div style="width:300px;border:solid 1px #dcdcdc;padding:10px;margin:100px;">';
	echo 'Hello <strong>'.$user_profile['name'].'</strong><br/><br/>';
	echo 'Your facebook account has been linked to the CMS<br>';
	echo '<a href="'.make_admin_url('setting').'">click here to go back</a> <br/><br/>';
    echo '<a href="get-code.php?d=1"><i>unlink this account & link new account</i></a> <br/><br/><b>Please logout of previously linked facebook account before proceeding to link new account</b>';
	echo '</div>';
		
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} 
else {
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'user_status,publish_stream,user_photos,offline_access'));
  header("location:".$loginUrl);
}