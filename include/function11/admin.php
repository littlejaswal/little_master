<?
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

function if_sub_cat_or_product_exist($cat_id)
{
	#check for sub categories.
	$query= new query('category');
	$query->Where="where parent_id='$cat_id'";
	$query->DisplayAll();
	if($query->GetNumRows()):
		return true;
	endif;

	#check for products.
	$query= new query('product');
	$query->Where="where parent_id='$cat_id'";
	$query->DisplayAll();
	return ($query->GetNumRows())?true:false;
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

function download_users()
{
	$users= new query('user');
	$users->DisplayAll();
	$users_arr= array();
	if($users->GetNumRows()):
		while($user= $users->GetArrayFromRecord()):
			$user['total orders']=get_total_orders_by_user($user['id']);
			array_push($users_arr, $user);
		endwhile;
	endif;
	$file=make_csv_from_array($users_arr);
	$filename="users".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
}

function download_products()
{
	$products= new query('product');
	$products->Field="id,parent_id,name,description,price,position,stock,meta_keyword,meta_desc,meta_title";
	$products->DisplayAll();
	$products_arr= array();
	if($products->GetNumRows()):
		while($product= $products->GetArrayFromRecord()):
			$product['category']=get_category_by_product($product['parent_id']);
			array_push($products_arr, $product);
		endwhile;
	endif;
	$file=make_csv_from_array($products_arr);
	$filename="products".'.csv';
	$fh=@fopen('download/'.$filename,"w");
	fwrite($fh, $file);
	fclose($fh);
	download_file('download/'.$filename);
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

function download_search_users($email,$first_name,$last_name,$city,$country)
{
	$search_users= new query('user');
	$search_users->Where="where username='$email' OR firstname='$first_name' OR lastname='$last_name' OR city='$city' OR country='$country'";
	$search_users->DisplayAll();
	$search_users_arr= array();
	if($search_users->GetNumRows()):
		while($search_user= $search_users->GetArrayFromRecord()):
			$search_user['total orders']=get_total_orders_by_user($search_user['id']);
			array_push($search_users_arr, $search_user);
		endwhile;
	endif;
	$file=make_csv_from_array($search_users_arr);
	$filename="search_users".'.csv';
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

function get_total_products_by_user($id)
{
	$q= new query('product');
	$q->Field="count(*) as total";
	$q->Where="where user_id='".$id."'";
	$o=$q->DisplayOne();
	return $o->total;
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

function get_category_by_product($id)
{
	$q=new query('category');
	$q->Where="where id='$id'";
	if($o=$q->DisplayOne()):
		return $o->name;
	else:
		return '';
	endif;
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

function get_all_sub_cats($tablename, $id)
{
	$sub_cat='';
	$q= new query($tablename);
	$q->Where="where parent_id='".$id."'";
	$q->DisplayAll();
	if($q->GetNumRows()):
		while ($item= $q->GetObjectFromRecord()) {
			$sub_cat.="'".$item->id."'".', ';
		}
		return substr($sub_cat, 0, strlen($sub_cat)-2);
	else:
		return false;
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

function get_category_list_control($id)
{
	if(!get_total_sub_categories($id) && !get_total_products($id)):
	?>
	<a href="<?php echo make_admin_url('category', 'list', 'list', 'id='.$id);?>"><?php echo get_control_icon('folder_explore')?>Category</a>&nbsp;(<?php echo get_total_sub_categories($id);?>)<br/>
	<a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$id);?>"><img src="<?php echo DIR_WS_SITE_CONTROL_IMAGE?>file.gif" border="0" align="absmiddle"/>Products</a>&nbsp;(<?php echo get_total_products($id)?>)
	<?php
	elseif(get_total_sub_categories($id) && !get_total_products($id)):?>
	<a href="<?php echo make_admin_url('category', 'list', 'list', 'id='.$id);?>"><?php echo get_control_icon('folder_explore')?>Category</a>&nbsp;(<?php echo get_total_sub_categories($id);?>)<br/>
	<?php
	elseif(!get_total_sub_categories($id) && get_total_products($id)):?>
	<a href="<?php echo make_admin_url('product', 'list', 'list', 'id='.$id);?>"><img src="<?php echo DIR_WS_SITE_CONTROL_IMAGE?>file.gif" border="0" align="absmiddle"/>Products</a>&nbsp;(<?php echo get_total_products($id)?>)
	<?php
	endif;

}

function get_category_status_link($id, $status)
{
	echo '<select name="is_active['.$id.']" size="1">';
	if($status):
		echo '<option value="1" selected>Active</option>';
		echo '<option value="0">Not-Active</option>';
	else:
		echo '<option value="1" selected>Active</option>';
		echo '<option value="0" selected>Not-Active</option>';
	endif;
	echo '</select>';
}

function get_category_position_control($catid, $id, $position=1, $page=1)
{
	echo '<a href="'.make_admin_url('category', 'update2', 'list', 'page='.$page.'&id='.$id.'&up='.$position.'&cat_id='.$catid).'"><img src="'.DIR_WS_SITE_CONTROL_IMAGE.'up.gif"></a>';
	echo '&nbsp;';
	echo '<a href="'.make_admin_url('category', 'update2', 'list', 'page='.$page.'&id='.$id.'&down='.$position.'&cat_id='.$catid).'"><img src="'.DIR_WS_SITE_CONTROL_IMAGE.'down.gif"></a>';
}


function parse_into_array($string)
{
	return explode(',', $string);
}

function update_last_access($id, $status)
{
	$q= new query('admin_user');
	$q->Data['last_access']=date("Y-m-d h:i:s");
	$q->Data['is_loggedin']=$status;
	$q->Data['id']=$id;
	$q->Update();
}

function page_preview($is_preview, $preview_update_date='', $publish_date='', $preview_of_page_id='')
{
	global $Data;
	$preview_update_date=($preview_update_date=='')?date("Y-m-d"):$preview_update_date;
	$publish_date=($publish_date=='')?date("Y-m-d"):$publish_date;
	$preview_of_page_id=($preview_of_page_id=='')?0:$preview_of_page_id;
	$is_preview=$is_preview?1:0;
	$Data['is_preview']=$is_preview;
	$Data['preview_update_date']=$preview_update_date;
	$Data['publish_date']=$publish_date;
	$Data['preview_of_page_id']=$preview_of_page_id;
	#return array('is_preview'=>$is_preview, 'preview_update_date'=>$preview_update_date, 'publish_date'=>$publish_date, 'preview_of_page_id'=>$preview_of_page_id);	
}

function is_published($id)
{
	$object=get_object_by_col('content', 'id', $id);
	return ($object->is_preview)?false:true;
}

function is_secure_published($id)
{
	$object=get_object_by_col('secure_content', 'id', $id);
	return ($object->is_preview)?false:true;
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
				return 'Newsletter Manager';
				break;
		case 'event':
				return 'Events Manager';
				break;
                            
		case 'zones':
		case 'ship':
		case 'zone_country':
		case 'country':
				return 'Delivery Manager';
				break;
		case 'diamond':
		case 'diamond_detail':
				return 'Diamond Manager';
				break;
		case 'attributes':
		case 'attribute_value':
		case 'att_description':
				return 'Diamond Attribute Manager';
				break;
		case 'home':
				return 'Dashboard';
				break;
		default:
				return $Page;
	}
}

?>


