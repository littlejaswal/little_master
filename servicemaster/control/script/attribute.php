<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('attribute');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('attribute');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('attribute', 'list', 'list'));
		endif;
		break;
	case'update':
		
		$QueryObj = new query('attribute');
		$QueryObj->Where="where id='".$id."'";
		$attribute=$QueryObj->DisplayOne();
		//print_r($attribute);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('attribute');
			$not=array('submit', 'is_deault', 'is_free');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_default']=isset($_POST['is_default'])?1:0;
			$QueryObj->Data['is_free']=isset($_POST['is_free'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('attribute', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('attribute');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('attribute', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
