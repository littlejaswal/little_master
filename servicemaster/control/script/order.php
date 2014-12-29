<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['oby'])?$oby=$_GET['oby']:$oby='order_date';
isset($_GET['so'])?$so=$_GET['so']:$so='desc';



#handle actions here.
switch ($action):
	case'list':
	$group='';
		$QueryObj = new query('orders');
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=20;
		$QueryObj->PageNo=isset($_GET['page'])?$_GET['page']:1;
		$QueryObj->Where="where order_status <>'delivered' and payment_status='1' order by ".$oby." $so";
		$QueryObj->DisplayAll();
		//$QueryObj->GetNumRows();
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	case'download':
		download_orders(1, 'paid');
		Redirect(make_admin_url('order'));
		break;
	default:break;
endswitch;
?>
