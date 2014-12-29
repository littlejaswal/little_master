<?php
/*
* File used to post content directly to Twitter
* Integreated with cWebConsultants CMS
*
*/
require_once('config.php');
require_once('twitteroauth/twitteroauth.php');

/*
if(isset($_POST['post'])){
	$twitter_post=$_POST['msg'];
}else{
	header("location:".SITE_NAME);
	exit;
}
*/

/* get varialbe names from GET */
if(isset($_GET) && $_GET['msg']){
	foreach($_GET as $k=>$v){
		$$k=$v;
	}
}



/* statuses/update */
//date_default_timezone_set('GMT');

if(isset($_POST['post'])){
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
	//$content = $connection->get('account/rate_limit_status');
	//echo "Current API hits remaining: {$content->remaining_hits}.<br/><br/>";


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
}
?>
<html>
<head>
	<title>Post to Twitter - <?php echo $mod;?></title>
</head>
<body>
    <div class="onecolumn" style="margin:0px;">
        <div class="header" style="font-size: 16px;text-align: center;padding-top:10px;"><strong>Twitter Status Update</strong></div>
              <form id="form_data" name="form_data" action="<?=DIR_WS_SITE?>control/twitter/post.php" method="post">
                <div class="content">
                    <table width="100%" cellspacing="0" cellpadding="0" class="data"> 
                        <tbody>
                            <tr>
								<th align="center">Your Message shall be posted on your twitter account</th><tr/>
                            <tr>
                                <td align="center">
										<textarea  name="msg"  tabindex="2" cols="50" rows="3"><?php echo trim(strip_tags(html_entity_decode($msg)));?></textarea>
                                </td>
                            </tr>
							<input type="hidden" name="module" value="<?php echo $mod?>" />
							<tr>
                                <td colspan="2" align="center"><input type="submit" name="post" value="POST"/></td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
           </form>
  </div>
</body>
</html>