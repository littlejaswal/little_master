<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		
		<form id="" action="<?=make_admin_url('cities', 'update2', 'list')?>" method="post" name="">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right"><a href="<?php echo make_admin_url('cities', 'list', 'insert');?>">Add New Item</a></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4">
				
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">City Name</td>
				<td align="center" width="15%" class="table_head">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($cities=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%"><?php echo $sr++;?>.</td>
				<td width="40%" align="left"><a href="#" title="<?php echo $cities->description?>"><?php echo stripslashes($cities->caption)?></a></td>
				<td align="center" width="15%"><input type="checkbox" name="is_active[<?=$cities->id;?>]" <?=$cities->is_active=='1'?'checked':''?> value="<?=$cities->caption?>" style="border:none;"></td>
				<td align="center">
						<?php echo make_admin_link(make_admin_url('cities', 'update', 'update', 'id='.$cities->id), get_control_icon('edit'));?>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo make_admin_link(make_admin_url('cities', 'delete', 'list', 'id='.$cities->id), get_control_icon('cancel'));?>
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
		<form id="news_insert" action="<?=make_admin_url('cities', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('cities', 'list', 'list'), 'Back to cities listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">New City Item</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">City Name</td>
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
					<td align="left" valign="top" width="30%">Zip Codes</td>
					<td align="left" valign="middle"><textarea rows="3" cols="35" name="description" tabindex="4"></textarea></td>
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
		<form id="news_insert" action="<?=make_admin_url('cities', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('cities', 'list', 'list', 'id='.$id), 'Back to cities listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Edit cities Item &raquo;</td>
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
					<td align="left" valign="middle"><input size="2" type="text" name="position" value="<?=($news->position)?$news->position:'1';?>" tabindex="3"/></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Link</td>
					<td align="left" valign="middle">
							<textarea rows="3" cols="35" name="description" tabindex="4"><?php echo $news->description;?></textarea> 
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
