<?
#handle sections here.
display_message(1);
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;">
			
			<tr>
				<td colspan="5" >
				<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=success_stories', 2);?>
				</td>
			</tr>
			<tr>
				<td width="10%" class="table_head">Sr.</td>
				<td width="30%" class="table_head" align="left">Story Name</td>
				<td width="30%" class="table_head" align="left">Status</td>
				<td width="10%" class="table_head" align="center">Edit</td>
				<td width="15%" class="table_head" align="center">View</td>
				<td width="15%" class="table_head" align="center">Delete</td>
			</tr>
			<?$sr=1;?>
			<?while ($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td ><?php echo $sr++;?>.</td>
				<td  align="left"><?php echo $QueryObj1->page_name;?></td>
				<td  align="left"><?php echo is_published($QueryObj1->id, 'success_stories')?'Published':'Not published'?></td>
				<td align="center"><a href="<?php echo make_admin_url('success_stories', 'update', 'update', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('edit')?></a></td>
				<td align="center"><a href="<?php echo make_admin_url('success_stories', 'view', 'view', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('zoom')?></a></td>
				<td align="center" ><a href="<?php echo make_admin_url('success_stories', 'delete', 'view', 'id='.$QueryObj1->id)?>" onclick="return confirm('Are you sure? You are deleting this page.');"><?php echo get_control_icon('cancel')?></a></td>
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
					<td valign="middle" width="10%" ><a href="<?php echo make_admin_url('success_stories')?>">&laquo;Back to Story listing</a></td>
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
		<form id="success_stories" action="<?php echo make_admin_url('success_stories', 'update', 'list', 'id='.$id)?>" method="POST" name="success_stories">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left" style="border-bottom:solid 1px #dcdcdc;"><a href="<?php echo make_admin_url('success_stories')?>">&laquo;Back to  listing</a></td>
				</tr>
				<input type="hidden" size="1" name="parent_id" value="0">
				<tr>
					<td align="left" valign="middle"   >
					<b>Page Name</b><br/>
					<input type="text" name="page_name" value="<?php echo $page_cotent->page_name;?>" size="85" tabindex="2"></td>
				</tr>
				<tr>
					<td align="left" valign="middle"  >
					<b>Page success_storiess</b></b> <br/>
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
						Click <input type="submit" name="save" value="Save" tabindex="2" tabindex="8" /> to save a copy of this Story. (Saving the Story does NOT publish it on the website.)<br/><br/>
						
						Click <input type="submit" name="publish" value="Publish" tabindex="2" tabindex="9" /> to publish the Story on website.
					</td>
				</tr>
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form id="success_stories" action="<?php echo make_admin_url('success_stories', 'insert', 'list')?>" method="POST" name="success_stories">
			<table width="70%" border="0" cellspacing="2" cellpadding="2" style="border:solid 1px #dcdcdc;" align="center">
				<tr>
					<td valign="middle"   align="left"><a href="<?php echo make_admin_url('success_stories')?>">&laquo;Back to Story listing</a></td>
				</tr>
				<tr>
					<td valign="middle"  class="table_head" align="left">Add New Story</td>
				</tr>
				<input type="hidden" size="1" name="parent_id" value="0">
				<tr>
					<td align="left" valign="middle"   >
					<b>Story Name</b><br/>
					<input type="text" name="page_name"  size="85" tabindex="2"</td>
				</tr>
				
				<tr>
					<td align="left" valign="middle"  >
					<b>Page success_storiess</b></b> <br/>
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
					<td align="left" valign="middle"  class="table_head"  >
						<b>Meta Information</b><br/></td>
					<td></td>
					
				</tr>
				<tr>
					<td align="left" valign="middle"   >
					<b>Story title</b><br/>
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
						Click <input type="submit" name="save" value="Save" tabindex="8" /> to save a copy of this Story.<br/><br/>
						
						Click <input type="submit" name="publish" value="Publish" tabindex="9" /> to directly publish the success story on the website.
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
