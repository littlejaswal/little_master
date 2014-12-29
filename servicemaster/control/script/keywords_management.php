<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('keywords');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('keywords');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('keywords_management', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('keywords');
		$QueryObj->Where="where id='".$id."'";
		$keywords=$QueryObj->DisplayOne();
		//print_r($keywords);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('keywords');
			$not=array('submit', 'is_active', 'free_paid', 'register_on_off');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;

			$QueryObj->Update();
			Redirect(make_admin_url('keywords_management', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('keywords');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('keywords_management', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
