<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['att_id'])?$att_id=$_GET['att_id']:$att_id='0';
isset($_GET['att_edit'])?$att_edit=1:$att_edit=0;
isset($_GET['att_value'])?$att_value=1:$att_value=0;

#handle actions here.
switch ($action):
	case'list':
		$QueryObj= new query('category');
		$QueryObj->Where="where id='".$id."'";
		$cate=$QueryObj->DisplayOne();
		$QueryObj = new query('product');
		$QueryObj->Where="where parent_id='".$id."'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		$QueryObj= new query('category');
		$QueryObj->Where="where id='".$id."'";
		$cate=$QueryObj->DisplayOne();
		if(isset($_POST['new_product']) && $_POST['new_product']=='Submit'):
			$not=array('new_product');
			$QueryObj =new query('product');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			if(isset($_POST['file_type']) && $_POST['file_type']=='upload'):
				# set product de-active by default
				$random_number=rand(0000000, 9999999);
				if(uploadfile($_FILES['product_file'], $AllowedImageTypes, DIR_FS_SITE.'upload/file/product/', $random_number)):
					$QueryObj->Data['product_file']=make_file_name($_FILES['product_file']['name'], $random_number);
				else:
					$admin_user->set_pass_msg('File can\'t be uploaded.');
					Redirect(make_admin_url('product', 'insert', 'insert'));
				endif;
			endif;
			$QueryObj->Data['is_active']=0;
			$QueryObj->Data['parent_id']=$id;
			$QueryObj->Insert();
			$pid=$QueryObj->GetMaxId();
			$admin_user->set_pass_msg('Product has been inserted successfully.');
			Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$pid));
		endif;
		break;
	case'update':
		$QueryObj= new query('category');
		$QueryObj->Where="where id='".$id."'";
		$cate=$QueryObj->DisplayOne();

		if(isset($_GET['pro_id'])):
			$QueryObj =new query('product');
			$QueryObj->Where="where id='$_GET[pro_id]'";
			$product=$QueryObj->DisplayOne();
		endif;
		
		if(isset($_POST['update_product']) && $_POST['update_product']=='Submit'):
			$not=array('update_product','is_active','is_override','is_stock');
			$QueryObj =new query('product');
			$data=MakeDataArray($_POST, $not);
			$random_number=rand(0000000, 9999999);
			if(isset($_POST['file_type']) && $_POST['file_type']=='upload'):
				if(!$_FILES['product_file']['error']):
					if(uploadfile($_FILES['product_file'], $AllowedImageTypes, DIR_FS_SITE.'upload/file/product/', $random_number)):
						$data['product_file']=make_file_name($_FILES['product_file']['name'], $random_number);
					endif;
				endif;
			endif;
			isset($_POST['is_active'])?$data['is_active']=1:$data['is_active']="0";
			isset($_POST['is_override'])?$data['is_override']=1:$data['is_override']="0";
			isset($_POST['is_stock'])?$data['is_stock']=1:$data['is_stock']="0";
			$QueryObj->Data=$data;
			$QueryObj->Data['parent_id']=$id;
			$QueryObj->Update();
		    $admin_user->set_pass_msg('Product has been updated successfully.');
			Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		endif;
		break;
	case 'list_ops':
		#update stock.
		if(is_var_set_in_post('stock_update')):
			foreach ($_POST['stock'] as $k=>$v):
				$q= new query('product');
				$q->Data['id']=$k;
				$q->Data['stock']=$v;
				$q->Update();
			endforeach;;
			$admin_user->set_pass_msg('Product stock has been updated successfully.');
			Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		endif;
		#update position.
		if(is_var_set_in_post('position_update')):
			foreach ($_POST['position'] as $k=>$v):
				$q= new query('product');
				$q->Data['id']=$k;
				$q->Data['position']=$v;
				$q->Update();
			endforeach;;
			$admin_user->set_pass_msg('Product(s) position has been updated successfully.');
			Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		endif;
		#status update.
		if(is_var_set_in_post('status_update')):
			foreach ($_POST['status'] as $k=>$v):
				$q= new query('product');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;;
			$admin_user->set_pass_msg('Product(s) status has been updated successfully.');
			Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'copy':
		if($_POST['copy_to']!=''):
			$QueryObj= new query('product');
			$QueryObj->Where="where id='".$_POST['pro_id']."'";
			$Data=MakeDataArray($QueryObj->DisplayOne(), array('id'));
			$Data['parent_id']=$_POST['copy_to'];
			$QueryObj1= new query('product');
			$QueryObj1->Data=$Data;
			$QueryObj1->Insert();
			$admin_session->set_pass_msg('Product has been updated successfully.');
		endif;
		Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		break;
	case'move':
		if($_POST['move_to']!=''):
			#Move the product to category.
			$QueryObj= new query('product');
			$QueryObj->Data['parent_id']=$_POST['move_to'];
			$QueryObj->Data['id']=$_POST['pro_id'];
			$QueryObj->Update();
			$admin_session->set_pass_msg('Product has been updated successfully.');
		endif;
		Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		break;
	case'delete':
		# delete all images:
		$product_id=$_GET['pro_id'];
		$query= new query('pimage');
		$query->Where="where product_id='$product_id'";
		$query->DisplayAll();
		while($obj=$query->GetObjectFromRecord()):
			delete_if_image_exists('product', 'large', $obj->image);
			delete_if_image_exists('product', 'medium', $obj->image);
			delete_if_image_exists('product', 'thumb', $obj->image);
			$q= new query('pimage');
			$q->id=$obj->id;
			$q->Delete();
		endwhile;

		#delete related products:
		$query= new query('related_product');
		$query->Where="where product_id='$product_id'";
		$query->Delete_where();

		#delete attributes
		$query= new query('attribute');
		$query->Where="where product_id='$product_id'";
		$query->DisplayAll();
		while($obj=$query->GetObjectFromRecord()):
			$qu= new query('attribute_value');
			$qu->Where="where attribute_id='$obj->id'";
			$qu->Delete_where();

			$qu= new query('attribute');
			$qu->id=$obj->id;
			$qu->Delete();
		endwhile;

		#delete actual product.
		$query= new query('product');
		$query->id=$product_id;
		$query->Delete();

		$admin_user->set_pass_msg('Product has been deleted.');
		Redirect(make_admin_url('product', 'list', 'list', 'id='.$id));
		break;
	case 'more_op':

		 # get category list array.
		 $product=get_object('product', $id);

		 $category_list=array();
		 $category_list=get_category_list();

		 $product_list=array();
		 $product_list=get_product_list();

		 # PRODUCT ATTRIBUTE CODE
		 $attribute= new query('attribute');
		 $attribute->Where="where product_id='$id'";
		 $attribute->DisplayAll();

		 $pimages= new query('pimage');
		 $pimages->Where="where product_id='$id'";
		 $pimages->DisplayAll();

		 $rproducts= new query('related_product');
		 $rproducts->Where="where product_id='$id'";
		 $rproducts->DisplayAll();
		 $selected_r_pro=array();
		 while($rp= $rproducts->GetObjectFromRecord()):
		 	$selected_r_pro[]=$rp->related_id;
		 endwhile;

		 if(is_var_set_in_post('new_attribute')):
		 	$query= new query('attribute');
		 	$query->Data=MakeDataArray($_POST, array('new_attribute'));
		 	$query->Insert();
		 	$admin_user->set_pass_msg('Attribute added successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#attributes'));
		 endif;

		 if(is_var_set_in_post('edit_attribute')):
		 	$query= new query('attribute');
		 	$query->Data=MakeDataArray($_POST, array('edit_attribute'));
		 	$query->Data['is_paid']=isset($_POST['is_paid'])?1:0;
		  	$query->Update();
		 	$admin_user->set_pass_msg('Attribute updated successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#attributes'));
		 endif;

		 if(isset($_GET['att_delete']) && $_GET['att_delete']==1):
		 	$query= new query('attribute');
		 	$query->id=$att_id;
		 	$query->Delete();
		 	$admin_user->set_pass_msg('Attribute deleted successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#attributes'));
		 endif;

		 if($att_value):
		 	$att= new query('attribute');
		 	$att->Where="where id='$att_id'";
		 	$att_detail=$att->DisplayOne();

		 	$attribute_values= new query('attribute_value');
		 	$attribute_values->Where="where attribute_id='$att_id'";
		 	$attribute_values->DisplayAll();
		 endif;

		 if(is_var_set_in_post('attribute_value')):
		 	$query= new query('attribute_value');
		 	$query->Data=MakeDataArray($_POST, array('attribute_value'));
		 	$query->Insert();
		 	$admin_user->set_pass_msg('Attribute value has been inserted.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_id='.$att_id.'&att_value=1#attributes'));
		 endif;

		 if(isset($_GET['delete_att_val'])):
		 	$query= new query('attribute_value');
		 	$query->id=$_GET['att_val_id'];
		 	$query->Delete();
		    $admin_user->set_pass_msg('Attribute value has been inserted.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'&att_id='.$att_id.'&att_value=1#attributes'));
		 endif;

		 #to fetch image
		 if(is_var_set_in_post('image_upload')):
		 	if(upload_photo('product', $_FILES['image'],$id)):
		 		$query= new  query('pimage');
		 		$query->Data['image']=make_image_name($_FILES['image']['name'], $id);
		 		$query->Data['product_id']=$id;
		 		$query->Insert();
		 	endif;
		 	$admin_user->set_pass_msg('Image uploaded successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;
			 
		 if(is_var_set_in_post('image_update'))://print_r($_POST['main_image']);exit;
		 	$query= new query('pimage');
		 	$query->Where="where product_id =$id";
		 	$query->Data['main_image']=0;
		 	$query->UpdateCustom();//print_r($query);print_r($_POST['main_image']);exit;
		 	foreach ($_POST['main_image'] as $key=>$value) {
		 		$query= new query('pimage');
		 		$query->Data['main_image']=1;
		 		$query->Data['id']=$value; 
		 		$query->Update();//print_r($query);exit;
		 	}
		 	$admin_user->set_pass_msg('Images position updated successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;

		 
		 if(is_var_set_in_post('image_position')):
		 	foreach ($_POST['position'] as $key=>$value) {
		 		$query= new query('pimage');
		 		$query->Data['position']=$value;
		 		$query->Data['id']=$key;
		 		$query->Update();
		 	}
		 	$admin_user->set_pass_msg('Images position updated successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;

		 if(isset($_GET['delete_image'])):
		 	$image=get_object('pimage', $_GET['delete']);
		 	$query= new query('pimage');
		 	$query->id=$_GET['delete'];
		 	$query->Delete();
		 	delete_if_image_exists('product', 'large', $image->image);
		 	delete_if_image_exists('product', 'thumb', $image->image);
		 	delete_if_image_exists('product', 'medium', $image->image);
		 	$admin_user->set_pass_msg('Image deleted successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;

		 if(is_var_set_in_post('move_product')):
		 	$query= new query('product');
		 	$query->Data['parent_id']=$_POST['move_to'];
		 	$query->Data['id']=$id;
		 	$query->Update();
		 	$admin_user->set_pass_msg('This product has been moved to target category successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;

		 if(is_var_set_in_post('copy_product')):
		 	$product=get_object('product', $id,'array');
		 	foreach ($_POST['copy_to'] as $k=>$v):
		 		#add product ... ... ... ...
		 		unset($product['id']);
		 		$query= new query('product');
		 		$query->Data=$product;
		 		$query->Data['parent_id']=$v;
		 		$query->Insert();
		 		$new_id= $query->GetMaxId();
		 		#copy all images
		 		copy_images($id, $new_id);
		 		#copy all related products
		 		copy_related_products($id, $new_id);
		 		#copy all attributes
		 		copy_attributes($id, $new_id);
		 	endforeach;
		 	$admin_user->set_pass_msg('This product has been copied to target category(s) successfully.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#images'));
		 endif;

		 if(is_var_set_in_post('related_product')):
		 	$q= new query('related_product');
		 	$q->Where="where product_id='$id'";
		 	$q->Delete_where();
		  	foreach ($_POST['rp_id'] as $k=>$v):
		 			$Quer= new query('related_product');
		 			$Quer->Data['related_id']=$v;
		 			$Quer->Data['product_id']=$id;
		 			$Quer->Insert();
		 	endforeach;
		 	$admin_user->set_pass_msg('Related products have been updated.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#related_products'));
		 endif;
		 
		  if(is_var_set_in_post('delete_related_product')):
		 	$q= new query('related_product');
		 	$q->Where="where product_id='$id'";
		 	$q->Delete_where();
		  	$admin_user->set_pass_msg('Related products have been updated.');
		 	Redirect(make_admin_url('product', 'more_op', 'more_op', 'id='.$id.'#related_products'));
		 endif;
		 break;
	case 'insert2':
		 #get category list array.
		 $product=get_object('product', $id);
		 $category_id=$product->parent_id;

		 $category_list=array();
		 $category_list=get_category_list();

		 $product_list=array();
		 $product_list=get_product_list();

		 #PRODUCT ATTRIBUTE CODE
		 $attribute= new query('attribute');
		 $attribute->Where="where product_id='$id'";
		 $attribute->DisplayAll();
		
		 $pimages= new query('pimage');
		 $pimages->Where="where product_id='$id'";
		 $pimages->DisplayAll();

		 #display all related products
		 $rproducts= new query('related_product');
		 $rproducts->Where="where product_id='$id'";
		 $rproducts->DisplayAll();
		 $selected_r_pro=array();
		 while($rp= $rproducts->GetObjectFromRecord()):
		 	$selected_r_pro[]=$rp->related_id;
		 endwhile;

		 #add new attribute
		 if(is_var_set_in_post('new_attribute')):
		 	$query= new query('attribute');
		 	$query->Data=MakeDataArray($_POST, array('new_attribute'));
		 	$query->Insert();
		 	$admin_user->set_pass_msg('Attribute added successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#attributes'));
		 endif;

		 #edit attribute
		 if(is_var_set_in_post('edit_attribute')):
		 	$query= new query('attribute');
		 	$query->Data=MakeDataArray($_POST, array('edit_attribute'));
		 	$query->Data['is_paid']=isset($_POST['is_paid'])?1:0;
		  	$query->Update();
		 	$admin_user->set_pass_msg('Attribute updated successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#attributes'));
		 endif;

		 #delete attribute
		 if(isset($_GET['att_delete']) && $_GET['att_delete']==1):
		 	$query= new query('attribute');
		 	$query->id=$att_id;
		 	$query->Delete();
		 	$admin_user->set_pass_msg('Attribute deleted successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#attributes'));
		 endif;

		 #get all attribute values
		 if($att_value):
		 	$att= new query('attribute');
		 	$att->Where="where id='$att_id'";
		 	$att_detail=$att->DisplayOne();

		 	$attribute_values= new query('attribute_value');
		 	$attribute_values->Where="where attribute_id='$att_id'";
		 	$attribute_values->DisplayAll();
		 endif;

		 #update/add attribute values
		 if(is_var_set_in_post('attribute_value')):
		 	$query= new query('attribute_value');
		 	$query->Data=MakeDataArray($_POST, array('attribute_value'));
		 	$query->Insert();
		 	$admin_user->set_pass_msg('Attribute value has been inserted.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'&att_id='.$att_id.'&att_value=1#attributes'));
		 endif;

		 #delete attribute values
		 if(isset($_GET['delete_att_val'])):
		 	$query= new query('attribute_value');
		 	$query->id=$_GET['att_val_id'];
		 	$query->Delete();
		    $admin_user->set_pass_msg('Attribute value has been inserted.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'&att_id='.$att_id.'&att_value=1#attributes'));
		 endif;

		#upload images
		 if(is_var_set_in_post('image_upload')):
		 	if(upload_photo('product', $_FILES['image'],$id)):
		 		$query= new  query('pimage');
		 		$query->Data['image']=make_image_name($_FILES['image']['name'],$id);
		 		$query->Data['product_id']=$id;
		 		$query->Insert();
		 	endif;
		 	$admin_user->set_pass_msg('Image uploaded successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#images'));
		 endif;
		
		 #udpate/set main image
		 if(is_var_set_in_post('image_update'))://print_r($_POST);exit;
		 	$query= new query('pimage');
		 	$query->Where="where product_id =$id";
		 	$query->Data['main_image']=0;
		 	$query->UpdateCustom();//print_r($query);print_r($_POST['main_image']);exit;
		 	foreach ($_POST['main_image'] as $key=>$value) {
		 		$query= new query('pimage');
		 		$query->Data['main_image']=1;
		 		$query->Data['id']=$value; 
		 		$query->Update();//print_r($query);exit;
		 	}
		 	$admin_user->set_pass_msg('Main image updated successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#images'));
		 endif;
		 
		 #udpate/set image position
		 if(is_var_set_in_post('image_position')):
		 	foreach ($_POST['position'] as $key=>$value) {
		 		$query= new query('pimage');
		 		$query->Data['position']=$value;
		 		$query->Data['id']=$key;
		 		$query->Update();
		 	}
		 	$admin_user->set_pass_msg('Images position updated successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#images'));
		 endif;

		 #delete image
		 if(isset($_GET['delete_image'])):
		 	$image=get_object('pimage', $_GET['delete']);
		 	$query= new query('pimage');
		 	$query->id=$_GET['delete'];
		 	$query->Delete();
		 	delete_if_image_exists('product', 'large', $image->image);
		 	delete_if_image_exists('product', 'thumb', $image->image);
		 	delete_if_image_exists('product', 'medium', $image->image);
		 	$admin_user->set_pass_msg('Image deleted successfully.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#images'));
		 endif;

		 #update related products.
		 if(is_var_set_in_post('related_product')):
		 	$q= new query('related_product');
		 	$q->Where="where product_id='$id'";
		 	$q->Delete_where();
		  	foreach ($_POST['rp_id'] as $k=>$v):
		 			$Quer= new query('related_product');
		 			$Quer->Data['related_id']=$v;
		 			$Quer->Data['product_id']=$id;
		 			$Quer->Insert();
		 	endforeach;
		 	$admin_user->set_pass_msg('Related products have been updated.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#related_products'));
		 endif;
		 
		 if(is_var_set_in_post('delete_related_product')):
		 	$q= new query('related_product');
		 	$q->Where="where product_id='$id'";
		 	$q->Delete_where();
		  	$admin_user->set_pass_msg('Related products have been updated.');
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id.'#related_products'));
		 endif;

		 #activate/ de activate the product.
		 if(isset($_GET['event']) && $_GET['event']=='activate'):
		 	$q= new query('product');
		 	$q->Data['id']=$id;
		 	$q->Data['is_active']=($_GET['make_active']=='yes')?1:0;
		 	$q->Update();
		 	Redirect(make_admin_url('product', 'insert2', 'insert2', 'id='.$id));
		 endif;

		 break;
	default:break;
endswitch;
?>
