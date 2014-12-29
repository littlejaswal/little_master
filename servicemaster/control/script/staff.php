<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('staff');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
		break;
	case'insert':
	        if(isset($_POST['submit'])):
				$QueryObj = new query('staff');
				$not=array('submit');
				$QueryObj->Data=MakeDataArray($_POST, $not);
				$QueryObj->Insert();
				$sendto=$QueryObj->Data['username'];
				$password=$QueryObj->Data['password'];
				include_once(DIR_FS_SITE_INCLUDE_EMAIL.'staff_register.php');
				send_email(SUBJECT_REGISTER_EMAIL, $sendto, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
				$admin_user->set_pass_msg('New staff member has been created and login details have been emailed to his email address successfully.');
				Redirect(make_admin_url('staff', 'list', 'list'));
			endif;
			break;
	case'download':
		download_staff();
		Redirect(make_admin_url('staff'));
		break;
	case'update':
		break;
	case'delete':
		if(isset($_GET['delete'])):
			$query= new query('staff');
			$query->id=$_GET['id'];
			$query->Delete();		
		endif;
		Redirect(make_admin_url('staff'));
		break;
	default:break;
endswitch;
?>