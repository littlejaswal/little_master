<?
#handle sections here.
switch ($section):
	case 'list':?>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td class="PageTitle"><?php echo ucfirst($type);?></td>
		</tr>
		</table>
		<table cellpadding="2" cellspacing="1" align="center" width="100%" style="border:solid 1px #dcdcdc;">
			<tr>
				<td  align="left" colspan="3" class="table_cell"><a href="<?php echo make_admin_url('banner_main', 'list', 'list')?>">Back to image manager</a></td>
				<td  align="right" colspan="3" class="table_cell"><a  href="<?=DIR_WS_SITE_CONTROL?>Control.php?Page=banner&section=insert&type=<?php echo $type?>">New Image</a>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="6" align="left" valign="middle" class="table_cell">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=banner&type='.$type, 2);?>
				</td>
			</tr>
			<tr>
				<td align="center" class="table_head"><b>Sr</b>.</td>
				<td align="center" class="table_head"><b>Image</b></td>
				<td align="center" class="table_head">&nbsp;&nbsp;<b>Name</b></td>
				<td align="center" class="table_head"><b>Active</b></td>
				<td class="table_head" align="center"colspan="2"><b>Controls</b></td>
			</tr>
			<?
			$sr=($QueryObj->PageNo-1)*$QueryObj->PageSize+1;
			while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center" width="5%" class="table_cell"><?=$sr++;?>.</td>
					<td align="center" width="35%" class="table_cell" height="75px"><img src="<?=resize_image(banner_img_url_fs($QueryObj1->image), 100, 100);?>"></td>
					<td align="center" width="20%" class="table_cell"><?=$QueryObj1->name?></td>
					<td align="center" width="20%" class="table_cell"><a href="<?php echo make_admin_url('banner', 'status', 'list', 'id='.$QueryObj1->id.'&is_active='.$QueryObj1->is_active.'&type='.$type)?>"><?=$QueryObj1->is_active?'Active':'Not Active';?></a></td>
					<td class="table_cell" width="10%" align="center"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner&section=update&id=<?=$QueryObj1->id?>&type=<?php echo $type?>">Update</a></td>
					<td class="table_cell" width="10%" align="center"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner&action=delete&id=<?=$QueryObj1->id?>&type=<?php echo $type?>">Delete</a></td>
				</tr>
			<?endwhile;?>
		</table>
		<?
		break;
	case 'insert':
	
	?><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
		<td class="PageTitle" align="left" style="padding-left:10px;">Add New Banner</td>
		</tr>
		</table>
		<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner&action=insert&type=<?php echo $type?>">
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#FFFFFF" style="border: solid 1px #dcdcdc;">
			
		<tr >
			<td colspan="5" class="table_cell"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner&type=<?php echo $type?>">Banners</a>&nbsp;&raquo;&nbsp;New Banner</td>
		</tr>	
		
			<tr>
				<td align="left" bgcolor="#f5f5f5">Name</td>
				<td align="left" bgcolor="#f5f5f5"><input type="text" name="name" size="24"></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#f5f5f5">Type</td>
				<td align="left" bgcolor="#f5f5f5">
					<select name="type" size="1">
						<option <?php echo ($type=='logo')?'selected':'';?>>Logo</option>
						<option <?php echo ($type=='scroller image')?'selected':'';?>>Scroller Image</option>
						<option <?php echo ($type=='banner')?'selected':'';?>>Banner</option>
					</select>
				</td>
			</tr>
			<tr>
				<td  align="left" bgcolor="#f5f5f5">URL</td>
				<td  align="left" bgcolor="#f5f5f5">http://<input type="text" name="url" size="24"></td>
			</tr>
			<tr>
					<td align="left" width="30%" bgcolor="#f5f5f5">Banner</td>
					<td align="left" bgcolor="#f5f5f5"><input type="file" name="ujpg" size="24"></td>
			</tr>
			<tr>
					<td align="left" width="30%" bgcolor="#f5f5f5">Active</td>
					<td align="left" bgcolor="#f5f5f5"><input type="checkbox" name="is_active" value="1" tabindex="4" /></td>
				</tr>
			<tr>
					<td align="right" class="table_cell">&nbsp;</td>
					<td align="left" class="table_cell">
						<input type="submit" name="submit" value="Submit">
					</td>
				</tr>
			</table>
		</form>
	<?
		#html code here.
		break;
	case 'update':
			$query_obj1=new query();
	        $query_obj1->InitilizeSQL();
	  		$query_obj1->TableName='banner';
	  		$query_obj1->Where="where id=$_GET[id]";
	  		$brand=$query_obj1->DisplayOne();
		?>
		<br>
	<form enctype="multipart/form-data" method="POST" action="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner&action=update&id=<?=$id?>&type=<?php echo $type?>">
		<table width="98%" border="0" cellspacing="2" cellpadding="2" align="center" valign="top" bgcolor="#ffffff" style="border: solid 1px #dcdcdc;">
			<tr class="table_cell">
				<td colspan="5"><a href="<?=DIR_WS_SITE_CONTROL?>control.php?Page=banner">Banners&nbsp;-></A>&nbsp;<?=$brand->name?></td>
			</tr>
			<tr>
					<td colspan="3" align="left" valign="top" class="table_head">Update Banner</td>
				</tr>
			<tr>
				<td  align="left" bgcolor="#f5f5f5" width="30%" >Name</td>
				<td align="left" class="RightCell" bgcolor="#f5f5f5" ><input type="text" name="name" value="<?=$brand->name;?>"></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#f5f5f5">Type</td>
				<td align="left" bgcolor="#f5f5f5">
					<select name="type" size="1">
						<option <?php echo ($brand->type=='logo')?'selected':'';?>>Logo</option>
						<option <?php echo ($brand->type=='scroller image')?'selected':'';?>>Scroller Image</option>
						<option <?php echo ($brand->type=='banner')?'selected':'';?>>Banner</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" bgcolor="#f5f5f5">URL</td>
				<td align="left" bgcolor="#f5f5f5">http://<input type="text" name="url" size="24" value="<?=$brand->url;?>"></td>
			</tr>
			<tr>
				<td align="left" bgcolor="#f5f5f5" width="30%" >Image</td>
				<td align="left" class="RightCell" bgcolor="#f5f5f5"><input type="file" name="ujpg" size="24"></td>
			</tr>
			<tr>
					<td align="left" width="30%" bgcolor="#f5f5f5">Active</td>
					<td align="left" bgcolor="#f5f5f5"><input type="checkbox" name="is_active" value="1" tabindex="4" <?=($brand->is_active)?'checked':'';?>/></td>
			</tr>
			<input type="hidden" name="id" value="<?=$brand->id;?>">
			<tr>
				<td bgcolor="#f5f5f5" width="30%" ></td>
				<td class="RightCell" bgcolor="#f5f5f5"><input type="submit" name="submit" value="Update"></td>
			</tr>
		</table>
		</form>
		<?break;				
		 #html code here.
	default:break;

	
	
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
