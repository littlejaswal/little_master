<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
        <form action="<?php echo make_admin_url('upload_logo', 'update2', 'list');?>" method="post">
		<table width="100%" border="0" cellspacing="1" cellpadding="5">
			
			
			<tr>
				<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
				 <td width="20%" class="table_head">Logo Image</td>
                <td width="20%" class="table_head">Company Name</td>
               	<td width="20%" align="center" class="table_head center">Position</td>
				<td align="center" width="20%" class="table_head center">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<? if($QueryObj->GetNumRows()!=0):?>
			<? $sr=1;while($logo=$QueryObj->GetObjectFromRecord()):?>
			<tr >
				<td width="5%"  align="center"><?=$sr++;?>.</td>
               <td width="20%" ><img src="<?=get_thumb('logo', $logo->company_logo);?>"/ ></td>
				<td width="20%" ><?=$logo->company_name;?></td>
                <td width="20%"  align="center"class="center"><input type="text" name="position[<?php echo $logo->id?>]" value="<?=$logo->position;?>" size="3"/></td>
				<td width="20%" align="center"   class="center"><input type="checkbox" name="is_active[<?php echo $logo->id?>]" value="1" <?php echo ($logo->is_active)?'checked':'';?>  /></td>
				
				<td align="center">
					<?=make_admin_link(make_admin_url('upload_logo', 'update', 'update', 'id='.$logo->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('upload_logo', 'delete', 'list', 'id='.$logo->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<? endwhile; ?>
            <tr>
				<td class="table_head"></td>
				<td class="table_head"></td>
               <td class="table_head"></td>
				<td align="center" valign="middle" width="20%" class="table_head center" ><input type="submit" name="update_position" value="Update" /></td>
				<td align="center" valign="middle" width="20%" class="table_head center" ><input type="submit" name="update_status" value="Update" /></td>
				<td class="table_head"></td>
			</tr>
			<?php			else:?>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="6">Sorry no record found.</td>
				</tr>
			<?endif;?>
			
		</table>
        </form>
		<?
		break;
	case 'insert':
		?>
		<form id="video_insert" action="<?=make_admin_url('upload_logo', 'insert', 'insert');?>" method="post" name="logo_insert" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('upload_logo', 'list', 'list'), 'Back to  logo listing');?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Link</td>
				</tr>
				<tr>
					<td align="left" width="29%">Company Name</td>
					<td width="71%" align="left"><input type="text" name="company_name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="29%">Company Detail</td>
					<td align="left">
                    <?  
						$oFCKeditor = new FCKeditor('company_detail') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
						?>
                    </td>
				</tr>
               	
                <tr>
					<td align="left" width="29%">Upload Logo</td>
					<td align="left"><input type="file" name="company_logo" size="16" tabindex="4" /></td>
				</tr>
                <tr>
					<td align="left" valign="middle" width="20%" >Link</td>
					<td align="left" valign="middle" >http://<input type="text" name="company_url" size="24" tabindex="2" value=""/></td>
				</tr>
                <tr>
					<td align="left" width="29%">Status</td>
					<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" /></td>
				</tr>
				<tr>
					<td align="left" width="29%">Position</td>
					<td align="left"><input type="text" size="4" name="position" tabindex="6" /></td>
				</tr>
				<tr>
					<td align="left" width="29%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
				
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'update':
		#html code here.
		?>
		<form id="video_update" action="<?=make_admin_url('upload_logo', 'update', 'update', 'id='.$id)?>" method="post" name="logo_update" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left">
						<?=make_admin_link(make_admin_url('upload_logo', 'list', 'list'), 'Back to logo listing');?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Link</td>
				</tr>
				<tr>
					<td align="left" width="29%">Company Name</td>
					<td width="71%" align="left"><input type="text" name="company_name" size="24" tabindex="1"  value="<?=$logo->company_name;?>"/></td>
				</tr>
              
				<tr>
					<td align="left" valign="top" width="29%">Company Detail</td>
					<td align="left">
                    <?  
						$oFCKeditor = new FCKeditor('company_detail') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($logo->company_detail);
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
					?>	
                    </td>
				</tr>
                	
                <tr>
				  <td align="left" width="29%" valign="top"><br /><br />
				    Photo</td>
					<td align="left"><br /><br /><input type="file" name="company_logo" size="16" tabindex="4" /> <br /><br /><img src="<?php echo get_thumb('logo', $logo->company_logo); ?>"  /></td>
				</tr>
				 <tr>
					<td align="left" valign="middle" width="20%" >Link</td>
					<td align="left" valign="middle" >http://<input type="text" name="company_url" size="24" tabindex="2" value="<?=$logo->company_url;?>"/></td>
				</tr>
				<tr>
					<td align="left" width="29%">Status</td>
					<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" <?=($logo->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" width="29%">Position</td>
					<td align="left"><input type="text" size="4" name="position" tabindex="6" value="<?=$logo->position;?>" /></td>
				</tr>
				<tr>
					<td align="left" width="29%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
				</tr>
				
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
