<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table cellpadding="2" cellspacing="2" class="table" align="left" width="100%" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left" class="table_head">Zones</td>
			</tr>
		</table>
		<div style="clear:both"></div>
		<br>
		<table cellpadding="2" cellspacing="2" class="table" align="left" width="100%">
			<tr>
				<td width="5%"  class="table_head">Sr.</td>
				<td width="65%" class="table_head">Name</td>
				<td width="30%" class="table_head">Controls</td>
			</tr>
			<?php $sr=1;while($object=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center"><?php echo $sr++;?>.</td>
				<td align="left"><?php echo $object->name?></td>
				<td align="left"><a href="<?php echo make_admin_url('zones', 'delete', 'list', 'id='.$object->id);?>">delete</a></td>
			</tr>
			<?php endwhile;?>
		</table>
		<p></p>
		<form action="<?php echo make_admin_url('zones', 'insert')?>" method="POST">
		<table cellpadding="2" cellspacing="2" class="table" align="left" width="100%">
			<tr>
				<td width="5%" align="center"><?php echo $sr;?>.</td>
				<td width="65%" align="left"><input type="text" name="name" value="" size="50"></td>
				<td align="left"><input type="submit" name="submit" value="Insert"> </td>
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
