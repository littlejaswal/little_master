<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="re_type" action="<?=make_admin_url('review')?>" method="get" name="re_type">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td colspan="3" class="table_head" colspan="2">Reviews</td>
				</tr>
				<tr>
					<td align="right" width="30%" class="table_cell1">Select review type</td>
					<td align="center" valign="middle" width="20%" class="table_cell1">
						<select name="r_type" size="1">
							<option value="1" <?=($type==1)?'selected':''?>>Newest</option>
							<option value="2" <?=($type==2)?'selected':''?>>Approved</option>
							<option value="3" <?=($type==3)?'selected':''?>>Archived</option>
						</select>
					</td>
					<input type="hidden" name="Page" value="review">
					<td class="table_cell1"><input type="submit" name="submit" value="Get List" /></td>
				</tr>
			</table>
		</form>
		<br/>
		<?while($rev=$QueryObj->GetObjectFromRecord()):?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td colspan="3" class="table_head" colspan="2">Review Details</td>
			</tr>
			<tr>
				<td width="30%" class="table_cell1">Product</td>
				<td class="table_cell1"><?=get_pro_name_by_id($rev->product_id);?></td>
			</tr>
			<tr>
				<td width="30%" class="table_cell1">Review by:</td>
				<td class="table_cell1"><?=$rev->name?></td>
			</tr>
			<tr>
				<td width="30%" class="table_cell1">Review date:</td>
				<td class="table_cell1"><?=$rev->on_date?></td>
			</tr>
			<tr>
				<td width="30%" class="table_cell1">Review</td>
				<td align="justify" class="table_cell1"><?=$rev->review?></td>
			</tr>
			<? if($rev->star_rating):?>
			<tr>
				<td width="30%" class="table_cell1">Star Rating</td>
				<td align="justify" class="table_cell1"><?=get_star($rev->star_rating);?></td>
			</tr>
			<? endif;?>
			<tr>
				<td colspan="2" class="table_cell1">
					<?=make_admin_link(make_admin_url('review', 'set_type', 'list', 'id='.$rev->id.'&r_type='.$type.'&set_type=2'), 'Approve', 'Approve','text')?> | 
					<?=make_admin_link(make_admin_url('review', 'set_type', 'list', 'id='.$rev->id.'&r_type='.$type.'&set_type=3'), 'Archive', 'Archive','text')?> | 
					<?=make_admin_link(make_admin_url('review', 'delete', 'list', 'id='.$rev->id.'&r_type='.$type), 'Delete', 'Delete','text')?> 
				</td>
			</tr>
		</table>
		<?endwhile;?>
		<?break;
	default:break;
endswitch;
?>
