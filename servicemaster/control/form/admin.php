<script language="javascript" src="<?=DIR_WS_SITE_JAVASCRIPT?>gen_validatorv2.js"></script>
<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		?>
        <form id="" action="<?=make_admin_url('admin', 'update2', 'list')?>" method="post" name="">
		<table width="100%" cellspacing="0" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="3" class="table_cell">			
						<?php echo PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=admin ', 2);?>
				</td>
			</tr>
			<tr>
				<td class="table_head" width="20%" align="left">Username</td>
				<td class="table_head" width="20%" align="left">Password</td>
               <td class="table_head" width="20%" align="center">Status</td>
				<td class="table_head" >Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td class="table_cell" align="left" ><?php echo $QueryObj1->username;?></td>
				<td class="table_cell" align="left"  ><?php echo $QueryObj1->password;?></td>
               <td align="center" ><input type="checkbox" name="is_active[<?=$QueryObj1->id;?>]" <?=$QueryObj1->is_active=='1'?'checked':''?> value="<?=$QueryObj1->username?>" style="border:none;"></td>
				<td align="table_control">
					<a href="<?php echo make_admin_url('admin', 'update', 'update', 'id='.$QueryObj1->id)?>"><?php echo get_control_icon('edit')?></a>&nbsp;&nbsp;
					<a href="<?php echo make_admin_url('admin', 'delete', 'list', 'id='.$QueryObj1->id.'&delete=1')?>" ><?php echo get_control_icon('cancel')?></a></td>
				</tr>
			<?endwhile;?>
            		<tr>
				  <td colspan="4" align="center" ><input type="submit" name="submit" value="update"></td>
			</tr>
		</table>
		<br/>
		
		<?
		#html code here.
		break;
	case 'insert':
		?>
		<form action="<?php echo make_admin_url('admin', 'insert', 'list')?>" method="POST" enctype="multipart/form-data" id="register">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
		   <tr>
				<td colspan="2" align="left"><?=make_admin_link(make_admin_url('admin', 'list', 'list'), 'Back to user listing')?></td>
		   </tr>
			<tr>
				<th colspan="2" align="left" class="table_head">Add New User</th>
			</tr>
		
			<tr>
				<td width="30%" align="left" class="">Username </td>
				<td class="" align="left"><input type="text" name="username" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Password</td>
				<td class="" align="left"><input type="password" name="password" size="31" tabindex="2" /></td>
			</tr>
			<tr>
				<td align="left" width="30%">Status</td>
				<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" /></td>
			</tr>
				<tr>
				<td align="left" width="30%"></td>
				<td align="left"><input type="submit" name="submit" value="Submit" tabindex="7" /></td>
			</tr>

		</table>
		</form>
	
		<?
		break;
	case 'update':
	?>
<form action="<?php echo make_admin_url('admin', 'update', 'list')?>" method="POST" enctype="multipart/form-data" id="register">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
		   <tr>
				<td colspan="2" align="left"><?=make_admin_link(make_admin_url('admin', 'list', 'list'), 'Back to user listing')?></td>
		   </tr>
			<tr>
				<th colspan="2" align="left" class="table_head">Update Admin Manager</th>
			</tr>
			
			<tr>
				<td width="30%" align="left" class="">Username </td>
				<td class="" align="left"><input type="text" name="username" value="<?php echo $page_cotent->username;?>" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Password</td>
				<td class="" align="left"><input type="password" name="password" value="<?php echo $page_cotent->password;?>" size="31" tabindex="2" /></td>
			</tr>
			<tr>
				<td align="left" width="30%">Status</td>
				<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" <?php echo ($page_cotent->is_active)?'checked':'';?> /></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $page_cotent->id?>">
			<tr>
			<td align="left" width="30%"></td>
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
