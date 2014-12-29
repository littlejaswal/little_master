<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('event');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('event');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('event', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('event');
		$QueryObj->Where="where id='".$id."'";
		$event=$QueryObj->DisplayOne();
		//print_r($event);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('event');
			$not=array('submit', 'is_active', 'free_paid', 'register_on_off');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Data['free_paid']=isset($_POST['free_paid'])?1:0;
			$QueryObj->Data['register_on_off']=isset($_POST['register_on_off'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('event', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('event');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('event', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
