<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';

#handle actions here.
switch ($action):
	case'list':
		# get all categories.
		$QueryObj = new query('category');
		$QueryObj->Where="where parent_id='".$id."' order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['new_category']) && $_POST['new_category']=='Submit'):
			$not=array('new_category');
			$QueryObj =new query('category');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['parent_id']=$id;
			$QueryObj->Insert();
			$category_id=$QueryObj->GetMaxId();
//			print_r($category_id);exit;
			$QueryObj= new query('category');
			$QueryObj->Data['id']=$category_id;
			#add image if uploaded.
			if(upload_photo('category', $_FILES['image'], $category_id)):
				$QueryObj->Data['image']=make_image_name($_FILES['image']['name'], $category_id);
				$QueryObj->Update();
			endif;
			//if(upload_banner('category', $_FILES['banner'],$category_id)):
			if(upload_banner('banner', $_FILES['banner'], $category_id)):
				$QueryObj->Data['banner']=make_image_name($_FILES['banner']['name'], $category_id);
				$QueryObj->Update();
			endif;
			//$QueryObj->print=1;
//			$QueryObj->Insert();
			$admin_user->set_pass_msg('Category has been inserted successfully.');
			Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':
		if(isset($_GET['cat_id'])):
			$QueryObj =new query('category');
			$QueryObj->Where="where id='$_GET[cat_id]'";
			$category=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
			$not=array('update_category');
			$QueryObj =new query('category');
			$data=MakeDataArray($_POST, $not);//print_r($_POST);exit;
			$QueryObj->Data=$data;
			$QueryObj->Data['parent_id']=$id;
			#add image if uploaded
			$error='';
			if(isset($_FILES['image'])):
				if(upload_photo('category', $_FILES['image'], $_POST['id'])):
				//print_r($_POST);exit;
					$object= get_object('category', $_POST['id']);
					delete_if_image_exists('category', 'large', $object->image);
					delete_if_image_exists('category', 'thumb', $object->image);
					delete_if_image_exists('category', 'medium', $object->image);
					$QueryObj->Data['image']=make_image_name($_FILES['image']['name'], $_POST['id']);
				endif;
			endif;
//			if(upload_banner('banner', $_FILES['banner'],$_POST['id'])):
//				$object= get_object('banner', $_POST['id']);
//				delete_if_image_exists('banner', 'large', $object->banner);
//				delete_if_image_exists('banner', 'thumb', $object->banner);
//				delete_if_image_exists('banner', 'medium', $object->banner);
//				$QueryObj->Data['banner']=$_FILES['banner']['name'];
//			endif;
			if(isset($_FILES['banner'])):
				if(upload_banner('banner', $_FILES['banner'])):
					$object= get_object('banner');
					delete_if_image_exists('banner', 'large', $object->banner);
					delete_if_image_exists('banner', 'thumb', $object->banner);
					delete_if_image_exists('banner', 'medium', $object->banner);
					$QueryObj->Data['banner']=$_FILES['banner']['name'];
				endif;
			endif;
			//$QueryObj->print=1;
			$QueryObj->Update();
			$admin_user->set_pass_msg('Category has been updated successfully.');
			Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
		endif;
		break;
	case 'update2':

			if(isset($_GET['up'])):  #reduce the position number
				$catlist=array();
				$query= new query('category');
				$query->Field='id, position';
				$query->Where="where parent_id='$id' order by position asc";
				$query->DisplayAll();
				while($obj=$query->GetObjectFromRecord()):
					$catlist[$obj->id]=$obj->position;
				endwhile;

				for($i=0;$i<$_GET['up'];$i++):
					$current=0;
					$prev=0;
					foreach ($catlist as $k=>$v):
						if($k==$_GET['cat_id']):
							$current=$k;
							break;
						else:
							$prev=$k;
						endif;
					endforeach;
					if($prev==0):
						$prev=$current;
					endif;
					$cpos=$catlist[$current];
					$catlist[$current]=$catlist[$prev];
					$catlist[$prev]=$cpos;

				endfor;
				foreach ($catlist as $k=>$v):
					if($k!='' && $v!=''):
						$query= new query('category');
						$query->Data['id']=$k;
						$query->Data['position']=$v;
						$query->Update();
					endif;
				endforeach;

				$admin_user->set_pass_msg('Catgory position has been updated successfully.');
				Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
			endif;

			if(isset($_GET['down'])):  #reduce the position number
				$catlist=array();
				$query= new query('category');
				$query->Field='id, position';
				$query->Where="where parent_id='$id' order by position asc";
				$query->DisplayAll();
				while($obj=$query->GetObjectFromRecord()):
					$catlist[$obj->id]=$obj->position;
				endwhile;

				for($i=0;$i<$_GET['down'];$i++):
					$current=0;
					$prev=0;
					$p=0;
					foreach ($catlist as $k=>$v):
						if($k==$_GET['cat_id']):
							$current=$k;
							$p=1;
						elseif($p):
							$prev=$k;
							break;
						endif;
					endforeach;
					if($prev==0):
						$prev=$current;
					endif;
					$cpos=$catlist[$current];
					$catlist[$current]=$catlist[$prev];
					$catlist[$prev]=$cpos;
				endfor;

				foreach ($catlist as $k=>$v):
					if($k!='' && $v!=''):
						$query= new query('category');
						$query->Data['id']=$k;
						$query->Data['position']=$v;
						$query->Update();
					endif;
				endforeach;

				$admin_user->set_pass_msg('Catgory position has been updated successfully.');
				Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
			endif;

			if(isset($_POST['submit_position'])):
				//unset($_POST['submit_position']);
				foreach ($_POST['position'] as $k=>$v):
					$q=new query('category');
					$q->Data['id']=stripslashes($k);
					$q->Data['position']=$v;
					$q->Update();
				endforeach;
				$admin_user->set_pass_msg('Catgory position has been updated successfully.');
				Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
			endif;

			if(isset($_POST['submit_active'])):
				//unset($_POST['submit_position']);
				foreach ($_POST['is_active'] as $k=>$v):
					$q=new query('category');
					$q->Data['id']=stripslashes($k);
					$q->Data['is_active']=$v;
					$q->Update();
				endforeach;
				$admin_user->set_pass_msg('Catgory status has been updated successfully.');
				Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
			endif;
			break;

	case'delete':
		# check if sub-cateogries or products exist.
		if(if_sub_cat_or_product_exist($_GET['cat_id'])):
			$admin_user->set_pass_msg('Category can\'t be deleted. It either contains sub-categories or products. Please firstly delete all its sub-categories and products, to delete it.');
			Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
		endif;
		$object= get_object('category', $_GET['cat_id']);
		delete_if_image_exists('category', 'large', $object->image);
		delete_if_image_exists('category', 'thumb', $object->image);
		delete_if_image_exists('category', 'medium', $object->image);
		$QueryObj =new query('category');
		$QueryObj->id=$_GET['cat_id'];
		$QueryObj->Delete();
		$admin_user->set_pass_msg('Category has been deleted successfully.');
		Redirect(make_admin_url('category', 'list', 'list', 'id='.$id));
		break;

	case'download':
		download_products();
		Redirect(make_admin_url('product'));
		break;
	default:break;
endswitch;
?>
