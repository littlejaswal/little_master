<?php
function category_chain_front($id)

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
		$cat_chain.=$chain[$i].' :: ';
	endfor;
	return $cat_chain;
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

function get_total_sub_categories($id, $tablename='category')
{
	#get total sub-categories.
		$QueryObj =new query($tablename);
		$QueryObj->Where="where parent_id='".$id."'";
		return $QueryObj->count();
}

function get_parent_cat_id($id)
{
	$query= new query('category');
	$query->Where="where id='$id'";
	$obj=$query->DisplayOne();
	return is_object($obj)?$obj->parent_id:'';
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


function category_drop_down($data, $name, $size=1, $type="mulitple", $selected=array())
{
	echo '<select name="'.$name.'" size="'.$size.'" style="width:600px;" '.$type.'>';
	foreach ($data as $value):
		if(in_array($value['id'], $selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

function get_product_id_by_url_name($url_name)
	{
		$query = new query('product');
		$query->Where="where urlname='$url_name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}

function get_product_id_by_product_name($name)
	{
		$query = new query('product');
		$query->Where="where name='$name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}

function get_category_id_by_name($name)
	{
		$query = new query('category');
		$query->Where="where name='$name'";
		if($object=$query->DisplayOne()):
			return $object->id;
		else:
			return false;
		endif;
	}




/* producuts based functions */

function product_drop_down($data, $name, $selected=array())
{
	echo '<select name="'.$name.'" size="10" style="width:600px;" multiple>';
	foreach ($data as $value):
		if(in_array($value['id'],$selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

function get_total_products_by_user($id)
{
	$q= new query('product');
	$q->Field="count(*) as total";
	$q->Where="where user_id='".$id."'";
	$o=$q->DisplayOne();
	return $o->total;
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

function get_total_products($id)
{
	#get total products
		$QueryObj =new query('product');
		$QueryObj->Where="where parent_id='".$id."'";
		return $QueryObj->count();
}


function get_product_parent_id($id)
{
	$object= get_object('product', $id);
	return $object->parent_id;
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

function get_latest_products($count=6)
{
$query= new query();
$query->InitilizeSQL();
$query->Field="product.*, pimage.image as image";
$query->TableName="product, product_check_box_value, pimage";
$query->Where="where product.id=product_check_box_value.product_id and product_check_box_value.option_id='5' and pimage.product_id=product.id and pimage.position=1 order by product_check_box_value.position limit 0,$count";
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

//function get_related_products($id, $count=1)
//{
//	$related_product=array();
//	$query= new query('related_product, product, pimage');
//	$query->Field="product.*, pimage.image as image";
//	$query->Where="where related_product.product_id='$id' and product.id=related_product.related_id and pimage.product_id=related_product.related_id and pimage.main_image=1 limit 0, $count";
//	//$query->print=1;
//	$query->DisplayAll();
//	if($query->GetNumRows()):
//		while($object = $query->GetArrayFromRecord()):
//			$related_product[]=$object;
//		endwhile;
//	endif;
//	return $related_product;
//}

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

function download_product_file($item)
{
	$order_detail=get_object('order_detail', $item);
	if(substr($order_detail->product_file, 0, 4)!='http'): 		
			return DIR_WS_SITE.'upload/file/product/'.$order_detail->product_file;
	elseif(substr($order_detail->product_file, 0, 4)=='http'):
			return $order_detail->product_file;
	endif;
}
	
function get_related_products($id, $count=1)
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
}

function category_img_url($name)
{
	if($name==''):
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_WS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function category_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_CATEGORY.$name;
	endif;
}

	function product_img_url_fs($name)
{
	if($name==''):
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT.'no_image.jpg';
	else:	
		return DIR_FS_SITE_UPLOAD_PHOTO_PRODUCT.$name;
	endif;
}
?>