<?
display_message(1);
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('content_photo', 'update_default', 'list', 'id='.$id)?>" method="POST">
			<table width="100%" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" >
			<tr>
					<td style="text-align:left" width="30%" colspan="4"><?=make_admin_link(make_admin_url('content', 'list', 'list', 'parent_id='.$product->parent_id), $product->name)?>&nbsp;::&nbsp;Images</td>
					<td style="text-align:right"><?=make_admin_link(make_admin_url('content_photo', 'insert', 'insert', 'id='.$id), 'New Image')?></td>
			</tr>
			<tr>
				<td width="10%" class="table_head" align="center">Sr.</td>
				<td align="left" width="30%" class="table_head">Image/Name</td>
				<td align="left" width="20%" class="table_head">Position</td>
				<td align="center" width="10%" class="table_head">Default</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($image=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center" class="table_cell"  valign="top"><?=$sr++?>.</td>
					<td class="table_cell" ><img src="<?php echo get_thumb('content', $image->image)?>" border="0"></td>
					<td class="table_cell" ><?php echo $image->position;?></td>
					<td class="table_cell" align="center"><input type="checkbox" name="default[<?=$image->id?>]" value="1"  <?=($image->default_image)?'checked':'';?>></td>
					<td class="table_cell" valign="top" align="center"><?=make_admin_link(make_admin_url('content_photo', 'delete', 'list', 'id='.$id.'&delete='.$image->id),'Delete');?></td>
				</tr>
			<?endwhile;?>
			<tr>
				<td colspan="3"></td>
				<td align="center"><input type="submit" value="Update" name="default_image"></td>
				<td></td>
			</tr>
			
			</table>
			</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form action="<?=make_admin_url('content_photo', 'insert', 'insert', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('content_photo', 'list', 'list', 'id='.$id), 'Image Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="center" >Upload New Image</td>
					</tr>
					<tr>
						<td align="center" width="20%">Image1</td>
						<td align="left" width="50%"><input  type="file" name="pic" ></td>
						<td></td>
					</tr>
					<tr>
						<td align="center" width="20%">Position</td>
						<td align="left" width="50%"><input  type="text" name="position" value="" size="3"></td>
						<td></td>
					</tr>
					<tr>
						<td align="center" width="20%">&nbsp;</td>
						<td align="center" width="50%"><input type="submit" name="submit" value="Upload" class="Bn"></td>
						<td ></td>
					</tr>
				</table>
			</form>
		<?
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
