<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="9">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=order', 2);?>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="center" valign="middle" width="15%" class="table_head">Order ID</td>
				<td align="center" valign="middle" width="20%" class="table_head">Date&nbsp;<a href="<?=make_admin_url('order', 'list', 'list', 'oby=order_date&so=ASC')?>"><?php echo get_control_icon('down');?></a><a href="<?=make_admin_url('order', 'list', 'list', 'oby=order_date&so=DESC')?>"><?php echo get_control_icon('up');?></a></td>
				<td align="center" valign="middle" width="10%" class="table_head">User</td>
				<td align="center" valign="middle" width="10%" class="table_head">Status</td>
				<td align="center" valign="middle" width="10%" class="table_head">Type</td>
				<td align="center" width="20%" class="table_head">Grand Total <a href="<?=make_admin_url('order', 'list', 'list', 'oby=grand_total&so=ASC')?>"><?php echo get_control_icon('down');?></a><a href="<?=make_admin_url('order', 'list', 'list', 'oby=grand_total&so=DESC')?>"><?php echo get_control_icon('up');?></a></td>
				<td width="15%" class="table_head"></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<?php $sr=1; 
			while($order=$QueryObj->GetObjectFromRecord()):
			if($group!=date("Y,M-d", strtotime($order->order_date))):
					?>
						<tr>
							<td colspan="7" align="left" class="table_head">
								<?=ucwords(str_replace('_', ' ', $oby)).': '.date("Y, M-d",strtotime($order->$oby))?>
							</td>
						</tr>
					<?
					$group=date("Y,M-d",strtotime($order->order_date));
			endif;
			?>
			<tr>
				<td width="15%" class="table_cell" align="center"><?=$sr++;?>.</td>
				<td width="20%" class="table_cell" align="center"><?=date("d-m-Y", strtotime($order->order_date));?></td>
				<td width="10%" class="table_cell" align="center"><?=is_numeric($order->user_id)?make_admin_link(make_admin_url('udetail', 'list', 'list','id='.$order->user_id), get_control_icon('zoom')):'Guest';?></td>
				<td width="10%" class="table_cell" align="center"><?=ucfirst($order->order_status)?></td>
				<td width="10%" class="table_cell" align="center"><?=ucfirst($order->order_type);?></td>
				<td width="20%" class="table_cell" align="right" style="padding-right:20px;"><?=number_format($order->grand_total, 2);?></td>
				<td align="center" width="15%" class="table_cell"><?=make_admin_link(make_admin_url('order_d' ,'list', 'list', 'id='.$order->id),get_control_icon('zoom'), 'View order details here', 'order details');?></td>
			</tr>
			<?php endwhile;?>
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
