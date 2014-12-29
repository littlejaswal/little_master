<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['oby'])?$oby=$_GET['oby']:$oby='order_date';
isset($_GET['so'])?$so=$_GET['so']:$so='ASC';
isset($_GET['email'])?$email=$_GET['email']:$email='';
isset($_GET['firstname'])?$first_name=$_GET['firstname']:$first_name='';
isset($_GET['lastname'])?$last_name=$_GET['lastname']:$last_name='';
isset($_GET['city'])?$city=$_GET['city']:$city='';
isset($_GET['country'])?$country=$_GET['country']:$country='';

#handle actions here.
switch ($action):
	case'list':
		$status=0;
		if(isset($_GET['submit']) && $_GET['submit']=='Search'):
			$query1=new query('user');
			$q="where username ='$email' OR ";
			$q.="firstname ='$first_name' OR ";
			$q.="lastname ='$last_name' OR ";
			$q.="city ='$city' OR ";
			$q.="country ='$country'";
			$query1->Where=$q;
			$query1->AllowPaging=true;
			$query1->PageNo=isset($_GET['page'])?$_GET['page']:1;
			$query1->PageSize=15;
			$query1->DisplayAll();
			($query1->GetNumRows())?$status=1:'';
			$country_name=array();
			$country_name[]=$country;
			$qstring='email='.$email.'&firstname='.$first_name.'&lastname='.$last_name.'&city='.$city.'&country='.$country.'&submit=Search';
		endif;
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	case'download':
		download_search_users($email,$first_name,$last_name,$city,$country);
		Redirect(make_admin_url('search_user'));
		break;
	default:break;
endswitch;
?>
