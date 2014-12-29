<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="50%">Shipping Types</td>
				<td align="center"><?=make_admin_link(make_admin_url('zones', 'list', 'list'), 'Manage Zones');?></td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="5%" class="table_head">Sr.</td>
				<td width="30%" class="table_head">Name</td>
				<td colspan="2" class="table_head">Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($shipt= $QueryObj->GetObjectFromRecord()):?>
				<?if($id!=0 && $id==$shipt->id):?>
					<form action="<?=make_admin_url('shipping_type', 'update', 'list', 'id='.$id)?>" method="POST">
						<tr>
							<td width="5%"></td>
							<td width="30%"><input type="text" name="name" size="20" tabindex="1" value="<?=$shipt->name;?>"/></td>
							<td align="center" valign="middle" width="30%"><input type="submit" name="submit" value="Done" /></td>
							<td align="center" valign="middle"></td>
						</tr>
					</form>
				<?else:?>
					<tr>
						<td width="5%"><?=$sr++;?></td>
						<td width="30%"><?=$shipt->name;?></td>
						<td align="center" valign="middle" width="30%"><?=make_admin_link(make_admin_url('shipping_type', 'list', 'list', 'id='.$shipt->id),'Edit');?></td>
						<td align="center" valign="middle"><?=make_admin_link(make_admin_url('shipping_type', 'delete', 'list', 'id='.$shipt->id),'Delete');?></td>
					</tr>
				<?endif;?>
			<?endwhile;?>
		</table>
		<p></p>
		<form action="<?=make_admin_url('shipping_type', 'insert', 'list')?>" method="POST">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="3" class="table_head">New Shipping Type</td>
				</tr>
				<tr>
					<td width="33%">Name</td>
					<td width="33%"><input type="text" name="name" size="20" tabindex="1" /></td>
					<td><input type="submit" name="submit" value="Done" tabindex="2" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	default:break;
endswitch;
?>
