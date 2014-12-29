<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('tag_cloud', 'update2', 'list')?>" method="POST" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  style="border:solid 1px #DCDCDC;">
		<tr>
			<td class="PageTitle" align="left" style="border-bottom:solid 1px #dcdcdc;">Tag Cloud</td>
		</tr>
		<tr>
			<td colspan="6" class="table">
			<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=tag_cloud&id='.$id, 2);?>
			</td>
		</tr>
		</table>
		<p></p>
		<table width="100%" border="0" cellspacing="2" cellpadding="2" class="table" style="border:solid 1px #DCDCDC;">
	
			<tr>
				<th width="5%" align="center" class="table_head">Sr.</th>
				<th width="40%" align="left" class="table_head">Tag Name</th>
				<th width="15%" align="left" class="table_head">Weight</th>
				<th width="15%" align="left" class="table_head">URL</th>
				<th width="15%" align="center" class="table_head">Status</th>
				<th width="20%" colspan="2" align="center" class="table_head">Controls</th>
			</tr>
			<? $sr=1;
			while($tag_cloud= $QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="5%" align="center" valign="top" ><?=$sr++;?></td>
				<td width="30%" align="left"  valign="top"><?=$tag_cloud->tag_name?></td>
					<td width="15%" align="left"  valign="top"><?=$tag_cloud->weight?></td>
					<td width="15%" align="left"  valign="top"><a href="<?=$tag_cloud->url?>" >Link</a></td>
				<td width="15%" align="center"  valign="top" ><input type="checkbox" name="is_active[<?=$tag_cloud->id;?>]" <?=$tag_cloud->is_active=='1'?'checked':''?> value="<?=$tag_cloud->tag_name?>"    style="border:none;"></td>
				<td width="10%" align="center" valign="top"><?=make_admin_link(make_admin_url('tag_cloud', 'update', 'update', 'id='.$tag_cloud->id),get_control_icon('edit'), 'Click here to edit the tag cloud');?></td>
				<td width="10%" align="center" valign="top"><?=make_admin_link(make_admin_url('tag_cloud', 'delete', 'list', 'id='.$tag_cloud->id),get_control_icon('cancel'), 'Click here to delete the tag cloud');?></td>
			</tr>
			<? endwhile;?>
			<tr><td colspan="6" style="padding-left:400px;"><input type="submit" name="submit" value="Update" ></td></tr>
		</table>
		</form>
		<?
		break;
	case 'insert':
		?>
		<form action="<?=make_admin_url('tag_cloud', 'insert', 'list')?>" method="POST" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
		   <tr>
				<td colspan="2"><?=make_admin_link(make_admin_url('tag_cloud', 'list', 'list'), 'Back to tag cloud listing')?></td>
		   </tr>
			<tr>
				<th colspan="2" align="center" class="table_head">Add New Tag cloud</th>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Tag Name</td>
				<td class=""><input type="text" name="tag_name" size="40" tabindex="1" /></td>
			</tr>
			
			<tr>
			<!--	<td width="30%" align="left" valign="top" class="">Long Description</td>
				<td class=""><textarea name="long_description" rows="4" cols="40" tabindex="3"></textarea></td>-->
			</tr>
			<tr>
				<td width="30%" align="left" class="">URL</td>
				<td class=""><input type="text" name="url" size="40" tabindex="4"/></td>
			</tr>
		<!--	<tr>
				<td width="30%" align="left" class="">Email</td>
				<td class=""><input type="text" name="email" size="20" tabindex="5"/></td>
			</tr>-->
			<tr>
				<td width="30%" align="left" class="">Status</td>
				<td class=""><input type="checkbox" name="is_active" value="1" tabindex="6" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Weight</td>
				<td class=""><input type="text" name="weight" value="0" size="4" tabindex="7"/></td>
			</tr>
			<tr>
				<td width="30%" align="left" valign="top" class="">Description</td>
				<td class=""><textarea name="description" rows="4" cols="40" tabindex="2"></textarea></td>
			</tr>
			<tr>
				<td width="30%" class=""></td>
				<td class=""><input type="submit" name="submit" value="Submit" tabindex="8"/></td>
			</tr>
		</table>
		</form>
		<?
		break;
	case 'update':
		
		?>
		<form action="<?=make_admin_url('tag_cloud', 'update', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			
		     <tr>
					<td colspan="2" class=""><?=make_admin_link(make_admin_url('tag_cloud', 'list', 'list', 'id='.$id), 'Back to tag cloud listing')?></td>
				</tr>
		    <tr>
				<th colspan="2" align="center" class="table_head">Update Tag cloud</th>
			</tr>
			<tr>
				<td width="30%" align="left" valign="top" class="">Tag Name</td>
				<td class=""><input type="text" name="tag_name" size="24" tabindex="1" value="<?=$tag_cloud->tag_name;?>"/></td>
		   </tr>
		   <tr>		
			
		<?php /*?>  <tr>		
				<td  width="30%" align="left" valign="top" class="">Long Description</td>
				<td class=""><textarea name="long_description" rows="4" cols="40" tabindex="3"><?=stripslashes($testimonials->long_description)?></textarea></td>
		 </tr><?php */?>
		 <tr>		
				<td width="30%" align="left" valign="top" class="">URL</td>
				<td class=""><input type="text" name="url" size="40" tabindex="4" value="<?=$tag_cloud->url?>"/></td>
		 </tr>
		 <tr>		
			<?php /*?>	<td width="30%" align="left" valign="top" class="">Email</td>
				<td class=""><input type="text" name="email" size="24" tabindex="5" value="<?=$testimonials->email?>"/></td>
				
		</tr><?php */?>
		<tr>
				<td width="30%" align="left" class="">Status</td>
				<td class=""><input type="checkbox" name="is_active" value="1" tabindex="6" <?=($tag_cloud->is_active)?'checked':'';?>/></td>
		</tr>
		<tr>
				<td width="30%" align="left" class="">Weight</td>
				<td class=""><input type="text" name="weight" size="4" tabindex="7" value="<?=$tag_cloud->weight?>"/></td>
			</tr>
				<td width="30%" align="left" valign="top" class="">Description</td>
				<td class=""><textarea name="description" rows="4" cols="40" tabindex="2"><?=stripslashes($tag_cloud->description)?></textarea></td>
		  </tr>
		<tr>
				<td width="30%" class=""></td>
				<td class=""><input type="submit" name="submit" value="Submit" tabindex="8"/></td>
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




