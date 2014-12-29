<?
display_message(1);;
#handle sections here.
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td style="text-align:left;">
					<a href="<?=DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=letters" >Newsletter Listing</a>
				</td>
			</tr>
		</table>
		<p></p>
		<form method="post" action="<?=make_admin_url('new_letter', 'insert', 'list', 'id='.$id);?>
			<table cellpadding="2" cellspacing="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
				<tr>
					<td class="table_head" colspan="2">Create new e-mail</td>
				</tr>
				<tr>
					<td  colspan="2"" align="left">Title&nbsp;&nbsp;<input type="text" name="title" value="<?=isset($Email->Name)?$Email->Name:'';?>" size="50"></td>
				</tr>
				<tr>
					<td  align="center" colspan="2" style="padding-left:20px;">
						<!---Start content editor--->
					<?  $oFCKeditor = new FCKeditor('Content') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($Email->Content);
						$oFCKeditor->Height		=700;
						$oFCKeditor->Create() ;
					?>
						
					</td>
				</tr>
					<input type="hidden" name="id" value="<?=isset($Email->id)?$Email->id:0;?>">
				<tr>
					
					<td  align="center" colspan="2">
					<input type="submit" name="submit" value="Save" class="Bn">
					&nbsp;&nbsp;&nbsp;
					<input type="submit" name="submit" value="Finish" class="Bn">
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
		
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td style="text-align:left;">
					<a href="<?=DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=letters" >Newsletter Listing</a>
				</td>
			</tr>
		</table>
		<p></p>
		<form method="post" action="<?=make_admin_url('new_letter', 'insert', 'list', 'id='.$id);?>">
			<table cellpadding="2" cellspacing="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
				<tr>
					<td class="table_head" colspan="2">Create new e-mail</td>
				</tr>
				<tr>
					<td  colspan="2" align="left"">Title&nbsp;&nbsp;<input type="text" name="title" value="<?=isset($Email->Name)?$Email->Name:'';?>" size="50"></td>
				</tr>
				<tr>
					<td  align="center" colspan="2" style="padding-left:20px;">
					<?  $oFCKeditor = new FCKeditor('Content') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= isset($Email->Content)?html_entity_decode($Email->Content):'';
						$oFCKeditor->Height		=700;
						$oFCKeditor->Create() ;
					?>						
					</td>
				</tr>
				<tr>
					
					<td  align="center" colspan="2">
						<input type="submit" name="submit" value="Save" class="Bn">
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'update':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td style="text-align:left;">
					<a href="<?=DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=letters" >Newsletter Listing</a>
				</td>
			</tr>
		</table>
		<p></p>
		<form method="post" action="<?=make_admin_url('new_letter', 'update', 'list', 'id='.$id);?>
			<table cellpadding="2" cellspacing="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
				<tr>
					<td class="table_head" colspan="2">Update Newsletter</td>
				</tr>
				<tr>
					<td  colspan="2" align="left">Title&nbsp;&nbsp;<input type="text" name="title" value="<?=isset($Email->Name)?$Email->Name:'';?>" size="50"></td>
				</tr>
				<tr>
					<td  align="center" colspan="2" style="padding-left:20px;">
					<?  $oFCKeditor = new FCKeditor('Content') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($Email->Content);
						$oFCKeditor->Height		=700;
						$oFCKeditor->Create() ;
					?>				
					</td>
				</tr>
				<input type="hidden" name="id" value="<?=isset($Email->id)?$Email->id:0;?>">
				<tr>
					
					<td  align="center" colspan="2">
						<input type="submit" name="submit" value="Save" class="Bn">
						<input type="submit" name="submit" value="Save as new" class="Bn">
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>


