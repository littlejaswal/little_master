<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['page'])?$page=$_GET['page']:$page='1';
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
				$not=array('submit', 'password', 'username', 'is_active');
				$data=MakeDataArray($_POST, $not);
				$allow_data='home@@logout';
				if(isset($data['allow_pages_all'])):
					$allow_data='*';
				elseif(is_array($data['allow_pages'])):
					$allow_data=implode('@@',$data['allow_pages']);
				endif;
				
				$QueryObj->Data['username']=$_POST['username'];
				$QueryObj->Data['password']=$_POST['password'];
				$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
				$QueryObj->Data['allow_pages']=$allow_data;
				$QueryObj->Insert();
				Redirect(make_admin_url('admin', 'list', 'list'));
                                  elseif(isset($_POST['cancel'])):
                                  $admin_user->set_pass_msg('The operation has been cancelled');
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
                $QueryObj->Where="where id='$_POST[id]'";
			    $not=array('submit', 'password', 'username', 'is_active');
				$data=MakeDataArray($_POST, $not);
				$allow_data='home@@logout';
				if(isset($data['allow_pages_all'])):
					$allow_data='*';
				elseif(is_array($data['allow_pages'])):
					$allow_data=implode('@@',$data['allow_pages']);
				endif;
				$QueryObj->Data['username']=$_POST['username'];
				$QueryObj->Data['password']=$_POST['password'];
				$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
				$QueryObj->Data['allow_pages']=$allow_data;
			$QueryObj->UpdateCustom();
			$admin_user->set_pass_msg('Admin user has been updated successfully.');
                          Redirect(make_admin_url('admin', 'list', 'list'));
                          elseif(isset($_POST['cancel'])):
                          $admin_user->set_pass_msg('The operation has been cancelled');
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
		/* if(isset($_POST['submit'])):
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
			endforeach;*/
			if(is_var_set_in_post('submit')):
			foreach ($_POST['is_active'] as $k=>$v):
				$q= new query('admin_user');
				$q->Data['id']=$k;
				$q->Data['is_active']=$v;
				$q->Update();
			endforeach;
			endif;
			if(isset($_POST['multiopt_go']) && $_POST['multiopt_go']=='Go'):
                            if($_POST['multiopt_action']=='delete'):
                                foreach($_POST['multiopt'] as $k=>$v):
                                        $query= new query('admin_user');
                                        $query->id="$k";
                                        $query->Delete();
                                endforeach;
                            endif;
                        endif;             
			Redirect(make_admin_url('admin', 'list', 'list'));	
		break;
	case'delete':
		if(isset($_GET['delete'])):
			$query= new query('admin_user');
			$query->id=$_GET['id'];
			$query->Delete();		
		endif;		$admin_user->set_pass_msg('User Record has been Deleted successfully.');
		Redirect(make_admin_url('admin'));
		break;
	case 'status':
		$status=$_GET['status'];
		$QueryObj = new query('admin_user');
		$QueryObj->Data['is_active']="$status";
		$QueryObj->Data['id']=$id;
		$QueryObj->Update();
		$admin_user->set_pass_msg('Admin status has been updated successfully.');
		Redirect(make_admin_url('admin', 'list', 'list','id='.$id.'&page='.$page));
	default:break;
endswitch;
?>