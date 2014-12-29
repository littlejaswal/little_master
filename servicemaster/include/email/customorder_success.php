<?//print_r($_POST);exit;
$contents='';
//print_r($contents);exit;
$contents.=str_pad('#############################################################################################', 80, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('This email is confidential and contains priviliged information.If you are not the named recipient,please e-mail or phone us immediately.You should not disclose the contents to any person,take copies, or use it for any purpose.', 80, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('#############################################################################################', 80, ' ', STR_PAD_LEFT)."\n";
$contents.="\n\n";
$contents.=str_pad('Dear ',0, ' ', STR_PAD_RIGHT).str_pad($order->first_name,0, ' ', STR_PAD_RIGHT).'  '.str_pad($order->last_name,0, ' ', STR_PAD_RIGHT).','."\n\n";
//$contents.='Order number:'.''.$order->id."\n\n";
$contents.='Order Date:'.''.date('d,M Y',strtotime($order->order_date))."\n\n";
//$contents.=str_pad('The chosen method of delivery was ',0, ' ', STR_PAD_RIGHT).$order->shipping_country."\n\n";
$contents.='The order has been successfully paid for by online credit card authorisation.'."\n\n";


$contents.='Order Details'."\n";
$contents.='--------------------------------------'."\n";
$total=0;while($order_d=$order_detail->GetObjectFromRecord()):

	


//print_r($order_d);exit;
$contents.=str_pad('Product Name: ',0, ' ', STR_PAD_RIGHT).str_pad($order_d->item_name,0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Length: ', 0, ' ', STR_PAD_RIGHT).str_pad($order_d->length,0, ' ', STR_PAD_RIGHT)."\n";

//$contents.=str_pad('Size: ', 0, ' ', STR_PAD_RIGHT).str_pad(html_entity_decode($order_d->size),0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Belt Color: ', 0, ' ', STR_PAD_RIGHT).str_pad($order_d->belt_color, 0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Stud Color: ', 0, ' ', STR_PAD_RIGHT).str_pad($order_d->stud_color, 0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Code: ', 0, ' ', STR_PAD_RIGHT).str_pad($order_d->code, 0, ' ', STR_PAD_RIGHT)."\n";
$contents.=str_pad('Price Per Item(£): ', 0, ' ', STR_PAD_RIGHT).str_pad(number_format($order_d->item_price, 2), 0, ' ', STR_PAD_RIGHT)."\n";
$contents.=str_pad('Quantity: ', 0, ' ', STR_PAD_RIGHT).str_pad($order_d->item_quantity, 0, ' ', STR_PAD_RIGHT)."\n";
$contents.=str_pad('Total(£): ', 0, ' ', STR_PAD_RIGHT).str_pad(number_format($order_d->item_price*$order_d->item_quantity, 2), 0, ' ', STR_PAD_RIGHT)."\n\n";

$total+=$order_d->item_price*$order_d->item_quantity;
$contents.='--------------------------------------'."\n";
endwhile;

$contents.=str_pad('Sub Total(£): ' , 0, ' ', STR_PAD_RIGHT).str_pad(number_format($total, 2), 0, ' ', STR_PAD_RIGHT)."\n\n";
$contents.=str_pad('Delivery Charge(£): ' , 0, ' ', STR_PAD_RIGHT).str_pad(number_format($order->shipping, 2), 0, ' ', STR_PAD_RIGHT)."\n";
$contents.=str_pad('Tax(£): ' , 0, ' ', STR_PAD_RIGHT).str_pad(number_format($order->tax, 2), 0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Promo Code: ', 0, ' ', STR_PAD_RIGHT).str_pad($order->code, 0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('Discount(£): ' , 0, ' ', STR_PAD_RIGHT).str_pad(number_format($order->discount, 2), 0, ' ', STR_PAD_RIGHT)."\n";
//$contents.=str_pad('VAT', 62, ' ', STR_PAD_LEFT).str_pad(number_format($order->vat, 2), 0, ' ', STR_PAD_LEFT)."\n";
$contents.=str_pad('Total Cost(£): ' , 0, ' ', STR_PAD_RIGHT).str_pad(number_format($total+$order->shipping+$order->tax, 2), 0, ' ', STR_PAD_RIGHT)."\n\n";
$contents.='------------------------------------------------------------------------------------'."\n";
$contents.='Customer Details.'."\n";
$contents.='--------------------------------------------------------------------------------------------------------------'."\n";
$contents.=str_pad('Email Address:', 0, ' ',STR_PAD_RIGHT).$order->customer_email."\n";
$contents.=str_pad('First Name:', 0, ' ',STR_PAD_RIGHT).$order->first_name."\n";
$contents.=str_pad('Last Name:', 0, ' ',STR_PAD_RIGHT).$order->last_name."\n";
$contents.=str_pad('Full Shipping Address:', 0, ' ',STR_PAD_RIGHT).$order->shipping_address."\n";
$contents.=str_pad('Post Code:', 0, ' ',STR_PAD_RIGHT).$order->postcode."\n";
$contents.='--------------------------------------------------------------------------------------------------------------'."\n";

//$contents.=str_pad('Phone: ', 0, ' ',STR_PAD_RIGHT).$contt->phone."\n\n";
$contents.='Should you have any problem please do not hesitate to contact us.'."\n";
$contents.='--------------------------------------------------------------------------------------------------------------'."\n";


$contact=new query('contact');
$contact->Where="where id=1";
$contt=$contact->DisplayOne();

$contents.=str_pad('Address:', 0, ' ',STR_PAD_RIGHT)."\n"."\t".$contt->name."\n"."\t".$contt->address1."\n"."\t".$contt->address2."\n"."\t".$contt->city."\n"."\t".$contt->country."\n"."\t".$contt->postcode."\n\n";
$contents.=str_pad('Email: ', 0, ' ',STR_PAD_RIGHT).''.''.$contt->email."\n\n";
$contents.=str_pad('Web: ', 0, ' ',STR_PAD_RIGHT).$contt->web."\n\n";
//$contents.=str_pad('Phone: ', 0, ' ',STR_PAD_RIGHT).$contt->phone."\n\n";

$contents.='-----------------------------------------------------------------------------------------------------------------------'."\n";

$contents.='Thanks & Regards,'."\n";
$contents.= SITE_NAME;


?>