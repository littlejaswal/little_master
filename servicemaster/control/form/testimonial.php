<?
#handle sections here.
switch ($section):
	case 'list':
		?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  style="border:solid 1px #DCDCDC;">
		<tr>
			<td colspan="6" class="table">
			<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=testimonials&id='.$id, 2);?>
			</td>
		</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #DCDCDC;">
			<tr>
				<th width="6%" align="center" class="table_head">Sr.</th>
				<th width="30%" align="left" class="table_head">Name</th>
				<th width="10%" align="center" class="table_head">Active</th>
				<th width="24%" colspan="2" align="center" class="table_head">Controls</th>
			</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #DCDCDC;">
			<?$sr=1;
			while($testimonials= $QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="6%" align="center" valign="top" ><?=$sr++;?></td>
				<td width="30%" align="left"  valign="top"><?=$testimonials->name?></td>
				<td width="10%" align="center"  valign="top" ><?=($testimonials->is_active)?'Active':'Not Active';?></td>
				<td width="12%" align="center" valign="top"><?=make_admin_link(make_admin_url('testimonial', 'update', 'update', 'id='.$testimonials->id),get_control_icon('edit'), 'Click here to edit the testimonial');?></td>
				<td width="12%" align="center" valign="top"><?=make_admin_link(make_admin_url('testimonial', 'delete', 'list', 'id='.$testimonials->id),get_control_icon('cancel'), 'Click here to delete the testimonial');?></td>
			</tr>
			<?endwhile;?>
		</table>
		<?
		break;
	case 'insert':
		?>
		<form action="<?=make_admin_url('testimonial', 'insert', 'list')?>" method="POST" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
		   <tr>
				<td colspan="2" align="left"><?=make_admin_link(make_admin_url('testimonial', 'list', 'list'), 'Back to testimonials listing')?></td>
		   </tr>
			<tr>
				<th colspan="2" align="left" class="table_head">Add New testimonial</th>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Testimonial Name</td>
				<td class="" align="left"><input type="text" name="testimonialname" size="24" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" valign="top" class="">Short Description</td>
				<td class="" align="left"><textarea name="short_description" rows="4" cols="40" tabindex="2"></textarea></td>
			</tr>
			<tr>
				<td width="30%" align="left" valign="top" class="">Long Description</td>
				<td class="">
					<?  
						$oFCKeditor = new FCKeditor('long_description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
						?>
				
				
				</td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Name</td>
				<td class="" align="left"><input type="text" name="name" size="20" tabindex="4"/></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Email</td>
				<td class="" align="left"><input type="text" name="email" size="20" tabindex="5"/></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Active</td>
				<td class="" align="left"><input type="checkbox" name="is_active" value="1" tabindex="6" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Position</td>
				<td class="" align="left"><input type="text" name="position" value="0" size="4" tabindex="4"/></td>
			</tr>
			<tr>
				<td width="30%" class=""></td>
				<td class="" align="left"><input type="submit" name="submit" value="Submit" tabindex="7"/></td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'update':
		?>
		<form action="<?=make_admin_url('testimonial', 'update', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			
		     <tr>
					<td colspan="2" class="" align="left"><?=make_admin_link(make_admin_url('testimonial', 'list', 'list', 'id='.$id), 'Back to testimonials listing')?></td>
				</tr>
		    <tr>
				<th colspan="2" align="left" class="table_head">Update testimonial</th>
			</tr>
			<tr>
				<td width="30%" align="left" valign="top" class="">Testimonial Name</td>
				<td class="" align="left" ><input type="text" name="testimonialname" size="24" tabindex="1" value="<?=$testimonials->testimonialname;?>"/></td>
		   </tr>
		   <tr>		
				<td width="30%" align="left" valign="top" class="">Short Description</td>
				<td class="" align="left"><textarea name="short_description" rows="4" cols="40" tabindex="2"><?=stripslashes($testimonials->short_description)?></textarea></td>
		  </tr>
		  <tr>		
				<td  width="30%" align="left" valign="top" class="">Long Description</td>
				<td class="" align="left">
				<?  
						$oFCKeditor = new FCKeditor('long_description') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($testimonials->long_description);
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
					?>		
				
				
				</td>
		 </tr>
		 <tr>		
				<td width="30%" align="left" valign="top" class="">Name</td>
				<td class="" align="left"><input type="text" name="name" size="24" tabindex="4" value="<?=$testimonials->name?>"/></td>
		 </tr>
		 <tr>		
				<td width="30%" align="left" valign="top" class="">Email</td>
				<td class=""  align="left"><input type="text" name="email" size="24" tabindex="5" value="<?=$testimonials->email?>"/></td>
				
		</tr>
		<tr>
				<td width="30%" align="left" class="">Active</td>
				<td class="" align="left"><input type="checkbox" name="is_active" value="1" tabindex="6" <?=($testimonials->is_active)?'checked':'';?>/></td>
		</tr>
		<tr>
				<td width="30%" align="left" class="">Position</td>
				<td class="" align="left"><input type="text" name="position" size="4" tabindex="4" value="<?=$testimonials->position?>"/></td>
			</tr>
		<tr>
				<td width="30%" class=""></td>
				<td class="" align="left"><input type="submit" name="submit" value="Submit" tabindex="7"/></td>
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



