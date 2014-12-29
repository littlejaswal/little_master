<?
function include_functions($functions)
{
	foreach ($functions as $value):
		if(file_exists(DIR_FS_SITE.'include/function/'.$value.'.php')):
			include_once(DIR_FS_SITE.'include/function/'.$value.'.php');
		endif;
	endforeach;
}

function display_message($unset=0)
{
	$admin_user= new admin_session();
	if($admin_user->isset_pass_msg()):
		foreach ($admin_user->get_pass_msg() as $value):
			echo $value;
		endforeach;
	endif;
	($unset)?$admin_user->unset_pass_msg():'';
}

function get_var_if_set($array, $var)
{
	return isset($array[$var])?$array[$var]:'';
}

function get_var_set($array, $var, $var1)
{
	if(isset($array[$var])):
		return $array[$var];
	else:
		return $var1;
	endif;
}

function get_template($template_name, $array, $selected='')
{
	include_once(DIR_FS_SITE.'template/'.TEMPLATE.'/'.$template_name.'.php');
}

function get_meta($page){
	$page=trim($page);
	if($page!=''):
		$query = new query('keywords');
		$query->Where="where page_name='$page'";
		if($content=$query->DisplayOne()):
			return $content;
		else:
			return null;
		endif;
	endif;
	return null;
	
}


function head($content='')
{
	# include all the header related things here... like... common meta tags/javascript files etc.
		global $page;
		
		if(is_object($content)):
		?>
			<title><?php echo isset($content->name) && $content->name?$content->name:'';?></title>	
			<meta name="keywords" content="<?php echo isset($content->meta_keyword)?$content->meta_keyword:'';?>" />
			<meta name="description" content="<?php echo isset($content->meta_description)?$content->meta_description:'';?>" />
		<?php else: 
		$content=get_meta($page);
		?>
			<title><?php echo isset($content->page_title) && $content->page_title?$content->page_title:'';?></title>	
			<meta name="keywords" content="<?php echo isset($content->keyword)?$content->keyword:'';?>" />
			<meta name="description" content="<?php echo isset($content->description)?$content->description:'';?>" />
		<?php endif;?>
		<meta name="robots" content="index, follow" />
		<meta name="software" content="cWebFramework" />
		<meta name="websit developers" content="cWebConsultants.com in partnership with GotItIssues.com" />
		<link rel="shortcut icon" href="<?php echo DIR_WS_SITE_GRAPHIC?>favicon.ico" />
		<?php include_once(DIR_FS_SITE.'include/template/stats/google_analytics.php');?>
	<?
}

function css($array=array('reset','master')){
	echo '<link href="'.DIR_WS_SITE.'css/print.css" rel="stylesheet" type="text/css" media="print" >'."\n";
	echo '<link href="'.DIR_WS_SITE.'css/base.css" rel="stylesheet" type="text/css" media="screen" >'."\n";
	foreach ($array as $k=>$v):
        if($v=='style' && isset($_SESSION['use_stylesheet'])):
        	echo '<link href="'.DIR_WS_SITE.'css/'.$_SESSION['use_stylesheet'].'.css" rel="stylesheet" type="text/css" media="screen, projection" >'."\n";
        else:
			echo '<link href="'.DIR_WS_SITE.'css/'.$v.'.css" rel="stylesheet" type="text/css" media="screen, projection" >'."\n";
		endif;
	endforeach;
}

function js($array=array('jquery-1.2.6.min', 'rollover', 'bookmark')){
	foreach ($array as $k=>$v):
		echo '<script src="'.DIR_WS_SITE.'javascript/'.$v.'.js" type="text/javascript"></script> '."\n";
	endforeach;
}

function body()
{
	# include all the body related things like... tracking code here.
	
}

function footer()
{
	# if you need to add something to the website footer... please add here.
}

function array_map_recursive($callback, $array) {
  $b = Array();
  foreach ($array as $key => $value) {
    $b[$key] = is_array($value) ? array_map_recursive($callback, $value) : call_user_func($callback, $value);
  }
  return $b;
}

function if_set_in_post_then_display($var){
	if(isset($_POST[$var])):
		echo $_POST[$var];
	endif;
	echo '';	
}

function validate_captcha(){
	global  $privatekey;
	
	if ($_POST["recaptcha_response_field"]) 
	{
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);
        if ($resp->is_valid) {
               return  true;
        } else {
                # set the error code so that we can display it
               return false;
        }
	}
}

function is_set($array=array(), $item, $default=1)
{
	if(isset($array[$item]) && $array[$item]!=0){
		return $array[$item];
	}
	else{
		return $default;
	}
}

function limit_text($text, $limit=100)
{
	if(strlen($text)>$limit):
		return substr($text, 0, strpos($text, ' ', $limit));
	else:
		return $text;
	endif;
}

function get_object($tablename, $id, $type='object')
{
		$query= new query($tablename);
		$query->Where="where id='$id'";
		return $query->DisplayOne($type);
}

function get_object_by_col($tablename, $col, $col_value, $type='object')
{
		$query= new query($tablename);
		$query->Where="where $col='$col_value'";
		return $query->DisplayOne($type);
}

