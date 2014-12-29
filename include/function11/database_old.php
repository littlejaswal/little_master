<?
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
function get_product_parent_id($id)
{
	$object= get_object('product', $id);
	return $object->parent_id;
}
function get_total_sub_categories($id, $tablename='category')
{
	#get total sub-categories.
		$QueryObj =new query($tablename);
		$QueryObj->Where="where parent_id='".$id."'";
		return $QueryObj->count();
}
function get_total_products($id)
{
	#get total products
		$QueryObj =new query('product');
		$QueryObj->Where="where parent_id='".$id."'";
		return $QueryObj->count();
}
function category_chain_front($id, $is_product=0)
{
	$chain=array();
	$idd=$id;
	while($id!=0):
		$QueryObj =new query('category');
		$QueryObj->Where="where id='".$id."'";
		$cat=$QueryObj->DisplayOne();
		if($cat->id==$idd):
			if($is_product):
				$chain[]=display_url($cat->name,'product', 'id='.$cat->id.'&category=1', '');
			else:
				$chain[]=$cat->name;
			endif;
		else:
			$chain[]=display_url($cat->name,'product', 'id='.$cat->id.'&category=1', '');
		endif;
		$id=$cat->parent_id;
	endwhile;
	$cat_chain='';
	for($i=count($chain)-1; $i>=0;$i--):
		$cat_chain.=$chain[$i].' | ';
	endfor;
	$str = substr($cat_chain, 0, strlen($cat_chain)-2); 
	return $str;
}
function get_plural($noun)
{
	switch ($noun)
	{
		case 'category': return 'Categories';
		case 'gallery': return 'Galleries';
		case 'product': return 'Products';
		default:'Categories';
	}
}
/*function category_chain_front($id)
{
		//print $id;exit;
	$chain=array();
	while($id!=0):
		$QueryObj =new query('category');
		$QueryObj->Where="where id='".$id."'";
		$cat=$QueryObj->DisplayOne();
		$chain[]=display_url($cat->name,'product', 'id='.$cat->parent_id.'&category=1', '');
		$id=$cat->parent_id;
	endwhile;
	//print_r($chain);exit;
	$cat_chain='';
	for($i=count($chain)-1; $i>=0;$i--):
		$cat_chain.=$chain[$i].'  ';
	endfor;
	return $cat_chain;
}*/

function category_chain($id, $tablename='category')
{
	$chain=array();
	while($id!=0):
		$QueryObj =new query($tablename);
		$QueryObj->Where="where id='".$id."'";
		//$QueryObj->print=1;
		$cat=$QueryObj->DisplayOne();
		$chain[]=make_admin_link(make_admin_url($tablename, 'list', 'list', 'id='.$cat->parent_id), $cat->name, 'click here to reach this '.$tablename);
		$id=$cat->parent_id;
	endwhile;
	$cat_chain='';
	for($i=count($chain)-1; $i>=0;$i--):
		$cat_chain.=$chain[$i].' :: ';
	endfor;
	return $cat_chain.ucfirst(get_plural($tablename));
}

function validate_user($table, $details=array())
{
	$query= new query($table);
	$query->Where="where username='$details[username]' and password='$details[password]' and is_active=1";
	if($user=$query->DisplayOne()):
		return $user;
	else:
		return false;
	endif;	
}
function make_name($n, $name)
		{
			$spaces='';
			for($i=$n;$i>0;$i--):
				$spaces.='&nbsp;&nbsp;';
			endfor;
			return $spaces.$name;
		}	
					
function find_category($id, $cat_arr)
		{
			if(is_array($cat_arr)):
				foreach ($cat_arr as $k=>$v):
					if($v['id']==$id):
						return $k;
					endif;
				endforeach;
			endif;
			return false;
		}		
function insert_category($temparr, $k, $cat_arr)
		{
			if(!isset($cat_arr[$k+1])):
				$cat_arr[$k+1]=$temparr;
				return;
			endif;
			$count=count($cat_arr);
			for($i=$count;$i>($k+1);$i--):
				$cat_arr[$i]=$cat_arr[$i-1];
			endfor;
			$cat_arr[$k+1]=$temparr;
			return $cat_arr;
		}		
