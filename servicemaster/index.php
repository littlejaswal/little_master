<?php
#fix canonical URL problem	

include_once("include/config/config.php");
	# website statistics.
	if(!isset($_SESSION['visitor'])):
		$_SESSION['visitor']=1;
		$qu=new query('web_stat');
		$qu->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
		$qu->Insert();
	endif;
	
	$include_fucntions=array(
		'video', 
		'date', 
		'email', 
		'file_handling', 
		'http', 
		'image_manipulation', 
		'paging', 
		'news', 
		'testimonials', 
		'recaptchalib', 
		'content',
		'footer',
		'gallery',
		'testimonials'
		);
	include_functions($include_fucntions);
	
	# website statistic recorded.	
	$page = isset($_REQUEST['page'])?$_REQUEST['page']:"home";
	#$page = (!isset($_REQUEST['page']))?"home":$_REQUEST['page'];
	if(file_exists(DIR_FS_SITE_PHP."$page.php"))
		require_once(DIR_FS_SITE_PHP."$page.php");
			
	if(file_exists(DIR_FS_SITE_HTML."$page.php"))
		require_once(DIR_FS_SITE_HTML."$page.php");
	else 
		require_once(DIR_FS_SITE_HTML."404.php");
			
?>