function get_object_var($tablename, $id, $var)
{
	$q= new query($tablename);
	$q->Field="$var";
	$q->Where="where id='".$id."'";
	if($obj=$q->DisplayOne()):
		return $obj->$var;
	else:
		return false;
	endif;
}

function echo_y_or_n($status)
{
	echo ($status)?'Yes':'No';
}

function target_dropdown($name, $selected='', $tabindex=1)
{
	$values=array('new window'=>'_blank', 'same window'=>'_parent');
	echo '<select name="'.$name.'" size="1" tabindex="'.$tabindex.'">';
	foreach ($values as $k=>$v):
		if($v==$selected):
			echo '<option value="'.$v.'" selected>'.ucfirst($k).'</option>';
		else:
			echo '<option value="'.$v.'">'.ucfirst($k).'</option>';
		endif;
	endforeach;
	echo '</select>';
}

function make_csv_from_array($array)
{
	$sr=1;
	$heading='';
	$file='';
	foreach ($array as $k=>$v):
		foreach ($v as $key=>$value):
			if($sr==1):$heading.=$key.', ';endif;
			$file.=str_replace("\r\n", "<<>>", str_replace(",", ".", html_entity_decode($value))).', ';
		endforeach;
		$file=substr($file, 0, strlen($file)-2);
		$file.="\n";
		$sr++;
	endforeach;
	return $file=$heading."\n".$file;
}


function get_y_n_drop_down($name, $selected)
{
	echo '<select name="'.$name.'" size="1">';
	if($selected):
		echo '<option value="1" selected>Yes</option>';
		echo '<option value="0">No</option>';
	else:
		echo '<option value="0" selected>No</option>';
		echo '<option value="1">Yes</option>';
	endif;
	echo '</select>';
}

function get_setting_control($key, $type, $value)
{
	switch ($type)
	{
	case 'text':
			echo '<input type="text" name="key['.$key.']" value="'.$value.'" size="30">';
			break;
	case 'select':
			echo get_y_n_drop_down('key['.$key.']', $value);
			break;
	default: echo get_y_n_drop_down('key['.$key.']', $value);
	}
}

function css_active($page, $value, $class)
{
	if($page==$value)
		echo 'class='.$class;
}

function parse_into_array($string)
{
	return explode(',', $string);
}

function get_section_heading($Page)
{
	switch($Page){
		case 'product':
		case 'category':
		case 'product_search':
				return 'Product Manager';
				break;
		case 'gallery':
		case 'gallery_image':
				return 'Image Manager';
				break;
		case 'user':
		case 'search_user':
				return 'User Manager';
				break;
		case 'testimonial':
				return 'Testimonial Manager';
				break;
		case 'news':
				return 'News Manager';
				break;
		case 'discount':
				return 'Discounts Manager';
				break;
		case 'setting':
				return 'Website Settings';
				break;
		case 'content':
		case 'content_collection':
		case 'content_navigation':
		case 'content_photo':
				return 'Content Manager';
				break;
		case 'order':
		case 'order_d':
		case 'a_order':
		case 'archive':
		case 'search_order':
				return 'Order Manager';
				break;
		case 'new_letter':
		case 'letters':
		case 'send_to':
				return 'Newsletter Manager';
				break;
		case 'event':
				return 'Events Manager';
				break;
		case 'videos':
				return 'Videos Manager';
				break;
		case 'faq':
				return 'FAQ Manager';
				break;
		case 'articles':
				return 'Article Manager';
				break;
		case 'blog':
				return 'Blog Manager';
				break;
		case 'success_stories':
				return 'Success Story Manager';
				break;
		case 'keywords_management':
				return 'Keywords Management';
				break;
		case 'meet_the_team':
				return 'Meet The Team';
				break;
		case 'services':
				return 'Footer Service Links Manager';
				break;
		case 'cities':
				return 'Footer City Links Manager';
				break;
		case 'glossary':
				return 'Glossary Manager';
				break;	
		case 'admin':
				return 'Admin Manager';
				break;
		case 'zones':
		case 'ship':
		case 'zone_country':
		case 'country':
				return 'Delivery Manager';
				break;
		case 'home':
				return 'Dashboard';
				break;
		case 'upload_logo':
				return 'Company Links Manager';
				break;
		default:
				return $Page;
			
	}
}

function MakeDataArray($post, $not)
	{
		$data=array();
		foreach ($post as $key=>$value):
			if(!in_array($key, $not)):
				$data[$key]=$value;
			endif;
		endforeach;
		return $data;
	}

function is_var_set_in_post($var, $check_value=false)
{
	if(isset($_POST[$var])):
		if($check_value):
			if($_POST[$var]===$check_value):
				return true;
			else:
				return false;
			endif;
		endif;
		return true;
	else:
		return false;
	endif;
}

