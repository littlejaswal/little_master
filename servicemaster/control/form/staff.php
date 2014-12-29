<script language="javascript" src="<?=DIR_WS_SITE_JAVASCRIPT?>gen_validatorv2.js"></script>
<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		?>
		<table width="100%" cellspacing="0" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="8" class="table_cell">			
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=staff', 2);?>
				</td>
			</tr>
			<tr>
				<td class="table_head" width="5%">Sr.</td>
				<td class="table_head" width="15%">Username</td>
				<td class="table_head" width="15%">Password</td>
				<td class="table_head" width="20%">LastVisit</td>
				<td class="table_head" width="15%">IP</td>
				<td class="table_head" width="10%">Visits</td>
				<td class="table_head" colspan="2">Controls</td>
			</tr>
			<?$sr=1;?>
			<?while($QueryObj1=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td class="table_cell" ><?=$sr++?>.</td>
				<td class="table_cell" ><?=$QueryObj1->username;?></td>
				<td class="table_cell" ><?=$QueryObj1->password;?></td>
				<td class="table_cell" ><?=ToUKDate($QueryObj1->last_visit);?></td>
				<td class="table_cell" ><?=$QueryObj1->ip_address;?></td>
				<td class="table_cell" ><?=$QueryObj1->total_visit;?></td>
				<td class="table_cell"><a href="<?=make_admin_url('staff_detail','list', 'list', 'id='.$QueryObj1->id);?>"><?php echo get_control_icon('zoom')?></a></td>
				<td class="table_cell"><a href="<?php echo make_admin_url('staff', 'delete', 'list', 'id='.$QueryObj1->id.'&delete=1')?>" onclick="return confirm('Are you sure? The user shall be deleted permanently');"><?php echo get_control_icon('cancel')?></a></td>
				
			</tr>
			<?endwhile;?>
		</table>
		<br/>
		
		<?
		#html code here.
		break;
	case 'insert':
		?>
		<form action="<?=make_admin_url('staff', 'insert', 'list')?>" method="POST" enctype="multipart/form-data" id="register">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
		   <tr>
				<td colspan="2"><?=make_admin_link(make_admin_url('staff', 'list', 'list'), 'Back to staff listing')?></td>
		   </tr>
			<tr>
				<th colspan="2" align="center" class="table_head">Add New Staff</th>
			</tr>
			<tr>
				<td width="30%"><strong>Account Information </strong></td>
				<td class="">&nbsp;</td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">User Email </td>
				<td class=""><input type="text" name="username" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Password</td>
				<td class=""><input type="password" name="password" size="30" tabindex="2" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Confirm Password</td>
				<td class=""><input type="password" name="password" size="30" tabindex="1" /></td>
			</tr>
				<tr>
				<td width="30%" align="left" ><strong>Personal Information</strong> </td>
				<td class="">&nbsp;</td>
			</tr>
			
			<tr>
				<td width="30%" align="left" class="">Title</td>
				<td class=""><select name="title" size="1" tabindex="4">
							<option value="Mr.">Mr.</option>
							<option value="Mrs.">Mrs.</option>
							<option value="Miss.">Miss.</option>
							<option>Other</option>
							
				  </select></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">First Name</td>
				<td class=""><input type="text" name="firstname" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Last Name</td>
				<td class=""><input type="text" name="lastname" size="30" tabindex="1" /></td>
			</tr>	
			<tr>
				<td width="30%" align="left"><strong>Contact Information</strong> </td>
				<td class="">&nbsp;</td>
			</tr>
		
			<tr>
				<td width="30%" align="left" class="">Address1</td>
				<td class=""><input type="text" name="address1" size="30" tabindex="1" /></td>
			</tr>	
			<tr>
				<td width="30%" align="left" class="">Address2</td>
				<td class=""><input type="text" name="address2" size="30" tabindex="1" /></td>
			</tr>	
			<tr>
			<tr>
				<td width="30%" align="left" class="">City</td>
				<td class=""><input type="text" name="city" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">State</td>
				<td class=""><input type="text" name="state" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Country</td>
				<td class=""><?php echo get_country_drop_down('country');?></td>
			</tr>
				<td width="30%" align="left" class="">Phone</td>
				<td class=""><input type="text" name="phone" size="30" tabindex="1" /></td>
			</tr>	
			
			
			<tr>
				<td width="30%" align="left" class="">Fax</td>
				<td class=""><input type="text" name="fax" size="30" tabindex="1" /></td>
			</tr>
			
			<tr>
				<td width="30%" align="left" class="">Zip Code</td>
				<td class=""><input type="text" name="zip" size="30" tabindex="1" /></td>
			</tr>
			
			<tr>
				<td width="30%" align="left"><strong>Other Information</strong> </td>
				<td class="">&nbsp;</td>
			</tr>
			
				<tr>
				<td width="30%" align="left" class="">Company Name</td>
				<td class=""><input type="text" name="companyname" size="30" tabindex="1" /></td>
			</tr>
			<tr>
				<td width="30%" align="left" class="">Newsletter</td>
				<td class=""><input type="checkbox" name="is_active" value="1" tabindex="6" /></td>
			</tr>
			<tr>
				<td width="30%" class=""></td>
				<td class=""><input type="submit" name="submit" value="Submit" tabindex="8"/></td>
			</tr>
		</table>
		</form>
		<script>
			frmvalidator= new Validator('register');
			frmvalidator.addValidation("username","req","Please enter Email address.");
			frmvalidator.addValidation("username","email","Please enter valid Email address.");
			frmvalidator.addValidation("password","req","Please enter Password."); 
			frmvalidator.addValidation("password","minlength","Please enter at least 6 charcters."); 
			//frmvalidator.addValidation("cpassword","req","Please enter Confirm Password."); 
			//frmvalidator.addValidation("cpassword","minlength","Please enter at least 6 charcters."); 
			frmvalidator.addValidation("firstname","req","Please enter First Name."); 
			frmvalidator.addValidation("lastname","req","Please enter Last Name");
			frmvalidator.addValidation("state","req","Please enter State");
			frmvalidator.addValidation("address1","req","Please enter Address1.");
			frmvalidator.addValidation("city","req","Please enter City."); 
			frmvalidator.addValidation("zip","req","Please enter Zip."); 
		</script>
		<?
		break;
	case 'update':
		#html code here.
		break;
	case 'delete':
		#html code here.
		break;
	default:break;
endswitch;
?>