function get_category_list()
{
	$QueryObj= new query('category');
	$QueryObj->DisplayAll();
	$cat_arr=array();
	while($cat= $QueryObj->GetObjectFromRecord()):
			if($cat->parent_id==0):
				$entry_arr=array('id'=>$cat->id, 'name'=>$cat->name, 'position'=>0);
				@array_push($cat_arr, $entry_arr);
			else:
				$k=find_category($cat->parent_id, $cat_arr);
				$position=$cat_arr[$k]['position']+1;
				$name=make_name($position, $cat->name);
				$entry_arr=array('id'=>$cat->id, 'name'=>$name, 'position'=>$position);
				$cat_arr=insert_category($entry_arr, $k, $cat_arr);
			endif;
	endwhile;
	return $cat_arr;
}
function get_category_name_by_id($id)
{
	if($id==0):
		return 'Root';
	else:
		$query= new query('category');
		$query->Where="where id='$id'";
		$obj=$query->DisplayOne();
		if(is_object($obj)):
			return $obj->name;
		else:
			return '';
		endif;
	endif;
}

function get_country_name_by_id($id)
{
	if($id==0):
		return 'Root';
	else:
		$query= new query('country');
		$query->Where="where id='$id'";
		$obj=$query->DisplayOne();
		if(is_object($obj)):
			return $obj->name;
		else:
			return '';
		endif;
	endif;
}


function get_country_ISO2_by_name($id)
{
	if($id!=''):
		$query= new query('country');
		$query->Where="where name='$id'";
		$obj=$query->DisplayOne();
		if(is_object($obj)):
			return $obj->iso2;
		else:
			return '';
		endif;
	endif;
}


function get_parent_cat_id($id)
{
	$query= new query('category');
	$query->Where="where id='$id'";
	$obj=$query->DisplayOne();
	return is_object($obj)?$obj->parent_id:'';
}
function get_product_list()
{
	$query= new query('product');
	$query->DisplayAll();
	$product_list=array();
	$product_name='';	
	while($object= $query->GetObjectFromRecord()):
		$product_name=get_category_name_by_id($object->parent_id).'>>'.$object->name;
		$idd=$object->parent_id;
		while($id=get_parent_cat_id($idd)):
			$product_name=get_category_name_by_id($id).'>>'.$product_name;
			$idd=$id;
		endwhile;
		array_push($product_list, array('id'=>$object->id, 'name'=>$product_name));
	endwhile;
	return $product_list;
}

function get_country_list()
{
	$query= new query('country');
	$query->Where="where is_active=1";
	$query->DisplayAll();
	$country_list=array();
	$country_name='';	
	while($object= $query->GetObjectFromRecord()):
		$country_name=$object->name;
		$idd=$object->id;
		$country_list[$object->id]=$country_name;
	endwhile;
	return $country_list;
}

function get_zone_list($zone_id)
{	
	$query=new query('zone_country');
	//$query->Field="country_id";
	$query->Where="where zone_id=$zone_id";
	$query->DisplayAll();//print_r($query);exit;
	$country_list=array();
	$country_name='';	
	while($object=$query->GetObjectFromRecord()):
		$country_name=get_category_name_by_id($object->country_id);
		$idd=$object->country_id;
		/*while($id=get_parent_cat_id($idd)):
			$product_name=get_category_name_by_id($id).'>>'.$product_name;
			$idd=$id;
		endwhile;*/
		array_push($country_list, array('id'=>$object->id, 'name'=>$country_name));
	endwhile;
	return $country_list;
}

