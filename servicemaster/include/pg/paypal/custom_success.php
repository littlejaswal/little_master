<?
#Check order payment statusif order payment status = 0 then update status and send email

if(isset($_POST['custom']) && $_POST['custom']):
	$query=new query('custom_order');
	$query->Where="where id='$_POST[custom]'";
	$order=$query->DisplayOne();
	$method=$order->payment_status;
	if(isset($method) && $method == 0):
		$q= new query('custom_order');
		$q->Data['id']=$order->id;
		$q->Data['payment_status']=1;
		$q->Data['order_status']='delivered';
		$q->Data['order_date']=date('y-m-d');
		$q->Update();
	endif;

	/** send mail from here **/
	$order_detail=new query('custom_order_item');
	$order_detail->Where="where order_id='$order->id'";
	$order_detail->DisplayAll();

	include_once(DIR_FS_SITE_INCLUDE_EMAIL.'customorder_success.php');
	send_email(SUBJECT_NEW_CUSTOM_ORDER.":".$order->email_subject, ADMIN_EMAIL, ADMIN_EMAIL, SITE_NAME, $contents,BCC_EMAIL,'text');
	
	$order_detailll=new query('custom_order_item'); 
	$order_detailll->Where="where order_id='$order->id'";
	$order_detailll->DisplayAll();
	
	include_once(DIR_FS_SITE_INCLUDE_EMAIL.'customhtmlorderemail.php');
	$contents=ob_get_clean();
	send_email(SUBJECT_NEW_CUSTOM_ORDER_CUSTOMER.":".$order->email_subject, $order->customer_email, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL,'html');
	/** mail sending ends here **/
endif;
?>