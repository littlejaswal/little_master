<?
include('url_rewrite.php');
function include_functions($functions)
{
	foreach ($functions as $value):
		if(file_exists(DIR_FS_SITE.'include/function/'.$value.'.php')):
			include_once(DIR_FS_SITE.'include/function/'.$value.'.php');
		endif;
	endforeach;
}
/*
function display_message($unset=0)
{
	$admin_user= new admin_session();
	if($admin_user->isset_pass_msg()):
		foreach ($admin_user->get_pass_msg() as $value):
                    echo '<div class="alert_warning"><p>';
                    echo '<img class="mid_align" alt="success" src="images/icon_accept.png">';
                    echo $value;
                    echo '</p></div>';
                endforeach;
	endif;

	($unset)?$admin_user->unset_pass_msg():'';
}*/


function display_message($unset=0)
{
	$admin_user= new admin_session();
	if($admin_user->isset_pass_msg()):
		foreach ($admin_user->get_pass_msg() as $value):
                    echo '<div style="width:35%;margin-left:10px;" class="notification green">';
                    echo '<p><img src="images/icons/success.png" alt="success" />';
                    echo $value;
                    echo '</p><a class="close hider"></a></div>';
                endforeach;
	endif;
      ($unset)?$admin_user->unset_pass_msg():'';
}
function get_var_if_set($array, $var, $preset='')
{
	return isset($array[$var])?$array[$var]:$preset;
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
	/*include all the header related things here... like... common meta tags/javascript files etc.*/
		global $page;
                global $content;
		
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
		
		<link rel="shortcut icon" href="<?php echo DIR_WS_SITE_GRAPHIC?>favicon.ico" />
		<?/*php include_once(DIR_FS_SITE.'include/template/stats/google_analytics.php');*/?>
	<?
}

