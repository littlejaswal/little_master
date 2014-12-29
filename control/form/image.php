<?


display_message(1);
switch ($section):
	case 'list':
		?>
	
			<table width="100%" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" >
			<tr>
					<td style="text-align:left;boredr:1px solid red;" width="30%" colspan="3"><?=make_admin_link(make_admin_url('attributes', 'list', 'list', 'id='.$product->parent_id), $product->name)?>&nbsp;::&nbsp;Images</td>
					<td style="text-align:right"><?=make_admin_link(make_admin_url('image', 'insert', 'insert', 'id='.$id), 'New Image')?></td>
			</tr>
			 <form action="<?php echo make_admin_url('image', 'insert2', 'insert2', 'id='.$id)?>" method="post">
			<tr>
				<td width="10%" class="table_head" align="center">Sr.</td>
				<td align="left" width="40%" class="table_head">Image/Name</td>
				<td align="center" width="10%" class="table_head">Main Image</td>
				<td class="table_head" width="40%" align="center">Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($image=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center" class="table_cell"  valign="top"><?=$sr++?>.</td>
					<td class="table_cell"><img src="<?php echo  get_thumb('category', $image->photo);?>" width="50"></td>
					<td class="table_cell" align="center">
					<input type="radio" name="main_image[i]" value="<?php echo $image->id?>" <?=($image->main_image==1)?'checked':'';?>>
					</td>
					<td class="table_cell" valign="top" align="center"><?=make_admin_link(make_admin_url('image', 'delete', 'list', 'id='.$id.'&delete='.$image->id),'Delete');?></td>
				</tr>
			<?endwhile;?>
		
			  <tr>
			  		<td colspan="2">&nbsp;</td>
			  		<td colspan="2"><input name="image_update" value="Update" type="submit"></td>
			  		
			  </tr>	
			
			</form>
			</table>
			
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form action="<?=make_admin_url('image', 'insert', 'insert', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('image', 'list', 'list', 'id='.$id), 'Image Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="center" >Upload New Image</td>
					</tr>
					<tr>
						<td align="center" width="20%">Image1</td>
						<td align="left" width="50%"><input  type="file" name="photo" ></td>
						<td></td>
					</tr>
					<!--<tr>
						<td align="center" width="20%">Position</td>
						<td align="left" width="50%"><input  type="text" name="position" value="" size="3"></td>
						<td></td>
					</tr>-->
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
