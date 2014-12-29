<?
#handle sections here.
switch ($section):
	case 'list':?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td class="PageTitle">Complete Custom Orders</td>
		</tr>
		</table>
	
		<table cellpadding="2" cellspacing="1" align="center" width="100%" class="table">
			<!--<tr>
				<td  align="right" colspan="7" style="padding-right:10px;border-bottom:solid 1px #dcdcdc;" class="table_cell"><a  href="<?=DIR_WS_SITE_CONTROL?>Control.php?Page=custom_order&section=insert&id=0">New Custom Order</a></td>
			</tr>-->
			<tr>
				<td colspan="7" align="left" valign="middle" class="table_cell">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=custom_payment', 2);?>
				</td>
			</tr>
			<?if($QueryObj->GetNumRows()!=0):?>
			<tr>
				<td align="center" class="table_head"  width="5%" ><b>Sr</b>.</td>
				<td align="left" class="table_head"  width="30%">&nbsp;&nbsp;<b>Title</b></td>
				<td align="left" class="table_head"  width="30%">&nbsp;&nbsp;<b>Customer Email Address</b></td>
				<td class="table_head" align="center"><b>View</b></td>
				<td class="table_head" align="center"><b>Edit</b></td>
				<td class="table_head" align="center"><b>Delete</b></td>
			</tr>
			<?php 
			$sr=($QueryObj->PageNo-1)*$QueryObj->PageSize+1;
			while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center"class="table_cell"><?=$sr++;?>.</td>
					<td align="left" class="table_cell"><?=$QueryObj1->title?></td>
					<td align="left" class="table_cell"><?=$QueryObj1->customer_email?></td>
					<td align="center" class="table_cell"><a href="<?=make_admin_url('preview','list','list','orderid='.$QueryObj1->id)?>"><img src="<?=DIR_WS_SITE.ADMIN_FOLDER?>/image/zoom.png" alt="View" border="0"/></a></td>
					<!--<td align="center" class="table_cell"><a href="<?=make_admin_url('custom_order', 'list', 'list','orderid='.$QueryObj1->id)?>&send=1">Send email</a></td>-->
					<td class="table_cell" align="center"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_payment&section=update&id=<?=$QueryObj1->id?>"><img src="<?=DIR_WS_SITE.ADMIN_FOLDER?>/image/edit.png" alt="Edit" border="0"/></a></td>
					<td class="table_cell" align="center"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_payment&action=delete&idd=<?=$QueryObj1->id?>"><img src="<?=DIR_WS_SITE.ADMIN_FOLDER?>/image/cancel.png" alt="Delete" border="0"/></a></td>
				</tr>
			<?php endwhile;
			else:?>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="middle" class="table_cell" colspan="6">Sorry no custom order found.</td>
				</tr>
			<?endif;?>
		</table>
		<?
		break;
	case 'insert':
	
	?>
	   <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td class="PageTitle">Add Custom Order</td>
		</tr>
		</table>
		<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_order&action=insert">
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
			<?php $qq=new query('custom_order');
			$qq->Where="where id='$_GET[id]'";
			$q=$qq->DisplayOne();
		//	print_r($q);exit;
				?>
		<tr class="table_cell">
				<td colspan="5"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_order">Custom Order&nbsp;-></A>New Custom Order </td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Title</td>
				<td bgcolor="#f5f5f5"><input type="text" name="title" value="<?=isset($_GET['id'])?$q->title:''?>" size="60px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Customer Email</td>
				<td bgcolor="#f5f5f5"><input type="text" name="customer_email" value="<?=isset($_GET['id'])?$q->customer_email:''?>" size="60px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Email Subject</td>
				<td bgcolor="#f5f5f5"><input type="text" name="email_subject" value="<?=isset($_GET['id'])?$q->email_subject:''?>" size="60px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Shipping(&pound;)</td>
				<td bgcolor="#f5f5f5"><input type="text" name="shipping" value="<?=isset($_GET['id'])?$q->shipping:''?>" size="10px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Tax(&pound;)</td>
				<td bgcolor="#f5f5f5"><input type="text" name="tax" value="<?=isset($_GET['id'])?$q->tax:''?>" size="10px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">Note</td>
				<td bgcolor="#f5f5f5"><textarea name="note" rows="5" cols="45"><?=isset($_GET['id'])?$q->note:''?></textarea></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5">&nbsp;</td>
				<td bgcolor="#f5f5f5" align="left"><input type="submit" name="submit" value="Save"></td>
			</tr>
			
		</table>
		</form>
		<br/>
		
		<div align="left" style="padding-left:10px;"><h2>Add Items</h2></div>
		<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_payment&action=insert">
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
			<tr>
				<td bgcolor="#f5f5f5" style="width:140px;"><strong>Item Name</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_name"  size="65px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Description</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><textarea name="item_desc" rows="5" cols="50"></textarea></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Price(&pound;)</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_price" size="10px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Quantity</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_quantity" size="6px;"></td>
			</tr>	
			<input type="hidden" name="order_id" value="<?=$_GET['id']?>">
			<tr>
					<td align="right">&nbsp;</td>
					<td align="left">
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
		<br/>
		<?php $item=new query('custom_order_item');
			$item->Where="where order_id=$_GET[id]";
			$item->DisplayAll();       
	
		if($item->GetNumRows()):?>
			<div align="left" style="padding-left:10px;"><h2>Items Listing</h2></div>
			<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
				<tr>
					<td width="25%"><strong>Item Name</strong></td>
					<td width="25%"><strong>Item Description</strong></td>
					<td width="15%" align="right"><strong>Item Price(&pound;)</strong></td>
					<td width="15%" align="center"><strong>Item Quantity</strong></td>
					<td width="25%" align="right"><strong>Item Total(&pound;)</strong></td>
				</tr>
				<?php $order=new query('custom_order');
				$order->Where="where id='$_GET[id]'";
				$od=$order->DisplayOne();
						
				$custom_order=new query('custom_order_item');
				$custom_order->Where="where order_id='$_GET[id]'";
				$custom_order->DisplayAll();
				$total=0;
				while($custom=$custom_order->GetObjectFromRecord()):?>
					<tr>
						<td bgcolor="#f5f5f5"><?=$custom->item_name?></td>
						<td bgcolor="#f5f5f5"><?=stripslashes($custom->item_desc)?></td>
						<td align="right" bgcolor="#f5f5f5"><?=number_format($custom->item_price,2)?></td>
						<td align="center" bgcolor="#f5f5f5"><?=$custom->item_quantity?></td>
						<td align="right" bgcolor="#f5f5f5"><?=number_format($custom->item_price*$custom->item_quantity,2);?><?$total+=$custom->item_price*$custom->item_quantity;?></td>
						<td bgcolor="#f5f5f5"><a href="<?=make_admin_url('custom_payment', 'delete', 'insert', 'id='.$id.'&orderid='.$custom->id)?>">Delete</a></td>
					</tr>
				<?endwhile;?>
				<tr align="center" valign="top">
					<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Sub Total (&pound;) </strong></td>
					<td bgcolor="#f5f5f5" width="15%" align="right"><strong><?=number_format($total, 2);?></strong></td>
					<td bgcolor="#f5f5f5" width="5%"> </td>
				</tr>
				<tr align="center" valign="top">
					<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Shipping(&pound;) </strong></td>
					<td bgcolor="#f5f5f5" width="15%" align="right"><strong><?php $ship=$od->shipping?></strong><strong><?=number_format($ship,2)?></strong></td>
					<td bgcolor="#f5f5f5" width="5%"> </td>
				</tr>	
				<tr align="center" valign="top">
					<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Tax(&pound;) </strong></td>
					<td bgcolor="#f5f5f5" width="15%" align="right"><strong><?php $tax=$od->tax?></strong><strong><?=number_format($tax,2)?></strong></td>
					<td bgcolor="#f5f5f5" width="5%"> </td>
				</tr>	
				<tr align="center" valign="top">
					<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Grand Total(&pound;) </strong></td>
					<td bgcolor="#f5f5f5" width="15%" align="right"><strong><?=number_format($total+$ship+$tax,2)?></strong></td>
					<td bgcolor="#f5f5f5" width="5%"> </td>
				</tr>	
			</table>
			<div align="right" style="padding-right:10px;">
				<a href="<?=make_admin_url('custom_order','list','list')?>" class="frmm">Order Complete</a>
			</div>
		<?php else:?>
			<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
				<tr>
					<td><strong>Sorry,No item is added by you.</strong></td>
				</tr>
				</table>
		<?php endif;?>
		
	<?
		#html code here.
		break;
	case 'update':
			$query_obj1=new query();
	        $query_obj1->InitilizeSQL();
	  		$query_obj1->TableName='custom_order';
	  		$query_obj1->Where="where id=$_GET[id]";
	  		$custom_order=$query_obj1->DisplayOne();
		?>
		<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_payment&action=update&id=<?=$id?>">
			<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#ffffff" style="border: solid 1px #dcdcdc;">
				<tr class="table_cell">
					<td colspan="5"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_payment">Custom Order&nbsp;-></A>&nbsp;<?=$custom_order->title?></td>
				</tr>
				<tr>
						<td colspan="3" align="center" valign="top" class="table_head">Update Custom order</td>
					</tr>
				<tr>
					<td bgcolor="#ff7e00" align="left" colspan="2"><strong><font color="#ffffff">Order Details</font></strong></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5">Title</td>
					<td bgcolor="#f5f5f5"><input type="text" name="title" value="<?=$custom_order->title?>" size="60px;"></td>
				</tr>
				<!--<tr>
					<td bgcolor="#f5f5f5">Customer Email</td>
					<td bgcolor="#f5f5f5"><input type="text" name="customer_email" value="<?=$custom_order->customer_email?>" size="60px;"></td>
				</tr>-->
				<tr>
					<td bgcolor="#f5f5f5">Email Subject</td>
					<td bgcolor="#f5f5f5"><input type="text" name="email_subject" value="<?=$custom_order->email_subject?>" size="60px;"></td>
				</tr>
				
				<tr>
					<td bgcolor="#f5f5f5">Shipping</td>
					<td bgcolor="#f5f5f5"><input type="text" name="shipping" value="<?=$custom_order->shipping?>" size="10px;"></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5">Tax</td>
					<td bgcolor="#f5f5f5"><input type="text" name="tax" value="<?=$custom_order->tax?>" size="10px;"></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5">Note</td>
					<td bgcolor="#f5f5f5"><textarea name="note" rows="5" cols="45"><?=$custom_order->note?></textarea></td>
				</tr>
				<tr>
					<td bgcolor="#ff7e00" align="left" colspan="2"><strong><font color="#ffffff">Customer Details</font></strong></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">Customer Email</td>
					<td bgcolor="#f5f5f5" align="left"><input type="text" name="customer_email" value="<?=$custom_order->customer_email?>" size="60%"></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">First Name</td>
					<td bgcolor="#f5f5f5" align="left"><input type="text" name="first_name" value="<?=$custom_order->first_name?>" size="60%"></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">Last Name</td>
					<td bgcolor="#f5f5f5" align="left"><input type="text" name="last_name" value="<?=$custom_order->last_name?>" size="60%"></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">Full shipping address</td>
					<td bgcolor="#f5f5f5" align="left"><textarea name="shipping_address" rows="5" cols="48"><?=$custom_order->shipping_address?></textarea></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">Post Code</td>
					<td bgcolor="#f5f5f5" align="left"><input type="text" name="postcode" value="<?=$custom_order->postcode?>" size="20%"></td>
				</tr>
				<tr>
					<td bgcolor="#ff7e00" align="left" colspan="2"><strong><font color="#ffffff">Order Status</font></strong></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" align="left">Order Status</td>
					<td bgcolor="#f5f5f5" align="left"><select name="order_status" size="1"  tabindex="2">
							<option value="received" <?=($custom_order->order_status=='received')?'selected':''?>>Received</option>
							<option value="processing" <?=($custom_order->order_status=='processing')?'selected':''?>>Processing</option>
							<option value="shipped" <?=($custom_order->order_status=='shipped')?'selected':''?>>Shipped</option>
							<option value="delivered" <?=($custom_order->order_status=='delivered')?'selected':''?>>Delivered</option>
						</select></td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5">&nbsp;</td>
					<td bgcolor="#f5f5f5" align="left"><input type="submit" name="submit" value="Save"></td>
				</tr>
			    <input type="hidden" name="id" value="<?=$custom_order->id;?>">
		   </table>
		</form>
		<br/>	
		<!--<div align="left" style="padding-left:10px;"><h2>Add Items</h2></div>-->
		<!--<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=custom_order&action=insert">
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
			<tr>
				<td bgcolor="#f5f5f5" style="width:140px;"><strong>Item Name</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_name" size="65px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Description</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><textarea name="item_desc" rows="5" cols="50"></textarea></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Price(&pound;)</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_price" size="10px;"></td>
			</tr>
			<tr>
				<td bgcolor="#f5f5f5"><strong>Quantity</strong></td>
				<td bgcolor="#f5f5f5" valign="top"><input type="text" name="item_quantity" size="6px;"></td>
			</tr>	
			<input type="hidden" name="order_id" value="<?=$_GET['id']?>">
			<tr>
					<td align="right">&nbsp;</td>
					<td align="left">
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>-->
		<div align="left" style="padding-left:10px;"><h2><font color="ff7e00">Items Listing</font></h2></div>
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
			<tr bgcolor="#ff7e00">
				<td width="25%"><strong><font color="#ffffff">Item Name</font></strong></td>
				<td width="25%"><strong><font color="#ffffff">Item Description</font></strong></td>
				<td width="15%" align="right"><strong><font color="#ffffff">Item Price(&pound;)</font></strong></td>
				<td width="15%" align="center"><strong><font color="#ffffff">Item Quantity</font></strong></td>
				<td width="25%" align="right"><strong><font color="#ffffff">Item Total(&pound;)</font></strong></td>
			</tr>
			<?php $order=new query('custom_order');
			$order->Where="where id='$_GET[id]'";
			$od=$order->DisplayOne();
			
			
			$custom_order=new query('custom_order_item');
			$custom_order->Where="where order_id='$_GET[id]'";
			$custom_order->DisplayAll();
			$total=0;
			while($custom=$custom_order->GetObjectFromRecord()):?>
				<tr>
					<td bgcolor="#f5f5f5"><?=$custom->item_name?></td>
					<td bgcolor="#f5f5f5"><?=stripslashes($custom->item_desc)?></td>
					<td bgcolor="#f5f5f5" align="right"><?=number_format($custom->item_price,2)?></td>
					<td bgcolor="#f5f5f5" align="center"><?=$custom->item_quantity?></td>
					<td bgcolor="#f5f5f5" align="right"><?=number_format($custom->item_price*$custom->item_quantity,2);?><?$total+=$custom->item_price*$custom->item_quantity;?></td>
					
				</tr>
			<?php endwhile;?>
			<tr align="center" valign="top">
				<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Sub Total (&pound;) </strong></td>
				<td bgcolor="#f5f5f5" width="15%" align="right"><?=number_format($total, 2);?></td>
				
			</tr>
			<tr align="center" valign="top">
				<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Shipping(&pound;) </strong></td>
				<td bgcolor="#f5f5f5" width="15%" align="right"><?php $ship=$od->shipping?><?=number_format($ship,2)?></td>
				
			</tr>	
			<tr align="center" valign="top">
				<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Tax(&pound;) </strong></td>
				<td bgcolor="#f5f5f5" width="15%" align="right"><?php $tax=$od->tax?><?=number_format($tax,2)?></td>
				
			</tr>	
			<tr align="center" valign="top">
				<td bgcolor="#f5f5f5" colspan="4" align="right"><strong>Grand Total(&pound;) </strong></td>
				<td bgcolor="#f5f5f5" width="15%" align="right"><?=number_format($total+$ship+$tax,2)?></td>
				
			</tr>	
		</table><br/>
		<div align="right" style="padding-right:10px;">
			<a href="<?=make_admin_url('custom_payment','list','list')?>" class="button">Save Order</a>
		</div>
	</form>
		<?php break;				
		 #html code here.
	default:break;
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
