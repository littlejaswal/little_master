<?php
// Content Post App
// Name: cWebConsultants CMS - Facebook API 
require_once '../../include/config/config.php';
$function=array('image_manipulation');
include_functions($function);

require_once 'inc/facebook-db.php';

/* Create our Application instance. */
$facebook = new Facebook(
/* facebook app details */
array(
  'appId' => '307658399342544',
  'secret' => 'dccb03491c7295a2a8812de55c6868d0',
  'cookie' => true, 
));

$pageId='MarbleMountain';

try { 
	// Proceed knowing you have a logged in user who's authenticated.
		$pageFeed = $facebook->api($pageId . '/feed');

print_r($pageFeed); exit;	

	foreach($pageFeed['data'] as $data):
			$facebook=get_object_from_table('facebook',"facebook_id='".$data['id']."'");
		
			if($facebook):
				$query= new query('facebook');
				$query->Data['id']=$facebook->id;
				$query->Data['facebook_id']=$data['id'];
				$query->Data['on_date']=date("Y-m-d",strtotime($data['created_time']));
				$query->Data['facebook_text']=$data['message'];
				$query->Data['facebook_link']="https://facebook.com/".$pageId;
				$query->Data['facebook_user_name']=$data['from']['name'];
				$query->Data['facebook_user_img']="https://graph.facebook.com/".$data['from']['id']."/picture";
				$query->Update();
			else:
				$query= new query('facebook');
				$query->Data['facebook_id']=$data['id'];
				$query->Data['on_date']=date("Y-m-d",strtotime($data['created_time']));
				$query->Data['facebook_text']=$data['message'];
				$query->Data['facebook_link']="https://facebook.com/".$pageId;
				$query->Data['facebook_user_name']=$data['from']['name'];
				$query->Data['facebook_user_img']="https://graph.facebook.com/".$data['from']['id']."/picture";
				$query->Insert();
			endif;	
			
		endforeach;	
} 
catch (FacebookApiException $e) {
		error_log($e);
		echo 'Sorry! Error occurd while posting to facebook - Please try again';
		$user = null;
}
?>