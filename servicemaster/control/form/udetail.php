<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_cell" width="34%">
					<a href="<?=make_admin_url('user')?>">User Listing</a>&nbsp;|&nbsp;<?=$user->username;?>				</td>
				<td width="55%" align="right" class="table_cell">
				<?php if($user->is_active):?>
					<a href="<?php echo make_admin_url('udetail', 'block', 'list', 'id='.$user->id);?>">Block this user</a></td>
				<?php else:?>
					<a href="<?php echo make_admin_url('udetail', 'block', 'list', 'id='.$user->id);?>">UnBlock this user</a><td width="11%"></td>
				<?php endif;?>
			</tr>
			<tr>
				<td class="table_head" colspan="2">User Details</td>
			</tr>
			<tr>
				<td class="table_cell" align="left" valign="middle" width="34%">First Name</td>
				<td class="table_cell"><?=$user->firstname;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Last Name</td>
				<td class="table_cell"><?=$user->lastname;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Address1</td>
				<td class="table_cell"><?=$user->address1;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Address2</td>
				<td class="table_cell"><?=$user->address2;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">City</td>
				<td class="table_cell"><?=$user->city;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">State/County</td>
				<td class="table_cell"><?=$user->state;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Postcode/ Zip</td>
				<td class="table_cell"><?=$user->zip;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Country</td>
				<td class="table_cell"><?=$user->country;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Phone</td>
				<td class="table_cell"><?=$user->phone;?></td>
			</tr>
			<tr>
				<td class="table_cell" width="34%">Fax</td>
				<td class="table_cell"><?=$user->fax;?></td>
			</tr>
		</table>
		<br/>
		
		<?if($orders->GetNumRows()):?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="8" class="table_cell">Order History</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
				<td align="center" valign="middle" width="10%" class="table_head">Order Date</td>
				<td align="center" valign="middle" width="15%" class="table_head">Order Status</td>
				<td align="center" valign="middle" width="15%" class="table_head">Payment Status</td>
				<td align="center" valign="middle" width="10%" class="table_head">Order Type</td>
				<td align="center" valign="middle" width="10%" class="table_head">Sub Total</td>
				<td align="center" width="15%" class="table_head">Grand Total</td>
				<td width="15%" class="table_head"></td>
			</tr>
			<?$sr=1; 
			while($order=$orders->GetObjectFromRecord()):
			?>
			<tr>
				<td width="5%" class="table_cell" align="center"><?=$sr++;?>.</td>
				<td width="10%" class="table_cell" align="center"><?=date("d-m-Y", strtotime($order->order_date));?></td>
				<td width="10%" class="table_cell" align="center"><?=ucfirst($order->order_status)?></td>
				<td width="15%" class="table_cell" align="center"><?=($order->payment_status)?'Complete':'Pending';?></td>
				<td width="10%" class="table_cell" align="center"><?=ucfirst($order->order_type);?></td>
				<td width="10%" class="table_cell" align="right" style="padding-right:20px;"><?=number_format($order->sub_total, 2);?></td>
				<td width="15%" class="table_cell" align="right" style="padding-right:20px;"><?=number_format($order->grand_total, 2);?></td>
				<td align="center" width="15%" class="table_cell"><?=make_admin_link(make_admin_url('order_d' ,'list', 'list', 'id='.$order->id),'Details', 'View order details here', 'order details');?></td>
			</tr>
			<?endwhile;?>
		</table>
		<?else:?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left" class="table_cell">Order History</td>
			</tr>
			<tr>
				<td align="center" class="table_head">No order placed by this user.</td>
			</tr>
		</table>
		<?endif;
		#html code here.
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
