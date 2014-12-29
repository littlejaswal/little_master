<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['oby'])?$oby=$_GET['oby']:$oby='order_date';
isset($_GET['so'])?$so=$_GET['so']:$so='ASC';

#handle actions here.
switch ($action):
	case'list':
		# check proper logout.
		$user_id=$admin_user->get_user_id();
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName = "admin_user";
		$QueryObj->Where = "where id='$user_id'";
		$QueryObj->Fields = "*, DATE_FORMAT(last_access,'%d %M %Y at %H:%i:%s') as MyLastAccess";
		$CurrentUser = $QueryObj->DisplayOne();
		
		#get total visits for today.
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where DATE(on_date)=CURDATE()";
		$webstat=$query->DisplayOne();
		$total_visit_today=$webstat->total;

		#get total visits for ever
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$webstat=$query->DisplayOne();
		$total_visits=$webstat->total;
		
		#get total visits for this month.
	    $month=date("n");
	    $year= date("Y");
	    $query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where MONTH(on_date)='$month' and YEAR(on_date)='$year'";
		$webstat=$query->DisplayOne();
		$total_visit_month=$webstat->total;
        
		#get total visits for this week.
		$week=date("W");
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where WEEK(on_date,1)='$week' and YEAR(on_date)='$year' and MONTH(on_date)='$month'";
		$webstat=$query->DisplayOne();
		$total_visit_week=$webstat->total;
		
		#get total visits for this year.
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where YEAR(on_date)='$year'";
		$webstat=$query->DisplayOne();
		$total_visit_year=$webstat->total;
		
//		#total orders today.
//		$query=new query('orders');
//		$query->Field="count(*) as total";
//		$query->Where="where DATE(order_date)=CURDATE() and payment_status='1'";
//		$webstat=$query->DisplayOne();
//		$total_order_today=$webstat->total;
//
//		#get total visits for ever
//		$query=new query('orders');
//		$query->Field="count(*) as total";
//		$query->Where="where payment_status='1'";
//		$webstat=$query->DisplayOne();
//		$total_orders=$webstat->total;
//
//		#get orders details
//		$home_order_query = new query('orders');
//		$home_order_query->Where="where DATE(order_date)=CURDATE() and payment_status='1' order by 'order_date' LIMIT 0,5";
//		$home_order_query->DisplayAll();
//		
//		//print_r($order->id);exit();
//							
//		#total products on the website.
//		$query=new query('product');
//		$query->Field="count(*) as total";
//		$webstat=$query->DisplayOne();
//		$total_product=$webstat->total;
//
//		#get product details
//		$home_product_query=new query('product');
//		$home_product_query->Where="where stock<=5 and is_active='1' LIMIT 0,5";
//		$home_product_query->DisplayAll();
//		
//		#total registered users on the website.
//		$query=new query('user');
//		$query->Field="count(*) as total";
//		$query->Where="where is_active='1' and is_email_verified='1'";
//		$webstat=$query->DisplayOne();
//		$total_user=$webstat->total;
//
//		#total registrations today.
//		$query=new query('user');
//		$query->Field="count(*) as total";
//		$query->Where="where DATE(on_date)=CURDATE() and is_active='1'";
//		$webstat=$query->DisplayOne();
//		$total_user_today=$webstat->total;
//		
//		#user details registered today
//		$home_user_query=new query('user');
//		$home_user_query->Where="where on_date=CURDATE() and is_active='1'";
//		$home_user_query->DisplayAll();
		
		break;
	
		case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
