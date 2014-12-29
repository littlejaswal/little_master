<?
#payment mode selection. ->url
if($payment_method['mode']):
	$payment_url='http://paypal.com/'; #live url
else:	
	$payment_url='https://www.sandbox.paypal.com/cgi-bin/webscr/'; #test url
endif;

#retrive relevant details for form.

$query= new query('orders,order_detail');
$query->Field="orders.*, order_detail.*";
$query->Where="where orders.id='$id' and orders.id= order_detail.order_id";
$query->DisplayAll();
$items='';
while($odi=$query->GetArrayFromRecord()):

	$order=$odi;
	$items.=$odi['product_name'];
	#print_r($order);
	$q= new query('order_detail_attribute');
	$q->Where="where order_detail_id='$odi[id]'";
	$q->DisplayAll();
	#print_r($order);
	if($q->GetNumRows()):
		while($item=$q->GetArrayFromRecord()):
			$items.='['.$item['attribute_name'].':'.$item['attribute_value_name'].'] ';			
		endwhile;
	endif;
	$items.=', ';
endwhile;
$form=array();
$form['items']=substr($items,0,strlen($items)-2); 	#items detail
$form['grand_total']=$order['grand_total'];
$form['business']='mani.s_1227165846_biz@gmail.com';
$form['cmd']='_xclick';
$form['currency_code']='GBP'; 
$form['return']=make_url('success');
$form['notify_url']=DIR_WS_SITE.'include/pg/paypal/ipn.php';
$form['cancel_return']=make_url('fail');
$form['item_name']=$items;
$form['amount']=number_format($order['grand_total'], 2);
//$form['amount']=number_format($order['sub_total'], 2);
$form['orderid']=$order['id'];
$form['custom']=$order['order_id'];
$form['no_notes']='1';
$form['shipping']=$order['shipping'];
$form['vat']=$order['vat'];
$form['name']=$order['billing_firstname'].' '.$order['billing_lastname'];
$form['address1']=$order['billing_address1'];
$form['address2']=$order['billing_address2'];
$form['city']=$order['billing_city'];
$form['state']=$order['billing_state'];
$form['country']=$order['billing_country'];
$form['email']=$order['billing_email'];
//print_r($form);exit;
?>