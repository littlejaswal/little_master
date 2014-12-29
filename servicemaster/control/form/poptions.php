<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
	<tr>
		<td colspan="2" align="left"><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$product->parent_id), $product->name);?>&nbsp;::&nbsp;Product options</td>
		<td align="right"><?=make_admin_link(make_admin_url('poptions', 'list', 'insert', 'pid='.$pid), 'Add new option')?>&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td width="40%" class="table_head" align="left">Name</td>
		<td width="30%" class="table_head" align="left">Price</td>
		<td class="table_head"></td>
	</tr>
	<?while($po=$QueryObj->GetObjectFromRecord()):?>
		<?if($section=='update' && $id==$po->id):?>
			<form action="<?=make_admin_url('poptions', 'update', 'list', 'pid='.$pid)?>" method="POST">
				<tr>
					<td width="40%"><input type="text" name="name" size="30" tabindex="1" value="<?=$po->name?>" /></td>
					<td width="30%">
						<input type="text" name="price" size="10" tabindex="2" value="<?=$po->price?>" />
						<input type="hidden" name="product_id" value="<?=$po->product_id?>">
						<input type="hidden" name="id" value="<?=$po->id?>">
					</td>
					<td><input type="submit" name="submit" value="Done" tabindex="3" /></td>
				</tr>
			</form>
		<?else:?>
			<tr>
				<td width="40%" align="left"><?=$po->name;?></td>
				<td width="30%" align="left"><?=number_format($po->price);?></td>
				<td align="center"><?=make_admin_link(make_admin_url('poptions', 'update', 'update', 'id='.$po->id.'&pid='.$pid), 'Edit', 'edit the option')?>&nbsp;&nbsp;&nbsp;<?=make_admin_link(make_admin_url('poptions', 'delete', 'list', 'id='.$po->id.'&pid='.$pid), 'Delete', 'delete the option')?></td>
			</tr>
		<?endif;?>
	<?endwhile;?>
	<tr>
		<td width="40%"></td>
		<td width="30%"></td>
		<td></td>
	</tr>
	<tr>
		<td width="40%"></td>
		<td width="30%"></td>
		<td></td>
	</tr>
	<?if($section=='insert'):?>
	<form action="<?=make_admin_url('poptions', 'insert', 'list', 'pid='.$pid)?>" method="POST">
		<table width="100%" border="0" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="40%"><input type="text" name="name" size="30" tabindex="1" /></td>
				<td width="30%"><input type="text" name="price" size="10" tabindex="2" value="0"/><input type="hidden" name="product_id", value="<?=$pid?>"></td>
				<td><input type="submit" name="submit" value="Done" tabindex="3" /></td>
			</tr>
		</table>
	</form>
	<?endif;?>
</table>