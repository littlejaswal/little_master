<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('news');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('news');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('news', 'list', 'list'));
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
		case'update2':
		$chip_info= new query('news');
		$chip_info->Where="where is_active='1'";
		$chip_info->DisplayAll();
		$chip1=array();
		while($pa= $chip_info->GetObjectFromRecord()):
			$chip1[$pa->id]=$pa->name;
		endwhile;
		if(isset($_POST['update_position'])):
				foreach($_POST['position'] as $k=>$v):
					$Q= new query('news');
					if($v==''):
						$Q->Data['position']=0;
					else:
						$Q->Data['position']=$v;
					endif;
					$Q->Data['id']=$k;
					$Q->Update();
				endforeach;
			endif;
	   if(isset($_POST['submit'])):
				$query= new query('news');
				$query->Data['is_active']=0;
				$query->UpdateCustom();
				foreach($_POST['is_active'] as $k=>$v):
					$query= new query('news');
					$query->Data['is_active']=1;
					$query->Data['id']=$k;
					$query->Update();
				endforeach;
			endif;
			Redirect(make_admin_url('news', 'list', 'list', 'id='.$id));
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
