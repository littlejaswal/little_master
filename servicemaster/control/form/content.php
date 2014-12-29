<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<?php if($parent_id):?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="left">
					<?php $current=get_object('content', $parent_id);?>
					<a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$current->parent_id)?>">Back to <?php echo get_name_by_id($current->id)?></a>
				</td>
			</tr>
		</table>
		<?endif;?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			<tr>
				<td align="right"><a href="<?php echo make_admin_url('content', 'list', 'insert', 'parent_id='.$parent_id);?>">Add New Page</a>&nbsp;</td>
			</tr>
		</table>
		<br/>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5" >
				<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=content', 2);?>
				</td>
			</tr>
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Page Name</td>
				<!--<td width="30%" class="table_head" align="left">Photos</td>-->
				<td width="30%" class="table_head" align="left">Status</td>
				<td width="10%" class="table_head" align="center">Edit</td>
				<td width="15%" class="table_head" align="center">View</td>
				<td width="15%" class="table_head" align="center">Delete</td>
			</tr>
			<?$sr=1;?>
			<?php if($QueryObj->GetNumRows()):?>
			<?while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?php echo $sr++;?>.</td>
				<td  align="left"><a href="<?php echo make_admin_url('content', 'list', 'list', 'parent_id='.$QueryObj1->id)?>" title="click on the page to add sub-pages to it"><?php echo $QueryObj1->page_name;?></a></td>
				<!--<td  align="left"><a href="<?php //echo make_admin_url('content_photo', 'list', 'list', 'id='.$QueryObj1->id)?>">Photos</a></td>-->
				<td  align="left"><?php echo is_published($QueryObj1->id)?'Published':'Not published'?></td>
				<td align="center"><a href="<?php echo make_admin_url('content', 'update', 'update', 'id='.$QueryObj1->id)?>" title="edit this page"><?php echo get_control_icon('edit')?></a></td>
				<td align="center"><a href="<?php echo make_url('content', 'id='.$QueryObj1->id)?>" title="View this page" target="_blank"><?php echo get_control_icon('zoom')?></a></td>
				<td align="center" ><a href="<?php echo make_admin_url('content', 'delete', 'view', 'id='.$QueryObj1->id)?>" title="delete this page" onclick="return confirm('Are you sure? You are deleting this page.');"><?php echo get_control_icon('cancel')?></a></td>
			</tr>
			<?endwhile;?>
			<?php else:?>
			<tr>
				<td colspan="5" align="center">No Page Found.</td>
	
			</tr>
			<?php endif;?>
			
		</table>
		<?
		#html code here.
		break;
	case 'view':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
				<tr>
					<td valign="middle" width="10%" ><a href="<?php echo make_admin_url('content')?>">&laquo;Back to page listing</a></td>
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
		<form id="content" action="<?php echo make_admin_url('content', 'update', 'list', 'id='.$id.'&parent_id='.$page_cotent->parent_id)?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?php echo make_admin_url('content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">
						<input type="hidden" name="parent_id" value="<?php echo $page_cotent->parent_id?>">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page Name</b><br/>
					<input type="text" name="page_name" value="<?php echo $page_cotent->page_name;?>" size="85" tabindex="2"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"  >
					<b>Page Contents</b></b> <br/>
					<?  $oFCKeditor = new FCKeditor('page') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($page_cotent->page);
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=620;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Is this part of any page collection?</b><br/>
						<select name="collection[]" size="4" multiple style="width:150px;">
							<?php get_content_collection(explode(',', $page_cotent->collection));?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Is this page part of any kind of navigation?</b><br/>
					<select name="navigation[]" size="4" multiple style="width:150px;">
						<?php get_content_navigation_type(explode(',', $page_cotent->navigation));?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"  class="table_head"  >
						<b>Meta Information</b><br/></td>
					<td></td>
					
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name" value="<?php echo $page_cotent->name;?>" size="85" tabindex="4"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>URL Name</b><br/>
					<input type="text" name="urlname" size="85" tabindex="2" value="<?=$page_cotent->urlname?>" tabindex="5" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Keywords</b><br/>	
					<input type="text" name="meta_keyword" value="<?php echo $page_cotent->meta_keyword;?>" tabindex="6" size="85">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
						<b>Description</b><br/>
						<textarea name="meta_description" cols="80" rows="5" tabindex="7"><?php echo $page_cotent->meta_description;?></textarea>
					</td>
				</tr>
				
				
				<tr>
					<td align="center" valign="middle"  >
						Click <input type="submit" name="save" value="Save" tabindex="2" tabindex="8" /> to save a copy of this page.<br/><br/>
						
						Click <input type="submit" name="publish" value="Publish" tabindex="2" tabindex="9" /> to directly publish the content of this page on website.
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form id="content" action="<?php echo make_admin_url('content', 'insert', 'list', 'parent_id='.$parent_id)?>" method="POST" name="content">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?php echo make_admin_url('content')?>">&laquo;Back to page listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Page</td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">
					<input type="hidden" name="parent_id" value="<?php echo $parent_id?>"/>
				</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page Name</b><br/>
					<input type="text" name="page_name"  size="85" tabindex="2"</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"  >
					<b>Page Contents</b></b> <br/>
						<?  $oFCKeditor = new FCKeditor('page') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=700;
						$oFCKeditor->Width		=620;
						$oFCKeditor->Create() ;
					?>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Is this part of any page collection?</b><br/>
						<select name="collection[]" size="4" multiple style="width:150px;">
							<?php get_content_collection();?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Is this page part of any kind of navigation?</b><br/>
					<select name="navigation[]" size="4" multiple style="width:150px;">
						<?php get_content_navigation_type();?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"  class="table_head"  >
						<b>Meta Information</b><br/></td>
					<td></td>
					
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Page title</b><br/>
					<input type="text" name="name"  size="85" tabindex="4"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>URL Name</b><br/>
					<input type="text" name="urlname" size="85" tabindex="5" /></td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Keywords</b><br/>	
					<input type="text" name="meta_keyword" size="85" tabindex="6">
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"   >
						<b>Description</b><br/>
						<textarea name="meta_description" cols="80" rows="5" tabindex="7"></textarea>
					</td>
				</tr>
				<tr>
					<td align="left" valign="middle"  >
						Click <input type="submit" name="save" value="Save" tabindex="8" /> to save a copy of this page.<br/><br/>
						
						Click <input type="submit" name="publish" value="Publish" tabindex="9" /> to directly publish the content of this page on website.
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
