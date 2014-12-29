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
		<form action="<?=make_admin_url('sproduct', 'list', 'list')?>" method="get">
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right" width="50%">Select Product Type</td>
				<td align="center" width="15%" >
					<select name="type" size="1" tabindex="1">
						<option value="is_featured" <?=($type=='is_featured')?'selected':'';?>>featured products</option>
						<option value="is_home" <?=($type=='is_home')?'selected':'';?>>Sale Products</option>
					</select>
					<input type="hidden" name="Page" value="sproduct">
				</td>
				<td ><input type="submit" name="submit" value="Go" tabindex="2" /></td>
			</tr>
		</table>
		</form>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right" width="50%"><?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, '', 'Page=sproduct&type='.$type, 2);?></td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="0" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="5%" align="left" class="table_head">Sr.</td>
				<td width="30%"  align="left" class="table_head">Name</td>
				<td width="20%" align="left" class="table_head">Price</td>
				<td align="center" width="20%" class="table_head">Status</td>
				<td align="center" align="left" class="table_head">Control</td>
			</tr>
			<?$sr=1; while ($product= $QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="5%"><?=$sr++;?>.</td>
				<td width="30%"><?=$product->name;?></td>
				<td width="20%"><?=number_format($product->price, 2);?></td>
				<td width="20%" align="center"><?=$product->is_active;?></td>
				<td align="center"><?=make_admin_link(make_admin_url('sproduct', 'update', 'list', 'id='.$product->id.'&type='.$type.'&submit=1'),'Delete from list');?></td>
			</tr>
			<?endwhile;?>
			
		</table>
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
