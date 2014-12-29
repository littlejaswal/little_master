<?php

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
		$data['product_file']=$object->product_file;
		$data['product_type']=$object->product_type;
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

function get_order_item_total($item_id)
{
	$item= get_object('order_detail', $item_id);
	$order=get_object('orders', $item->order_id);
	if($order->config_add_att_price_to_pro):
		return ($item->quantity*$item->price)+ get_item_attribute_total($item_id);
	endif;

	if($order->config_att_price_overlap):
		return get_item_attribute_total($item_id);
	endif;

	return $item->quantity*$item->price;

}

function get_item_attribute_total($item_id)
{
	$item= get_object('order_detail', $item_id);
	$query= new query('order_detail_attribute');
	$query->Where="where order_detail_id='$item_id'";
	$query->DisplayAll();
	$total=0;
	while($obj= $query->GetArrayFromRecord()):
		if($obj['is_attribute_paid']):
			$total+=$obj['price']*$item->quantity;
		endif;
	endwhile;
	return $total;
}

function display_attributes_for_cart($item_id)
{
	$query= new query('order_detail_attribute');
	$query->Where="where order_detail_id='$item_id'";
	$query->DisplayAll();
	$items='';
	if($query->GetNumRows()):
		while($obj=$query->GetArrayFromRecord()):
			if($obj['is_attribute_paid']):
				$items.='<b>'.$obj['attribute_name'].'</b>:-'.$obj['attribute_value_name'].'('.number_format($obj['price'], 2).')'.'<br/>';
			else:
				$items.='<b>'.$obj['attribute_name'].'</b>:-'.$obj['attribute_value_name'].'<br/>';
			endif;
		endwhile;
	endif;
	return $items;
}

function order_status_drop_down($name, $selected,$id)
{
	global $conf_order_status;
	echo '<select name="'.$name.'" size="1" onchange="getvalue(this.form);">';
	foreach ($conf_order_status as $value):
	if(strtolower($value)==strtolower($selected)):
		echo '<option selected="selected" value="'.strtolower($value).'">'.ucfirst($value).'</option>';
	else:
		echo '<option value="'.strtolower($value).'">'.ucfirst($value).'</option>';
	endif;
	endforeach;
	echo '</select>';
}

# order_status: paid, attempted, archive
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
	#print_r($orders);exit();
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

# custom_order_status: paid, attempted, archive
function download_custom_orders($payment_status)
{
	$custom_orders= new query('custom_order');
	$custom_orders->Field="id,title,shipping,tax,customer_email,email_subject,note,first_name,last_name,shipping_address,postcode";
	$custom_orders->Where="where payment_status=".$payment_status."";
	$custom_orders->DisplayAll();
	$custom_orders_arr= array();
	if($custom_orders->GetNumRows()):
		while($custom_order= $custom_orders->GetArrayFromRecord()):
			array_push($custom_orders_arr, $custom_order);
		endwhile;
	endif;
	$file=make_csv_from_array($custom_orders_arr);
	$filename="custom_orders".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function download_searchorders($from_date,$to_date,$order_status)
{	
	$fdate=ToUSDate($from_date);
	$tdate=ToUSDate($to_date);
	$search_orders= new query('orders');
	$search_orders->Field="id,user_id,sub_total,vat,shipping,voucher_code,voucher_amount,shipping_firstname,shipping_lastname,shipping_address1,shipping_address2,shipping_city,shipping_state,shipping_zip,shipping_country,shipping_phone,shipping_fax,billing_firstname,billing_lastname,billing_email,billing_address1,billing_address2,billing_city,billing_state,billing_zip,billing_country,billing_phone,billing_fax,grand_total,order_type,order_status,order_date,ip_address,order_comment,shipping_comment,cart_id";
	$search_orders->Where="where order_status='$order_status' AND order_date BETWEEN CAST('$fdate' as DATETIME) AND CAST('$tdate'as DATETIME)";
	$search_orders->DisplayAll();
	//print_r($search_orders);exit();
	$search_orders_arr= array();
	if($search_orders->GetNumRows()):
		while($search_order= $search_orders->GetArrayFromRecord()):
			array_push($search_orders_arr, $search_order);
		endwhile;
	endif;
	$file=make_csv_from_array($search_orders_arr);
	$filename="search_orders".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function download_search_customorders($from_date, $to_date, $order_order_status)
{	
	$fdate=ToUSDate($from_date);
	$tdate=ToUSDate($to_date);
	$search_custom_orders= new query('custom_order');
	$search_custom_orders->Field="id,title,shipping,tax,customer_email,email_subject,note,first_name,last_name,shipping_address,postcode";
	$search_custom_orders->Where="where order_status='$order_order_status' AND order_date BETWEEN CAST('$fdate' as DATETIME) AND CAST('$tdate'as DATETIME)";
	$search_custom_orders->DisplayAll();
	$search_custom_orders_arr= array();
	if($search_custom_orders->GetNumRows()):
		while($search_custom_order= $search_custom_orders->GetArrayFromRecord()):
			array_push($search_custom_orders_arr, $search_custom_order);
		endwhile;
	endif;
	$file=make_csv_from_array($search_custom_orders_arr);
	$filename="search_custom_orders".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function get_total_orders_by_user($id)
{
	$q= new query('orders');
	$q->Field="count(*) as total";
	$q->Where="where user_id='".$id."'";
	$o=$q->DisplayOne();
	return $o->total;
}

?>