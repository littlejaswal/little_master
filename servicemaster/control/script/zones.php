<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('zone');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=ADMIN_CATEGORY_PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('zone');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			$admin_user->set_pass_msg('Zone has been added successfully.');
			Redirect(make_admin_url('zones', 'list', 'list'));
		endif;
		break;
	case'update':
		//print_r($_POST);exit;
		if(isset($_POST['submit'])):
			#set all the zone id to zero.
			$Query= new query('shipping_country');
			$Query->Where="where zone_id='".$id."'";
			$Query->DisplayAll();
			while($newSC= $Query->GetObjectFromRecord()):
				$QueryNew= new query('shipping_country');
				$QueryNew->Data['id']=$newSC->id;
				$QueryNew->Data['zone_id']=0;
				$QueryNew->Update();	
			endwhile;
			#update name;
			$QueryObj = new query('zone');
			$not=array('submit', 'country');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Update();
			#update country list with zoneids.
			foreach ($_POST['country'] as $k=>$v):
				$QueryNew= new query('shipping_country');
				$QueryNew->Data['id']=$v;
				$QueryNew->Data['zone_id']=$id;
				$QueryNew->Update();	
			endforeach;
			Redirect(make_admin_url('zones', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('zone');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		$admin_user->set_pass_msg('Zone has been deleted.');
		Redirect(make_admin_url('zones', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
