<?
$contents='';
$contents.=str_pad('Online Order Receipt', 80, ' ', STR_PAD_BOTH)."\n";
$contents.="\n\n";
$contents.='Order Information'."\n";
$contents.='--------------------------------------'."\n\n";
$contents.=str_pad(SITE_NAME, 40, ' ', STR_PAD_RIGHT).str_pad('Order No.:', 13, ' ', STR_PAD_RIGHT).$order->id."\n";
$contents.=str_pad('Address1', 40, ' ', STR_PAD_RIGHT).str_pad('Order Date.:', 13, ' ', STR_PAD_RIGHT).date($order->order_date)."\n";
$contents.=str_pad('Address2', 40, ' ', STR_PAD_RIGHT)."\n";
$contents.='phone'."\n\n\n";
$contents.='Order Details'."\n";
$contents.='--------------------------------------'."\n\n";
$contents.=str_pad('Sr.', 10, ' ', STR_PAD_RIGHT).str_pad('Product Name', 30, ' ', STR_PAD_RIGHT).str_pad('Quantity', 12, ' ', STR_PAD_BOTH).str_pad('Price', 10, ' ', STR_PAD_LEFT).str_pad('Total', 10, ' ', STR_PAD_LEFT)."\n";
$sr=1;
while($order_d= $order_detail->GetObjectFromRecord()):
	$contents.=str_pad($sr, 10, ' ', STR_PAD_RIGHT).str_pad($order_d->product_name, 30, ' ', STR_PAD_RIGHT).str_pad($order_d->quantity, 12, ' ', STR_PAD_BOTH).str_pad(number_format($order_d->price, 2), 10, ' ', STR_PAD_LEFT).str_pad(number_format($order_d->price*$order_d->quantity, 2), 10, ' ', STR_PAD_LEFT)."\n";
endwhile;
$contents.=str_pad('Sub Total', 62, ' ', STR_PAD_LEFT).str_pad(number_format($order->sub_total, 2), 10, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('Shipping', 62, ' ', STR_PAD_LEFT).str_pad(number_format($order->shipping, 2), 10, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('VAT', 62, ' ', STR_PAD_LEFT).str_pad(number_format($order->vat, 2), 10, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('Grand Total', 62, ' ', STR_PAD_LEFT).str_pad(number_format($order->grand_total, 2), 10, ' ', STR_PAD_LEFT)."\n\n";
$contents.=str_pad('Billing Address', 50, ' ')."\n";
$contents.='--------------------------------------'."\n\n";
$contents.=str_pad('First Name:', 15, ' ',STR_PAD_RIGHT).$order->billing_firstname."\n";
$contents.=str_pad('Last Name:', 15, ' ',STR_PAD_RIGHT).$order->billing_lastname."\n";
$contents.=str_pad('Address1:', 15, ' ',STR_PAD_RIGHT).$order->billing_address1."\n";
$contents.=str_pad('Address2:', 15, ' ',STR_PAD_RIGHT).$order->billing_address2."\n";
$contents.=str_pad('City:', 15, ' ',STR_PAD_RIGHT).$order->billing_city."\n";
$contents.=str_pad('State:', 15, ' ',STR_PAD_RIGHT).$order->billing_state."\n";
$contents.=str_pad('Country:', 15, ' ',STR_PAD_RIGHT).$order->billing_country."\n";
$contents.=str_pad('Zip:', 15, ' ',STR_PAD_RIGHT).$order->billing_zip."\n";
$contents.=str_pad('Phone:', 15, ' ',STR_PAD_RIGHT).$order->billing_phone."\n";
$contents.=str_pad('Fax:', 15, ' ',STR_PAD_RIGHT).$order->billing_fax."\n\n";
$contents.=str_pad('Shipping Address', 50, ' ')."\n";
$contents.='--------------------------------------'."\n\n";
$contents.=str_pad('First Name:', 15, ' ',STR_PAD_RIGHT).$order->shipping_firstname."\n";
$contents.=str_pad('Last Name:', 15, ' ',STR_PAD_RIGHT).$order->shipping_lastname."\n";
$contents.=str_pad('Address1:', 15, ' ',STR_PAD_RIGHT).$order->shipping_address1."\n";
$contents.=str_pad('Address2:', 15, ' ',STR_PAD_RIGHT).$order->shipping_address2."\n";
$contents.=str_pad('City:', 15, ' ',STR_PAD_RIGHT).$order->shipping_city."\n";
$contents.=str_pad('State:', 15, ' ',STR_PAD_RIGHT).$order->shipping_state."\n";
$contents.=str_pad('Country:', 15, ' ',STR_PAD_RIGHT).$order->shipping_country."\n";
$contents.=str_pad('Zip:', 15, ' ',STR_PAD_RIGHT).$order->shipping_zip."\n";
$contents.=str_pad('Phone:', 15, ' ',STR_PAD_RIGHT).$order->shipping_phone."\n";
$contents.=str_pad('Fax:', 15, ' ',STR_PAD_RIGHT).$order->shipping_fax."\n\n";
$contents.='Please contact at the following address if you have any problem regarding your order.'."\n";
$contents.='--------------------------------------'."\n\n";
$contents.=SALES_EMAIL."\n";
$contents.='Thanks & Regards,'."\n";
$contents.=SITE_NAME;
?>