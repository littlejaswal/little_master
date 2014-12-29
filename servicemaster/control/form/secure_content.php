
<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="6" >
				<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=secure_content', 2);?>
				</td>
			</tr>
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="20%" class="table_head" align="left">Parent Page</td>
				<td width="30%" class="table_head" align="left">Page Name</td>
				<td width="30%" class="table_head" align="left">Status</td>
				<td width="10%" class="table_head" align="center">Edit</td>
				<td width="15%" class="table_head" align="center">View</td>
				<td width="15%" class="table_head" align="center">Delete</td>
			</tr>
			<?$sr=1;?>
			<?while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?php echo $sr++;?>.</td>
				<td  align="left"><?php echo get_name_by_id($QueryObj1->parent_id);?></td>
				<td  align="left"><?php echo $QueryObj1->name;?></td>
				<td  align="left"><?php echo is_secure_published($QueryObj1->id)?'Published':'Not published'?></td>
				<td align="center"><a href="<?php echo make_admin_url('secure_content', 'update', 'update', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('edit')?></a></td>
				<td align="center"><a href="<?php echo make_admin_url('secure_content', 'view', 'view', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('zoom')?></a></td>
				<td align="center" ><a href="<?php echo make_admin_url('secure_content', 'delete', 'view', 'id='.$QueryObj1->id)?>" onclick="return confirm('Are you sure? You are deleting this page.');"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<?endwhile;?>
		</table>
		<?
		#html code here.
		break;
	case 'view':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td valign="middle" width="10%" ><a href="<?php echo make_admin_url('secure_content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle" width="10%" class="table_head"><?php echo $page_cotent->name;?></td>
				</tr>
				<tr>
					<td align="left" valign="middle" width="10%" >
						<?php echo html_entity_decode($page_cotent->page);?>
					</td>
				</tr>
		</table>
		<?
		#html code here.
		break;
	case 'update':
		?>
		<form id="content" action="<?php echo make_admin_url('secure_content', 'update', 'list', 'id='.$id)?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?php echo make_admin_url('secure_content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">
					<b>Select Parent</b>&nbsp;&nbsp;&nbsp;&nbsp;
					<select size="1" name="parent_id">
						<option value="0">Root</option>
						<?while($rec=$AllRecords->GetObjectFromRecord()):?>
							<option value="<?php echo $rec->id?>" <?php echo ($rec->id==$page_cotent->parent_id)?'checked':'';?>><?php echo $rec->name?></option>
						<?endwhile;?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name" value="<?php echo $page_cotent->name;?>" size="85"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>URL Name</b><br/>
					<input type="text" name="urlname" size="85" tabindex="2" value="<?=$page_cotent->urlname?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Keywords</b><br/>	
					<input type="text" name="meta_keyword" value="<?php echo $page_cotent->meta_keyword;?>" size="85">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
						<b>Description</b><br/>
						<textarea name="meta_description" cols="80" rows="5"><?php echo $page_cotent->meta_description;?></textarea>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
					<b>Page Contents</b></b> <br/>
					<?  $oFCKeditor = new FCKeditor('page') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($page_cotent->page);
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=600;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
						<input type="submit" name="save" value="Save" tabindex="2" />
						<input type="submit" name="publish" value="Publish" tabindex="2" />
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form id="content" action="<?php echo make_admin_url('secure_content', 'insert', 'list')?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?php echo make_admin_url('secure_content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Page</td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">
					<b>Select Parent</b>&nbsp;&nbsp;&nbsp;&nbsp;
					<select size="1" name="parent_id">
						<option value="0">Root</option>
						<?while($rec=$AllRecords->GetObjectFromRecord()):?>
							<option value="<?php echo $rec->id?>"><?php echo $rec->name?></option>
						<?endwhile;?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name"  size="85"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>URL Name</b><br/>
					<input type="text" name="urlname" size="85" tabindex="2" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Keywords</b><br/>	
					<input type="text" name="meta_keyword" size="85">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
						<b>Description</b><br/>
						<textarea name="meta_description" cols="80" rows="5"></textarea>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
					<b>Page Contents</b></b> <br/>
						<?  $oFCKeditor = new FCKeditor('page') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=600;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="center" valign="middle"  >
						<input type="submit" name="save" value="Save" tabindex="2" />
						<input type="submit" name="publish" value="Publish" tabindex="2" />
					</td>
				</tr>
			</table>
			</form>		
		<?
		#html code here.
		break;
	default:break;
endswitch;
?>
