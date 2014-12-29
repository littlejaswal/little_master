<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('user');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
		break;
	case'insert':
	        if(isset($_POST['submit'])):
			$QueryObj = new query('user');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['is_email_verified']=1;
			$QueryObj->Insert();
			$sendto=$QueryObj->Data['username'];
			$UserName=$QueryObj->Data['username'];
			$Password=$_POST['password'];
			include_once(DIR_FS_SITE_INCLUDE_EMAIL.'AccountDetails.php');
			send_email(SUBJECT_REGISTER_EMAIL, $sendto, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
			$admin_user->set_pass_msg('New user has been created and mailed  successfully.');
			Redirect(make_admin_url('user', 'list', 'list'));
		endif;
			break;
	case'download':
		download_users();
		Redirect(make_admin_url('user'));
		break;
	case'update':
		break;
	case'delete':
		if(isset($_GET['delete'])):
			$query= new query('user');
			$query->id=$_GET['id'];
			$query->Delete();		
		endif;
		Redirect(make_admin_url('user'));
		break;
	default:break;
endswitch;
?>