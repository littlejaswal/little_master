<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		
		<form id="" action="<?=make_admin_url('zipcodes', 'update2', 'list')?>" method="post" name="">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right"><a href="<?php echo make_admin_url('zipcodes', 'list', 'insert');?>">Add New Item</a></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4">
				
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Item</td>
				<td align="center" width="15%" class="table_head">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($zipcodes=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%"><?php echo $sr++;?>.</td>
				<td width="40%" align="left"><a href="#" title="<?php echo $zipcodes->description?>"><?php echo stripslashes($zipcodes->caption)?></a></td>
				<td align="center" width="15%"><input type="checkbox" name="is_active[<?=$zipcodes->id;?>]" <?=$zipcodes->is_active=='1'?'checked':''?> value="<?=$zipcodes->name?>" style="border:none;"></td>
				<td align="center">
						<?php echo make_admin_link(make_admin_url('zipcodes', 'update', 'update', 'id='.$zipcodes->id), get_control_icon('edit'));?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo make_admin_link(make_admin_url('zipcodes', 'delete', 'list', 'id='.$zipcodes->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<?endwhile;?>
			
			
			<tr>
				  <td colspan="4" align="center" style="padding-left:100px;"><input type="submit" name="submit" value="update"></td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('zipcodes', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('zipcodes', 'list', 'list'), 'Back to zipcodes listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head">New zipcodes Item</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle">
						<input type="text" name="caption" value="" tabindex="1" />
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="2" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Position</td>
					<td align="left" valign="middle"><input type="text" name="position" value="1" tabindex="3" size="2" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Link</td>
					<td align="left" valign="middle">http://<input type="text" name="description" tabindex="4" value="#" /></td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="5" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('zipcodes', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('zipcodes', 'list', 'list', 'id='.$id), 'Back to zipcodes listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head">Edit zipcodes Item &raquo;</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle"><input type="text" name="caption" tabindex="1" value="<?php echo $news->caption?>" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="2" value="1" <?=($news->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Position</td>
					<td align="left" valign="middle"><input type="checkbox" name="position" value="<?=($news->position)?$news->position:'1';?>" tabindex="3"/></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Link</td>
					<td align="left" valign="middle">
							http://<input size="35" type="text" name="description" tabindex="4" value="<?php echo $news->description;?>" />
					</td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="5" /></td>
				</tr>
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
