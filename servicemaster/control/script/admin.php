<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('admin_user');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->DisplayAll();
		break;
	case'insert':
	        if(isset($_POST['submit'])):
			$QueryObj = new query('admin_user');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			$sendto=$QueryObj->Data['username'];
			$UserName=$QueryObj->Data['username'];
			$Password=$_POST['password'];
			$admin_user->set_pass_msg('New admin user has been created successfully.');
			Redirect(make_admin_url('admin', 'list', 'list'));
		endif;
			break;
	
	case'update':
		if($id!=0):
			$QueryObj =new query('admin_user');
			$QueryObj->Where="where id='".$id."'";
			$page_cotent=$QueryObj->DisplayOne();
		endif;
		if(isset($_POST['submit'])):
			$QueryObj = new query('admin_user');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?'1':'0';
			$QueryObj->Update();
			$admin_user->set_pass_msg('Admin user has been updated successfully.');
			Redirect(make_admin_url('admin', 'list', 'list'));
		endif;
		break;
		case'update2':
		$chip_info= new query('admin_user');
		$chip_info->Where="where is_active='1'";
		$chip_info->DisplayAll();
		$chip1=array();
		while($pa= $chip_info->GetObjectFromRecord()):
			$chip1[$pa->id]=$pa->name;
		endwhile;
		 if(isset($_POST['submit'])):
	   		$act_count=array();
	   		foreach ($chip1 as $kk=>$vv):
	   		if(!in_array($vv,$_POST['is_active'])):
	   		$act_count[$kk]=$vv;
	   		endif;
	   		endforeach;
	   		
	   		if(sizeof($act_count)!=0):
	   		foreach($act_count as $k=>$v):
					$QueryObj1 = new query('admin_user');
					$QueryObj1->Data['is_active']=0;
					$QueryObj1->Data['id']=$k;
					$QueryObj1->Update();
			endforeach;
	   		endif;
	   	
			foreach ($_POST['is_active'] as $k=>$v):
					$QueryObj = new query('admin_user');
					$QueryObj->Data['is_active']=1;
					$QueryObj->Data['id']=$k;
					$QueryObj->Update();
			endforeach;
			Redirect(make_admin_url('admin', 'list', 'list'));
		 endif;	
		break;
	case'delete':
		if(isset($_GET['delete'])):
			$query= new query('admin_user');
			$query->id=$_GET['id'];
			$query->Delete();		
		endif;
		Redirect(make_admin_url('admin'));
		break;
	default:break;
endswitch;
?>