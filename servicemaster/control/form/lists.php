<?
#handle sections here.
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td  >
					<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=lists', 2);?>
				</td>
			</tr>
		</table><br/>
		<table width="100%" border="0" cellpadding="2" cellspacing="2" align="center" class="table" style="border:solid 1px #dcdcdc;">
		<tr>
			<td width="5%" class="table_head">Sr.</td>
			<td width="40%" class="table_head">Email Address</td>
			<td width="25%"class="table_head">Signup date</td>
			<td width="15%"class="table_head">IP Address</td>
			<td width="15%"class="table_head" align="center">Control</td>
			
		</tr>
		<?$sr=(($QueryObj->PageNo-1)*$QueryObj->PageSize)+1;?>
		<?while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
		<tr>
			<td ><?=$sr++;?>.</td>
			<td ><?=$QueryObj1->emailaddress?></td>
			<td ><?=$QueryObj1->signupon?></td>
			<td ><?=$QueryObj1->ip_address?></td>
			<td  align="center"><a href="<?=make_admin_url('lists','delete', 'list', 'id='.$QueryObj1->id);?>">Delete</a></td>
		</tr>
		<?endwhile;?>
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
