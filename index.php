<?php
        /*include basic config file*/
	include_once("include/config/config.php");

        /*website statistics.*/
	if(!isset($_SESSION['visitor'])):
		$_SESSION['visitor']=1;
		$qu=new query('web_stat');
		$qu->Data['ip_address']=$_SERVER['REMOTE_ADDR'];
		$qu->Insert();
	endif;

    /*include basic functions*/
    $include_fucntions=array('date','email','file_handling','http','image_manipulation','paging','news','testimonials','recaptchalib','content','footer','gallery','cart','login','order', 'category', 'navigation','calender','database');
	include_functions($include_fucntions);
	
	/*FOR URL REWRITE */
	load_url();
	
      if(count($_GET)):
		prepare_query($_SERVER['QUERY_STRING']);
	endif;
        
		

        /* website statistic recorded.*/
	$page = isset($_REQUEST['page']) ? $_REQUEST['page']:"home";	
	if(file_exists(DIR_FS_SITE_PHP."$page.php"))
		require_once(DIR_FS_SITE_PHP."$page.php");
			
	if(file_exists(DIR_FS_SITE_HTML."$page.php"))
		require_once(DIR_FS_SITE_HTML."$page.php");
	else 
		require_once(DIR_FS_SITE_HTML."404.php");

?>