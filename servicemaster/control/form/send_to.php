
<script language = "Javascript">
function SetChecked(val,form)
{
	dml=document.forms[form];
	len = dml.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) 
	{ if (dml.elements[i].type=='checkbox')
		{  dml.elements[i].checked=val;}
	}
}

function ValidateForm(dml){
len = dml.elements.length;
var i=0;
for( i=0 ; i<len ; i++) {
if ((dml.elements[i].type=='checkbox') && (dml.elements[i].checked==1)) {
	return true;
}
}
alert("Please select at least one record to send newsletter");
return false;
}
// -->
</script>
<?
display_message(1);
#handle sections here.
switch ($section):
	case 'newsletterUsersList':
		?>
		<form action="<?=DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=send_to&action=send&id=<?=$id?>&page=<?=$page?>" method="POST" id="send_to" name="send_to" onsubmit="return ValidateForm(send_to);">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
					<tr>
					<td >
						<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE.ADMIN_FOLDER.'/control.php', 'Page=send_to&id='.$id, 2);?>
					</td>
				</tr>
			</table><br/>
			<table align="center" class="table" width="100%" style="border:solid 1px #dcdcdc;">
				<tr>
					<td class="table_head">Sr.</td>
					<td class="table_head">Email Address</td>
					<td class="table_head">Signup date</td>
					<td class="table_head">IP Address</td>
					<td class="table_head" width="15%">de/select all <input type="checkbox" value="1" name="selectall" id="selectall"   onclick="SetChecked(document.getElementById('selectall').checked, 'send_to');" style="margin:0px;padding:0px;"></td>
				</tr>
				<?$sr=(($QueryObj->PageNo-1)*$QueryObj->PageSize)+1;?>
				<?while($newsletterUsers=$QueryObj->GetObjectFromRecord()):?>
					<tr>
						<td ><?=$sr++;?>.</td>
						<td ><?=$newsletterUsers->emailaddress?></td>
						<td ><?=$newsletterUsers->signupon?></td>
						<td ><?=$newsletterUsers->ip_address?></td>
						<td  align="center"><input type="checkbox" name="email[]" value="<?=$newsletterUsers->emailaddress?>" style="border:none;"></td>
					</tr>
				<?endwhile;?>
			</table>
			<br>
			<table align="center" class="table" width="100%" style="border:solid 1px #dcdcdc;">
				<tr>
					<td  align="right"><input type="submit" name="submit" value="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table><br/>
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table"style="border:solid 1px #dcdcdc;" >
				<tr>
					<td align="center">
						<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE.ADMIN_FOLDER.'/control.php', 'Page=send_to&id='.$id, 2);?>
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
		case 'registeredUsersList':
		?>
		<form action="<?=DIR_WS_SITE.ADMIN_FOLDER?>/control.php?Page=send_to&action=send&id=<?=$id?>&page=<?=$page?>" method="POST" id="send_to" name="send_to" onsubmit="return ValidateForm(send_to);">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
					<tr>
					<td >
						<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE.ADMIN_FOLDER.'/control.php', 'Page=send_to&id='.$id, 2);?>
					</td>
				</tr>
			</table><br/>
			<table align="center" class="table" width="100%" style="border:solid 1px #dcdcdc;">
				<tr>
					<td class="table_head">Sr.</td>
					<td class="table_head">Name</td>
					<td class="table_head">Email Address</td>
					<td class="table_head">Signup date</td>
					<td class="table_head">IP Address</td>
					<td class="table_head" width="15%">de/select all <input type="checkbox" value="1" name="selectall" id="selectall"   onclick="SetChecked(document.getElementById('selectall').checked, 'send_to');" style="margin:0px;padding:0px;"></td>
				</tr>
				<?$sr=(($QueryObjUser->PageNo-1)*$QueryObjUser->PageSize)+1;?>
				<?while($registeredUsers=$QueryObjUser->GetObjectFromRecord()):?>
					<tr>
						<td ><?=$sr++;?>.</td>
						<td ><?=$registeredUsers->firstname." ".$registeredUsers->lastname;?></td>
						<td ><?=$registeredUsers->username?></td>
						<td ><?=$registeredUsers->on_date?></td>
						<td ><?=$registeredUsers->ip_address?></td>
						<td  align="center"><input type="checkbox" name="email[]" value="<?=$QueryObj1->emailaddress?>" style="border:none;"></td>
					</tr>
				<?endwhile;?>
			</table>
			<br>
			<table align="center" class="table" width="100%" style="border:solid 1px #dcdcdc;">
				<tr>
					<td  align="right"><input type="submit" name="submit" value="Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>
			</table><br/>
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table"style="border:solid 1px #dcdcdc;" >
				<tr>
					<td align="center">
						<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE.ADMIN_FOLDER.'/control.php', 'Page=send_to&id='.$id, 1);?>
					</td>
				</tr>
			</table>
		</form>
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
