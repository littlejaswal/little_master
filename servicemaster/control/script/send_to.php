<?
set_time_limit(300);
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';

#handle actions here.
switch ($action):
	case 'newsletterUsersList':
		# get newsletters
		$QueryObj= new query();
		$QueryObj->TableName='emails';
		$QueryObj->Where="where id='".$id."'";
		$newsletter=$QueryObj->DisplayOne();
		
		# get newsletter users from lists	
		$QueryObj= new query();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='lists';
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=50;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	
	case 'registeredUsersList':
		# get newsletters
		$QueryObj= new query();
		$QueryObj->TableName='emails';
		$QueryObj->Where="where id='".$id."'";
		$newsletter=$QueryObj->DisplayOne();
		
		#get registerd users who has choosen newsletter
		$QueryObjUser= new query();
		$QueryObjUser->InitilizeSQL();
		$QueryObjUser->TableName='user';
		$QueryObjUser->Where="where newsletter=1";
		$QueryObjUser->AllowPaging=true;
		$QueryObjUser->PageSize=50;
		$QueryObjUser->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObjUser->DisplayAll();
		break;
		
	case 'send':
		$count=0;
		//print_r($_POST);exit;
		if(isset($_POST['submit']) && $_POST['submit']=='Send'):
			foreach ($_POST['email'] as $k=>$v):
					$pag= new query();
					$pag->TableName='emails';	
					$pag->Where="where id='".$id."'";
					$content=$pag->DisplayOne();
					$content1=html_entity_decode($content->Content);
					++$count;
					SendEmail($content->Name, $v, ADMIN_EMAIL, SITE_NAME, html_entity_decode($content1), BCC_EMAIL, 'html');
			endforeach;
			ob_clean();
			$admin_user->set_pass_msg('Newsletter has been sent to '.$count.' user(s)');
			Redirect(make_admin_url('letters', 'list', 'list'));
		endif;
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
