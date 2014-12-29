<?
# destrory cart session.
$cart_obj->empty_cart();

#precautionary things.

/**
1. Check order payment status
   if order paymetn status = 0
	then update status and send email

2. Remove items form cart table. and its supporting tables.
**/
if(isset($_POST['custom']) && $_POST['custom']):
	$query=new query('orders');
	$query->Where="where id='$_POST[custom]'";
	$order=$query->DisplayOne();
	$method=$order->payment_status;
	if(isset($method) && $method == 0):				
		$q= new query('orders');
		$q->Data['id']=$_REQUEST['custom'];
		$q->Data['payment_status']=1;
		$q->Data['order_date']=date('y-m-d');
		$q->Update();
		
#Remove items form cart table. and its supporting tables.		
		$carty=new query('cart');
		$carty->Where="where cart_id='$order->cart_id'";
		$cartitem=$carty->DisplayOne();
		
		if($cartitem):
			$query=new query('cart');
			$query->id=$cartitem->id;
			$query->Delete();
		endif;
		
		$carty_detail=new query('cart_more_detail');
		$carty_detail->Where="where cart_id='$order->cart_id'";
		$cartitemdetail=$carty_detail->DisplayOne();
		if($cartitemdetail):
			$query1=new query('cart_more_detail');
			$query1->id=$cartitemdetail->id;
			$query1->Delete();
		endif;
	
		$carty_att_detail=new query('cart_attribute');
		$carty_att_detail->Where="where cart_instance_id='$cartitem->id'";
		$cart_attribute_detail=$carty_att_detail->DisplayOne();
		print_r($cart_attribute_detail);
		if($cart_attribute_detail):
			$query2=new query('cart_attribute');
			$query2->id=$cart_attribute_detail->id;
			$query2->Delete();
		endif;
	endif;

	
	
	/** send mail from here **/
	$oid=$_REQUEST['custom'];
	//$cart_obj->setbilling(array());
	//$cart_obj->setshipping(array());
	
	$order1=new query('orders');
	$order1->Where="where id='$oid'";
	$order=$order1->DisplayOne();
	
	$order_detail=new query('order_detail');
	$order_detail->Where="where order_id='$oid'";
	$order_detail->DisplayAll();
	
	include_once(DIR_FS_SITE_INCLUDE_EMAIL.'order.php');
	
	send_email(SUBJECT_NEW_ORDER, ADMIN_EMAIL,ADMIN_EMAIL, SITE_NAME, $contents,BCC_EMAIL,'text');
	
	$order_detailll=new query('order_detail');
	$order_detailll->Where="where order_id='$oid'";
	$order_detailll->DisplayAll();
	
	include_once(DIR_FS_SITE_INCLUDE_EMAIL.'htmlorderemail.php');
	$contents=ob_get_clean();
	send_email(SUBJECT_NEW_ORDER_CUSTOMER, $order->billing_email, ADMIN_EMAIL, SITE_NAME, $contents,'','html');
	/** mail sending ends here **/
endif;	
?>