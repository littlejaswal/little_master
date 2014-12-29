<?

echo display_message(1);

#handle sections here.

switch ($section):

	case 'list':

		#html code here.

		?>

		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">

			<tr>

				<td align="left">Settings</td>

			</tr>

		</table>

		<p></p>

		<form action="<?php echo make_admin_url('setting', 'update', 'update');?>" method="POST">

		<table cellpadding="2" cellspacing="2" align="left" width="100%" class="table" style="border:solid 1px #DCDCDC;">

			<tr>

				<td width="50%" align="left"><b>Name</b></td>

				<td align="left"><b>Value</b></td>

			</tr>

			<?php $sr=1; while ($object= $QueryObj->GetObjectFromRecord()):?>
			
			<?php if($object->name!=$name):?>

			<tr>

				<td width="50%" colspan="2" align="left" class="table_head"><?php echo ucfirst($object->name);?> settings</td>

			</tr>

			<?php $name=$object->name;?>

			<?php endif;?>
		    <?php if(strtolower($object->title)!='error email address'):?>
			<tr>

				<td align="left"><?php echo ucfirst($object->title);?></td>

				<td align="left"><?php echo get_setting_control($object->id, $object->type, $object->value);?></td>

			</tr>		
			<?php endif;?>
			<?php endwhile;?>

			<tr>

				<td width="50%" align="left">&nbsp;</td>

				<td align="left"><input type="submit" name="Submit" value="Update"></td>

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

