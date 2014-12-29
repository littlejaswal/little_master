<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="re_type" action="<?=make_admin_url('question')?>" method="get" name="re_type">
			<table width="100%" border="1" cellspacing="2" cellpadding="2">
				<tr>
					<td align="right" width="30%">Select question type</td>
					<td align="center" valign="middle" width="20%">
						<select name="r_type" size="1">
							<option value="1" <?=($type==1)?'selected':''?>>Answered</option>
							<option value="0" <?=($type==0)?'selected':''?>>Not Answered</option>
							<option value="3" <?=($type==3)?'selected':''?>>Archived</option>
						</select>
					</td>
					<input type="hidden" name="Page" value="question">
					<td><input type="submit" name="submit" value="Get List" /></td>
				</tr>
			</table>
		</form>
		<br/>
		<?while($que=$QueryObj->GetObjectFromRecord()):?>
		<table width="100%" border="1" cellspacing="2" cellpadding="2">
			<tr>
				<td width="30%">Product</td>
				<td><?=$product_obj->get_name_by_id($que->product_id);?></td>
			</tr>
			<tr>
				<td width="30%">question by:</td>
				<td><?=$que->name?></td>
			</tr>
			<tr>
				<td width="30%">question date:</td>
				<td><?=$que->on_date?></td>
			</tr>
			<tr>
				<td width="30%">question</td>
				<td align="justify"></td>
			</tr>
			<tr>
				<td colspan="2" align="justify"><?=$que->question?></td>
			</tr>
			<?if($type==1 || $type==3):?>
			<tr>
				<td width="30%">Answer</td>
				<td align="justify">Answered on:&nbsp;<?=$que->answer_date?></td>
			</tr>
			<tr>
				<td colspan="2" align="justify"><?=$que->answer?></td>
			</tr>
			<?endif;?>
			<tr>
				<td colspan="2">
					<?=($type==0)?make_admin_link(make_admin_url('answer', 'list', 'list', 'id='.$que->id.'&r_type='.$type), 'Answer', 'Answer'):'';?> 
					<?=make_admin_link(make_admin_url('question', 'set_type', 'list', 'id='.$que->id.'&r_type='.$type.'&set_type=3'), 'Archive', 'Archive')?> 
					<?=make_admin_link(make_admin_url('question', 'delete', 'list', 'id='.$que->id.'&r_type='.$type), 'Delete', 'Delete')?> 
				</td>
			</tr>
		</table>
		<?endwhile;?>
		<?
		break;
	default:break;
endswitch;
?>
