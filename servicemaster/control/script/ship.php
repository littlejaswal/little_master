<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('shipping');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['new'])):
			$QueryObj = new query('shipping');
			$not=array('new');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('ship', 'list', 'list'));
		endif;
		break;
	case'update':
		if(isset($_POST['edit'])):
			$QueryObj = new query('shipping');
			$not=array('edit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Update();
			Redirect(make_admin_url('ship', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('shipping');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('ship', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
