<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form action="<?php echo make_admin_url('product_search', 'search', 'list');?>" method="get">
		<table cellpadding="2" cellspacing="2" align="center" width="50%" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td class="table_head" width="100%" colspan="2">Product Search</td>
			</tr>
			<tr>
				<td width="30%">Category</td>
				<td>
				<select name="category" size="1">
				<option value="0">Select All</option>
				<?php while($item=$QueryObj->GetObjectFromRecord()):?>
					<option value="<?php echo $item->id?>" <?php echo (isset($category) && $item->id==$category)?'selected':'';?>><?php echo ucfirst($item->name)?></option>
				<?php endwhile;?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="30%">Keyword</td>
				<td><input type="text" name="keyword" value="<?php echo isset($keyword)?$keyword:''?>"></td>
			</tr>
			<tr>
				<td width="30%"></td>
				<td>
				<input type="hidden" name="Page" value="product_search">
				<input type="hidden" name="action" value="search">
				<input type="submit" name="submit_search" value="Search">
				</td>
			</tr>
		</table>
		</form>
		
		<?php if($results):?>
		<table align="center" cellpadding="2" cellspacing="2" width="100%" border="0" class="table">
			<tr>
				<td class="table_cell">Search results</td>
			</tr>
			<tr>
				<td class="table_cell" style="border-top:solid 1px #dcdcdc;"><?=PageControl($q->PageNo, $q->TotalPages, $q->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=product_search&keyword='.$keyword.'&category='.$category.'&submit_search=Search&action=search', 2);?></td>
			</tr>
		</table>
		<p></p>
		
		<table width="100%" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="5%" class="table_head" align="center" valign="top">Sr.</td>
				<td width="20%" class="table_head">Name</td>
				<td width="10%" class="table_head" align="center">Stock</td>
				<td width="10%" class="table_head" align="center">Position</td>
				<td width="10%" class="table_head" align="center">Price</td>
				<td width="15%" class="table_head" align="center">Active</td>
				<td width="10%" class="table_head" align="center">Operations</td>
			</tr>
		</table><br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" id="zebra" class="table">
			<?$sr=1;while($QueryObj1=$q->GetObjectFromRecord()):?>
			<tr>
				<td width="5%" align="center" valign="middle"><?=$sr++;?>.</td>
				<td width="20%"><?=$QueryObj1->name;?></td>
				<td width="10%" align="center"><?php echo $QueryObj1->stock;?></td>
				<td width="10%" align="center"><?php echo $QueryObj1->position;?></td>
				<td width="10%" align="center"><?=number_format($QueryObj1->price,2);?></td>
				<td width="15%" align="center" style="padding-left:5px;">
					<?=($QueryObj1->is_active==1)?'Yes':'No';?>
				</td>
				<td width="10%" align="center"><?=make_admin_link(make_admin_url('product', 'list', 'list', 'id='.$QueryObj1->parent_id.'#'.$QueryObj1->id), 'Go to listing');?></td>
			</tr>
			<?endwhile;?>
		</table>
		<?
		endif;
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
