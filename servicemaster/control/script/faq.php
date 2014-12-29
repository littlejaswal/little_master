<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('faq');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('faq');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('faq', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('faq');
		$QueryObj->Where="where id='".$id."'";
		$news=$QueryObj->DisplayOne();
		if(isset($_POST['submit'])):
			$QueryObj = new query('faq');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('faq', 'list', 'list'));
		endif;
		break;
		case'update2':
		$chip_info= new query('faq');
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
					$QueryObj1 = new query('faq');
					$QueryObj1->Data['is_active']=0;
					$QueryObj1->Data['id']=$k;
					$QueryObj1->Update();
			endforeach;
	   		endif;
	   	
			foreach ($_POST['is_active'] as $k=>$v):
					$QueryObj = new query('faq');
					$QueryObj->Data['is_active']=1;
					$QueryObj->Data['id']=$k;
					$QueryObj->Update();
			endforeach;
			Redirect(make_admin_url('faq', 'list', 'list'));
		 endif;	
		break;
	case'delete':
		$QueryObj = new query('faq');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('faq', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
