<?
#handle sections here.
switch ($section):
	case 'list':
		#html code heret
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4"><b>Attributes</b></td>
				<td colspan="5" align="right"><?=make_admin_link(make_admin_url('attribute','list','insert'), 'Add New Attribute', 'Add new attribute');?></td>
			</tr>
			<tr>
				<td colspan="5"></td>
			</tr>
			<tr>
				<td width="5%" class="table_head">Sr.</td>
				<td width="20%" class="table_head">Name</td>
				<td width="20%" class="table_head">Type</td>
				<td class="table_head"></td>
				<td class="table_head"></td>
			</tr>
			<?
			$sr=1;
			while($attribute=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="5%" class="table_cell"><?=$sr++;?>.</td>
				<td width="20%" class="table_cell"><?=$attribute->name?></td>
				<td width="20%" class="table_cell"><?=$attribute->type?></td>
				<td align="center" valign="middle" class="table_cell"><?=make_admin_link(make_admin_url('attribute','update','update','id='.$attribute->id), 'Edit', 'Edit');?></td>
				<td align="center" valign="middle" class="table_cell"><?=make_admin_link(make_admin_url('attribute','delete','list','id='.$attribute->id), 'Delete', 'Delete');?></td>
			</tr>
			<?endwhile;?>
		</table>
		<?
		break;
	case 'insert':
		?>
		<form id="attribute_add" action="<?=make_admin_url('attribute','insert','list');?>" method="post" name="attribute">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" class="table_cell"><a href="#">back to attribute listing</a></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="middle" class="table_head">Add New Attribute</td>
				</tr>
				<tr>
					<td width="30%" class="table_cell">Name</td>
					<td class="table_cell"><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%" class="table_cell">Type</td>
					<td class="table_cell">
						<select name="type" size="1" tabindex="2">
							<option selected="selected" value="textbox">Text Box</option>
							<option value="list">List Box</option>
							<option value="radio">Radio</option>
							<option value="check">Check Box</option>
							<option value="textarea">Text Area</option>
							<option value="file">File Upload</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%" class="table_cell">Is Free</td>
					<td class="table_cell"><input type="checkbox" name="is_free" value="1" tabindex="3" /></td>
				</tr>
				<tr>
					<td width="30%" class="table_cell">default</td>
					<td class="table_cell"><input type="checkbox" name="is_default" value="is_default" tabindex="4" /></td>
				</tr>
				<tr>
					<td width="30%" class="table_cell">Apply To</td>
					<td class="table_cell"><input type="radio" name="apply_to" value="product" tabindex="5" /> Products&nbsp;&nbsp;<input type="radio" name="apply_to" value="category" tabindex="6" /> Categories</td>
				</tr>
				<tr>
					<td width="30%" class="table_cell"></td>
					<td class="table_cell"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		?>
		<form id="attribute_edit" action="<?=make_admin_url('attribute','update','list','id='.$id)?>" method="post" name="attribute_edit">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2"><a href="#">back to attribute listing</a></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="middle" class="table_head">Edit Attribute</td>
				</tr>
				<tr>
					<td width="30%">Name</td>
					<td><input type="text" name="name" size="24" tabindex="1" value="<?=$attribute->name?>"/></td>
				</tr>
				<tr>
					<td width="30%">Type</td>
					<td>
						<select name="type" size="1" tabindex="2">
							<option value="textbox" <?=($attribute->type=='textbox')?'selected':'';?>>Text Box</option>
							<option value="list" <?=($attribute->type=='list')?'selected':'';?>>List Box</option>
							<option value="radio" <?=($attribute->type=='radio')?'selected':'';?>>Radio</option>
							<option value="check" <?=($attribute->type=='check')?'selected':'';?>>Check Box</option>
							<option value="textarea" <?=($attribute->type=='textarea')?'selected':'';?>>Text Area</option>
							<option value="file" <?=($attribute->type=='file')?'selected':'';?>>File Upload</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="30%">Is Free</td>
					<td><input type="checkbox" name="is_free" value="1" tabindex="3" <?=($attribute->is_free)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td width="30%">Default</td>
					<td><input type="checkbox" name="is_default" value="is_default" tabindex="4"  <?=($attribute->is_default)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td width="30%">Apply To</td>
					<td><input type="radio" name="apply_to" value="product" tabindex="5" <?=($attribute->apply_to=='product')?'checked':'';?>/> Products&nbsp;&nbsp;<input type="radio" name="apply_to" value="category" tabindex="6" <?=($attribute->apply_to=='category')?'checked':'';?> /> Categories</td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
