<script type="text/javascript">
	$("document").ready(function() {
		$("#keywords_date").datepicker();
	});
</script>
<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td colspan="7"  style="border-top:solid 1px #dcdcdc;">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=keywords_management', 2);?>
				</td>
			</tr>
			<? if($QueryObj->GetNumRows()!=0):?>
			<tr>
				<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
				<td width="20%" class="table_head">Page Name</td>
				<td align="center" valign="middle" width="10%" class="table_head">Meta Title</td>
			
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($keywords=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="10%"  align="center"><?=$sr++?>.</td>
				<td width="25%" ><?=$keywords->page_name?></td>
				<td width="25%"  align="center"><?=$keywords->page_title?></td>

				<td align="center">
					<?=make_admin_link(make_admin_url('keywords_management', 'update', 'update', 'id='.$keywords->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('keywords_management', 'delete', 'list', 'id='.$keywords->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<?endwhile;
			else:?>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="6">Sorry no keywords found.</td>
				</tr>
			<?endif;?>
			
		</table>
		<?
		break;
	case 'insert':
		?>
		<form id="keywords_insert" action="<?=make_admin_url('keywords_management', 'insert', 'insert');?>" method="post" name="keywords_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('keywords_management', 'list', 'list'), 'Back to keywords listing');?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left" >Add New keywords</td>
				</tr>
				<tr>
					<td align="left" width="40%">Page Name</td>
					<td align="left"><input type="text" name="page_name" size="31" tabindex="1" /></td>
				</tr>
             
				<tr>
					<td align="left" width="40%">Meta Title</td>
					<td align="left"><textarea name="page_title" rows="2" cols="25" tabindex="8"></textarea></td>
				</tr>
				
			
				<tr>
					<td align="left" valign="top" width="40%">Meta Keywords</td>
					<td align="left"><textarea name="keyword" rows="3" cols="25" tabindex="9"></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="40%">Meta Description</td>
					<td align="left"><textarea name="description" rows="4" cols="25" tabindex="10"></textarea></td>
				</tr>
				<tr>
					<td align="left" width="40%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="11" /></td>
				</tr>
				
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'update':
		#html code here.
		?>
		<form id="keywords_update" action="<?=make_admin_url('keywords_management', 'update', 'update', 'id='.$id)?>" method="post" name="keywords_update">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left">
						<?=make_admin_link(make_admin_url('keywords_management', 'list', 'list'), 'Back to keywords listing');?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left" >Edit keywords</td>
				</tr>
				<tr>
					<td align="left" width="40%">Page Name</td>
	<td align="left"><input type="text" name="page_name" size="31" tabindex="1"  value="<?=$keywords->page_name;?>"/></td>
				</tr>
                
				<tr>
					<td align="left" width="40%">Meta Title</td>
	<td align="left"><textarea name="page_title" rows="2" cols="25" tabindex="8" ><?=$keywords->page_name;?></textarea></td>
				</tr>
				
			<tr>
					<td align="left" width="29%">Meta Keywords</td>
					<td width="71%" align="left"><textarea name="keyword" rows="3" cols="25" tabindex="9"><?=$keywords->keyword;?></textarea></td>
				</tr>
	<tr>
					<td align="left" width="29%">Meta Description</td>
					<td width="71%" align="left"><textarea name="Description" rows="4" cols="25" tabindex="10" ><?=$keywords->description;?></textarea></td>
				</tr>
					<tr>
					<td align="left" width="40%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="11" /></td>
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
