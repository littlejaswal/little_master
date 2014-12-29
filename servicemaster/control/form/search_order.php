<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="search_order" action="<?php echo make_admin_url('search_order','list','list');?>" method="GET" name="search_order">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="9" class="table_head">Order Search</td>
			</tr>
			<tr>
				<td width="34%" align="left" valign="middle" style="padding-left:5px;">Order Date&nbsp;From&nbsp;(YYYY-MM-DD):
			  <td width="66%"><input type="text" name="from_date" id="from_date" tabindex="1" size="20" value="<?php echo $from_date;?>" /></td>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Order Date&nbsp;To&nbsp;(YYYY-MM-DD):
				<td><input type="text" name="to_date" id="to_date" tabindex="2" size="20" value="<?php echo $to_date;?>" /></td>
			</tr>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Order Status:&nbsp;</td>
				<td align="left" valign="middle"><?php echo order_status_drop_down('order_status', $order_order_status);?></td>
			</tr>
			<tr>
				<td></td>
			  <td align="left" valign="middle" style="padding-left:80px;">
				<input type="hidden" name="Page" value="search_order">
	            <input type="submit" name="submit" value="Search" tabindex="4" />		
			</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
		</table>
		</form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td colspan="9" class="table_head">Search Results</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td colspan="9">
							<?php if($status):?>
							<?php echo PageControl($query1->PageNo, $query1->TotalPages, $query1->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=search_order&'.$qstring,2);?></td>
							<?php endif;?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<p></p>
			<tr>
				<td align="left" valign="middle" width="100%">
				<?if(!$status):?>
					Sorry! No order found.
			   <?else:?> 
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td align="center" valign="middle" width="12%" class="table_head">Order ID </td>
							<td align="center" valign="middle" width="17%" class="table_head">Date&nbsp;
								<a href="<?php echo make_admin_url('search_order', 'list', 'list','oby=order_date&so=ASC&'.$qstring)?>"><?php echo get_control_icon('down');?></a>
								<a href="<?php echo make_admin_url('search_order', 'list', 'list', 'oby=order_date&so=DESC&'.$qstring)?>"><?php echo get_control_icon('up');?></a>							</td>
							<td align="center" valign="middle" width="13%" class="table_head">User</td>
							<td align="center" valign="middle" width="13%" class="table_head">Status</td>
							<td align="center" width="17%" class="table_head">GrandTotal <a href="<?php echo make_admin_url('search_order', 'list', 'list', 'oby=grand_total&so=ASC&'.$qstring)?>"><?php echo get_control_icon('down')?></a><a href="<?php echo make_admin_url('search_order', 'list', 'list', 'oby=grand_total&so=DESC&'.$qstring)?>"><?php echo get_control_icon('up')?></a></td>
							<td width="11%" class="table_head">Control</td>
						</tr>
					</table>
				<?endif;?>
				</td>
			</tr>
			<p></p>
			<tr>
				<td width="100%" align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" id="zebra">
						<?php
						if($status):
							$sr=1; 
							while($orderdetails=$query1->GetObjectFromRecord()):
							?>
							<tr>
								<td align="center" valign="middle" width="15%"><?php echo $orderdetails->id;?></td>
								<td width="19%"  align="center"><?php echo date("d-m-Y", strtotime($orderdetails->order_date));?></td>
								<td width="18%"  align="center"><?php echo is_numeric($orderdetails->user_id)?make_admin_link(make_admin_url('udetail', 'list', 'list','id='.$orderdetails->user_id), get_control_icon('zoom')):'Guest';?></td>
								<td width="14%"  align="center"><?php echo ucfirst($orderdetails->order_status)?></td>
								<td width="18%"  align="right" style="padding-right:20px;"><?php echo number_format($orderdetails->grand_total, 2);?></td>
								<td align="center" width="16%" ><?php echo make_admin_link(make_admin_url('order_d' ,'list', 'list', 'id='.$orderdetails->id.'&ao=1'),get_control_icon('zoom'), 'View order details here', 'order details');?></td>
							</tr>
							<?php endwhile;
						endif;?>
						
					</table>
				</td>
			</tr>
		</table>

		<?
		break;
	case 'insert':
		#html code here.
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
