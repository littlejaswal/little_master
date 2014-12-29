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

function get_billing_var_if_set($var)
{
	global $billing_address;
	return isset($billing_address[$var])?$billing_address[$var]:'';
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

function head()
{
	# include all the header related things here... like... common meta tags/javascript files etc.
		?>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<!--<meta name="keywords" content="engagement rings, loose diamonds, hatton garden, diamond rings, earrings, wedding rings, diamonds, diamond rings hatton garden"/>-->
		<meta name="author" content="Marcpierre Diamonds"/>
		<meta name="language" content="EN"/>
		<meta name="Classification" content="Marcpierre Diamonds"/>
		<meta name="copyright" content="www.marcpierrediamonds.co.uk"/>
		<meta name="robots" content="index, follow"/>
		<meta name="revisit-after" content="7 days"/>
		<meta name="document-classification" content="Marcpierre Diamonds"/>
		<meta name="document-type" content="Public"/>
		<meta name="document-rating" content="Safe for Kids"/>
		<meta name="document-distribution" content="Global"/>
		<meta name="robots" content="noodp" />
		<meta  name="GOOGLEBOT" content="NOODP" />
		<!--[if IE 6]>
			<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_SITE?>css/iecss.css" />
		<![endif]-->
		<!--[if lt IE 7.]>
			<script defer type="text/javascript" src="<?php echo DIR_WS_SITE?>javascript/pngfix.js"></script>
		<![endif]-->
		<script type="text/javascript" src="<?php echo DIR_WS_SITE?>js/boxOver.js"></script>
		<script type="text/javascript" src="<?php echo DIR_WS_SITE?>control/js/jquery-1.2.6.min.js"></script>
		<link href="<?=DIR_WS_SITE_CSS?>style.css" media="screen" rel="stylesheet" type="text/css">
		<?
		
		
		
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
?>