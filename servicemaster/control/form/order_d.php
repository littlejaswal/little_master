<script language="javascript" src="<?=DIR_WS_SITE_JAVASCRIPT?>pop_out.js"></script>
<script>
function getvalue(form)
{
	var val=form.order_status.options[form.order_status.options.selectedIndex].value;
	self.location='<?=make_admin_url('order_d','list','list','id='.$id.'&status=');?>'+val;
}
</script>
<?

#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td>
					<?if($arc):?>
						<?=make_admin_link(make_admin_url('archive', 'list', 'list', ''), 'Archives', 'go back to archive', 'orders');?> :: Order Details : [<?=$order->id;?>]
					<?elseif($ao):?>
						<?=make_admin_link(make_admin_url('a_order', 'list', 'list', ''), 'Attempted Orders', 'go back to attempted orders', 'orders');?> :: Order Details : [<?=$order->id;?>]
					<?else:?>
						<?=make_admin_link(make_admin_url('order', 'list', 'list', ''), 'Orders', 'go back to order list', 'orders');?> :: Order Details : [<?=$order->id;?>]
					<?endif;?>
				</td>
			</tr>
			<tr>
				<td valign="top">
				
				
				<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td colspan="5" align="left" valign="middle">Shopping Cart</td>
					</tr>
					<tr>
						<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
						<td align="left" valign="top" width="30%" class="table_head">Product Name</td>
						<td align="center" valign="top" width="15%" class="table_head">Quantity</td>
						<td align="right" width="15%" class="table_head">Price</td>
						<td align="right" valign="top" width="20%" class="table_head">Total</td>
					</tr>
					<?
					$sr=1;$total=0;$vat=0;
					while($item= $QueryObj->GetObjectFromRecord()):?>
					<tr>
						<td align="center" valign="top" width="5%"><?php echo $sr++;?>.</td>
						<td align="left" valign="middle" width="30%">
							<?php 
							echo $item->product_name;echo '<br/>';
							echo display_attributes_for_cart($item->id);
							?>
						</td>
						<td align="center" valign="middle" width="15%"><?php echo $item->quantity;?></td>
						<td align="right" valign="middle" width="15%"><?php echo number_format($item->price,2);?></td>
						<td align="right" valign="middle" width="20%"><?php echo number_format($item->product_total, 2);?></td>
					</tr>
					<?endwhile;?>
					<tr>
						<td colspan="4" align="right" valign="middle">Sub Total</td>
						<td align="right" valign="middle" width="20%"><?php echo number_format($order->sub_total, 2);?></td>
						
					</tr>
					<?php if($order->config_cart_vat):?>
					<tr>
						<td colspan="4" align="right" valign="middle">VAT</td>
						<td align="right" valign="middle" width="20%"><?=number_format($order->vat, 2)?></td>
						
					</tr>
					<?php endif;?>
					<tr>
						<td colspan="4" align="right" valign="middle">Shipping</td>
						<td align="right" valign="middle" width="20%"><?=number_format($order->shipping, 2);?></td>
						
					</tr>
					<?php if($order->voucher_amount):?>
					<tr>
						<td colspan="4" align="right" valign="middle">voucher [<?php echo $order->voucher_code;?>]</td>
						<td align="right" valign="middle" width="20%"><?=number_format($order->voucher_amount, 2);?></td>
						
					</tr>
					<?php endif;?>
					<tr>
						<td colspan="4" align="right" valign="middle">Grand Total</td>
						<td align="right" valign="middle" width="20%"><?=number_format($order->grand_total, 2);?></td>
						
					</tr>
				</table>
				
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="50%">
								<table width="100%" border="0" cellspacing="2" cellpadding="2">
									<tr>
										<td colspan="2" class="table_head">Billing Address</td>
									</tr>
									<tr>
										<td width="30%">First Name</td>
										<td><?=$order->billing_firstname;?></td>
									</tr>
									<tr>
										<td width="30%">Last Name</td>
										<td><?=$order->billing_lastname;?></td>
									</tr>
									<tr>
										<td width="30%">Address1</td>
										<td><?=$order->billing_address1?></td>
									</tr>
									<tr>
										<td width="30%">Address2</td>
										<td><?=$order->billing_address2?></td>
									</tr>
									<tr>
										<td width="30%">City</td>
										<td><?=$order->billing_city;?></td>
									</tr>
									<tr>
										<td width="30%">State</td>
										<td><?=$order->billing_state;?></td>
									</tr>
									<tr>
										<td width="30%">Country</td>
										<td><?=$order->billing_country;?></td>
									</tr>
									<tr>
										<td width="30%">Post Code</td>
										<td><?=$order->billing_zip?></td>
									</tr>
									<tr>
										<td width="30%">Phone</td>
										<td><?=$order->billing_phone;?></td>
									</tr>
									<tr>
										<td width="30%">Fax</td>
										<td><?=$order->billing_fax;?></td>
									</tr>
								</table>
							</td>
							<td>
								<table width="100%" border="0" cellspacing="2" cellpadding="2">
									<tr>
										<td colspan="2" class="table_head">Shipping Address</td>
									</tr>
									<tr>
										<td width="30%">First Name</td>
										<td><?=$order->shipping_firstname;?></td>
									</tr>
									<tr>
										<td width="30%">Last Name</td>
										<td><?=$order->shipping_lastname;?></td>
									</tr>
									<tr>
										<td width="30%">Address1</td>
										<td><?=$order->shipping_address1?></td>
									</tr>
									<tr>
										<td width="30%">Address2</td>
										<td><?=$order->shipping_address2?></td>
									</tr>
									<tr>
										<td width="30%">City</td>
										<td><?=$order->shipping_city;?></td>
									</tr>
									<tr>
										<td width="30%">State</td>
										<td><?=$order->shipping_state;?></td>
									</tr>
									<tr>
										<td width="30%">Country</td>
										<td><?=$order->shipping_country;?></td>
									</tr>
									<tr>
										<td width="30%">Post Code</td>
										<td><?=$order->shipping_zip?></td>
									</tr>
									<tr>
										<td width="30%">Phone</td>
										<td><?=$order->shipping_phone;?></td>
									</tr>
									<tr>
										<td width="30%">Fax</td>
										<td><?=$order->shipping_fax;?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			<td> 
			<b>Shipping Comments:</b><br/>
			<?php echo $order->shipping_comment;?>
			<br/><br/>
			<b>Order Comments:</b></br>
			<?php echo $order->order_comment;?>
			</td>
			</tr>
			<tr>
				<td colspan="2">
					<form id="order_d" action="<?=make_admin_url('order_d', 'update', 'list', 'id='.$order->id.'&arc='.$arc)?>" method="post" name="order_d">
						<table width=100%" border="0" cellspacing="2" cellpadding="2">
							<tr>
								<td colspan="2" class="table_head">Order Details</td>
							</tr>
							<tr>
								<td width="30%">Order Type</td>
								<td><?=ucfirst($order->order_type);?></td>
							</tr>
							<tr>
								<td width="30%">Customer IP Address:</td>
								<td><?=ucfirst($order->ip_address);?></td>
							</tr>
							<tr>
								<td width="30%">Order Payment Status</td>
								<td><select name="payment_status" size="1"  tabindex="1">
										<option value="0" <?=($order->payment_status)?'':'selected'?>>Pending</option>
										<option value="1" <?=($order->payment_status)?'selected':''?>>Complete</option>
								      </select>
							        </td>
							</tr>
							<tr>
								<td width="30%">Order Status</td>
								<td>
									<?php echo order_status_drop_down('order_status', isset($_GET['status'])?$_GET['status']:$order->order_status,$id);
									if(isset($_GET['status'])):
										$status=$_GET['status'];
										if($status != 'received'):?>
											<br/><br/>Send Email <input type="checkbox" name="email" value="1"/><br/>
											Message: <input type="text" name="message" size="32" />
										<?endif;
									endif;
									?>
								</td>
							</tr>
							<tr>
								<td width="30%"><input type="button" name="dispatch_note" value="Get Dispatch Note" onclick="popUp('<?=make_url('email','id='.$order->id)?>')" tabindex="2"/></td>
								<td><input type="submit" name="update" value="Submit" tabindex="3" /></td>
								<td>
								<iframe src="<?=make_url('invoice','id='.$order->id)?>" name="frame1" style="display:none"></iframe>
								<input type="button" onclick="frames['frame1'].print()" value="Print Invoice Note" name="invoice" tabindex="4">
								</td>
							</tr>
						</table>
					</form>
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