function css1($array=array('reset','master')){
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
function css($array=array('reset','master')){
	
	echo '<link href="'.DIR_WS_SITE.'css/base.css" rel="stylesheet" type="text/css" media="screen" >'."\n";
    echo '<link href="'.DIR_WS_SITE.'css/menu/superfish.css" rel="stylesheet" type="text/css" media="screen" >'."\n";
	foreach ($array as $k=>$v):
        if($v=='style' && isset($_SESSION['use_stylesheet'])):
        	echo '<link href="'.DIR_WS_SITE.'css/'.$_SESSION['use_stylesheet'].'.css" rel="stylesheet" type="text/css" media="screen, projection" >'."\n";
        else:
			echo '<link href="'.DIR_WS_SITE.'css/'.$v.'.css" rel="stylesheet" type="text/css" media="screen, projection" >'."\n";
		endif;
	endforeach;
}

function js($array=array('jquery-1.2.6.min','search-reset')){
 
	foreach ($array as $k=>$v):
		echo '<script src="'.DIR_WS_SITE.'javascript/'.$v.'.js" type="text/javascript"></script> '."\n";
	endforeach;
 
}

function body()
{
	/*# include all the body related things like... tracking code here.*/
	
}

function footer()
{
	/*# if you need to add something to the website footer... please add here.*/
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
               /* # set the error code so that we can display it*/
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
	echo '<select class="regular" name="'.$name.'">';
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
			echo '<input type="text" name="key['.$key.']" value="'.$value.'">';
			break;
        case 'textarea':
			echo '<textarea class="resize" name="key['.$key.']" rows="8" cols="35" tabindex="6">'.$value.'</textarea>';
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
		case 'cat_product':
		case 'product_search':
		case 'product_map':
		case 'product_collection':
		case 'mailing_addresses':
				return 'Mailing Address Manager';
				break;
		case 'product_check':
				return 'Product Manager';
				break;
		case 'review':
				return 'Review Manager';
				break;
		case 'gallery':
                                return 'Gallery Manager';
				break;
		case 'gallery_image':
				return 'Image Manager';
				break;
        case 'meet_the_team':
				return 'Staff Manager';
				break;            
                case 'project':
                                return 'Project Manager';
				break;
		case 'project_image':
				return 'Project Image Manager';
				break;           
		case 'user':
		case 'search_user':
		case 'udetail':
				return 'User Manager';
				break;
		case 'jobposting':
				return 'Job Postings Manager';
				break;
		case 'news':
				return 'News Manager';
				break;
                 case 'link_heading':
				return 'Links Heading Manager';
				break;             
                case 'links':
				return 'Links Manager';
				break;   
				case 'funerals':
				return 'Services';
				break;
				case 'testimonial':
				return 'Testimonials';
				break;
				case 'tributes':
				return 'Tributes';
				break;
				
                 case 'department':
				return 'Department Manager';
				break;   
                  case 'business_category':
				return 'Business Directory Manager';
				break;               
                 case 'directory':
				return 'Business Directory Manager';
				break;           
                case 'quick_pos':
				return 'Home Manager';
				break;
                		break;
                case 'quick_pos_image':
				return 'Manage Home Images';
				break;            
		case 'discount':
				return 'Discounts Manager';
				break;
		case 'setting':
				return 'Website Settings';
				break;
		case 'content':return 'Page Manager';
				break;
		case 'content_collection':
		case 'content_navigation':return 'Navigation Manager';
				break;
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
		case 'all_attribute':
				return 'Attribute Manager';
				break;
		case 'email':
				return 'Email Manager';
				break;
		case 'new_letter':
		case 'letters':
		case 'send_to':
				return 'Newsletter Manager';
				break;
		case 'event':
				return 'Event Manager';
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
                            
                case 'banner':
				return 'Slider Manager';
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
                            <div class="errorMsg">
                                   <?php
                                       foreach ($array as $value):
                                            echo $value.'<br/>';
                                       endforeach;
                                   ?>
                            </div>
		<?php
		elseif(isset($_GET['msg']) && $_GET['msg']!=''):?>
			<div class="errorMsg">
				<?php echo urldecode($_GET['msg']).'<br/>';?>
                        </div>
		<?php endif;
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
	/*function make_url($page, $query=null)
	{
		return DIR_WS_SITE.'?page='.$page.'&'.$query;
	}*/
	
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

function quit($message='processing stopped here'){
    echo $message;
    exit;
}

function download_orders($payment_status,$order_status)
{
	$orders= new query('orders');
	$orders->Field="id,user_id,sub_total,vat,shipping,voucher_code,voucher_amount,shipping_firstname,shipping_lastname,shipping_address1,shipping_address2,shipping_city,shipping_state,shipping_zip,shipping_country,shipping_phone,shipping_fax,billing_firstname,billing_lastname,billing_email,billing_address1,billing_address2,billing_city,billing_state,billing_zip,billing_country,billing_phone,billing_fax,grand_total,order_type,order_status,order_date,ip_address,order_comment,shipping_comment,cart_id";
	if($order_status=='paid'):
		$orders->Where="where payment_status=".$payment_status." and order_status!='delivered'";
	elseif($order_status=='attempted'):
		$orders->Where="where payment_status=".$payment_status." and order_status='received'";
	else:
		$orders->Where="where payment_status=".$payment_status." and order_status='delivered'";
	endif;
	$orders->DisplayAll();
	
	$orders_arr= array();
	if($orders->GetNumRows()):
		while($order= $orders->GetArrayFromRecord()):
			$order['Username']=get_username_by_orders($order['user_id']);
			array_push($orders_arr, $order);
		endwhile;
	endif;
	$file=make_csv_from_array($orders_arr);
	$filename="orders".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}


function download_orders_by_criteria($from_date, $to_date, $payment_status, $order_status)
{
	$orders= new query('orders');
	$orders->Field="id,user_id,sub_total,vat,shipping,voucher_code,voucher_amount,shipping_firstname,shipping_lastname,shipping_address1,shipping_address2,shipping_city,shipping_state,shipping_zip,shipping_country,shipping_phone,shipping_fax,billing_firstname,billing_lastname,billing_email,billing_address1,billing_address2,billing_city,billing_state,billing_zip,billing_country,billing_phone,billing_fax,grand_total,order_type,order_status,order_date,ip_address,order_comment,shipping_comment,cart_id";
	$orders->Where="where order_status='$order_status' AND payment_status='$payment_status' AND (order_date BETWEEN CAST('$from_date' as DATETIME) AND CAST('$to_date' as DATETIME)) order by order_date";
	$orders->DisplayAll();
	
	$orders_arr= array();
	if($orders->GetNumRows()):
		while($order= $orders->GetArrayFromRecord()):
			$order['Username']=get_username_by_orders($order['user_id']);
			array_push($orders_arr, $order);
		endwhile;
	endif;
	$file=make_csv_from_array($orders_arr);
	$filename="orders".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}


function get_username_by_orders($id)
{	if($id==0):
		return 'Guest';
	elseif($id):
		$q= new query('user');
		$q->Field="firstname,lastname";
		$q->Where="where id='".$id."'";
		$o=$q->DisplayOne();
		return $o->firstname;
	endif;
}

function get_zones_box($selected=0)
{
	$q= new query('zone');
	$q->DisplayAll();
	echo '<select name="zone" size="1">';
	while($obj=$q->GetObjectFromRecord()):
		if($selected=$obj->id):
			echo '<option value="'.$obj->id.'" selected>'.$obj->name.'</option>';
		else:
			echo '<option value="'.$obj->id.'">'.$obj->name.'</option>';
		endif;
	endwhile;
	echo '</select>';
}
function zone_drop_down($zone_id,$id,$s,$z)
{
	$query=new query('zone_country');
	$query->Where="where zone_id=$zone_id";
	$query->DisplayAll();
	$country_list=array();
	$country_name='';	
	while($object=$query->GetObjectFromRecord()):
		$country_name=get_country_name_by_id($object->country_id);
		$idd=$object->country_id;
		/*$country_list('id'=>$object->id, 'name'=>$country_name));*/
		array_push($country_list, array('name'=>$country_name,'id'=>$object->id));
		/*$country_list[$object->id]=$country_name;*/
	endwhile;
	$total_list=array();
	foreach ($country_list as $k=>$v):
		$total_list[]=$v['name'];
    endforeach;
	array_multisort($total_list, SORT_ASC, $country_list);
	
	echo '<select name="'.$id.'" size="10" style="width:200px;" multiple>';
	foreach ($country_list as $k=>$v):
		if(($z == $zone_id) && $s):
			echo '<option value="'.$v['id'].'" selected="selected">'.ucfirst($v['name']).'</option>';
		else:
			echo '<option value="'.$v['id'].'">'.ucfirst($v['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

function get_page_head_description($page='home'){
	$defoult_text_for_home="Whether you live in the province, have visited Newfoundland, or are a homesick Newfie looking for some much-needed reminders of The Rock, Island Treasures is your one source for everything Newfoundland and Labrador.";
	$defoult_text="Mauris hendrerit ligula ut sapien varius in adipiscing nisl cursus. Nullam varius lacinia hendrerit. Ut eleifend porttitor porta. In et justo justo, eget dignissim lorem. Etiam eleifend enim eu purus fermentum a vulputate diam dapibus.";
    switch($page){
        case 'product':
                global $category;
				if(isset($_GET['id'])):
                	echo html_entity_decode(limit_text($category->description, 303));
                else:
					echo html_entity_decode($defoult_text);
				endif;
				break;
        case 'content':
                global $object;
                echo html_entity_decode(limit_text($object->top_content, 303));
                break;
		case 'home':
                global $object;
                echo html_entity_decode($defoult_text_for_home);
                break;
        case 'pdetail':
                global $object;
                echo html_entity_decode(limit_text($object->top_description, 303));
                break;
        default:
                echo html_entity_decode($defoult_text);
    }
}

/*Function to add meta tags to content pages*/
 function add_metatags($title="", $keyword="", $description="")
{
/* description rule */
$description_length=150; /* characters */
if(strlen($description)>$description_length)
$description=substr($description, 0, $description_length);

/* title rule */
$title_length=100;
if(strlen($title)>$title_length)
$title= SITE_NAME.' > '.substr($title, 0, $title_length);
else
$title =SITE_NAME.' > '.$title;

$content->name=ucwords($title);
$content->meta_keyword=$keyword;
$content->meta_description=ucfirst($description);

return $content;
}

/* sanitize funtion*/
function sanitize($value){
	$prohibited_chars=array(" ", "/", "$", "&", "'", '%', '"', "@");
	foreach($prohibited_chars  as $k=>$v):
		$value=str_replace($v, '-', $value);
	endforeach;
	return strtolower($value);
}

function time_hour($values,$selected='')
{
	for($v=1; $v<=$values; $v++)
	{
		if($v<10):
			if($v==$selected):
				echo '<option value="0'.$v.'" selected>0'.$v.'</option>';
			else:
				echo '<option value="0'.$v.'">0'.$v.'</option>';
			endif;
		elseif($v==13):
			if($v==$selected):
				echo '<option value="00" selected>00</option>';
			else:
				echo '<option value="00">00</option>';
			endif;
		else:
			if($v==$selected):
				echo '<option value="'.$v.'" selected>'.$v.'</option>';
			else:
				echo '<option value="'.$v.'">'.$v.'</option>';
			endif;
		endif;
	}
	echo '</select>';
}

function time_minutes($values,$selected='')
{
	for($v=1; $v<=$values; $v++)
	{
		if($v<10):
			if($v==$selected):
				echo '<option value="0'.$v.'" selected>0'.$v.'</option>';
			else:
				echo '<option value="0'.$v.'">0'.$v.'</option>';
			endif;
		elseif($v==60):
			if($v==$selected):
				echo '<option value="00" selected>00</option>';
			else:
				echo '<option value="00">00</option>';
			endif;
		else:
			if($v==$selected):
				echo '<option value="'.$v.'" selected>'.$v.'</option>';
			else:
				echo '<option value="'.$v.'">'.$v.'</option>';
			endif;
		
		endif;
	}
	echo '</select>';
}
function tribute_count($funeral_id)
{
	$query= new query('tributes');
	$query->Where="where funeral_id=".$funeral_id;
	$query->DisplayAll();
	
	echo $count=$query->GetNumRows();
	
}

?>