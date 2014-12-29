<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('category', 'update2', 'list', 'page='.$page.'&id='.$id)?>" method="POST">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table" style="border:solid 1px #DCDCDC;">
			<tr>
				<td colspan="7" align="left" valign="middle"  style="border-bottom:solid 1px #dcdcdc;"><?=category_chain($id)?></td>
				<td colspan="2" align="right" valign="middle"  style="border-bottom:solid 1px #dcdcdc;">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="9" align="left" valign="middle" >
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=category', 2);?>
				</td>
			</tr>
			</table>
			<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="table" style="border:solid 1px #DCDCDC;">
			<tr>
				<td align="center" width="5%" class="table_head">Sr.</td>
				<td align="center" width="15%" class="table_head">Image</td>
				<td align="left" width="35%" class="table_head">Name</td>
				<td align="center" width="10%" class="table_head">Position</td>
				<td align="center" width="15%" class="table_head">Active</td>

				<td colspan="2" class="table_head" align="center">Controls</td>
			</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" id="zebra" class="table" style="border:solid 1px #dcdcdc;">
			<?
			$sr=1;
			while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td align="center" width="5%" valign="top"><?=$sr++;?>.</td>
				<td  align="center" width="15%"><img src="<?php echo  get_thumb('category', $QueryObj1->image);?>" width="50"></td>
				<td width="35%"><?=$QueryObj1->name;?><br/>
					<?php get_category_list_control($QueryObj1->id);?>
				</td>
				<td align="center" width="10%">
					<?php get_category_position_control($QueryObj1->id, $id, 1, $page);?>
				</td>
				<td align="center" width="15%">
					<?php get_category_status_link($QueryObj1->id, $QueryObj1->is_active);?>
				</td>
				<td align="center" ><?=make_admin_link(make_admin_url('category', 'update', 'update', 'id='.$id.'&cat_id='.$QueryObj1->id), get_control_icon('edit'));;?></td>
				<td align="center" ><?=make_admin_link(make_admin_url('category', 'delete', 'list', 'id='.$id.'&cat_id='.$QueryObj1->id), get_control_icon('cancel'));?></td>
			</tr>
			<?endwhile;?>
			<tr>
				<td align="center" width="5%" >&nbsp;</td>
				<td align="center" width="15%" >&nbsp;</td>
				<td align="center" width="20%" >&nbsp;</td>
				<td align="center" width="10%" ><!--<input type="submit" name="submit_position" value="Update">--></td>
				<td align="center" width="10%" ><input type="submit" name="submit_active" value="Update"></td>
				<td align="center" width="15%" >&nbsp;</td>
				<td align="center" width="10%" >&nbsp;</td>
				<td align="center" colspan="2">&nbsp;</td>

			</tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('category', 'insert', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="2"><?=make_admin_link(make_admin_url('category', 'list', 'list', 'id='.$id),'&laquo;Back to category list');?></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="top" class="table_head">Add New Category</td>
				</tr>
				<tr>
					<td width="30%" >Name</td>
					<td><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td width="30%" >URL Name</td>
					<td width="5%"><input type="text" name="urlname" size="40" tabindex="2" /></td>
				</tr>
				<tr>
					<td width="30%" >Image</td>
					<td><input type="file" name="image" size="16" tabindex="3" /></td>
				</tr>
				<tr>
					<td width="30%" >Position</td>
					<td><input type="text" name="position" size="3" tabindex="4"  maxlength="3"/></td>
				</tr>
				<tr>
					<td width="30%" >Status</td>
					<td><input type="checkbox" name="is_active" value="1" tabindex="5" /></td>
				</tr>
				<tr>
					<td width="30%" >Featured</td>
					<td><input type="checkbox" name="is_featured" value="1" tabindex="6" /></td>
				</tr>
				<?php if($id==0):?>
				<tr>
					<td width="30%">Banner</td>
					<td><input type="file" name="banner" size="16" tabindex="7" /></td>
				</tr>
				<?php endif;?>
				<tr>
					<td align="left" valign="top" width="30%" >Description</td>
					<td><textarea name="description" rows="4" cols="40" tabindex="8"></textarea></td>
				</tr>
				<tr>
					<td valign="top" width="30%">Title</td>
					<td width="5%"><input name="cat_title" value="" type="text" size="53" tabindex="9"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%">ALT</td>
					<td width="5%"><input name="cat_alt" value="" type="text" size="53" tabindex="10"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%">Meta Title</td>
					<td width="5%"><input name="meta_title" value="" type="text" size="53" tabindex="11"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%">Meta Keywords</td>
					<td width="5%"><input name="meta_keyword" value="" type="text" size="53" tabindex="12"/></td>
				</tr>
				<tr>
					<td valign="top" width="30%">Meta Description</td>
					<td width="5%"><textarea name="meta_desc" rows="4" cols="40" tabindex="13"></textarea></td>
				</tr>
				<tr>
					<td width="30%"></td>
					<td><input type="submit" name="new_category" value="Submit" tabindex="14" /></td>
				</tr>
			</table>
		</form>
		<?
		break;
	case 'update':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('category', 'update', 'list', 'id='.$id);?>" method="post" name="add_category" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="3"><?=make_admin_link(make_admin_url('category', 'list', 'list', 'id='.$id),'&laquo;Back to category list');?></td>
				</tr>
				<tr>
					<td colspan="3" align="center" valign="top" class="table_head">Update Category</td>
				</tr>
				<tr>
					<td width="40%" >Name</td>
					<td><input type="text" name="name" size="24" tabindex="1" value="<?=$category->name;?>"/></td>
				</tr>
				<!--<tr>
					<td width="30%" >URL Name</td>
					<td width="5%"><input type="text" name="urlname" size="40" tabindex="2" value="<?=$category->urlname?>"/></td>
					<td rowspan="4" align="center" valign="top"><img src="<?php get_thumb('category', $category->image);?>"></td>
				</tr>-->
				<tr>
					<td width="40%" >Image</td>
					<td><input type="file" name="image" size="16" tabindex="2" /></td>
				</tr>
				<tr>
					<td width="40%" >Position</td>
					<td><input type="text" name="position" size="3" tabindex="3"  maxlength="3" value="<?=$category->position?>"/></td>
				</tr>
				<tr>
					<td width="40%" >Status</td>
					<td><input type="checkbox" name="is_active" value="1" tabindex="4" <?=($category->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td width="40%" >Featured</td>
					<td><input type="checkbox" name="is_featured" value="1" tabindex="5" <?=($category->is_featured)?'checked':'';?> /></td>
				<?php if($id==0):?>
					<td rowspan="" align="center" valign="top">
					<?php if($category->banner!=''):?>
						<img src="<?php get_large('banner', $category->banner);?>" height="117px" width="171px">
					<?php else:?>
						<img src="<?php get_thumb('banner', 'ImageNotFound.jpg');?>" height="117px" width="171px">
					<?php endif;?>
					</td>
					<?php endif;?>
				</tr>
				<?php if($id==0):?>
				<tr>
					<td width="40%" >Banner</td>
					<td><input type="file" name="banner" size="16" tabindex="5" /></td>
				</tr>
				<?php endif;?>
				<tr>
					<td align="left" valign="top" width="40%">Description</td>
					<td><textarea name="description" rows="4" cols="40" tabindex="6"><?=$category->description;?></textarea></td>
				</tr>
				<tr>
					<td valign="top" width="40%">Title</td>
					<td width="5%"><input name="cat_title" value="<?=$category->cat_title;?>" type="text" size="53" tabindex="6"/></td>
				</tr>
				<tr>
					<td valign="top" width="40%">ALT</td>
					<td width="5%"><input name="cat_alt" value="<?=$category->cat_alt;?>" type="text" size="53" tabindex="7"/></td>
				</tr>
				<tr>
					<td valign="top" width="40%">Meta Title</td>
					<td width="5%"><input name="meta_title" value="<?=$category->meta_title;?>" type="text" size="53" tabindex="8"/></td>
				</tr>
				<tr>
					<td valign="top" width="40%">Meta Keywords</td>
					<td width="5%"><input name="meta_keyword" value="<?=$category->meta_keyword;?>" type="text" size="53" tabindex="9"/></td>
				</tr>
				<tr>
					<td valign="top" width="40%">Meta Description</td>
					<td width="5%"><textarea name="meta_desc" rows="4" cols="40" tabindex="10"><?=$category->meta_desc;?></textarea></td>
				</tr>
				<tr>
					<td width="40%" ></td>
					<td><input type="submit" name="update_category" value="Submit" tabindex="7" /></td>
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