function copy_images($from, $to)
{
	$query= new query('pimage');
	$query->Where="where product_id='$from'";
	$query->DisplayAll();
	while($img= $query->GetObjectFromRecord()):
		$q= new query('pimage');
		$q->Data['image']=$img->image;
		$q->Data['position']=$img->position;
		$q->Data['product_id']=$to;
		$q->Insert();
	endwhile;
}
function copy_related_products($from, $to)
{
	$query= new query('related_product');
	$query->Where="where product_id='$from'";
	$query->DisplayAll();
	while($pro= $query->GetObjectFromRecord()):
		$q= new query('related_product');
		$q->Data['related_id']=$pro->related_id;
		$q->Data['product_id']=$to;
		$q->Insert();
	endwhile;
}
function copy_attributes($from, $to)
{
	$query= new query('attribute');
	$query->Where="where product_id='$from'";
	$query->DisplayAll();
	while($att= $query->GetObjectFromRecord()):
		$q= new query('attribute');
		$q->Data['name']=$att->name;
		$q->Data['is_paid']=$att->is_paid;
		$q->Data['product_id']=$to;
		$q->Insert();
		$new_at_id= $q->GetMaxId();
		$qu= new query('attribute_value');
		$qu->Where="where attribute_id='$att->id'";
		$qu->DisplayAll();
		while($at_val= $qu->GetObjectFromRecord()):
			$que= new query('attribute_value');
			$que->Data['stock']=$at_val->stock;
			$que->Data['price']=$at_val->price;
			$que->Data['name']=$at_val->name;
			$que->Data['attribute_id']=$new_at_id;
			$que->Insert();
		endwhile;
	endwhile;
}
function get_pro_name_by_id($id)
{
	$q= new query('product');
	$q->Where="where id='$id'";
	if($o=$q->DisplayOne()):
		return $o->name;
	else:
		return false;
	endif;
}
function insert_order($cart_id)
{
	$cart_obj= new cart();
	#get cart more detail object.
	$more_detail=get_object_by_col('cart_more_detail', 'cart_id', $cart_id, 'array');
	#get billing address
	$billing_address=$cart_obj->get_billing_address();
	
	#get shipping address
	$shipping_address=$cart_obj->get_shipping_address();
	
	$data=array();
	$data['cart_id']=			$cart_id;
	$data['billing_firstname']=	get_var_if_set($billing_address, 'first_name');
	$data['billing_lastname']=	get_var_if_set($billing_address, 'last_name');
	$data['billing_address1']=	get_var_if_set($billing_address, 'address1');
	$data['billing_address2']=	get_var_if_set($billing_address, 'address2');
	$data['billing_city']= 		get_var_if_set($billing_address, 'city');
	$data['billing_state']=		get_var_if_set($billing_address, 'state');
	$data['billing_zip']=		get_var_if_set($billing_address, 'zip');
	$data['billing_country']=	get_var_if_set($billing_address, 'country');
	$data['billing_phone']=		get_var_if_set($billing_address, 'phone');
	$data['billing_fax']=		get_var_if_set($billing_address, 'fax');
	$data['billing_email']=		get_var_if_set($billing_address, 'email');
	$data['shipping_firstname']=get_var_if_set($shipping_address, 'first_name');
	$data['shipping_lastname']=	get_var_if_set($shipping_address, 'last_name');
	$data['shipping_address1']=	get_var_if_set($shipping_address, 'address1');
	$data['shipping_address2']=	get_var_if_set($shipping_address, 'address2');
	$data['shipping_city']=		get_var_if_set($shipping_address, 'city');
	$data['shipping_state']=	get_var_if_set($shipping_address, 'state');
	$data['shipping_zip']=		get_var_if_set($shipping_address, 'zip');
	$data['shipping_country']=	get_var_if_set($shipping_address, 'country');
	$data['shipping_phone']=	get_var_if_set($shipping_address, 'phone');
	$data['shipping_fax']=		get_var_if_set($shipping_address, 'fax');
	if(CART_VAT):
		//$data['grand_total']=		($cart_obj->get_cart_vat($cart_obj->get_cart_total())+$cart_obj->get_cart_total()+$cart_obj->get_cart_shipping())-get_var_if_set($more_detail, 'voucher_amount');
		$data['grand_total']=		($cart_obj->get_cart_vat($cart_obj->get_cart_total())+$cart_obj->get_cart_total()+$cart_obj->GetSHIP($cart_obj->get_cart_total_items()))-get_var_if_set($more_detail, 'voucher_amount');
		$data['vat']=				$cart_obj->get_cart_vat($cart_obj->get_cart_total());
	else:
		//$data['grand_total']=		($cart_obj->get_cart_total()+$cart_obj->get_cart_shipping())-get_var_if_set($more_detail, 'voucher_amount');
		$data['grand_total']=		($cart_obj->get_cart_total()+$cart_obj->GetSHIP($cart_obj->get_cart_total_items()))-get_var_if_set($more_detail, 'voucher_amount');
		$data['vat']=				0;
	endif;
	$data['voucher_code']=		get_var_if_set($more_detail, 'voucher_code');
	$data['voucher_amount']=	get_var_if_set($more_detail, 'voucher_amount');
	$data['currency']=			get_var_if_set($more_detail, 'currency');
	$data['language']=			get_var_if_set($more_detail, 'language');
	$data['user_id']=			get_var_if_set($billing_address, 'user_id');
	$data['sub_total']=			$cart_obj->get_cart_total();
	//$data['shipping']=			$cart_obj->get_cart_shipping();
	$data['shipping']=			$cart_obj->GetSHIP($cart_obj->get_cart_total_items());
	$data['shipping_comment']=	get_var_if_set($more_detail, 'shipping_comment');
	$data['order_comment']=		get_var_if_set($more_detail, 'order_comment');
	$data['payment_method']=	get_var_if_set($more_detail, 'payment_method');
	$data['ip_address']=		$_SERVER['REMOTE_ADDR'];
	
	# some config options
	$data['config_add_att_price_to_pro']= 		ADD_ATTRIBUTE_PRICE_TO_PRODUCT_PRICE;
	$data['config_att_price_overlap']=			ATTRIBUTE_PRICE_OVERLAP;
	$data['config_stock_check']=				CART_STOCK;
	$data['config_stock_check_product']=		CART_STOCK;
	$data['config_stock_check_attribute']=		CHECK_STOCK_WITH_ATTRIBUTE;
	$data['config_allow_buy_if_not_in_stock']=	ALLOW_BUY_IF_OUT_OF_STOCK;
	$data['config_cart_vat']=					CART_VAT;
		
	$query= new query('orders');
	$query->Data=$data;
	$query->Insert();
	
	$order_id= $query->GetMaxId();
	# add data to order detail table;
	
	$query= new query('cart');
	$query->Where="where cart_id='$cart_id'";
	$query->DisplayAll();
	while($object= $query->GetObjectFromRecord()):
		$data=array();
		$data['product_id']=$object->product_id;
		$data['quantity']=$object->quantity;
		$data['price']=	$object->price;
		$data['order_id']=$order_id;
		$data['product_name']=$object->product_name;
		$data['product_total']=$cart_obj->get_cart_item_total($object->id);
		$q= new query('order_detail');
		$q->Data=$data;
		$q->Insert();
		#attributes enabled.
		$od_id=$q->GetMaxId();
		
		$qu= new query('cart_attribute');
		$qu->Where="where cart_instance_id='$object->id'";
		$qu->DisplayAll();
		
		while($obj=$qu->GetObjectFromRecord()):
			$data= array();
			$data['order_detail_id']=$od_id;
			$data['attribute_id']=$obj->attribute_id;
			$data['attribute_name']=$obj->attribute_name;
			$data['attribute_value_id']=$obj->attribute_value_id;
			$data['attribute_value_name']=$obj->attribute_value_name;
			$data['price']=$obj->price;
			$data['is_attribute_paid']=$obj->is_paid_attribute;
			$quer= new query('order_detail_attribute');
			$quer->Data=$data;
			$quer->Insert();
		endwhile;
	endwhile;
	return $order_id;
}
function update_order($order_id)
{
	
	#get cart more detail object.
	$cart_obj= new cart();
	$cart_id=$cart_obj->get_cart_id();
	$more_detail=get_object_by_col('cart_more_detail', 'cart_id', $cart_id, 'array');
	
	#get billing address
	$billing_address=$cart_obj->get_billing_address();
	
	#get shipping address
	$shipping_address=$cart_obj->get_shipping_address();
	
	$cart_id=$cart_obj->get_cart_id();
	
	$data=array();
	$data['cart_id']=			$cart_id;
	$data['billing_firstname']=	get_var_if_set($billing_address, 'first_name');
	$data['billing_lastname']=	get_var_if_set($billing_address, 'last_name');
	$data['billing_address1']=	get_var_if_set($billing_address, 'address1');
	$data['billing_address2']=	get_var_if_set($billing_address, 'address2');
	$data['billing_city']= 		get_var_if_set($billing_address, 'city');
	$data['billing_state']=		get_var_if_set($billing_address, 'state');
	$data['billing_zip']=		get_var_if_set($billing_address, 'zip');
	$data['billing_country']=	get_var_if_set($billing_address, 'country');
	$data['billing_phone']=		get_var_if_set($billing_address, 'phone');
	$data['billing_fax']=		get_var_if_set($billing_address, 'fax');
	$data['billing_email']=		get_var_if_set($billing_address, 'email');
	$data['shipping_firstname']=get_var_if_set($shipping_address, 'first_name');
	$data['shipping_lastname']=	get_var_if_set($shipping_address, 'last_name');
	$data['shipping_address1']=	get_var_if_set($shipping_address, 'address1');
	$data['shipping_address2']=	get_var_if_set($shipping_address, 'address2');
	$data['shipping_city']=		get_var_if_set($shipping_address, 'city');
	$data['shipping_state']=	get_var_if_set($shipping_address, 'state');
	$data['shipping_zip']=		get_var_if_set($shipping_address, 'zip');
	$data['shipping_country']=	get_var_if_set($shipping_address, 'country');
	$data['shipping_phone']=	get_var_if_set($shipping_address, 'phone');
	$data['shipping_fax']=		get_var_if_set($shipping_address, 'fax');
	if(CART_VAT):
		$data['grand_total']=		($cart_obj->get_cart_vat($cart_obj->get_cart_total())+$cart_obj->get_cart_total()+$cart_obj->get_cart_shipping())-get_var_if_set($more_detail, 'voucher_amount');
		$data['vat']=				$cart_obj->get_cart_vat($cart_obj->get_cart_total());
	else:
		$data['grand_total']=		($cart_obj->get_cart_total()+$cart_obj->get_cart_shipping())-get_var_if_set($more_detail, 'voucher_amount');
		$data['vat']=				0;
	endif;
	$data['voucher_code']=		get_var_if_set($more_detail, 'voucher_code');
	$data['voucher_amount']=	get_var_if_set($more_detail, 'voucher_amount');
	$data['currency']=			get_var_if_set($more_detail, 'currency');
	$data['language']=			get_var_if_set($more_detail, 'language');
	$data['user_id']=			get_var_if_set($billing_address, 'user_id');
	$data['sub_total']=			$cart_obj->get_cart_total();
	$data['shipping']=			$cart_obj->get_cart_shipping();
	$data['shipping_comment']=	get_var_if_set($more_detail, 'shipping_comment');
	$data['order_comment']=	    get_var_if_set($more_detail, 'order_comment');
	$data['payment_method']=	get_var_if_set($more_detail, 'payment_method');
	$data['ip_address']=		$_SERVER['REMOTE_ADDR'];
	
	# some config options
	$data['config_add_att_price_to_pro']= 		ADD_ATTRIBUTE_PRICE_TO_PRODUCT_PRICE;
	$data['config_att_price_overlap']=			ATTRIBUTE_PRICE_OVERLAP;
	$data['config_stock_check']=				CART_STOCK;
	$data['config_stock_check_product']=		CART_STOCK;
	$data['config_stock_check_attribute']=		CHECK_STOCK_WITH_ATTRIBUTE;
	$data['config_allow_buy_if_not_in_stock']=	ALLOW_BUY_IF_OUT_OF_STOCK;
	$data['config_cart_vat']=					CART_VAT;
		
	$data['id']=$order_id;
	
	$query= new query('orders');
	$query->Data=$data;
	//$query->print=1;
	$query->Update();
	
	#remove entries from order detail table that belong to current order.
	$query= new query('order_detail');
	$query->Where="where order_id='$order_id'";
	$query->DisplayAll();
	while($item=$query->GetObjectFromRecord()):
		$qq= new query('order_detail_attribute');
		$qq->Where="where order_detail_id='$item->id'";
		$qq->Delete_where();
	endwhile;
	$query= new query('order_detail');
	$query->Where="where order_id='$order_id'";
	$query->Delete_where();
	# items removed.	
	
	# add new items to both tables.
	$query= new query('cart');
	$query->Where="where cart_id='$cart_id'";
	$query->DisplayAll();
	while($object= $query->GetObjectFromRecord()):
		$data=array();
		$data['product_id']=$object->product_id;
		$data['quantity']=$object->quantity;
		$data['price']=	$object->price;
		$data['order_id']=$order_id;
		$data['product_name']=$object->product_name;
		$data['product_total']=$cart_obj->get_cart_item_total($object->id);
		$q= new query('order_detail');
		$q->Data=$data;
		$q->Insert();
		#if attributes enabled.
		$od_id=$q->GetMaxId();
		
		$qu= new query('cart_attribute');
		$qu->Where="where cart_instance_id='$object->id'";
		$qu->DisplayAll();
		
		while($obj=$qu->GetObjectFromRecord()):
			$data= array();
			$data['order_detail_id']=$od_id;
			$data['attribute_id']=$obj->attribute_id;
			$data['attribute_name']=$obj->attribute_name;
			$data['attribute_value_id']=$obj->attribute_value_id;
			$data['attribute_value_name']=$obj->attribute_value_name;
			$data['price']=$obj->price;
			$data['is_attribute_paid']=$obj->is_paid_attribute;
			$quer= new query('order_detail_attribute');
			$quer->Data=$data;
			$quer->Insert();
		endwhile;
	endwhile;
}
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
function get_latest_products($count=6)
{
$query= new query();
$query->InitilizeSQL();
$query->Field="product.*, pimage.image as image";
$query->TableName="product, product_check_box_value, pimage";
$query->Where="where product.id=product_check_box_value.product_id and product_check_box_value.option_id='5' and pimage.product_id=product.id and pimage.position=1 order by product_check_box_value.position limit 0,$count";
//$query->print=1;
$query->DisplayAll();
$latest_products=array();
if($query->GetNumRows()):
	while ($pro=$query->GetArrayFromRecord()) {
		$latest_products[]=$pro;
	}
endif;
return $latest_products;
}
function get_bestseller_products($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="product.*, pimage.image as image";
	$query->TableName="product, product_check_box_value, pimage";
	$query->Where="where product.id=product_check_box_value.product_id and product_check_box_value.option_id='4' and pimage.product_id=product.id and pimage.position=1 order by product_check_box_value.position limit 0, $count";
	$query->DisplayAll();
	$best_sellers=array();
	if($query->GetNumRows()):
	while ($pro=$query->GetArrayFromRecord()) {
		$best_sellers[]=$pro;
	}
	endif;
	return $best_sellers;
}
function get_featured_products($count=0)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="product.*, pimage.image as image";
	$query->TableName="product, product_check_box_value, pimage";
	$query->Where="where product.id=product_check_box_value.product_id and product_check_box_value.option_id='2' and pimage.product_id=product.id and pimage.position=1 order by product_check_box_value.position ASC limit 0, $count";
	$query->DisplayAll();
	$featured=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$featured[]=$pro;
		}
	endif;
	return $featured;
}


