<script type="text/javascript">
	$("document").ready(function() {
		$("#event_date").datepicker();
	});
	$("document").ready(function() {
		$("#event_date_show").datepicker();
	});
</script>
<?
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table width="100%" border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td colspan="7"  style="border-top:solid 1px #dcdcdc;">
				<?=PageControl($QueryObj->PageNo, $QueryObj->TotalPages, $QueryObj->TotalRecords, DIR_WS_SITE_CONTROL.'control.php', 'Page=event', 2);?>
				</td>
			</tr>
			<? if($QueryObj->GetNumRows()!=0):?>
			<tr>
				<td align="center" valign="middle" width="5%" class="table_head">Sr.</td>
				<td width="20%" class="table_head">Name</td>
				<td align="center" valign="middle" width="10%" class="table_head">Venue</td>
				<td align="center" valign="middle" width="20%" class="table_head">Date</td>
				<td align="center" valign="middle" width="10%" class="table_head">Status</td>
				<td align="center" valign="middle" width="10%" class="table_head">Reg. Required?</td>
				<td class="table_head" align="center">Controls</td>
			</tr>
			<?$sr=1;while($event=$QueryObj->GetObjectFromRecord()):?>
			<tr>
				<td width="5%"  align="center"><?=$sr++?>.</td>
				<td width="20%" ><?=$event->name?></td>
				<td width="10%"  align="center"><?=$event->venue?></td>
				<td width="20%"  align="center"><?=$event->event_date?></td>
				<td width="10%"  align="center"><?=echo_y_or_n($event->is_active)?></td>
				<td width="10%"  align="center"> <?=echo_y_or_n($event->register_on_off)?></td>
				<td align="center">
					<?=make_admin_link(make_admin_url('event', 'update', 'update', 'id='.$event->id), get_control_icon('edit'));?>&nbsp;&nbsp;
				<?=make_admin_link(make_admin_url('event', 'delete', 'list', 'id='.$event->id), get_control_icon('cancel'));?>
				</td>
			</tr>
			<?endwhile;
			else:?>
				<tr>
					<td>&nbsp;&nbsp;</td>
				</tr>
				<tr>
					<td align="center" valign="middle" colspan="6">Sorry no event found.</td>
				</tr>
			<?endif;?>
			
		</table>
		<?
		break;
	case 'insert':
		?>
		<form id="event_insert" action="<?=make_admin_url('event', 'insert', 'insert');?>" method="post" name="event_insert">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left"><?=make_admin_link(make_admin_url('event', 'list', 'list'), 'Back to event listing');?></td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Event</td>
				</tr>
				<tr>
					<td align="left" width="40%">Event Title</td>
					<td align="left"><input type="text" name="name" size="24" tabindex="1" /></td>
				</tr>
			
				<tr>
					<td align="left" width="40%">Event Date</td>
					<td align="left"><input type="text" name="event_date" size="24" tabindex="2" id="event_date"  /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Event Date(as it appears on the website)</td>
					<td align="left"><input type="text" name="event_date_show" id="event_date_show" size="24" tabindex="3" /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Is Registration Needed For The Event?</td>
					<td align="left"><input type="checkbox" name="register_on_off" value="1" tabindex="4" /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Status</td>
					<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Is Entry Fee Required?</td>
					<td align="left"><input type="checkbox" name="free_paid" value="1" tabindex="6" /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Entry Fee($)</td>
					<td align="left"><input type="text" name="fee" size="24" tabindex="7" /></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="40%">Short Description</td>
					<td align="left"><textarea name="short_description" rows="4" cols="40" tabindex="8"></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="40%">Long Description</td>
					<td align="left"><textarea name="long_description" rows="10" cols="40" tabindex="9"></textarea></td>
				</tr>
                   <tr><td style="font-size:18px"><b>Location</b></td></tr>
                	<tr>
					<td align="left" width="40%">Venue</td>
					<td align="left"><input type="text" name="venue" size="24" tabindex="10" /></td>
				</tr>
              
                <tr>	
                <td align="left" valign="top" width="40%">City</td>
                <td align="left"><input type="text" name="city" size="24" tabindex="11" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">State</td>
                <td align="left"><input type="text" name="state" size="24" tabindex="12" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Country</td>
                <td align="left"><input type="text" name="country" size="24" tabindex="13" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Zipcode</td>
                <td align="left"><input type="text" name="zipcode" size="24" tabindex="14" /></td>
                </tr>
                <tr><td style="font-size:18px"><b>Organiser Details</b></td></tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Organiser Name</td>
                <td align="left"><input type="text" name="organisers" size="24" tabindex="15" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Country</td>
                <td align="left"><input type="text" name="country" size="24" tabindex="16" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Telephone No</td>
                <td align="left"><input type="text" name="telephone" size="24" tabindex="17" /></td>
                </tr>
                <tr>	
                <td align="left" valign="top" width="40%">Email Address</td>
                <td align="left"><input type="text" name="email" size="24" tabindex="18" /></td>
                </tr>
                  <tr><td style="font-size:18px"><b>Your Details</b></td></tr>
                    <td align="left" valign="top" width="40%">Your Name</td>
                <td align="left"><input type="text" name="user_name" size="24" tabindex="19" /></td>
                </tr>
                <tr>	
                <td align="left" valign="top" width="40%"> Email Address</td>
                <td align="left"><input type="text" name="user_email" size="24" tabindex="20" /></td>
                </tr>
				<tr>
					<td align="left" width="40%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="21" /></td>
				</tr>
				
			</table>
		</form>
		<?
		#html code here.
		break;
	case 'update':
		#html code here.
		?>
		<form id="event_update" action="<?=make_admin_url('event', 'update', 'update', 'id='.$id)?>" method="post" name="event_update">
			<table width="100%" border="0" cellspacing="2" cellpadding="2" style="border: solid 1px #dcdcdc;">
				<tr>
					<td colspan="2" align="left">
						<?=make_admin_link(make_admin_url('event', 'list', 'list'), 'Back to event listing');?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="table_head" align="left">Add New Event</td>
				</tr>
				<tr>
					<td align="left" width="40%">Event Title</td>
					<td align="left"><input type="text" name="name" size="24" tabindex="1"  value="<?=$event->name;?>"/></td>
				</tr>
				
				<tr>
					<td align="left" width="40%">Event Date</td>
					<td align="left"><input type="text" name="event_date" id="event_date" size="24" tabindex="2" value="<?=$event->event_date;?>"/></td>
				</tr>
				<tr>
					<td align="left" width="40%">Event Date On Website</td>
					<td align="left"><input type="text" name="event_date_show" id="event_date_show" size="24" tabindex="3" value="<?=$event->event_date_show;?>" /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Is Registration Needed For The Event?</td>
					<td align="left"><input type="checkbox" name="register_on_off" tabindex="4" value="1" <?=($event->register_on_off)?'checked':'';?> /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Status</td>
					<td align="left"><input type="checkbox" name="is_active" value="1" tabindex="5" <?=($event->is_active)?'checked':'';?> /></td>
				</tr>
				<tr>
					<td align="left" width="40%">Is Entry Fee Required?</td>
					<td align="left"><input type="checkbox" name="free_paid" value="1" tabindex="6" <?=($event->free_paid)?'checked':'';?>/></td>
				</tr>
				<tr>
					<td align="left" width="40%">Entry Fee($)</td>
					<td align="left"><input type="text" name="fee" size="24" tabindex="7" value="<?=$event->fee;?>"/></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="40%">Short Description</td>
					<td align="left"><textarea name="short_description" rows="4" cols="40" tabindex="8"><?=$event->short_description;?></textarea></td>
				</tr>
				<tr>
					<td align="left" valign="top" width="40%">Long Description</td>
					<td align="left"><textarea name="long_description" rows="10" cols="40" tabindex="9"><?=$event->long_description;?></textarea></td>
				</tr>
                 <tr><td style="font-size:18px"><b>Location</b></td></tr>
                 <tr>
					<td align="left" width="40%">Venue</td>
					<td align="left"><input type="text" name="venue" size="24" tabindex="10"  value="<?=$event->venue;?>"/></td>
				</tr>
                <tr>	
                <td align="left" valign="top" width="40%">City</td>
                <td align="left"><input type="text" name="city" size="24" tabindex="11" value="<?=$event->city;?>" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">State</td>
                <td align="left"><input type="text" name="state" size="24" tabindex="12" value="<?=$event->state;?>" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Country</td>
                <td align="left"><input type="text" name="country" size="24" tabindex="13" value="<?=$event->country;?>" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Zipcode</td>
                <td align="left"><input type="text" name="zipcode" size="24" tabindex="14" value="<?=$event->zipcode;?>" /></td>
                </tr>
                <tr><td style="font-size:18px"><b>Organiser Details</b></td></tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Organiser Name</td>
                <td align="left"><input type="text" name="organisers" size="24" tabindex="15" value="<?=$event->organisers;?>" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Country</td>
                <td align="left"><input type="text" name="country" size="24" tabindex="16" value="<?=$event->organisers_country;?>" /></td>
                </tr>
                 <tr>	
                <td align="left" valign="top" width="40%">Telephone No</td>
                <td align="left"><input type="text" name="telephone" size="24" tabindex="17" value="<?=$event->telephone;?>" /></td>
                </tr>
                <tr>	
                <td align="left" valign="top" width="40%">Email Address</td>
                <td align="left"><input type="text" name="email" size="24" tabindex="18" value="<?=$event->email;?>" /></td>
                </tr>
                  <tr><td style="font-size:18px"><b>Your Details</b></td></tr>
                    <td align="left" valign="top" width="40%">Your Name</td>
                <td align="left"><input type="text" name="user_name" size="24" tabindex="19" value="<?=$event->user_name;?>" /></td>
                </tr>
                <tr>	
                <td align="left" valign="top" width="40%"> Email Address</td>
                <td align="left"><input type="text" name="user_email" size="24" tabindex="20" value="<?=$event->user_email;?>" /></td>
                </tr>
				<tr>
					<td align="left" width="40%"></td>
					<td align="left"><input type="submit" name="submit" value="Submit" tabindex="21" /></td>
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
<br/><br/><br/>
<p style="text-align:left;">
	<strong>Please note that an event shall stay listed on the website until to "uncheck" the "status" of the event from event edit page.</strong>
</p>