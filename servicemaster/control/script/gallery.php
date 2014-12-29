<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		# get all categories.
		$QueryObj = new query('gallery');
		$QueryObj->Where="where parent_id='".$id."'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=8;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['new_category']) && $_POST['new_category']=='Submit'):
			$not=array('new_category');
			$QueryObj =new query('gallery');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['parent_id']=$id;
			#add image if uploaded.
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=make_image_name($_FILES['image']['name'], '0'); 
			endif;
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Category has been inserted successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'update':
		if(isset($_GET['cat_id'])):
			$QueryObj =new query('gallery');
			$QueryObj->Where="where id='$_GET[cat_id]'";
			$category=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['update_category']) && $_POST['update_category']=='Submit'):
			$not=array('update_category');
			$QueryObj =new query('gallery');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['parent_id']=$id;
			#add image if uploaded
			if(upload_photo('gallery', $_FILES['image'])):
				$QueryObj->Data['image']=make_image_name($_FILES['image']['name'], '0'); 
			endif;
			$QueryObj->Update();
			$admin_user->set_pass_msg('Category has been updated successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		
		if(is_var_set_in_post('submit_active')):
			foreach ($_POST['is_active'] as $k=>$v):
				$q= new query('gallery');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;
			$admin_user->set_pass_msg('Category status has been updated successfully.');
			Redirect(make_admin_url('gallery', 'list', 'list', 'id='.$id));
		endif;
		break;
	case'delete':
		$QueryObj = new query('gallery');
		$QueryObj->id=$_GET['cat_id'];
		$QueryObj->Delete();
		Redirect(make_admin_url('gallery', 'list', 'list','id='.$id));
		break;
	default:break;
endswitch;
?>
