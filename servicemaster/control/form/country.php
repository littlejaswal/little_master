<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table cellspacing="2" cellpadding="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="34%" class="table_head" align="left" style="padding-left:5px;">Country Name</td>
				<td width="21%" class="table_head" align="left" style="padding-left:5px;">ISO1</td>
				<td width="20%" class="table_head" align="left" style="padding-left:5px;">ISO2</td>
				<td width="25%" class="table_head" align="center">Status</td>
			</tr>
		</table>
		<p></p>
		<form action="<?php echo make_admin_url('country', 'update', 'list')?>" method="POST">
		<table cellspacing="2" cellpadding="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;" id="zebra">
			<?php while($country=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="34%"  align="left" style="padding-left:5px;"><?php echo $country->name;?></td>
				<td width="22%"  align="left" style="padding-left:5px;"><?php echo $country->iso1;?></td>
				<td width="17%"  align="left" style="padding-left:5px;"><?php echo $country->iso2;?></td>
				<td width="27%"  align="center">
					Yes
					  <input type="radio" name="is_active[<?php echo $country->id?>]" value="1" <?php echo ($country->is_active)?'checked':'';?> >&nbsp;&nbsp;&nbsp;&nbsp;
					No<input type="radio" name="is_active[<?php echo $country->id?>]" value="0" <?php echo (!$country->is_active)?'checked':'';?> >
			  </td>
			</tr>
			<?php endwhile;?>
			<tr>
				<td class="table_cell" align="left" colspan="3"></td>
			  <td width="27%" class="table_cell" align="center"><input type="submit" name="submit_update" value="Update"></td>
			</tr>
		</table>
		</form>
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
