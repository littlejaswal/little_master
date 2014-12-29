<script src="<?php echo DIR_WS_SITE_JAVASCRIPT?>jquery.js"></script>
<script language = "Javascript">
	$('document').ready(function (){
		$('#deleteall').click(function (){
			if( $('#deleteall').is(':checked')){	$("input[@rel=del]").attr("checked", true); }
			else{ $("input[@rel=del]").attr("checked", false); }
		});
	});
</script>

<?
display_message(1);
#handle sections here.
switch ($section):
	case 'list':
		#html code here.
		?>
		<table cellspacing="2" cellpadding="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="20%" class="table_head" align="left">Country Zones</td>
			</tr>
		</table>
		<p></p>
		<?php 
		$selected_zone=array();
		while($zone=$q1->GetObjectFromRecord()):?>
		<form action="<?php echo make_admin_url('zone_country', 'list', 'list')?>" method="POST" name="zone" id="zone">
		<table cellspacing="2" cellpadding="2" align="center" width="100%" border="0" class="table" style="border:solid 1px #dcdcdc;">
			<tr>
				<td width="20%" class="table_head" align="left" colspan="3" style="padding-left:5px;">Zone: <?php echo $zone->name;?></td>
			</tr>
		
			<tr>
				<td class="table_head_title" style="padding-left:5px;">Countries</td>
				<td class="table_head_title" style="padding-left:5px;" colspan="2"><?php echo $zone->name;?> Zone</td>
				
			</tr>
			<tr>
				<?php 
					$query=new query('zone_country');
					$query->Where="where zone_id=$zone->id";
					$query->DisplayAll();
					$country_name='';	
					while($object=$query->GetObjectFromRecord()):
						$country_name=get_country_name_by_id($object->country_id);
						$idd=$object->country_id;
						$selected_zone[$object->id]=$country_name;
					endwhile;
					$z=isset($_GET['id']) && $_GET['id']?$_GET['id']:'';
					$s=isset($_GET['s']) && $_GET['s']?$_GET['s']:'';
				?>
				<td><?php echo country_drop_down($country_list, 'add_country_id[]', $selected_zone);?></td>
				<td colspan="2"><?php echo zone_drop_down($zone->id,'delete_country_id[]',$s,$z);?></td>
				
			</tr>
			<tr>
				<td align="left"><input type="hidden" name=zone_id value="<?php echo $zone->id?>" /><input type="submit" name="add_zone_country" value="Add" style="width:100px;"></td>
				<td align="left"><input type="submit" name="delete_zone_country" value="Remove" style="width:70px;"></td>
				<td align="left">
				<a href="<?php echo make_admin_url('zone_country', 'list', 'list','id='.$zone->id.'&s=1')?>">Select All</a>
				</td>
			</tr>
		</table>
		</form>
		<p></p>
		<?php endwhile;?>
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
