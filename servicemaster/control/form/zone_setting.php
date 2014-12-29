<form id="addzonesetting" action="<?=make_admin_url('zone_setting', 'insert', 'zone_id='.$zone_id);?>" method="post" name="addzonesetting">
	<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
		<tr>
			<td colspan="4" class="table_head">&lt;&gt;</td>
		</tr>
		<tr>
			<td width="25%">Shipping Type</td>
			<td width="25%">
				<select name="shipping_type" size="1">
					<?while($shipp= $querys->GetObjectFromRecord()):?>
							<option value="<?=$shipp->id?>"><?=$shipp->name?></option>
					<?endwhile;?>
				</select>
			</td>
			<td width="25%">Price Type</td>
			<td>
				<select name="price_type" size="1" tabindex="2">
					<option value="+">Percentage</option>
					<option value="%">Flat</option>
				</select>
			</td>
		</tr>
		<input type="hidden" name="zone_id" value="<?=$zone_id?>">
		<tr>
			<td width="25%">Extra Limit From</td>
			<td width="25%"><input type="text" name="upper_limit" size="24" tabindex="3" /></td>
			<td width="25%">Extra Limit To</td>
			<td><input type="text" name="lower_limit" size="24" tabindex="4" /></td>
		</tr>
		<tr>
			<td width="25%">Extra Units</td>
			<td width="25%"><input type="text" name="unit_extra" size="24" tabindex="5" /></td>
			<td width="25%">Extra Price per unit</td>
			<td><input type="text" name="price_extra" size="24" tabindex="6" /></td>
		</tr>
		<tr>
			<td width="25%"></td>
			<td width="25%"></td>
			<td width="25%"></td>
			<td><input type="submit" name="submit" value="Click to add" tabindex="7" /></td>
		</tr>
	</table>
</form>
<br />

<?if($QueryObj->GetNumRows()):?>
<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;"><tr>
<?
$sr=0;
while($display_set= $QueryObj->GetObjectFromRecord()):?>
	<?if($id!=0 && $id==$display_set->id):?>
		<td width="50%">
			<form id="update_zone_setting" action="<?=make_admin_url('zone_setting', 'update','list','id='.$id.'&zone_id='.$zone_id);?>" method="post" name="update_zone_setting">
				<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td width="50%">Zone</td>
						<td>
							<select name="zone_id" size="1">
								<?while($zone= $queryz->GetObjectFromRecord()):?>
										<option value="<?=$zone->id?>" <?=($display_set->zone_id=$zone->id)?'selected':'';?>><?=$zone->name?></option>
								<?endwhile;?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="50%">Shipping Type</td>
						<td>
							<select name="shipping_type" size="1">
								<?while($shipp= $querysu->GetObjectFromRecord()):?>
											<option value="<?=$shipp->id?>" <?=($shipp->id==$display_set->shipping_type)?'selected':''?>><?=$shipp->name?></option>
								<?endwhile;?>
							</select>
						</td>
					</tr>
					<tr>
						<td width="50%">Price Type</td>
						<td>
							<select name="price_type" size="1">
								<option value="%" <?=($display_set->price_type=='%')?'selected':'';?>>Percentage</option>
								<option value="+" <?=($display_set->price_type=='+')?'selected':'';?>>Flat</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="50%">Extra Limit From</td>
						<td><input type="text" name="lower_limit" size="15" value="<?=$display_set->lower_limit?>" /></td>
					</tr>
					<tr>
						<td width="50%">Extra Limit To</td>
						<td><input type="text" name="upper_limit" size="15" value="<?=$display_set->upper_limit?>" /></td>
					</tr>
					<tr>
						<td width="50%">Extra Price per unit</td>
						<td><input type="text" name="price_extra" size="15" value="<?=$display_set->price_extra?>" /></td>
					</tr>
					<tr>
						<td width="50%">Extra Units</td>
						<td><input type="text" name="unit_extra" size="15" value="<?=$display_set->unit_extra?>" /></td>
					</tr>
					<tr>
						<td align="center" width="50%" colspan="2"><input type="reset">&nbsp;&nbsp; <input type="submit" name="submit" value="Done"></td>
						
					</tr>
				</table>
			</form>
		</td>
	<?else:?>
			<td valign="top" width="50%">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td width="50%">Zone</td>
					<td><?=$display_set->zone_id?></td>
				</tr>
				<tr>
					<td width="50%">Shipping Type</td>
					<td><?=$display_set->shipping_type?></td>
				</tr>
				<tr>
					<td width="50%">Price Type</td>
					<td><?=$display_set->price_type?></td>
				</tr>
				<tr>
					<td width="50%">Extra Limit From</td>
					<td><?=$display_set->upper_limit?></td>
				</tr>
				<tr>
					<td width="50%">Extra Limit To</td>
					<td><?=$display_set->lower_limit?></td>
				</tr>
				<tr>
					<td width="50%">Extra Price per unit</td>
					<td><?=$display_set->price_extra?></td>
				</tr>
				<tr>
					<td width="50%">Extra Units</td>
					<td><?=$display_set->unit_extra?></td>
				</tr>
				<tr>
					<td align="center" width="50%"><?=make_admin_link(make_admin_url('zone_setting', 'list', 'list', 'id='.$display_set->id.'&zone_id='.$zone_id), 'Edit')?> | <?=make_admin_link(make_admin_url('zone_setting', 'delete', 'list', 'id='.$display_set->id), 'Delete')?></td>
					<td align="center"><?=make_admin_link(make_admin_url('shipping', 'list', 'list', 'zsid='.$display_set->id),'Add Shipping Values')?></td>
				</tr>
			</table>
		</td>
	<?endif;?>
	<?($sr++%2==0)?'</tr><tr>':'';?>
<?endwhile;?>
	</tr>
</table>
<?endif;?>