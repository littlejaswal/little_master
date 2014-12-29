<?
function get_template_box($name)
{
	$login_session= new user_session();
	include(DIR_FS_SITE.'template/'.$name.'_box.php');
}

function get_news_box($count=2)
{
	!is_numeric($count)?$count=2:'';	
	$query= new query('news');
	$query->Where="where is_active=1 limit 0,$count";
	$query->DisplayAll();
	include(DIR_FS_SITE.'template/news_box.php');
}

function get_cart_detail_box()
{
	$cart_obj= new cart();$v=0;
	$total_items=$cart_obj->get_cart_total_items();
	$subtotal=number_format($t=$cart_obj->get_cart_total(), 2);
	$vat= (CART_VAT)?'VAT:'.number_format($v=$cart_obj->get_cart_vat($t), 2):0;
	$shipping=number_format($s=$cart_obj->get_cart_shipping(), 2);
	$grand_total=number_format($t+$v+$s, 2);
	include(DIR_FS_SITE.'template/cart_detail_box.php');
}
?>