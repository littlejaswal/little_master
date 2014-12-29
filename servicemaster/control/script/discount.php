<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('discount');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('discount');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('discount', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('discount');
		$QueryObj->Where="where id='".$id."'";
		$discount=$QueryObj->DisplayOne();
		//print_r($discount);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('discount');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['apply_to_all']=isset($_POST['apply_to_all'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('discount', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('discount');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('discount', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
