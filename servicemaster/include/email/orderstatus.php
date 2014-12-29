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
					<td align="center" class="content" bgcolor="#FF6600" height="3"></td>
				</tr>
				<tr>
					<td align="center" class="content">
						<table width="600" border="0" cellspacing="1" cellpadding="2">
							<tr>
								<td align="center" class="top_info">This e-mail is confidential and contains privileged information. If you are not the named recipient, please e-mail or phone us immediately. You should not disclose the contents to any person, take copies, or use it for any purpose.</td>
							</tr>
							<tr>
								<td align="left" class="salutation">Dear <?=$order->billing_firstname?>&nbsp;<?=$order->billing_lastname?></td>
							</tr>
							<tr>
								<td align="left">
								<strong>Order date: <?=date('d,M Y',strtotime($order->order_date))?>.</strong><br />
									This order has been successfully paid for by <strong>online credit card authorisation.</strong><br />
									The order status of the order has been changed <strong><?=$status;?></strong>
									<br />
								</td>
							</tr>
							<?if($message !=''):?>
							<tr>
								<td align="left"><strong>Message:</strong> <?=$message;?></td>
							</tr>
							<?endif;?>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>

</html>