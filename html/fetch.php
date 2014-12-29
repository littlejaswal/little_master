<?php
// Content Post App
// Name: cWebConsultants CMS - Facebook API 
require_once 'include/config/config.php';
$function=array('image_manipulation');
include_functions($function);

require_once 'inc/facebook-db.php';

/* Create our Application instance. */
$facebook = new Facebook(
/* facebook app details */
array(
  'appId' => FACEBOOK_APP_CODE,
  'secret' => FACEBOOK_APP_SECRET,
  'cookie' => true,
));

$pageId='';

try {
	// Proceed knowing you have a logged in user who's authenticated.
		$pageFeed = $facebook->api($pageId . '/feed');
		print_r($pageFeed); exit;
} 
catch (FacebookApiException $e) {
		error_log($e);
		echo 'Sorry! Error occurd while posting to facebook - Please try again';
		$user = null;
}
