<?
/** Update our database with the results from the Notification POST **/						
$q= new query('orders');
$q->Data['id']=$_REQUEST['custom'];
$q->Data['payment_status']=1;
$q->Data['order_date']=date('y-m-d');
$q->Update();


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
Redirect(DIR_WS_SITE.'index.php?page=success&');

/** mail sendign ends here **/
?>