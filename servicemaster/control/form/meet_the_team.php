<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
        <form action="<?php echo make_admin_url('meet_the_team', 'update2', 'list');?>" method="post">
		<table width="100%" border="0" cellspacing="1" cellpadding="5">
			
			
			<tr>
				<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
				 <td width="20%" class="table_head">Team member photo</td>
                <td width="20%" class="table_head">Team member name</td>
               	<td width="20%" align="center" class="table_head center">Position</td>
				<td align="center" width="20%" class="table_head center">Status</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<? if($QueryObj->GetNumRows()!=0):?>
			<? $sr=1;while($team=$QueryObj->GetObjectFromRecord()):?>
			<tr >
				<td width="5%"  align="center"><?=$sr++;?>.</td>
               <td width="20%" ><img src="<?=get_thumb('team', $team->team_logo);?>"/ ></td>
				<td width="20%" ><?=$team->team_name;?></td>
                <td width="20%"  align="center"class="center"><input type="text" name="position[<?php echo $team->id?>]" value="<?=$team->position;?>" size="3"/></td>
				<td width="20%" align="center"   class="center"><input type="checkbox" name="is_active[<?php echo $team->id?>]" value="1" <?php echo ($team->is_active)?'checked':'';?>  /></td>
				
				<td align="center">
					<?=make_admin_link(make_admin_url('meet_the_team', 'update', 'update', 'id='.$team->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('meet_the_team', 'delete', 'list', 'id='.$team->id), get_control_icon('cancel'));?>
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
		<form id="video_insert" action="<?=make_admin_url('meet_the_team', 'insert', 'insert');?>" method="post" name="team_insert" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('meet_the_team', 'list', 'list'), 'Back to  team listing');?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Team Member</td>
				</tr>
				<tr>
					<td align="left" width="29%">Team Member Name</td>
					<td width="71%" align="left"><input type="text" name="team_name" size="24" tabindex="1" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="29%">Team Member Detail</td>
					<td align="left">
                    <?  
						$oFCKeditor = new FCKeditor('team_detail') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= '';
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
						?>
                    </td>
				</tr>
               	
                <tr>
					<td align="left" width="29%">Upload Team Member Photo</td>
					<td align="left"><input type="file" name="team_logo" size="16" tabindex="4" /></td>
				</tr>
                <tr>
					<td align="left" valign="middle" width="20%" >Email Address</td>
					<td align="left" valign="middle" ><input type="text" name="team_email" size="24" tabindex="2" value=""/></td>
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
		<form id="video_update" action="<?=make_admin_url('meet_the_team', 'update', 'update', 'id='.$id)?>" method="post" name="team_update" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left">
						<?=make_admin_link(make_admin_url('meet_the_team', 'list', 'list'), 'Back to team listing');?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Member Team</td>
				</tr>
				<tr>
					<td align="left" width="29%">Team Member Name</td>
					<td width="71%" align="left"><input type="text" name="team_name" size="24" tabindex="1"  value="<?=$team->team_name;?>"/></td>
				</tr>
              
				<tr>
					<td align="left" valign="top" width="29%">Team Member Detail</td>
					<td align="left">
                    <?  
						$oFCKeditor = new FCKeditor('team_detail') ;
						$oFCKeditor->BasePath	= DIR_WS_SITE.ADMIN_FOLDER.'/js/fckeditor/';
						$oFCKeditor->Value		= html_entity_decode($team->team_detail);
						$oFCKeditor->Height		=400;
						$oFCKeditor->Create() ;
					?>	
                    </td>
				</tr>
                	
                <tr>
				  <td align="left" width="29%" valign="top"><br /><br />
				   Team Member Photo</td>
					<td align="left"><br /><br /><input type="file" name="team_logo" size="16" tabindex="4" /> <br /><br /><img src="<?php echo get_thumb('team', $team->team_logo); ?>"  /></td>
				</tr>
				 <tr>
					<td align="left" valign="middle" width="20%" >Email Address</td>
					<td align="left" valign="middle" ><input type="text" name="team_email" size="24" tabindex="2" value="<?=$team->team_email;?>"/></td>
				</tr>
				<tr>
					<td align="left" width="29%">Status</td>
					<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" <?=($team->is_active)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" width="29%">Position</td>
					<td align="left"><input type="text" size="4" name="position" tabindex="6" value="<?=$team->position;?>" /></td>
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
