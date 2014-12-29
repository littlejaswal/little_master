<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
						<td class="table_head">Zone:&nbsp;<?=$zones->name?>&nbsp; Shipping Type:&nbsp;<?=$shipping_type->name;?></td>
				</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
						<td class="table_head" align="center"><?=make_admin_link(make_admin_url('zone_setting', 'list', 'list', 'id='.$zones->id), 'Zone Settings')?></td>
						<td class="table_head" align="center"><?=make_admin_link(make_admin_url('zones', 'list', 'list'), 'Manage Zones')?></td>
						<td class="table_head" align="center"><?=make_admin_link(make_admin_url('shipping_type', 'list', 'list'), 'Manage Shipping Types')?></td>
				</tr>
		</table>
		<br/>
		<form id="shipping" action="<?=make_admin_url('shipping', 'insert', 'list', 'zsid='.$zsid)?>" method="post" name="shipping">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td width="15%" class="table_head">From</td>
					<td width="15%" class="table_head">To</td>
					<td width="15%" class="table_head">Price</td>
					<td width="15%" class="table_head">Type</td>
					<td width="15%" class="table_head"></td>
					<td class="table_head"></td>
				</tr>
				<tr>
					<td width="15%" class="table_cell"><input type="text" name="lower_limit" size="10" tabindex="1" /></td>
					<td width="15%" class="table_cell"><input type="text" name="upper_limit" size="10" tabindex="2" /></td>
					<td width="15%" class="table_cell"><input type="text" name="price" size="10" tabindex="3" /></td>
					<td width="15%" class="table_cell">
							<select name="type" size="1" tabindex="4">
									<option value="+">Flat</option>
									<option value="%">Percentage</option>
							</select>
					</td>
					<input type="hidden" value="<?=$zsid?>" name="zsid">
					<td width="15%" class="table_cell"><input type="submit" name="submit" value="Done" tabindex="5" /></td>
					<td class="table_cell"><input type="reset" name="cancel" value="Reset" tabindex="6" /></td>
				</tr>
			</table>
		</form>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
					<td width="5%" class="table_head">Sr.</td>
					<td width="15%" class="table_head">From</td>
					<td width="15%" class="table_head">To</td>
					<td width="15%" class="table_head">Price</td>
					<td width="15%" class="table_head">Type</td>
					<td width="15%" class="table_head"></td>
					<td class="table_head"></td>
				</tr>
			<?$sr=1;?>
			<?while($query= $QueryObj->GetObjectFromRecord()):?>
			<?if($id!=0 && $id==$query->id):?>
				<form action="<?=make_admin_url('shipping', 'update', 'list', 'id='.$id.'&zsid='.$zsid)?>" method="POST">
				<tr>
					<td width="5%"><?=$sr++;?></td>
					<td width="15%"><input type="text" name="lower_limit" size="10" tabindex="1" value="<?=$query->lower_limit?>"/></td>
					<td width="15%"><input type="text" name="upper_limit" size="10" tabindex="2" value="<?=$query->upper_limit?>"/></td>
					<td width="15%"><input type="text" name="price" size="10" tabindex="3" value="<?=$query->price?>"/></td>
					<td width="15%">
							<select name="type" size="1" tabindex="4">
								<option value="+" <?=($query->type=='+')?'selected':'';?>>Flat</option>
								<option value="%" <?=($query->type=='%')?'selected':'';?>>Percentage</option>
							</select>
					</td>
					<td width="15%"><input type="submit" name="submit" value="Done" tabindex="5" /></td>
					<td><input type="submit" name="cancel" value="Cancel" tabindex="6" /></td>
				</tr>
				</form>
			<?else:?>
				<tr>
					<td width="5%"><?=$sr++;?></td>
					<td width="15%"><?=$query->lower_limit?></td>
					<td width="15%"><?=$query->upper_limit?></td>
					<td width="15%"><?=$query->price;?></td>
					<td width="15%"><?=$query->type?></td>
					<td width="15%"><?=make_admin_link(make_admin_url('shipping', 'list', 'list', 'id='.$query->id.'&zsid='.$zsid), 'Edit', 'click here to edit');?></td>
					<td><?=make_admin_link(make_admin_url('shipping', 'delete', 'list', 'id='.$query->id.'&zsid='.$zsid), 'Delete', 'click here to delete');?></td>
				</tr>
			<?endif;?>
			<?endwhile;?>
		</table>
		<?
		break;
	default:break;
endswitch;
?>
