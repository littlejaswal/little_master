<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table cellpadding="2" cellspacing="2" class="table" align="left" width="100%" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left">Shipping</td>
			</tr>
		</table>
		<div style="clear:both"></div>
		
		<table cellpadding="2" cellspacing="2" class="table" width="100%">
			<tr>
				<td width="5%"  class="table_head">Sr.</td>
				<td width="25%" class="table_head">Title</td>
				<td width="20%" class="table_head">Zone</td>
				<td width="10%" class="table_head">Min <?php echo ucfirst(SHIPPING_TYPE);?></td>
				<td width="10%" class="table_head">Max <?php echo ucfirst(SHIPPING_TYPE);?></td>
				<td width="10%" class="table_head">Amount</td>
				<td width="20%" class="table_head">Controls</td>
			</tr>
		</table>
			<?php 
			$sr=1;
			while($object= $QueryObj->GetObjectFromRecord()):?>
			<?php if($object->id==$id):?>
			<form action="<?php echo make_admin_url('ship', 'update', 'list', 'id='.$id);?>" method="POST">
				<table cellpadding="2" cellspacing="2" class="table" width="100%">
				<tr>
						<td  width="5%"><?php echo $sr++;?>.</td>
						<td  width="25%"><input type="text" name="title" value="<?php echo $object->title?>" size="20"></td>
						<td  width="20%"><?php get_zones_box($object->id);?></td> 
						<td  width="10%"><input type="text" name="min" value="<?php echo $object->min?>" size="3"></td>
						<td  width="10%"><input type="text" name="max" value="<?php echo $object->max?>" size="3"></td>
						<td  width="10%"><input type="text" name="amount" value="<?php echo $object->amount?>" size="5"></td>
						<td  width="20%"><input type="submit" value="Done" name="edit"></td>
					</tr>
				</table>
			</form>
			<?php else:?>
			<!-- list section  -->
				<table cellpadding="2" cellspacing="2" class="table" width="100%">
					<tr>
						<td  width="5%"><?php echo $sr++;?>.</td>
						<td  width="25%"><?php echo $object->title;?></td>
						<td  width="20%"><a href="<?php echo make_admin_url('zone_country');?>"><?php echo get_object_var('zone', $object->zone, 'name');?></a></td>
						<td  width="10%"><?php echo $object->min;?></td>
						<td  width="10%"><?php echo $object->max;?></td>
						<td  width="10%"><?php echo $object->amount;?></td>
						<td  width="20%">
							<a href="<?php echo make_admin_url('ship', 'list', 'list', 'id='.$object->id);?>"><?php echo get_control_icon('edit')?></a>&nbsp;&nbsp;
							<a href="<?php echo make_admin_url('ship', 'delete', 'list', 'id='.$object->id);?>"><?php echo get_control_icon('cancel')?></a>
						</td>
					</tr>
				</table>
			<?php endif;?>
			<?php endwhile;?>
			<!-- list section  -->
			
			<!-- new section  -->
			<form action="<?php echo make_admin_url('ship', 'insert', 'list');?>" method="POST">
				<table cellpadding="2" cellspacing="2" class="table" width="100%">
					<tr>
						<td width="5%"><?php echo $sr++;?>.</td>
						<td width="25%"><input type="text" name="title" value="" size="20"></td>
						<td width="20%"><?php get_zones_box();?></td> 
						<td width="10%"><input type="text" name="min" value="" size="3"></td>
						<td width="10%"><input type="text" name="max" value="" size="3"></td>
						<td width="10%"><input type="text" name="amount" value="" size="5"></td>
						<td width="20%"><input type="submit" value="Done" name="new"></td>
					</tr>
				</table>
			</form>
			<!-- new section  -->
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
