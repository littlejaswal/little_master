<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td width="20%">Name</td>
				<td width="20%">Value</td>
				<td width="20%">Type</td>
				<td width="20%">Begins on</td>
				<td width="20%">Ends on</td>
			</tr>
			<tr>
				<td width="20%"><?=$discount->name?></td>
				<td width="20%"><?=$discount->amount?></td>
				<td width="20%"><?=$discount->type?></td>
				<td width="20%"><?=$discount->from_date?></td>
				<td width="20%"><?=$discount->to_date?></td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td align="left" width="5%">Sr.</td>
				<td align="left" width="70%">Product Name</td>
				<td></td>
			</tr>
			<?$sr=1;foreach ($products as $k=>$v):?>
			<tr>
				<td width="5%"><?=$sr++;?></td>
				<td width="70%"><?=$product_obj->get_name_by_id($v);?></td>
				<td><?=make_admin_link(make_admin_url('discount_pro', 'delete','list', 'id='.$id.'&idd='.$k),'Delete')?></td>
			</tr>
			<?endforeach;?>
		</table>
		<form id="insert" action="<?=make_admin_url('discount_pro', 'insert', 'list', 'id='.$id)?>" method="post" name="FormName">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td>Select Products</td>
				</tr>
				<tr>
					<td><select name="product[]" size="10" multiple="multiple" style="width:500px;">
						<?foreach ($all_products as $k=>$v):?>
							<option value="<?=$v['id']?>"><?=$v['name']?></option>
						<?endforeach;?>
						</select></td>
				</tr>
				<tr>
					<td align="center"><input type="submit" name="submit" value="Submit" /></td>
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