/*function get_related_products($id, $count=1)
{
	$related_product=array();
	$query= new query('related_product, product, pimage');
	//$query->Field="product.*, pimage.image as image";
	//$query->Where="where related_product.product_id='$id' and product.id=related_product.related_id and pimage.product_id=related_product.related_id limit 0, $count";
	$query->Field="product.*, pimage.image as image";
	$query->Where="where related_product.product_id='$id' and product.id=related_product.related_id and pimage.product_id=related_product.related_id limit 0, $count";
	$query->print=1;
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object = $query->GetArrayFromRecord()):
			$related_product[]=$object;
		endwhile;
	endif;
	return $related_product;
}*/

function get_related_products($id, $count=1)
{
	$related_product=array();
	$query= new query('related_product, product, pimage');
	$query->Field="product.*, pimage.image as image";
	$query->Where="where related_product.product_id='$id' and product.id=related_product.related_id and pimage.product_id=related_product.related_id and pimage.main_image=1 limit 0, $count";
	//$query->print=1;
	$query->DisplayAll();
	if($query->GetNumRows()):
		while($object = $query->GetArrayFromRecord()):
			$related_product[]=$object;
		endwhile;
	endif;
	return $related_product;
}

function get_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=5 order by position limit 0, $count";
	$query->DisplayAll();
	$banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$banner[]=$pro;
		}
	endif;
	return $banner;
}


