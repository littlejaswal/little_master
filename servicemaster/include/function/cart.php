<?php
function get_attribute_for_cart($item_id)
{
	#$object= get_object_by_col('cart_attribute', 'cart_instance_id', $item_id);
	$object= new query('cart_attribute');
	$object->Where="where cart_instance_id='".$item_id."'";
	$object->DisplayAll();
	$string='';
	if($object->GetNumRows()):
		while($v=$object->GetArrayFromRecord()):
			if($v['is_paid_attribute']):
				$string.='<strong>'.$v['attribute_name'].'</strong>:-'.$v['attribute_value_name'].'(&pound;'.$v['price'].')'.'<br/>';
			else:
				$string.='<strong>'.$v['attribute_name'].'</strong>:-'.$v['attribute_value_name'].'<br/>';
			endif;
		endwhile;
	endif;
	return $string;
}
function get_cart_breif()
{
	$cart_obj= new cart();$v=0;
	echo 'Items in cart:'.$cart_obj->get_cart_total_items().'<br/>';
	echo 'Subtotal:'.number_format($t=$cart_obj->get_cart_total(), 2).'<br/>';
	echo (CART_VAT)?'VAT:'.number_format($v=$cart_obj->get_cart_vat($t), 2).'<br/>':'';
	echo 'Shipping:'.number_format($s=$cart_obj->get_cart_shipping(), 2).'<br/>';
	echo 'Grand Total:'.number_format($t+$v+$s, 2);
}

function cart_stock($id)
{
	
	$query= new query('product');
	$query->Where="where id='$id' and is_active=1";
	$query->Field="stock";
	$ob=$query->DisplayOne();
	if($ob->stock>0):
		echo '<img src="'.DIR_WS_SITE_GRAPHIC_SUBPAGE_GRAPHIC.'sign_instock.jpg" align="absmiddle" vspace="5"/> <span class="Price">In Stock</span>';
	else:
		echo '<img src="'.DIR_WS_SITE_GRAPHIC_SUBPAGE_GRAPHIC.'sign_outof_stock.jpg" align="absmiddle"vspace="15" /> <span class="Price">Out of Stock</span>';
	endif;

}

function get_billing_var_if_set($var)
{
	global $billing_address;
	return isset($billing_address[$var])?$billing_address[$var]:'';
}

?>