<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="" action="<?=make_admin_url('videos', 'update2', 'list')?>" method="post" name="">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4">
				
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head">Video</td>
				<td align="center" width="15%" class="table_head">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($videos=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%"><?=$sr++;?>.</td>
				<td width="40%" align="left"><?=stripslashes($videos->caption)?></td>
				<td align="center" width="15%"><input type="checkbox" name="is_active[<?=$videos->id;?>]" <?=$videos->is_active=='1'?'checked':''?> value="<?=$videos->name?>" style="border:none;"></td>
				<td align="center">
				<?=make_admin_link(make_admin_url('videos', 'update', 'update', 'id='.$videos->id), get_control_icon('edit'));?>&nbsp;&nbsp;&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('videos', 'delete', 'list', 'id='.$videos->id), get_control_icon('cancel'));?>
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
		<form id="news_insert" action="<?=make_admin_url('videos', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('videos', 'list', 'list'), 'Back to videos listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">New videos Item</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle">
						<textarea name="caption" rows="5" cols="50" tabindex="1"></textarea>
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
					<td align="left" valign="top" width="30%">
						You Tube Video Link<br/>
						(i.e. <i>http://www.youtube.com/watch?v=W8vMkjjiVpw</i>)
						</td>
					<td align="left" valign="middle"><textarea name="embed_code" rows="5" cols="50" tabindex="4"></textarea>
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
		<form id="news_insert" action="<?=make_admin_url('videos', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('videos', 'list', 'list', 'id='.$id), 'Back to videos listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Edit videos Item &raquo;</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle"><textarea name="caption" rows="5" cols="50" tabindex="1"><?php echo $news->caption?></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="2" value="1" <?=($news->is_active)?'checked':'';?> /></td>
				</tr>
                <tr>
					<td align="left" valign="middle" width="30%">Position</td>
					<td align="left" valign="middle"><input type="text" name="position"  value="<?=($news->position)?$news->position:'1';?>" value="1" tabindex="3" size="2" /></td>
				</tr>
				
				<tr>
					<td align="left" valign="top" width="30%">YouTube Video Link<br>
					(i.e. <i>http://www.youtube.com/watch?v=W8vMkjjiVpw</i>)
					</td>
					<td align="left" valign="middle">
							<textarea name="embed_code" rows="5" cols="50" tabindex="4"><?php echo $news->embed_code;?></textarea>
					</td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="3" /></td>
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