function get_pimages($id)
{
	$prope= new query('pimage');
	$prope->Where="where product_id='$id' and main_image='1'";
	$prope1=$prope->DisplayOne();
	//print_r($prope1);exit;
	return $prope1->image;
	
}

/**
 * To get all images related a one product
 *
 * @param integer $id
 * @param integer $count
 * @param bool $repeat_main
 * @return array
 */
function get_product_images($id, $count, $repeat_main=1)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->TableName="pimage";
	$query->Where="where product_id='$id' and main_image=0 order by position limit 0, $count";
	$query->DisplayAll();
	$product_image=array();
	if($query->GetNumRows()):
		$sr=1;
		while ($pro=$query->GetArrayFromRecord()) {
			//if($repeat_main && $sr==1):
				$product_image[]=$pro;
			//endif;
			$sr++;
		}
	endif;
	return $product_image;
}

function get_bottom_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=9 order by position limit 0, $count";
	$query->DisplayAll();
	$bottom_banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$bottom_banner[]=$pro;
		}
	endif;
	return $bottom_banner;
}

function get_centre_banner_images($count)
{
	$query= new query();
	$query->InitilizeSQL();
	$query->Field="gimage.*";
	$query->TableName="gimage";
	$query->Where="where parent_id=10 order by position limit 0, $count";
	$query->DisplayAll();
	$centre_banner=array();
	if($query->GetNumRows()):
		while ($pro=$query->GetArrayFromRecord()) {
			$centre_banner[]=$pro;
		}
	endif;
	return $centre_banner;
}

