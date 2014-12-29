<?
display_message(1);
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('gallery_image', 'update_default', 'list', 'id='.$id)?>" method="POST">
			<table width="100%" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" >
			<tr>
					<td style="text-align:left" width="30%" colspan="3"><?=make_admin_link(make_admin_url('gallery', 'list', 'list'), $product->name)?>&nbsp;::&nbsp;Images</td>
					<td style="text-align:right"><?=make_admin_link(make_admin_url('gallery_image', 'insert', 'insert', 'id='.$id), 'New Image')?></td>
			</tr>
			<tr>
				<td width="10%" class="table_head" align="center">Sr.</td>
				<td align="left" width="30%" class="table_head">Image/Name</td>
				<td align="center" width="20%" class="table_head">Position</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($image=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center" valign="top"><?=$sr++?>.</td>
					<td class="table_cell" ><img src="<?php echo get_thumb('gallery', $image->image);?>" border="0" width="30"></td>
					<td align="center" >
				
					<?php echo $image->position;?></td>
					<td align="center" >
					<?php echo make_admin_link(make_admin_url('gallery_image', 'update', 'update', 'id='.$id.'&image_id='.$image->id),'Edit');?>&nbsp;&nbsp;
					<?php echo make_admin_link(make_admin_url('gallery_image', 'delete', 'list', 'id='.$id.'&delete='.$image->id),'Delete');?></td>
				</tr>
			<?endwhile;?>
			<tr>
				<td colspan=""></td>
				<td align="center"></td>
				<td align="center"></td>
				<td></td>
			</tr>
			
			</table>
			</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form action="<?=make_admin_url('gallery_image', 'insert', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('gallery_image', 'list', 'list', 'id='.$id), 'Image Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="left" >Upload New Image</td>
					</tr>
					<tr>
						<td align="left" width="20%">Image</td>
						<td align="left" width="50%"><input  type="file" name="pic" ></td>
						<td></td>
					</tr>
                     <tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle"><textarea name="caption" rows="2" cols="30" tabindex="1"></textarea></td>
				</tr>
					<tr>
						<td align="left" width="20%">Position</td>
						<td align="left" width="50%"><input  type="text" name="position" value="" size="3"></td>
						<td></td>
					</tr>
					<input  type="hidden" name="link_url" value="#" size="38">
					<input  type="hidden" name="target" value="_blank" size="3">
					<!--<tr>
						<td align="left" width="20%">Link URL</td>
						<td align="left" width="50%"><input  type="text" name="link_url" value="#" size="38"></td>
						<td></td>
					</tr>
					<tr>
						<td align="left" width="20%">Window Target</td>
						<td align="left" width="50%">
							New Window<input  type="radio" name="target" value="_blank" size="3">
							Same Window<input  type="radio" name="target" value="_parent" size="3" checked>
						</td>
						<td></td>
					</tr>-->
					<tr>
						<td align="left" width="20%">&nbsp;</td>
						<td align="left" width="50%"><input type="submit" name="submit" value="Upload" class="Bn"></td>
						<td ></td>
					</tr>
				</table>
			</form>
		<?
		#html code here.
		break;
	case 'update':
		?>
			<form action="<?=make_admin_url('gallery_image', 'update', 'list', 'id='.$id.'&image_id='.$image_id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('gallery_image', 'list', 'list', 'id='.$id), 'Image Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="left" >Edit New Image</td>
					</tr>
					<tr>
						<td align="left" width="20%" valign="top">Image</td>
						<td align="left" width="50%"><input  type="file" name="pic" >
						<?php if($gimg->image!=''):?>
							<img src="<?php echo get_thumb('gallery', $gimg->image);?>">
						<?php endif;?>
						
						</td>
						<td></td>
					</tr>
                     <tr>
					<td align="left" valign="top" width="30%">Caption</td>
					<td align="left" valign="middle"><textarea name="caption" rows="2" cols="30" tabindex="1"><?php echo $gimg->caption?></textarea></td>
				</tr>
					<tr>
						<td align="left" width="20%">Position</td>
						<td align="left" width="50%"><input  type="text" name="position" value="<?php echo $gimg->position?>" size="3"></td>
						<td></td>
					</tr>
                    <input type="hidden" name="image_id" value="<?php echo $gimg->id?>" >
					<input  type="hidden" name="link_url" value="#" size="38">
					<input  type="hidden" name="target" value="_blank" size="3">
					
					<tr>
						<td align="left" width="20%">&nbsp;</td>
						<td align="left" width="50%"><input type="submit" name="submit" value="Upload" class="Bn"></td>
						<td ></td>
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
