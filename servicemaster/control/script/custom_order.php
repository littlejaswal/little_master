<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
$id=isset($_GET['id'])?$_GET['id']:"0";
#handle actions here.


switch ($action):
	case'list':
	
	if(isset($_GET['send']) && $_GET['send']==1):
		$orderid=$_GET['orderid'];
		$odd=new query('custom_order');
		$odd->Where="where id='$orderid'";
		$codd=$odd->DisplayOne();
		include_once(DIR_FS_SITE_INCLUDE_EMAIL.'custom_order.php');
		$contents=ob_get_contents();
		send_email($codd->email_subject,$codd->customer_email, ADMIN_EMAIL , SITE_NAME, $contents, BCC_EMAIL,'html');
		$QueryObj5= new query('custom_order');
		$QueryObj5->Data['last_email_send_date']=date('y-m-d');
		$QueryObj5->Data['id']=$orderid;
		$QueryObj5->Update();
		$_SESSION['msg']='Custom order email has been sent.';
		Redirect(make_admin_url('custom_order','list', 'list'));
	endif;
	
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='custom_order';
		$QueryObj->Where="where payment_status=0";
		$QueryObj->AllowPaging=true;
		$QueryObj->PageSize=15;
		$QueryObj->PageNo=(isset($_GET['page']))?$_GET['page']:1;
		$QueryObj->DisplayAll();
		break;	
	case'insert':
		if(isset($_POST['submit']) && $_POST['submit']=='Proceed'):
	  //  print_r($_POST);exit;
			 $actualfilename="";
				$QueryObj= new query('custom_order');
				$QueryObj->Data['title']=$_POST['title'];
				$QueryObj->Data['shipping']=$_POST['shipping'];
				$QueryObj->Data['tax']=$_POST['tax'];
				$QueryObj->Data['customer_email']=$_POST['customer_email'];
				$QueryObj->Data['first_name']=$_POST['first_name'];
				$QueryObj->Data['last_name']=$_POST['last_name'];
				$QueryObj->Data['shipping_address']=$_POST['shipping_address'];
				$QueryObj->Data['email_subject']=$_POST['email_subject'];
				$QueryObj->Data['note']=$_POST['note'];
				$QueryObj->Data['postcode']=$_POST['postcode'];
				$QueryObj->Data['order_date']=date('y-m-d');
				$QueryObj->Insert();
				$customorderid=$QueryObj->GetMaxId();
				$_SESSION['msg']='Your order has been created.Please add some items to the order.';
				Redirect(make_admin_url('custom_order','list', 'insert','id='.$customorderid));
			endif;
			 if(isset($_POST['submit']) && $_POST['submit']=='Submit'):	
			 $QueryObj1= new query('custom_order_item');
				$QueryObj1->Data['item_name']=$_POST['item_name'];
				$QueryObj1->Data['item_desc']=$_POST['item_desc'];
				$QueryObj1->Data['item_price']=$_POST['item_price'];
				$QueryObj1->Data['item_quantity']=$_POST['item_quantity'];
				$QueryObj1->Data['order_id']=$_POST['order_id'];
				$QueryObj1->Data['subtotal']=$_POST['subtotal'];
				$QueryObj1->Insert();
				//$QueryObj1->print=1;exit;
				Redirect(make_admin_url('custom_order','list', 'insert','id='.$_POST['order_id']));
			endif;	
			break;
	case'update':
			$query1=new query('custom_order_item');
			$query1->Where="where order_id=$_POST[id]";
			$query1->DisplayAll();
						
			if(isset($_POST['submit']) && $_POST['submit']=='Proceed'):
			 $QueryObj= new query('custom_order');
				$QueryObj->Data['title']=$_POST['title'];
				$QueryObj->Data['shipping']=$_POST['shipping'];
				$QueryObj->Data['tax']=$_POST['tax'];
				$QueryObj->Data['email_subject']=$_POST['email_subject'];
				$QueryObj->Data['customer_email']=$_POST['customer_email'];
				$QueryObj->Data['first_name']=$_POST['first_name'];
				$QueryObj->Data['last_name']=$_POST['last_name'];
				$QueryObj->Data['shipping_address']=$_POST['shipping_address'];
				$QueryObj->Data['note']=$_POST['note'];
				$QueryObj->Data['order_status']=$_POST['order_status'];
				$QueryObj->Data['postcode']=$_POST['postcode'];
				$QueryObj->Data['id']=$_POST['id'];
				$QueryObj->Update();
				 Redirect(make_admin_url('custom_order', 'list', 'update','id='.$_POST['id']));
			else:
				Redirect(make_admin_url('custom_order','list', 'insert'));
			endif;
			
		break;
	case'delete':
	if(isset($_GET['orderid'])):
		$orderid=$_GET['orderid'];
		$QueryObj->InitilizeSQL();
		$QueryObj->TableName='custom_order_item';
		$QueryObj->id=$orderid;
		$QueryObj->Delete();
		Redirect(make_admin_url('custom_order','list', 'insert','id='.$_GET['id']));
		exit;	
	endif;	
		
		if(isset($_GET['idd'])):
			$idd=$_GET['idd'];
			$QueryObj->InitilizeSQL();
			$QueryObj->TableName='custom_order';
			$QueryObj->id=$idd;
			$QueryObj->Delete();
			Redirect(make_admin_url('custom_order','list', 'list'));
			exit;	
		endif;
		# get the object in variable first and then delete it.
		# now delte the corresponding address object.
		# redirect back to listing page.
		break;
	
	case'download':
		download_custom_orders(0);
		Redirect(make_admin_url('custom_order'));
		break;
	default:break;
endswitch;
?>
