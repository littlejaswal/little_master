<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		update_last_access($admin_user->get_user_id(), 0);
		session_destroy();
		Redirect(DIR_WS_SITE.ADMIN_FOLDER.'/index.php');
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('demo', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('news');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		//print_r($news);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('news', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('news');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('news', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
