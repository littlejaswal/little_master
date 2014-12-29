<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<form id="search_user" action="<?php echo make_admin_url('search_user','list','list');?>" method="GET" name="search_user">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
			<tr>
				<td colspan="9" class="table_head">User Search</td>
			</tr>
			<tr>
				<td width="16%" align="left" valign="middle" style="padding-left:5px;">User email:
			  <td width="84%"><input type="text" name="email" tabindex="1" size="30" value="<?php echo $email;?>" /></td>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">First Name:
				<td><input type="text" name="firstname" tabindex="2" size="30" value="<?php echo $first_name;?>" /></td>
			</tr>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Last Name:
				<td><input type="text" name="lastname" tabindex="3" size="30" value="<?php echo $last_name;?>" /></td>
			</tr>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">City:
				<td><input type="text" name="city" tabindex="4" size="30" value="<?php echo $city;?>" /></td>
			</tr>
			<tr>
				<td align="left" valign="middle" style="padding-left:5px;">Country:
				<td><?php echo get_country_drop_down('country',isset($country_name)?$country_name:'');?></td>
			</tr>
			<tr>
				<td></td>
			  <td align="left" valign="middle" style="padding-left:80px;">
				<input type="hidden" name="Page" value="search_user">
	            <input type="submit" name="submit" value="Search" tabindex="5" />		
			</td>
			</tr>
			<tr>
				<td colspan="2"></td>
			</tr>
		</table>
		</form>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td colspan="9" class="table_head">Search Results</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td colspan="9">
							<?php if($status):?>
							<?php echo PageControl($query1->PageNo, $query1->TotalPages, $query1->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=search_user&'.$qstring,2);?></td>
							<?php endif;?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<p></p>
			<tr>
				<td align="left" valign="middle" width="100%">
				<?if(!$status):?>
					Sorry! No user found.
			   <?else:?> 
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;">
						<tr>
							<td align="center" valign="middle" width="30%" class="table_head">User Email </td>
							<td align="center" valign="middle" width="14%" class="table_head">First Name</td>
							<td align="center" valign="middle" width="17%" class="table_head">Last Name</td>
							<td align="center" valign="middle" width="15%" class="table_head">City</td>
							<td align="center" width="19%" class="table_head">Country</td>
							<td width="5%" class="table_head"></td>
						</tr>
					</table>
				<?endif;?>
				</td>
			</tr>
			<p></p>
			<tr>
				<td width="100%" align="left" valign="middle">
					<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:solid 1px #dcdcdc;" id="zebra">
						<?php
						if($status):
							$sr=1; 
							while($userdetails=$query1->GetObjectFromRecord()):
							?>
							<tr>
								<td align="left" valign="middle" width="31%"><?php echo $userdetails->username;?></td>
								<td width="15%"  align="left"><?php echo $userdetails->firstname;?></td>
								<td width="17%"  align="left"><?php echo $userdetails->lastname;?></td>
								<td width="15%"  align="left"><?php echo $userdetails->city?></td>
								<td width="18%"  align="left"><?php echo $userdetails->country;?></td>
								<td align="left" width="4%" ><?php echo make_admin_link(make_admin_url('udetail' ,'list', 'list', 'id='.$userdetails->id.'&ao=1'),get_control_icon('zoom'), 'View order details here', 'order details');?></td>
							</tr>
							<?php endwhile;
						endif;?>
						
					</table>
				</td>
			</tr>
		</table>

		<?
		break;
	case 'insert':
		#html code here.
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
