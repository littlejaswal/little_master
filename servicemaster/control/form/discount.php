<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border: solid 1px #dcdcdc;">
			<tr>
				<td width="70%">Discounts</td>
				<td align="right"></td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;" id="zebra">
			<tr>
				<td align="left" width="15%" class="table_head">Name/Code</td>
				<td align="center" width="10%" class="table_head">Type</td>
				<td align="left" width="10%" class="table_head">Value</td>
				<td align="left" width="13%" class="table_head">Begins on</td>
				<td align="left" width="13%" class="table_head">Ends on</td>
				<td colspan="2" align="center" class="table_head">Controls</td>
			</tr>
			
			<?while($object=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="15%" ><?=$object->name?><br/>Code:&nbsp;<?=$object->code?></td>
				<td width="10%"  align="center"><?=$object->type?></td>
				<td width="10%" ><?=number_format($object->amount, 2);?></td>
				<td width="13%" ><?=$object->from_date?></td>
				<td width="13%" ><?=$object->to_date?></td>
				<td width="8%"  align="center"><?=make_admin_link(make_admin_url('discount', 'update', 'update', 'id='.$object->id), get_control_icon('edit'), 'Edit Discount', '','');?></td>
				<td width="8%"  align="center"><?=make_admin_link(make_admin_url('discount', 'delete', 'list', 'id='.$object->id), get_control_icon('cancel'), 'Delete Discount', '','');?></td>
			</tr>
			<?endwhile;?>
			<tr>
				<td width="15%"></td>
				<td width="10%"></td>
				<td width="10%"></td>
				<td width="13%"></td>
				<td width="13%"></td>
				<td width="8%"></td>
				<td width="8%"></td>
			</tr>
		</table>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		
		<form id="new_discount" action="<?=make_admin_url('discount', 'insert', 'insert')?>" method="post" name="new_discount">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table">
				<tr>
					<td colspan="2" class="table_head">New Discount</td>
				</tr>
				<tr>
					<td width="30%">Name</td>
					<td><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%">Code</td>
					<td><input type="text" name="code" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%">Type</td>
					<td><select name="type" size="1" tabindex="2">
							<option value="-">&nbsp;Flat Dicount&nbsp;</option>
							<option value="%-">&nbsp; %- &nbsp;Discount&nbsp;</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%">Value</td>
					<td><input type="text" name="amount" size="24" tabindex="3" /></td>
				</tr>
				<tr>
					<td width="30%">Begins on</td>
					<td><input type="text" name="from_date" size="24" tabindex="4" /></td>
				</tr>
				<tr>
					<td width="30%">Ends on</td>
					<td><input type="text" name="to_date" size="24" tabindex="5" /></td>
				</tr>
				<tr>
					<td width="30%">Minimum Sub Total</td>
					<td><input type="text" name="min_sub_total" size="24" tabindex="5" /></td>
				</tr>
				<!--<tr>
					<td width="30%">Apply to all</td>
					<td><input type="checkbox" name="apply_to_all" size="24" tabindex="6" value="1"/></td>
				</tr>-->
				<tr>
					<td width="30%">Comments</td>
					<td><textarea name="comment" rows="4" cols="58" tabindex="7"></textarea></td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td><input type="submit" name="submit" value="Submit" tabindex="8" /></td>
				</tr>
			</table>
		</form>
		
		
		
		<?
		break;
	case 'update':
		#html code here.
		?>
		
		<form id="update_discount" action="<?=make_admin_url('discount', 'update', 'list', 'id='.$id)?>" method="post" name="update_discount">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table">
				<tr>
					<td colspan="2" class="table_head">Update Discount</td>
				</tr>
				<tr>
					<td width="30%">Name</td>
					<td><input type="text" name="name" size="24" tabindex="1" value="<?=$discount->name?>"/></td>
				</tr>
				<tr>
					<td width="30%">Code</td>
					<td><input type="text" name="code" size="24" tabindex="1" value="<?=$discount->code?>"/></td>
				</tr>
				<tr>
					<td width="30%">Type</td>
					<td><select name="type" size="1" tabindex="2">
							<option value="-" <?=($discount->type=='-')?'selected':''?>>&nbsp;Flat Dicount&nbsp;</option>
							<option value="%-" <?=($discount->type=='%-')?'selected':''?>>&nbsp; %- &nbsp;Discount&nbsp;</option>
						</select></td>
				</tr>
				<tr>
					<td width="30%">Value</td>
					<td><input type="text" name="amount" size="24" tabindex="3" value="<?=$discount->amount?>" /></td>
				</tr>
				<tr>
					<td width="30%">Begins on</td>
					<td><input type="text" name="from_date" size="24" tabindex="4" value="<?=$discount->from_date?>" /></td>
				</tr>
				<tr>
					<td width="30%">Ends on</td>
					<td><input type="text" name="to_date" size="24" tabindex="5" value="<?=$discount->to_date?>" /></td>
				</tr>
				<tr>
					<td width="30%">Minimum Sub Total</td>
					<td><input type="text" name="min_sub_total" size="24" tabindex="5" value="<?=$discount->min_sub_total?>"/></td>
				</tr>
			<!--	<tr>
					<td width="30%">Apply to all</td>
					<td><input type="checkbox" name="apply_to_all" size="24" tabindex="6" value="1" <? //($discount->apply_to_all)?'checked':'';?>/></td>
				</tr>-->
				<tr>
					<td width="30%">Comments</td>
					<td><textarea name="comment" rows="4" cols="58" tabindex="6"><?=$discount->comment?></textarea></td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>

		