<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left" class="table_head">Display Selected Products</td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right" width="50%"><?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, '', 'Page=related_product&id='.$id, 2);?></td>
			</tr>
		</table>
		<br/>
		<form action="<?=make_admin_url('related_product', 'update', 'list', 'id='.$id)?>" method="POST">
			<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
				<tr>
					<td width="5%" align="left" class="table_head">Sr.</td>
					<td width="25%"  align="left" class="table_head">Name</td>
					<td width="15%" align="left" class="table_head">Price</td>
					<td align="center" width="10%" class="table_head">Position</td>
					<td align="center" align="left" class="table_head" colspan="2">Control</td>
				</tr>
				<?$sr=1; foreach ($products as $key=>$value):?>
				<tr>
					<td ><?=$sr++;?>.</td>
					<td ><?=$value['name'];?></td>
					<td ><?=number_format($value['price'], 2);?></td>
					<td align="center"><input type="text" name="<?=$value['related_id']?>" value="<?=$value['position']?>" size="3"></td>
					<td align="center" colspan="2">
						<?=make_admin_link(make_admin_url('Product', 'update', 'update','id='.$value['parent_id'].'&pro_id='.$value['id']), 'Edit Product', 'edit product details');?>&nbsp;&nbsp;&nbsp;
						<?=make_admin_link(make_admin_url('related_product', 'delete', 'list', 'related_id='.$value['related_id'].'&id='.$id.'&submit=1'),'Delete from list');?>
					</td>
				</tr>
				<?endforeach;;?>
				<tr>
					<td width="5%" align="left" class="table_cell" colspan="3"></td>
					<td align="center" width="10%" class="table_cell"><input type="submit" name="submit" value="Update"></td>
					<td align="center" align="left" class="table_cell" colspan="2">&nbsp;</td>
				</tr>
			</table>
		</form>
		<br/>
		<form action="<?=make_admin_url('related_product', 'insert', 'list', 'id='.$id)?>" method="POST">
			<table align="center" width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td align="left" width="100%">
						
						<b>Select Products to add to the list:</b><br/>
						<select name="related[]" size="10" multiple style="width:700px;">
							<?foreach ($all_products as $k=>$v):?>
								<option value="<?=$v['id']?>"><?=$v['name']?></option>
							<?endforeach;?>
						</select>
						<br/>
					</td>
				</tr>
				<tr>
					<td width="700px" align="right">
						<input type="submit" name="submit" value="Submit">
					</td>
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
