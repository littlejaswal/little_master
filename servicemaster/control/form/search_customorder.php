<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="search_customorder" action="<?=make_admin_url('search_customorder','list','list');?>" method="GET" name="search_customorder">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="9" class="table_head">Search Custom Order</td>
			</tr>
			<tr>
				<td width="43%" align="left" valign="middle" style="padding-left:5px;">Custom Order Date&nbsp;From&nbsp;(YYYY-MM-DD):
			  <td width="57%"><input type="text" name="from_date" id="from_date" tabindex="1" size="20" value="<?php echo $from_date;?>" /></td>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Custom Order Date&nbsp;To&nbsp;(YYYY-MM-DD):
				<td><input type="text" name="to_date" id="to_date" tabindex="2" size="20" value="<?php echo $to_date;?>" /></td>
			</tr>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Custom Order Status:&nbsp;</td>
				<td align="left" valign="middle"><?php echo order_status_drop_down('order_status', $order_order_status);?></td>
			</tr>
			<tr>
			  <td></td>
			  <td align="left" valign="middle" style="padding-left:80px;">
				<input type="hidden" name="Page" value="search_customorder">
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
							<?php echo PageControl($query1->PageNo, $query1->TotalPages, $query1->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=search_customorder&'.$qstring,2);?></td>
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
					Sorry! No custom order found.
			   <?else:?> 
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td align="center" valign="middle" width="20%" class="table_head">Order ID </td>
							<td align="center" valign="middle" width="14%" class="table_head">Date&nbsp;
								<a href="<?=make_admin_url('search_customorder', 'list', 'list', 'oby=order_date&so=ASC&'.$qstring)?>"><?php echo get_control_icon('down');?></a>
								<a href="<?=make_admin_url('search_customorder', 'list', 'list', 'oby=order_date&so=DESC&'.$qstring)?>"><?php echo get_control_icon('up');?></a>
							</td>
							<td align="center" valign="middle" width="15%" class="table_head">User</td>
							<td align="center" valign="middle" width="15%" class="table_head">Status</td>
							<td width="10%" class="table_head">Control</td>
						</tr>
					</table>
				<?endif;?>
				</td>
			</tr>
			<p></p>
			<tr>
				<td width="100%" align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" id="zebra">
						<?
						if($status):
							$sr=1; 
							while($order=$query1->GetObjectFromRecord()):
							?>
							<tr>
								<td align="center" valign="middle" width="25%"><?php echo $order->id;?></td>
								<td width="20%"  align="center"><?=date("d-m-Y", strtotime($order->order_date));?></td>
								<td width="22%"  align="center"><?=$order->first_name." ".$order->last_name;?></td>
								<td width="17%"  align="center"><?=ucfirst($order->order_status)?></td>
								<td align="center" width="16%" ><?=make_admin_link(make_admin_url('preview' ,'list', 'list', 'orderid='.$order->id.'&ao=1'),get_control_icon('zoom'), 'View custom order details here', 'custom order details');?></td>
							</tr>
							<?endwhile;
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
