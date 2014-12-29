<script type="text/javascript">
	$("document").ready(function() {
		$("#news_date").datepicker();
	});
</script>
<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
        <form id="" action="<?=make_admin_url('news', 'update2', 'list')?>" method="post" name="">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=news', 2);?>
				</td>
			</tr>
			<tr>
				<td align="center" valign="middle" width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head">Title</td>
				<td width="20%" class="table_head">News Date</td>
				<td align="center" width="15%" class="table_head">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($news=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" valign="middle" width="10%" ><?=$sr++;?>.</td>
				<td width="30%" ><?=$news->name?></td>
				<td width="20%" ><?=$news->date_show;?></td>
				<td align="center" width="15%" ><input type="checkbox" name="is_active" value="1" <?=$news->is_active?'checked':'';?>></td>
				<td align="center">
				<?=make_admin_link(make_admin_url('news', 'update', 'update', 'id='.$news->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('news', 'delete', 'list', 'id='.$news->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<?endwhile;?>
            <tr><td class="table_head"></td><td class="table_head"></td><td class="table_head"></td>
				  <td align="center" class="table_head"><input type="submit" name="submit" value="Update"></td>
                  <td  colspan="2"class="table_head"></td>
			</tr>
		</table>
        </form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('news', 'insert', 'list')?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2"  align="left"><?=make_admin_link(make_admin_url('news', 'list', 'list'), 'Back to news listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">New News Item</td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%" >Title</td>
					<td align="left" valign="middle" ><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">News Date</td>
					<td align="left" valign="middle"><input type="text" name="news_date" size="24" tabindex="2" id="news_date" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Date to be shown on page</td>
					<td align="left" valign="middle"><input type="text" name="date_show" size="24" tabindex="3" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="4" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Short Description</td>
					<td align="left" valign="middle">
						<textarea name="short_description" rows="4" cols="40" tabindex="5"></textarea>
					</td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Long Description</td>
					<td align="left" valign="middle">
						<?  
						$oFCKeditor = new FCKeditor('long_description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
						?>
					</td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		?>
		<form id="news_insert" action="<?=make_admin_url('news', 'update', 'list', 'id='.$id)?>" method="post" name="news_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2"  align="left"><?=make_admin_link(make_admin_url('news', 'list', 'list', 'id='.$id), 'Back to news listing')?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Edit News Item </td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%" >Title</td>
					<td align="left" valign="middle" ><input type="text" name="name" size="24" tabindex="1" value="<?=$news->name?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">News Date</td>
					<td align="left" valign="middle"><input type="text" name="news_date" id="news_date" size="24" tabindex="2" value="<?=$news->news_date;?>" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Date to be shown on page</td>
					<td align="left" valign="middle"><input type="text" name="date_show" size="24" tabindex="3" value="<?=$news->date_show;?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="30%">Status</td>
					<td align="left" valign="middle"><input type="checkbox" name="is_active" value="1" tabindex="4" value="1" <?=($news->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Short Description</td>
					<td align="left" valign="middle"><textarea name="short_description" rows="4" cols="40" tabindex="5"><?=$news->short_description?></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%">Long Description</td>
					<td align="left" valign="middle">
					<?  
						$oFCKeditor = new FCKeditor('long_description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($news->long_description);
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
					?>			
					
				
					</td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td align="left" valign="middle"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
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
