<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['zsid'])?$zsid=$_GET['zsid']:$zsid='0';

#handle actions here.
switch ($action):
	case'list':
		$QueryObj = new query('shipping_value');
		$QueryObj->Where="where zsid='".$zsid."'";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=PAGE_SIZE;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->DisplayAll();
		
		$zqu= new query('zone_setting');
		$zqu->Where="where id='".$zsid."'";
		$zoneq=$zqu->DisplayOne();
		
		$zone= new query('zone');
		$zone->Where="where id='".$zoneq->zone_id."'";
		$zones=$zone->DisplayOne();
		
		$shipt= new query('shipping');
		$shipt->Where="where id='".$zoneq->shipping_type."'";
		$shipping_type=$shipt->DisplayOne();
		
		break;
	case'insert':
		if(isset($_POST['submit'])):
			$QueryObj = new query('shipping_value');
			$not=array('submit');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Insert();
			Redirect(make_admin_url('shipping', 'list', 'list', 'zsid='.$zsid));
		endif;
		break;
	case'update':
		//$QueryObj = new query('shipping_value');
		//$QueryObj->Where="where id='".$id."'";
		//$shipping_value=$QueryObj->DisplayOne();
		//print_r($shipping_value);exit;
		if(isset($_POST['submit'])):
			$QueryObj = new query('shipping_value');
			$not=array('submit', 'is_active');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			$QueryObj->Data['zsid']=$zsid;
			$QueryObj->Update();
			Redirect(make_admin_url('shipping', 'list', 'list', 'zsid='.$zsid));
		endif;
		break;
	case'delete':
		$QueryObj = new query('shipping_value');
		$QueryObj->id=$id;
		$QueryObj->Delete();
		Redirect(make_admin_url('shipping', 'list', 'list', 'zsid='.$zsid));
		break;
	default:break;
endswitch;
?>
