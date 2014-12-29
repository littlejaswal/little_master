<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="9">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=a_order', 2);?>
				</td>
			</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="center" valign="middle" width="15%" class="table_head">Order ID </td>
				<td align="center" valign="middle" width="20%" class="table_head">Date&nbsp;
					<a href="<?=make_admin_url('a_order', 'list', 'list', 'oby=order_date&so=ASC')?>"><?php echo get_control_icon('down');?></a>
					<a href="<?=make_admin_url('a_order', 'list', 'list', 'oby=order_date&so=DESC')?>"><?php echo get_control_icon('up');?></a>				</td>
				<td align="center" valign="middle" width="16%" class="table_head">User</td>
				<td align="center" valign="middle" width="17%" class="table_head">Status</td>
				<td align="center" width="21%" class="table_head">GrandTotal <a href="<?=make_admin_url('a_order', 'list', 'list', 'oby=grand_total&so=ASC')?>"><?php echo get_control_icon('down')?></a><a href="<?=make_admin_url('a_order', 'list', 'list', 'oby=grand_total&so=DESC')?>"><?php echo get_control_icon('up')?></a></td>
				<td width="11%" class="table_head">Control</td>
			</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" id="zebra">
			<?
			$sr=1; 
			while($order=$QueryObj->GetObjectFromRecord()):
			?>
			<tr>
				<td align="center" valign="middle" width="15%"><?php echo $order->id;?></td>
				<td width="20%"  align="center"><?=date("d-m-Y", strtotime($order->order_date));?></td>
				<td width="18%"  align="center"><?=is_numeric($order->user_id)?make_admin_link(make_admin_url('udetail', 'list', 'list','id='.$order->user_id), get_control_icon('zoom')):'Guest';?></td>
				<td width="15%"  align="center"><?=ucfirst($order->order_status)?></td>
				<td width="18%"  align="right" style="padding-right:20px;"><?=number_format($order->grand_total, 2);?></td>
				<td align="center" width="14%" ><?=make_admin_link(make_admin_url('order_d' ,'list', 'list', 'id='.$order->id.'&ao=1'),get_control_icon('zoom'), 'View order details here', 'order details');?></td>
			</tr>
			<?endwhile;?>
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
