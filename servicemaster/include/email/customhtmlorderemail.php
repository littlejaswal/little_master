<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta name="generator" content="Adobe GoLive" />
		<title><?php echo SITE_NAME;?></title>

	</head>

	<body>
<style>
body
{
margin:5px 0px 5px 0px;
font-size:11px;
color:#15526d;
line-height: 18px;
font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
}

td
{
font-size:11px;
color:#15526d;
line-height: 18px;
font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
}

td.top_info
{
font-size:10px;
color:#ff5a00;
font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
font-weight:bold;
line-height: 14px;
background: #f6f6f6;
padding:7px;
}

table.main
{
border:2px solid #ff6f00;
}

.content
{
padding:1px;
}

.salutation
{
font-weight:bold;
font-size:12px;
color:#000000;
height:40px;
}

.section_title
{
font-weight:bold;
font-size:11px;
color:#ffffff;
background: #FF952F url(<?=DIR_WS_SITE_GRAPHIC?>HdBg.jpg) repeat-x;
border-bottom:1px solid #ff6f00;
height:21px;
padding:3px;
text-transform: uppercase;
}

.pro_title
{
font-weight:bold;
font-size:11px;
color:#000000;
background: #b9e2f3;
height:21px;
padding:3px;
text-transform: uppercase;
border-top:2px solid #ffffff;
}

.pro_title
{
font-weight:bold;
font-size:11px;
color:#ffffff;
background: #f8b06a;
height:21px;
padding:3px;
text-transform: uppercase;
border-top:2px solid #ffffff;
}

.lfcell
{
font-weight:bold;
font-size:11px;
color:#15526d;
background: #ffe8d2;
height:21px;
padding:4px;
}

.calc_cell
{
font-weight:bold;
font-size:11px;
color:#000000;
background: #ffe8d2;
padding:4px;
}

.rtcell
{
font-weight:normal;
font-size:11px;
color:#15526d;
background: #fff5eb;
height:21px;
padding:4px 4px 4px 10px;
background: #fff5eb url(<?=DIR_WS_SITE_GRAPHIC?>rt_lf_bg.jpg) repeat-y;
}

