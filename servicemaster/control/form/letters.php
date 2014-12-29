<?
display_message(1);
switch ($section):
	case 'list':
		?>
		<table border="0" align="center" cellpadding="2" cellspacing="2" width="100%" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left" ><?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE.ADMIN_FOLDER."//control.php", 'Page=letters',2);?></td>
			</tr>
		</table>
		<br/>
		<table border="0" align="center" cellpadding="2" cellspacing="2" width="100%" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td  width="5%" class="table_head" align="center"><strong>Sr.</strong></td>
				<td width="34%" class="table_head"><strong>Title</strong></td>
				<!--<td width="18%" class="table_head" align="left"><strong>Created|Updated</strong></td>-->
				<td width="15%"class="table_head" align="center" colspan="1"><strong>Send Newsletter</strong></td>
				<td colspan="2" class="table_head" align="center"><strong>Controls</strong></td>
			</tr>
			<?if($QueryObj->GetNumRows()>0):?>
			<?$sr=1;?>
			<?while($Email=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td  align="left"><?=$sr++;?>.</td>
				<td ><?=$Email->Name;?></td>
				<td width="19%" align="center"  ><a href="<?php echo make_admin_url('send_to', 'newsletterUsersList', 'newsletterUsersList', 'id='.$Email->id)?>">Newsletter Users</a></td>
				<td width="10%" align="center" ><a href="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=new_letter&id=<?=$Email->id;?>&section=update&action=list"><?php echo get_control_icon('edit')?></a></td>
				<td width="6%" align="center" ><a href="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=letters&delete=<?=$Email->id;?>&action=delete"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<?endwhile;?>
			<?else:?>
			<tr>
				<td  align="center" colspan="6">Sorry! no record found.</td>
			</tr>
			<?endif;?>
		</table>
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



