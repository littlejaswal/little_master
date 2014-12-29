<?
#payment mode selection. ->url
if($payment_method['mode']):
	$payment_url='http://paypal.com/'; #live url
else:	
	$payment_url='https://www.sandbox.paypal.com/cgi-bin/webscr/'; #test url
endif;

#retrive relevant details for form.
$ord=new query('custom_order');
$ord->Where="where id='$id'";
$order=$ord->DisplayOne();

$order_detail= new query('custom_order_item');
$order_detail->Where="where order_id='".$order->id."'";
$order_detail->DisplayAll();

//$order_detail1= new query('sample');
//$order_detail1->Where="where user_id='".$login_session->get_user_id()."'";
//$od1=$order_detail1->DisplayOne();

# make basket string;
$basket_in_string='';
$basket_line='';
$basket_items=0;
$total=0;
$items='';
while($od= $order_detail->GetObjectFromRecord()):
	$basket_in_string.=':'.$od->item_name.':'.$od->item_quantity;
	$basket_in_string.=':'.number_format($od->item_price, 2).':'.'0.00';
	$basket_in_string.=':'.number_format($od->item_price,2).':'.number_format($od->item_price*$od->item_quantity, 2);
	++$basket_items;
	$total+=$od->item_price*$od->item_quantity;
	$items.=$od->item_name;
	$items.=' ';
endwhile;

$form=array();
$form['items']=substr($items,0,strlen($items)-2); 	#items detail
$form['grand_total']=$total;
$form['business']='mani.s_1227165846_biz@gmail.com';
$form['cmd']='_xclick';
$form['currency_code']='GBP'; 
$form['return']=make_url('custom_order_success');
$form['notify_url']=DIR_WS_SITE.'include/pg/paypal/custom_ipn.php';
$form['cancel_return']=make_url('custom_fail');
$form['item_name']=$items;
$form['amount']=number_format($total, 2);
$form['orderid']=$order->id;
$form['custom']=$order->id;
$form['no_notes']='1';
$form['shipping']=$order->shipping;
$form['tax']=$order->tax;
$form['name']=$order->first_name.' '.$order->last_name;
$form['address']=$order->shipping_address;
$form['postcode']=$order->postcode;
$form['email']=$order->customer_email;
?>