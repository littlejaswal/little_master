<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="" action="<?=make_admin_url('faq', 'update2', 'list')?>" method="post" name="">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4">
				
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head">Question</td>
				<td align="center" width="15%" class="table_head">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($faq=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%"><?=$sr++;?>.</td>
				<td width="40%" align="left"><?=stripslashes($faq->question)?></td>
				<td align="center" width="15%"><input type="checkbox" name="is_active[<?=$faq->id;?>]" <?=$faq->is_active=='1'?'checked':''?> value="<?=$faq->question?>" style="border:none;"></td>
				<td align="center">
				<?=make_admin_link(make_admin_url('faq', 'update', 'update', 'id='.$faq->id), get_control_icon('edit'));?>&nbsp;&nbsp;&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('faq', 'delete', 'list', 'id='.$faq->id), get_control_icon('cancel'));?>
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
		<form id="news_insert" action="<?=make_admin_url('faq', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('faq', 'list', 'list'), 'Back to faq listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">New Faq Item</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Question</td>
					<td align="left" valign="middle">
						<textarea name="question" rows="5" cols="70" tabindex="1"></textarea>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="2" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Answer</td>
					<td align="left" valign="middle">
						<?  
						$oFCKeditor = new FCKeditor('answer') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
						?>
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
	case 'update':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('faq', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('faq', 'list', 'list', 'id='.$id), 'Back to faq listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Edit FAQ Item </td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Question</td>
					<td align="left" valign="middle"><textarea name="question" rows="5" cols="70" tabindex="1"><?=$news->question?></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="2" value="1" <?=($news->is_active)?'checked':'';?> /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Answer</td>
					<td align="left" valign="middle">
					<?  
						$oFCKeditor = new FCKeditor('answer') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= $news->answer;
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
					?>			
					
				
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
