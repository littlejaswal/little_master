<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['type'])?$type=$_GET['type']:$type='is_active';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('product');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->Where="where ".$type."='1'";
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('product');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('sproduct', 'list', 'list'));
		endif;
		break;
	case'update':
		if(isset($_GET['submit'])):
			$QueryObj = new query('product');
			$not=array('submit');
			$QueryObj->Data['id']=$_GET['id'];
			$QueryObj->Data[$type]=0;
			$QueryObj->Update();
			Redirect(make_admin_url('sproduct', 'list', 'list', 'type='.$type));
		endif;
		break;
	case'delete':
		$QueryObj = new query('product');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('sproduct', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
