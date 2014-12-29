<?php
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

switch ($action):
	case'list':
		$QueryObj = new query('content_collection');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('content_collection');
			$not=array('submit','is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['is_active']=(isset($_POST['is_active']) && $_POST['is_active']=='yes')?$_POST['is_active']:'no';
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Content Collection has been inserted successfully.');
			Redirect(make_admin_url('content_collection', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('content_collection');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('content_collection');
			$not=array('submit','is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['is_active']=(isset($_POST['is_active']) && $_POST['is_active']=='yes')?$_POST['is_active']:'no';
			$QueryObj->Data['id']=$_POST['id'];
			$QueryObj->Update();
			$admin_user->set_pass_msg('Content Collection has been updated successfully.');
			Redirect(make_admin_url('content_collection', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('content_collection');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		$admin_user->set_pass_msg('Content Collections has been deleted successfully.');
		Redirect(make_admin_url('content_collection', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
