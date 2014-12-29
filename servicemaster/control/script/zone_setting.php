<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['zone_id'])?$zone_id=$_GET['zone_id']:$zone_id='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('zone_setting');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->Where="where id='".$zone_id."'";
		$QueryObj->DisplayAll();
		#get all zones;
		$queryz= new query('zone');
		$queryz->DisplayAll();
		
		#get all shipping types for listing;
		$querys= new query('shipping');
		$querys->DisplayAll();
		
		#get all shipping types for update;
		$querysu= new query('shipping');
		$querysu->DisplayAll();
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('zone_setting');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('zone_setting', 'list', 'list'));
		endif;
		break;
	case'update':
		$QueryObj = new query('zone_setting');
		$QueryObj->Where="where id='".$id."'";
		$zone_setting=$QueryObj->DisplayOne();
		//print_r($zone_setting);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('zone_setting');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
		//	$QueryObj->print=1;
			//$QueryObj->Data['is_active']=isset($_POST['is_active'])?1:0;
			$QueryObj->Update();
			Redirect(make_admin_url('zone_setting', 'list', 'list'));
		endif;
		break;
	case'delete':
		$QueryObj = new query('zone_setting');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('zone_setting', 'list', 'list'));
		break;
	default:break;
endswitch;
?>
