<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5">
				<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=content_collection', 2);?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head">Name</td>
				<td width="10%" class="table_head">Status</td>
				<td colspan="2" class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($news=$QueryObj->GetObjectFromRecord()):?>
			<tbody class="alter">
			<tr>
				<td align="center" valign="middle" width="10%" ><?=$sr++?>.</td>
				<td width="48%" ><?=$news->name?></td>
				<td width="10%" ><?=$news->is_active?></td>
				<td align="center">
				<?=make_admin_link(make_admin_url('content_collection', 'update', 'update', 'id='.$news->id), get_control_icon('edit'));?></td>
				<td align="center"><?=make_admin_link(make_admin_url('content_collection', 'delete', 'list', 'id='.$news->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			</tbody>
			<?endwhile;?>
		</table>
		<br/>
		<br/>
		<form id="method" action="<?=make_admin_url('content_collection', 'insert', 'list')?>" method="post" name="payment-method">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<!--<tr>
					<td colspan="3" ><?=make_admin_link(make_admin_url('content_collection', 'list', 'list'), 'Back to Content Collection listing')?></td>
				</tr>-->
				<tr>
					<td align="left" colspan="3" class="table_head">New Content Collection Item</td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="20%" >Name</td>
					<td align="left" valign="middle" ><input type="text" name="name" size="40" tabindex="1" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="20%" >Status</td>
					<td align="left" valign="middle" ><input type="checkbox" name="is_active" value="yes" size="40" tabindex="1" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
			
			</table>
		</form>
		
		
		<?
		break;
	case 'insert':
		#html code here.
		?>
		
		<?
		break;
	case 'update':
		#html code here.
		?>
			<form id="method" action="<?=make_admin_url('content_collection', 'update', 'list')?>" method="post" name="payment-method">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="3" ><?=make_admin_link(make_admin_url('content_collection', 'list', 'list'), 'Back to Content Collection listing')?></td>
				</tr>
				<tr>
					<td  align="left" colspan="3" class="table_head">New Content Collection Item</td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="20%" >Name</td>
					<td align="left" valign="middle" ><input type="text" name="name" size="40" tabindex="1" value="<?=$news->name?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="20%" >Status</td>
					<td align="left" valign="middle" ><input type="checkbox" name="is_active" value="yes" size="40" tabindex="1" <?=(isset($news->is_active) && $news->is_active=='yes')?'checked':''?> /></td>
				</tr>				
				<tr>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Update" tabindex="7" /></td>
				</tr>
					<input type="hidden" name="id" value="<?=$_GET['id']?>">
			</table>
		</form>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
