<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('country');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=300;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
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
		if(is_var_set_in_post('submit_update')):
			foreach ($_POST['is_active'] as $k=>$v):
				$q= new query('country');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;
			$admin_user->set_pass_msg('Country status has been updated successfully.');
			Redirect(make_admin_url('update', 'list', 'list'));
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
