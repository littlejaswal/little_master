<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		case'list':
		$QueryObj = new query('tag_cloud');
		//$QueryObj->Where="order by id desc";
		//$QueryObj->Where="order by position";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
	        if(isset($_POST['submit'])):
			$QueryObj = new query('tag_cloud');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('tag_cloud', 'list', 'list'));
		endif;
			break;
	case'update':
		$QueryObj = new query('tag_cloud');
		$QueryObj->Where="where id='".$id."'";
		$tag_cloud=$QueryObj->DisplayOne();
		
		if(isset($_POST['submit'])):
			$QueryObj = new query('tag_cloud');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			//$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Data['is_active']=$_POST['is_active'];
			$QueryObj->Update();
			Redirect(make_admin_url('tag_cloud', 'list', 'list'));
		endif;
	break;
	
		case'update2':
		$QueryObj= new query('tag_cloud');
		$QueryObj->Where="where is_active='1'";
		$QueryObj->DisplayAll();
		$ObjArray=array();
		while($pa= $QueryObj->GetObjectFromRecord()):
			$ObjArray[$pa->id]=$pa->tag_name;
		endwhile;
		
	   if(isset($_POST['submit'])):
	   		$act_count=array();
	   		foreach ($ObjArray as $kk=>$vv):
	   		if(!in_array($vv,$_POST['is_active'])):
	   		$act_count[$kk]=$vv;
	   		endif;
	   		endforeach;
	   		
	   		if(sizeof($act_count)!=0):
	   		foreach($act_count as $k=>$v):
					$QueryObj1 = new query('tag_cloud');
					$QueryObj1->Data['is_active']=0;
					$QueryObj1->Data['id']=$k;
					$QueryObj1->Update();
			endforeach;
	   		endif;
	   	
			foreach ($_POST['is_active'] as $k=>$v):
					$QueryObj = new query('tag_cloud');
					$QueryObj->Data['is_active']=1;
					$QueryObj->Data['id']=$k;
					$QueryObj->Update();
			endforeach;
			$admin_user->set_pass_msg('Tag cloud has been updated successfully.');
			Redirect(make_admin_url('tag_cloud', 'list', 'list'));
		 endif;	
		break;
		
	
	case'delete':
	   	$QueryObj = new query('tag_cloud');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('tag_cloud', 'list', 'list'));
		break;
	default:break;
endswitch;
?>