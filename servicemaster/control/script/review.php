<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['r_type'])?$type=$_GET['r_type']:$type='1';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('review');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->Where="where type='$type' order by on_date";
		$QueryObj->DisplayAll();
		break;
	case'set_type':
		$QueryObj = new query('review');
		$QueryObj->Data['id']=$id;
		$QueryObj->Data['type']=$_GET['set_type'];
		$QueryObj->Update();
		Redirect(make_admin_url('review', 'list', 'list', 'r_type='.$type));
		break;
	case'update':
		$QueryObj = new query('review');
		$QueryObj->Where="where id='".$id."'";
		$review=$QueryObj->DisplayOne();
		//print_r($review);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('review');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('review', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('review');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('review', 'list', 'list', 'r_type='.$type));
		break;
	default:break;
endswitch;
?>
