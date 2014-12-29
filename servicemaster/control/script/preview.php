<?$orderid=$_GET['orderid'];
	$odd=new query('custom_order');
	$odd->Where="where id='$orderid'";
	$codd=$odd->DisplayOne();
	

$ordertt=new query('custom_order_item');
$ordertt->Where="where order_id=$codd->id";
$ordertt->DisplayAll();
										
?>	