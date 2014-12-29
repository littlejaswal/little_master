<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['arc'])?$arc=$_GET['arc']:$arc=0;
isset($_GET['ao'])?$ao=$_GET['ao']:$ao=0;

#handle actions here.
switch ($action):
	case'list':
		#order 
		$QueryObj = new query('orders');
		$QueryObj->Where="where id='".$id."'";
		$order=$QueryObj->DisplayOne();
		#order details objects.
		$QueryObj = new query('order_detail');
		$QueryObj->Where="where order_id='".$id."'";
		$QueryObj->DisplayAll();
		break;
	case'insert':
		break;
	case'update':
		if(isset($_POST['update']) && $_POST['update']=='Submit'):
			$not=array('update','email','message');
			$QueryObj= new query('orders');
			$QueryObj->Data=MakeDataArray($_POST, $not);
			$QueryObj->Data['id']=$id;
			//$QueryObj->print=1;
			$QueryObj->Update();
			
			if(isset($_POST['email']) && $_POST['email'] ==1):
				$order=get_object('orders',$id);
				$user=get_object_by_col('user','id',$order->user_id);
				$status=$_POST['order_status'];
				$message=$_POST['message'];
				include_once(DIR_FS_SITE_INCLUDE_EMAIL.'orderstatus.php');
				send_email(SUBJECT_ORDER_STATUS, $user->username, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL,'html');
			endif;
			
			$admin_user->set_pass_msg('Order has been updated.');
			Redirect(make_admin_url('order_d', 'list', 'list', 'id='.$id.'&arc='.$arc.'&ao='.$ao));
		endif;
		break;
	case'delete':
		break;
	default:break;
endswitch;
?>