function get_attribute_values($id)
{
	$values=array();
	$q= new query('attribute_value');
	$q->Where="where attribute_id='$id'";
	$q->DisplayAll();
	while($aa=$q->GetArrayFromRecord()):
		array_push($values, $aa);
	endwhile;
	return $values;
}

function get_attribute_select_box($name, $values)
{
	echo '<select name="attribute['.$name.']" size="1" style="width:200">';
	foreach ($values as $k=>$v):
		echo '<option value="'.$v['id'].'">'.$v['name'].'-&pound;'.$v['price'].'</option>';	
	endforeach;
	echo '</select>';
}

function display_attributes($attributes)
{
	if(USE_PRODUCT_ATTRIBUTE):
		foreach ($attributes as $k=>$v):
			echo $v['name'].'&nbsp;&nbsp;';
			get_attribute_select_box($v['id'], get_attribute_values($v['id']));
			echo '<br/>';
		endforeach;
	endif;
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

function cart_attribute_stock($id)
{	
	$q= new query('attribute_value,attribute');
	$q->Where="where attribute_value.attribute_id=attribute.id and attribute.product_id='$id'";
	$q->Field="attribute_value.stock";
	$q->DisplayAll();
	$values=array();
	while($ob=$q->GetArrayFromRecord()):
		if($ob['stock']):
			return true;
		else:
			return false; 
		endif;
	endwhile;
}

function get_n_words($string, $number=1)
{
	if($string==''):
		return false;
	endif;
	$num = is_numeric($number)?$number:1;
	$temp= explode(' ', $string);
	$final='';
	$num= (count($temp)<$num)?count($temp):$num;
	for($i=0;$i<$num;$i++):
		$final.=$temp[$i].' ';
	endfor;
	return substr($final, 0, strlen($final)-1);
}



?>