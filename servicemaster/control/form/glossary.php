<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="" action="<?=make_admin_url('glossary', 'update2', 'list')?>" method="post" name="">
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
			<?$sr=1;while($glossary=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%"><?php echo $sr++;?>.</td>
				<td width="40%" align="left"><a href="#" title="<?php echo $glossary->description?>"><?php echo stripslashes($glossary->caption)?></a></td>
				<td align="center" width="15%"><input type="checkbox" name="is_active[<?=$glossary->id;?>]" <?=$glossary->is_active=='1'?'checked':''?> value="<?=$glossary->caption?>" style="border:none;"></td>
				<td align="center">
						<?php echo make_admin_link(make_admin_url('glossary', 'update', 'update', 'id='.$glossary->id), get_control_icon('edit'));?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo make_admin_link(make_admin_url('glossary', 'delete', 'list', 'id='.$glossary->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<?endwhile;?>
			
			
			<tr><td class="table_head"></td><td class="table_head"></td>
				  <td align="center" class="table_head"><input type="submit" name="submit" value="Update"></td>
                  <td class="table_head"></td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('glossary', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('glossary', 'list', 'list'), 'Back to glossary listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">New glossary Item</td>
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
					<td align="left" valign="top" width="30%">Description</td>
					<td align="left" valign="middle">
						<textarea name="description" rows="5" cols="70" tabindex="4"></textarea>
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
	case 'update':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('glossary', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('glossary', 'list', 'list', 'id='.$id), 'Back to glossary listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Edit glossary Item &raquo;</td>
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
					<td align="left" valign="middle"><input type="text" name="position"  value="<?=($news->position)?$news->position:'1';?>" value="1" tabindex="3" size="2" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Description</td>
					<td align="left" valign="middle">
							<textarea name="description" rows="5" cols="70" tabindex="4"><?php echo $news->description;?></textarea>
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
