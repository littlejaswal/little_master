<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="4" align="left" valign="middle" ><?php echo category_chain($id, 'gallery')?></td>
				<td colspan="2" align="right" valign="middle" >&nbsp;</td>
			</tr>
		</table>
		<p></p>
		<form action="<?php echo make_admin_url('gallery', 'update', 'list', 'id='.$id);?>" method="POST">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;"class="table">
			<tr>
				<td colspan="6" align="left" valign="middle" >
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=gallery', 2);?>
				</td>
			</tr>
			<tr>
				<td align="center" width="5%" class="table_head">Sr.</td>
				<td align="center" width="15%" class="table_head">Image</td>
				<td align="center" width="30%" class="table_head">Name</td>
				<td align="center" width="20%" class="table_head">Status</td>
				<td colspan="2" class="table_head" align="center">Controls</td>
			</tr>
			<?
			$sr=1;
			while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" ><?=$sr++;?></td>
				<td align="center" ><img src="<?php echo get_thumb('gallery', $QueryObj1->image);?>" width="30"></td>
  			    <td align="left" > 
  			    	<?php echo get_control_icon('folder_explore');?><a href="<?php echo make_admin_url('gallery', 'list', 'list', 'id='.$QueryObj1->id)?>"><?=$QueryObj1->name;?></a><br/>
  			    	<?php echo get_control_icon('bullet_picture');?><a href="<?=make_admin_url('gallery_image', 'list', 'list', 'id='.$QueryObj1->id);?>">pictures</a>
  			    	</td>
				<td align="center" >
					Yes<input type="radio" name="is_active[<?php echo $QueryObj1->id?>]" value="1" <?php echo ($QueryObj1->is_active)?'checked':'';?>>
					No<input type="radio" name="is_active[<?php echo $QueryObj1->id?>]" value="0" <?php echo (!$QueryObj1->is_active)?'checked':'';?>>
				</td>
				<td align="right" style="padding-right:5px;" ><?=make_admin_link(make_admin_url('gallery', 'update', 'update', 'id='.$id.'&cat_id='.$QueryObj1->id), get_control_icon('edit'));?></td>
				<td align="left" style="padding-left:5px;" ><?=make_admin_link(make_admin_url('gallery', 'delete', 'list', 'id='.$id.'&cat_id='.$QueryObj1->id), get_control_icon('cancel'));?></td>
			</tr>
			<?endwhile;?>
			<tr>
				<td class="table_head"></td><td class="table_head"></td><td class="table_head"></td>
				<td align="center" width="20%" class="table_head"><input type="submit" name="submit_active" value="Update"></td>
				<td class="table_head" colspan="2"></td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('gallery', 'insert', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('gallery', 'list', 'list', 'id='.$id),'&laquo;Back to category list');?></td>
				</tr>
				<tr>
					<td colspan="2" align="left" valign="top" class="table_head">Add New Gallery</td>
				</tr>
				<tr>
					<td width="40%"  align="left">Name</td>
					<td align="left" ><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%"  align="left">Image</td>
					<td align="left" ><input type="file" name="image" size="16" tabindex="2" /></td>
				</tr>
              
				<tr>
					<td width="20%"  align="left">Status</td>
					<td align="left" ><input type="checkbox" name="is_active" value="1" tabindex="4" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%"  align="left">Description</td>
					<td align="left" ><textarea name="description" rows="4" cols="30" tabindex="6" id="description"></textarea></td>
				</tr>
				<tr>
					<td width="30%" ></td>
					<td ><input type="submit" name="new_category" value="Submit" tabindex="7" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('gallery', 'update', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="3" align="left"><?=make_admin_link(make_admin_url('gallery', 'list', 'list', 'id='.$id),'&laquo;Back to category list');?></td>
				</tr>
				<tr>
					<td colspan="3" align="left" valign="top" class="table_head">Update Gallery</td>
				</tr>
				<tr>
					<td width="30%"  align="left">Name</td>
					<td align="left" ><input type="text" name="name" size="24" tabindex="1" value="<?=$category->name;?>"/></td>
					<td rowspan="6" align="center" valign="top" ><img src="<?=get_thumb('gallery', $category->image);?>"></td>
				</tr>
				<tr>
					<td width="30%"  align="left">Image</td>
					<td align="left" ><input type="file" name="image" size="16" tabindex="2" /></td>
				</tr>
                
					<td width="30%"  align="left">Status</td>
					<td align="left" ><input type="checkbox" name="is_active" value="1" tabindex="4" <?=($category->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="30%"  align="left">Description</td>
					<td align="left" style="border:solid 1px #dcdcdc;" >
						<textarea name="description" rows="4" cols="30" tabindex="6" id="description" ><?=$category->description;?>
						</textarea>
					</td>
				</tr>
				<tr>
					<td width="30%" ></td>
					<td ><input type="submit" name="update_category" value="Submit" tabindex="7" /></td>
				</tr>
				<input type="hidden" name="id" value="<?=$_GET['cat_id']?>">
			</table>
		</form>
		<?
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>                                                                                                                                                                                                                                                                                                                                                                                                             