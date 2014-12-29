<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left">
			<tr>
				<td align="left">
					Welcome {<?=ucfirst($CurrentUser->username);?>}<br/> 
				</td>
				<td></td>
				<td align="right">
					Last access date: <?=$admin_user->get_last_access();?> 
				</td>
			</tr>
			<tr>
				<td width="33%"></td>
				<td width="10%"></td>
				<td></td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="left" >
			<tr>
				<td valign="top" class="background">
					<table width="90%" border="0" cellspacing="1" cellpadding="3" align="left">
						<tr>
							<td colspan="2" style="border-bottom:dashed 1px #dcdcdc;"  align="left"><b>Visitor Statistics </b></td>
						</tr>
						<tr>	
							<td width="50%" class="table_cell" align="left">Total visits today:&nbsp;<?=$total_visit_today;?></td>
							<td width="50%" class="table_cell" align="left">Total visits this week:&nbsp;<?=$total_visit_week;?></td>
						</tr>
						<tr>	
							<td width="50%" class="table_cell" align="left">Total visits this month:&nbsp;<?=$total_visit_month;?></td>
							<td width="50%" class="table_cell" align="left">Total visits this year:&nbsp;<?=$total_visit_year;?></td>
						</tr>
					    <tr>	
							<td class="table_cell" colspan="2"></td>
						</tr>
				  </table>			  
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			
			
             
</table>
		<?
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
