<?php
// Content Post App
// Name: cWebConsultants CMS - Facebook API 
require_once '../../include/config/config.php';
$function=array('image_manipulation');
include_functions($function);

if(isset($_POST['post']))
{
	require_once 'inc/facebook-db.php';

	/* Create our Application instance. */
	$facebook = new Facebook(
	/* facebook app details */
	array(
	  'appId' => FACEBOOK_APP_CODE,
	  'secret' => FACEBOOK_APP_SECRET,
	  'cookie' => true,
	));

	//make message to be posted on facebook from session. We assume that we had saved the post from webpage into session.
	function makeMessage(){
		$arr=array('message', 'picture', 'caption', 'link');
		$array=array();
		if(count($_POST)>2){
			foreach($_POST as $k=>$v){
				if(in_array($k, $arr)){
					$array[$k]=$v;
				}
			}
		}
		return $array;
	}

	/* make redirct URL */
	function getRedirectURL(){
		if(isset($_POST['redirect_url'])){
			return $_POST['redirect_url'];
		}
		else{
			return false;
		}
	}

	try {
	 // Proceed knowing you have a logged in user who's authenticated.
		$status = $facebook->api('/me/feed', 'POST', makeMessage());
		if(isset($status['id']))
			{
				header("location:".getRedirectURL()."&error=Posted Successfully");
				exit;
			}
		else{
				header("location:".getRedirectURL()."&error=Error occured. Please try again after sometime.");
				exit;
			}
	  } 
	  catch (FacebookApiException $e) 
	  {
		error_log($e);
		echo 'Sorry! Error occurd while posting to facebook - Please try again';
		$user = null;
	  }
	}
	
/* extract variables */
isset($_GET['mod'])?$module=$_GET['mod']:$module=false;
isset($_GET['id'])?$item_id=$_GET['id']:$item_id=false;

/* if any of them is not set - then redirect back to module home */
if(!$item_id or !$module){
	redirect(make_admin_url($module));
} 

/* map modules to tables */
$array=array(
	'content'=>'content',
	'event'=>'event',
	'news'=>'news',
	'partners'=>'supplier',
	'tender'=>'tender',
	'tickets'=>'tickets',
	'jobposting'=>'jobposting',
	'directory'=>'directory',
	'team'=>'team',
	'accommodations'=>'accommodations',
	'gallery_image'=>'gimage'
);

/* fetch object from DB */
$item=get_object($array[$module], $item_id);

/* content module */
if($module=='content'){
    $caption=$item->page_name;
    $message=$item->page;
    $link=$module;
    $link_query='id='.$item_id;
    $image='';
}
/* event module */
if($module=='event'){
    $caption=$item->name;
    $message=$item->short_description;
    $link='event';
     $link_query='id='.$item_id;
    $image=$item->image;
    $folder='gallery';
}
/* news module */
if($module=='news'){
    $caption=$item->name;
    $message=$item->long_description;
    $link='news-detail';
    $link_query='id='.$item_id;
    $image=$item->image;
    $folder='gallery';
    
}
/* gallery module */
if($module=='gallery_image'){
    $caption=$item->caption;
    $message=$item->link_url;
    $link='gallery';
    $link_query='';
    $image=$item->image;
    $folder='gallery';
}

/*job posting module */
if($module=='jobposting'){
    $caption=$item->job_title;
    $message=$item->job_description;
    $link_query='id='.$item_id;
    $image='';
}
/* team module */
if($module=='team'){
    $caption=$item->team_name;
    $message=$item->team_detail."<br/>Email Id :".$item->team_email;
    $link='home';
    $link_query='id='.$item_id;
    $image=$item->team_logo;
    $folder='team';
}
/* tender module */
if($module=='directory'){
    $caption=$item->name;
    $message=$item->long_description;
    $link='directory';
    $link_query='id='.$item_id;
    $image=$item->image;
    $folder='gallery';
    
}
/* tickets module */
if($module=='tickets'){
    $caption=$item->name;
    $message=$item->description;
    $link='cart';
    $link_query='';
    $image='';
}

/*Snow report module */
if($module=='report'){
    $caption=$item->snow;
    $message=$item->surface;
    $link='home';
    $link_query='';
    $image='';
}


/* accommodations Module */
if($module=='accommodations'){
    $caption=$item->name;
    $message=$item->amenities;
    $link='accommodations';
    $link_query='';
    $image=$item->photo;
    $folder='house';
}

?>
<html>
<head>
<title>Post to Facebook - <?php echo $module;?></title>
</head>
<body>
    
      <div style="width:500px" class="box threethirds">
		<div class="boxheading clearfix"><h3>Post To Facebook - <?php echo ucwords($module);?></h3><a class="move"></a></div>
		<section>
                    <form id="form_data" name="form_data" action="<?=DIR_WS_SITE?>control/facebook/post.php" method="post" >
                         <div class="row">
                                <label>Caption:</label>
                                <input type="text" name="caption" value="<?php echo $caption?>"/>    

                        </div>
                        <div class="row">
                                <label>Message:</label>
                                <textarea class="editor"name="message"><?php echo trim(strip_tags(html_entity_decode($message)));?></textarea>
                                	
                        </div>
                        <div class="row">
                                <label>Link:</label>
                               <input type="text" name="link" value="<?php echo make_url($link,$link_query);?>"/>

                        </div>
                        <div class="row">
                                <label>Image:</label>
                                 <?php if($image):?>    
                                   <img src="<?php echo get_large($folder,$image);?>" height="100"/><br class="clear" />
                                   <input type="hidden" name="picture" value="<?php echo get_large($folder,$image);?>"/>
                                <?endif;?>
                        </div>
                        <input type="hidden" value="<?php echo DIR_WS_SITE?>" name="redirect_url" />
                        <div  class="row">
                            <input class="btn green submit mt15" type="submit" name="post" value="POST"/>
                           <div class="clear"></div>
                        </div>   
                 </form>
              </section>
     </div>                  
     
    
</body>
</html>

