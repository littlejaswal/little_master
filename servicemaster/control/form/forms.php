<?
display_message(1);
switch ($section):
	case 'list':
		?>
		<form action="<?=make_admin_url('forms', 'update_default', 'list', 'id='.$id)?>" method="POST">
			<table width="100%" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" >
			<tr>
					<td style="text-align:left" width="30%">Home Page Forms</td>
					<td style="text-align:right" colspan="3"></td>
			</tr>
			<tr>
				<td width="10%" class="table_head" align="center">Sr.</td>
				<td align="left" width="30%" class="table_head">Title</td>
				<td align="left" width="30%" class="table_head">File</td>
				
				<td class="table_head" align="center">Controls</td>
			</tr>
			<? $sr=1;?>
			<? while($image=$QueryObj->GetObjectFromRecord()):?>
				<tr>
					<td align="center" class="table_cell"  valign="top"><?=$sr++?>.</td>
					<td class="table_cell" ><?php echo $image->title;?></td>
					<td class="table_cell" ><?php echo $image->name;?></td>
					
					<td align="center" class="table_cell"><?=make_admin_link(make_admin_url('forms', 'update', 'update', 'id='.$id.'&update='.$image->id), get_control_icon('edit'));?><?php echo make_admin_link(make_admin_url('forms', 'delete', 'list', 'id='.$id.'&delete='.$image->id), get_control_icon('cancel'));?></td>
				</tr>
			<? endwhile;?>
			
			
			</table>
			</form>
		<?
		#html code here.
		break;
	case 'insert':
		?>
			<form action="<?=make_admin_url('forms', 'insert', 'list', 'id='.$id)?>" method="POST" enctype="multipart/form-data">
				<table width="100%" cellpadding="2" cellspacing="2" style="border:solid 1px #dcdcdc;">
					<tr>
						<td class="table_cell" colspan="3" ><?=make_admin_link(make_admin_url('forms', 'list', 'list', 'id='.$id), 'Form Listing');?></td>
					</tr>
					<tr>
						<td class="table_head" colspan="3" align="left" >Upload New File</td>
					</tr>
					<tr>
						<td align="left" width="20%">Title</td>
						<td align="left" width="50%"><input  type="text" name="title" ></td>
						<td></td>
					</tr>
					<tr>
						<td align="left" width="20%">File</td>
						<td align="left" width="50%"><input  type="file" name="pic1" ></td>
						<td></td>
					</tr>
					
					
					
					<tr>
						<td align="left" width="20%">&nbsp;</td>
						<td align="left" width="50%"><input type="submit" name="submit" value="Upload" class="Bn"></td>
						<td ></td>
					</tr>
				</table>
			</form>
		<?
		#html code here.
		break;
	case 'update':
		#html code here.
		?>
		<form id="add_category" action="<?=make_admin_url('forms', 'update', 'list', 'id='.$_GET['update']);?>" method="post" name="add_category" enctype="multipart/form-data">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" align="left" style="border:solid 1px #dcdcdc;">
				<tr>
					<td colspan="3"><?=make_admin_link(make_admin_url('forms', 'list', 'list', 'id='),'&laquo;Back to  list');?></td>
				</tr>
				<tr>
					<td colspan="3" align="center" valign="top" class="table_head">Update file</td>
				</tr>
				<tr>
					<td width="30%"  align="left">Title</td>
					<td align="left" ><input type="text" name="title" size="16" tabindex="2" value="<?=$category->title?>" /></td>
					<td  align="center" valign="top" ></td>
				</tr>
				<tr>
					<td width="30%"  align="left">File</td>
					<td align="left" ><input type="file" name="pic1" size="16" tabindex="2" /></td>
					<td  align="center" valign="top" ></td>
				</tr>
				
				<input type="hidden" name="id" value="<?=$_GET['update']?>">
				<tr>
					<td width="30%" ></td>
					<td ><input type="submit" name="update_category" value="Submit" tabindex="7" /></td>
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
