<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj= new query();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='lists';
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=50;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		$id=$_GET['id'];
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='lists';
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('lists', 'list', 'list','id='.$id));
		exit;	
		break;
	default:break;
endswitch;
?>
