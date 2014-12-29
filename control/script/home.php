<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['oby'])?$oby=$_GET['oby']:$oby='order_date';
isset($_GET['so'])?$so=$_GET['so']:$so='ASC';

/*handle actions here.*/
switch ($action):
	case'list':
		
		/*get total visits for today.*/
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where DATE(on_date)=CURDATE()";
		$webstat=$query->DisplayOne();
		$total_visit_today=$webstat->total;

		/*get total visits for ever*/
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$webstat=$query->DisplayOne();
		$total_visits=$webstat->total;
		
		/*get total visits for this month.*/
	    $month=date("n");
	    $year= date("Y");
	    $query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where MONTH(on_date)='$month' and YEAR(on_date)='$year'";
		$webstat=$query->DisplayOne();
		$total_visit_month=$webstat->total;
        
		/*get total visits for this week.*/
		$week=date("W");
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where WEEK(on_date,1)='$week' and YEAR(on_date)='$year' and MONTH(on_date)='$month'";
		$webstat=$query->DisplayOne();
		$total_visit_week=$webstat->total;
		
		/*get total visits for this year.*/
		$query=new query('web_stat');
		$query->Field="count(*) as total";
		$query->Where="where YEAR(on_date)='$year'";
		$webstat=$query->DisplayOne();
		$total_visit_year=$webstat->total;
		

		break;
	
        case'approve_business':
            isset($_GET['bid'])?$bid=$_GET['bid']:$bid='0';
                  if($id){
                    $object= get_object('directory', $id);
                    $QueryObj= new query('directory');
                    $QueryObj->Data['is_active']='1';
                    $QueryObj->Data['id']=$id;
                    $QueryObj->Update();
                    
                    
                    $admin_user->set_pass_msg('Business has been approved successfully.');
                    Redirect(make_admin_url('home', 'list', 'list'));
                };
        break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
