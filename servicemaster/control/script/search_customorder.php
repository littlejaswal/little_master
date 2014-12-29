<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['oby'])?$oby=$_GET['oby']:$oby='order_date';
isset($_GET['so'])?$so=$_GET['so']:$so='ASC';
(isset($_GET['from_date']) && $_GET['from_date']!='')?$from_date=($_GET['from_date']):$from_date=date("Y-m-d");
(isset($_GET['to_date']) && $_GET['to_date']!='')?$to_date=($_GET['to_date']):$to_date=date("Y-m-d");
isset($_GET['order_status'])?$order_order_status=$_GET['order_status']:$order_order_status='1';

#handle actions here.
switch ($action):
	case'list':
		$status=0;
		if(isset($_GET['submit']) && $_GET['submit']=='Search'):
			$query1=new query('custom_order');
			$q="where order_status ='$order_order_status' AND ";
			$q.=" order_date BETWEEN CAST('$from_date' as DATETIME) AND CAST('$to_date'as DATETIME) order by ".$oby." $so";
			$query1->Where=$q;
			$query1->AllowPaging=true;
			$query1->PageNo=isset($_GET['page'])?$_GET['page']:1;
			$query1->PageSize=15;
			$query1->DisplayAll();
			($query1->GetNumRows())?$status=1:'';
			$qstring='from_date='.$from_date.'&to_date='.$to_date.'&order_status='.$order_order_status.'&submit=Search';
		endif;
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	case'download':
		download_search_customorders($from_date, $to_date, $order_order_status);
		Redirect(make_admin_url('search_order'));
		break;
	default:break;
endswitch;
?>
