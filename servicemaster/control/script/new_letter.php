<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='1';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj= new query();
		$QueryObj->TableName='emails';
		$QueryObj->Where="where id='$id'";
		$Email=$QueryObj->DisplayOne();
		break;
	case'insert':
		if(isset($_POST['submit']) && $_POST['submit']=='Save'):
			$QueryObj= new query();
			$QueryObj->TableName='emails';
			$QueryObj->Data['Content']=$_POST['Content'];
			$QueryObj->Data['Created']=date("Y-m-d H:i:s");
			$QueryObj->Data['Name']=$_POST['title'];
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Newsletter has been added successfully');
			$id=$QueryObj->GetMaxId();
			Redirect(make_admin_url('letters', 'list', 'list'));
		endif;	
		break;
	case'update':
		if(isset($_POST['submit']) && $_POST['submit']=='Save'):
			$QueryObj= new query();
			$QueryObj->TableName='emails';
			$QueryObj->Data['Content']=$_POST['Content'];
			$QueryObj->Data['Created']=date("Y-m-d H:i:s");
			$QueryObj->Data['Name']=$_POST['title'];
			$QueryObj->Data['id']=$_POST['id'];
			$QueryObj->Update();
			$admin_user->set_pass_msg('Newsletter updated successfully');
			Redirect(make_admin_url('letters', 'list', 'list'));
		elseif(isset($_POST['submit']) && $_POST['submit']=='Save as new'):
			$QueryObj= new query();
			$QueryObj->TableName='emails';
			$QueryObj->Data['Content']=$_POST['Content'];
			$QueryObj->Data['Created']=date("Y-m-d H:i:s");
			$QueryObj->Data['Name']=$_POST['title'];
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Newsletter updated successfully');
			$id=$QueryObj->GetMaxId();
			Redirect(make_admin_url('letters', 'list', 'list'));
		endif;
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>