function display_form_error()
	{
		$login_session =new user_session();
		if($login_session->isset_pass_msg()):
			$array=$login_session->get_pass_msg();
			?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="error_message">
			<tr>
				<td width="9px">&nbsp;</td>
				<td align="right" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#FF0000;">
						<tr>
							<td align="center" valign="top" style="color:#000000;">
								
								<? foreach ($array as $value):
								?><table><tr><td style="color:#FFFFFF;">
									 <? echo $value; ?>
									 </td></tr></table>
								 <? endforeach;?>
								 
							</td>
						</tr>
				  </table>
			  </td>
		 	 <td width="9px">&nbsp;</td>
		</tr>
		</table>
		<?
		elseif(isset($_GET['msg']) && $_GET['msg']!=''):?>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="5" id="error_message">
			<tr>
				<td width="9px">&nbsp;</td>
				<td align="right" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#FF0000;">
						<tr>
							<td align="center" valign="top" style="color:#FFFFFF;">
									 <? echo $_GET['msg']; ?>
							</td>
						</tr>
				  </table>
			  </td>
		 	 <td width="9px">&nbsp;</td>
		</tr>
		</table>			
		<?php 
		endif;
		$login_session->isset_pass_msg()?$login_session->unset_pass_msg():'';
	}

	function Redirect($URL)
	{
		header("location:$URL");
		exit;
	}
	
	function Redirect1($filename)
	{
    	if (!headers_sent())
       		 header('Location: '.$filename);
   	else {
		        echo '<script type="text/javascript">';
		        echo 'window.location.href="'.$filename.'";';
		        echo '</script>';
		        echo '<noscript>';
		        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
		        echo '</noscript>';
    	}
	}

	
	function re_direct($URL)
	{
		header("location:$URL");
		exit;
	}
	function make_url($page, $query=null)
	{
		return DIR_WS_SITE.'?page='.$page.'&'.$query;
	}
	
	function display_url($title, $page, $query='', $class='')
	{
		return '<a href="'.make_url($page, $query).'" class="'.$class.'">'.$title.'</a>';
	}
	
	function make_admin_url($page, $action='list', $section='list', $query='')
	{
		return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action='.$action.'&section='.$section.'&'.$query;
		
	}
	
	function make_admin_url2($page, $action='list', $section='list', $query='')
	{
		if($page=='home'):
			return DIR_WS_SITE.'index.php';
		else:
			return DIR_WS_SITE_CONTROL.'control.php?Page='.$page.'&action2='.$action.'&section2='.$section.'&'.$query;
		endif;
	}
	
	function prepare_query($queryString)
{
	#print_r($_GET);exit;
	$string='';
	parse_str($queryString, $string);
	switch ($string['page']):
		case 'content':
			$query= new query('content');
			$name=$string['id'];
			$query->Where="where name='$name'";
			$object=$query->DisplayOne();
			$_GET['id']=$object->id;
			$_REQUEST['id']=$object->id;
			break;
		case 'category':
				$category_name=strtolower(str_replace('-', " ", $string['id']));
				$id=get_category_id_by_name($category_name);
				$_GET['id']=$id; $_REQUEST['id']=$id;
				isset($string['p'])?$_GET['p']=$string['p']:'';
				$_GET['page']='product'; $_REQUEST['page']='product';
				break;
		case 'pdetail':
				$category_name=strtolower(str_replace('-', " ", $string['id']));
				if($id=get_product_id_by_url_name($category_name)):
					$_GET['id']=$id; $_REQUEST['id']=$id;
					$_GET['page']='pdetail'; $_REQUEST['page']='pdetail';
				elseif($id=get_product_id_by_product_name($category_name)):
					$_GET['id']=$id; $_REQUEST['id']=$id;
					$_GET['page']='pdetail'; $_REQUEST['page']='pdetail';
				endif;
				break;
		case 'wish_list':
				$_GET['page']='wish_list'; $_REQUEST['page']='wish_list';
				isset($string['id'])?$_GET['id']=$string['id']:''; 
				isset($string['id'])?$_REQUEST['id']=$string['id']:''; 
				isset($string['delete'])?$_GET['delete']=1:'';
				isset($string['add_wishlist'])?$_GET['add_wishlist']=1:'';
				break;
		case 'search':
				$_GET['page']='search'; $_REQUEST['page']='search';
				isset($string['category'])?$_GET['category']=$string['category']:''; 
				isset($string['keyword'])?$_GET['keyword']=$string['keyword']:''; 
				isset($string['p'])?$_GET['p']=$string['p']:''; 
				break;
		case 'payment':
				isset($string['id'])?$_GET['id']=$string['id']:'';
				break;
		case 'home':
				isset($string['download'])?$_GET['download']=$string['download']:'';
				break;
		default: 
				isset($string['id'])?$_GET['id']=$string['id']:'';
				isset($string['msg'])?$_GET['msg']=str_replace('-', ' ', $string['msg']):'';
				!isset($_GET['page'])?$_GET['page']='home':'';		
				break;
	endswitch;
}

function make_admin_link($url, $text, $title='', $class='', $alt='')
{
	return  '<a href="'.$url.'" class="'.$class.'" title="'.$title.'" alt="'.$alt.'" >'.$text.'</a>';
}
?>