</style>
		<div align="center">
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				<tr height="3">
					<td align="center" class="content" bgcolor="#FF6633" height="3"></td>
				</tr>
				<tr>
					<td align="center" class="content">
						<table width="600" border="0" cellspacing="1" cellpadding="2">
							<tr>
								<td align="center" class="top_info">This e-mail is confidential and contains privileged information. If you are not the named recipient, please e-mail or phone us immediately. You should not disclose the contents to any person, take copies, or use it for any purpose.</td>
							</tr>
							<tr>
								<td align="left" class="salutation">Dear <?=$order->first_name?>&nbsp;&nbsp;<?=$order->last_name?></td>
							</tr>
							<tr>
								<td align="left">
									<strong>Order date: <?=date('d,M Y',strtotime($order->order_date))?>.</strong><br />
									This order has been successfully paid for by <strong>online credit card authorisation.</strong><br />
									<br />
								</td>
							</tr>
							<!--<tr>
								<td align="left">
									<div class="section_title">Customer Details</div><table width="100%" border="0" cellspacing="1" cellpadding="0">
										<tr>
											<td class="lfcell" valign="top" width="50%">Billing Address</td>
											<td class="rtcell" valign="top">
												<?=$order->customer_email ?><br/>
											</td>
										</tr>
			  </table>
								</td>
							</tr>
							-->
										<!--<tr>
											<td class="lfcell" valign="top" width="50%">Delivery Instructions</td>
											<td class="rtcell" valign="top"></td>
										</tr>-->
		  </table>
								</td>
							</tr>
							<tr>
								<td align="left">
									<div class="section_title">Order Details</div>
									
									<?$total=0;while($order_dd=$order_detailll->GetObjectFromRecord()):
										
									?>	
									<div class="pro_title">Product Detail</div>
									<table width="100%" border="0" cellspacing="1" cellpadding="0">
										<tr>
											<td class="lfcell" valign="top" width="50%">Product Name</td>
											<td class="rtcell" valign="top"><?=$order_dd->item_name?></td>
										</tr>
										<tr>
											<td class="lfcell" valign="top" width="50%">Price Per Item</td>
											<td class="rtcell" valign="top">&pound;<?=number_format($order_dd->item_price,2)?></td>
										</tr>
										<tr>
											<td class="lfcell" valign="top" width="50%">Quantity</td>
											<td class="rtcell" valign="top"><?=$order_dd->item_quantity?></td>
										</tr>
										<tr>
											<td class="lfcell" valign="top" width="50%">Total</td>
											<td class="rtcell" valign="top">&pound;<?=number_format($order_dd->item_price*$order_dd->item_quantity, 2)?></td>
										</tr>
										<?$total+=$order_dd->item_price*$order_dd->item_quantity?>
								  </table>
										<?endwhile;?>
									<table width="100%" border="0" cellspacing="1" cellpadding="0">
									<tr>
											<td class="calc_cell" valign="top" width="50%">Sub Total</td>
											<td class="calc_cell" valign="top">&pound;<?=number_format($total, 2)?></td>
									  </tr>
										<tr>
											<td class="calc_cell" valign="top" width="50%">Delivery Charges</td>
											<td class="calc_cell" valign="top">&pound;<?=number_format($order->shipping, 2)?></td>
										</tr>
										<tr>
											<td class="calc_cell" valign="top" width="50%">Tax</td>
											<td class="calc_cell" valign="top">&pound;<?=number_format($order->tax, 2)?></td>
										</tr>
										<tr>
											<td class="calc_cell" valign="top" width="50%">Total Cost</td>
											<td class="calc_cell" valign="top">&pound;<?=number_format($total+$order->shipping+$order->tax, 2)?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
						<TD align="left">Customer Details
							<table width="100%" border="0" cellspacing="1" cellpadding="0">
								<tr>
									<td class="lfcell" valign="top" width="50%">Email Address</td>
									<td class="rtcell" valign="top"><?=$order->customer_email?></td>
								</tr>
								<tr>	
									<td class="lfcell" valign="top" width="50%">First Name</td>
									<td class="rtcell" valign="top"><?=$order->first_name?></td>
								</tr>
								<tr>	
									<td class="lfcell" valign="top" width="50%">Last Name</td>
									<td class="rtcell" valign="top"><?=$order->last_name?></td>
								</tr>
								<tr>
									<td class="lfcell" valign="top" width="50%">Full Shipping Address</td>
									<td class="rtcell" valign="top"><?=$order->shipping_address?></td>
								</tr>
								<tr>
									<td class="lfcell" valign="top" width="50%">Post Code</td>
									<td class="rtcell" valign="top"><?=$order->postcode?></td>
								</tr>
							</table>
						</TD>
					</tr>
							<tr>
								<td align="left">
									Should you have any problems please do not hesitate to contact us.<br />
										<?$contact=new query('contact');
										$contact->Where="where id=1";
										$contt=$contact->DisplayOne();?>
									<table width="100%" border="0" cellspacing="1" cellpadding="0">
										<tr>
											<td class="lfcell" valign="top" width="50%">Address</td>
											<td class="rtcell" valign="top"><?=$contt->name?><br />
												<?=$contt->address1?><br />
												<?=$contt->address2?><br />
												<?=$contt->city?><br />
												<?=$contt->country?><br />
												<?=$contt->postcode?>
											</td>
										</tr>
										<tr>
											<td class="lfcell" valign="top" width="50%">E-mail</td>
											<td class="rtcell" valign="top"><a href="mailto:<?=$contt->email?>"><?=$contt->email?></a></td>
										</tr>
										<tr>
											<td class="lfcell" valign="top" width="50%">Web</td>
											<td class="rtcell" valign="top"><a href="<?=$contt->web?>"><?=$contt->web?></a></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>

</html>