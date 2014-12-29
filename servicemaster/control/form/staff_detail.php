<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_cell" width="34%">
					<a href="<?=make_admin_url('staff')?>">Staff Listing</a>&nbsp;|&nbsp;<?=$user->username;?>				</td>
				<td width="55%" align="right" class="table_cell">
				<?php if($user->is_active):?>
					<a href="<?php echo make_admin_url('staff_detail', 'block', 'list', 'id='.$user->id);?>">Block this user</a></td>
				<?php else:?>
					<a href="<?php echo make_admin_url('staff_detail', 'block', 'list', 'id='.$user->id);?>">UnBlock this user</a><td width="11%"></td>
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
		
	
		<?
	
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
