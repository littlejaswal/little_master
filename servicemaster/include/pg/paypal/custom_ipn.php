<?
$query= new query('custom_order');
$query->Where="where id='$_POST[custom]'";
$order=$query->DisplayOne();
		
/** Update our database with the results from the Notification POST **/						
$q= new query('custom_order');
$q->Data['id']=$order->id;
$q->Data['payment_status']=1;
$q->Data['order_status']='delivered';
$q->Data['order_date']=date('y-m-d');
$q->Update();

/** send mail from here **/
$oid=$_POST['custom'];

$order1=new query('custom_order');
$order1->Where="where id='$oid'";
$order=$order1->DisplayOne();

$order_detail=new query('custom_order_item');
$order_detail->Where="where order_id='$oid'";
$order_detail->DisplayAll();

include_once(DIR_FS_SITE_INCLUDE_EMAIL.'customorder_success.php');
send_email(SUBJECT_NEW_CUSTOM_ORDER.":".$order->email_subject, ADMIN_EMAIL, ADMIN_EMAIL, SITE_NAME, $contents,BCC_EMAIL,'text');

$order_detailll=new query('custom_order_item'); 
$order_detailll->Where="where order_id='$oid'";
$order_detailll->DisplayAll();

include_once(DIR_FS_SITE_INCLUDE_EMAIL.'customhtmlorderemail.php');
$contents=ob_get_clean();
send_email(SUBJECT_NEW_CUSTOM_ORDER_CUSTOMER.":".$order->email_subject, $order->customer_email, ADMIN_EMAIL, SITE_NAME, $contents, BCC_EMAIL,'html');
Redirect(DIR_WS_SITE.'index.php?page=custom_order_success&');

/** mail sending ends here **/
?>