<?
isset($_GET['action'])?$action=$_GET['action']:$action='list';
isset($_GET['section'])?$section=$_GET['section']:$section='list';
isset($_GET['id'])?$id=$_GET['id']:$id='0';

#handle actions here.
switch ($action):
	case'list':
		$q1= new query('zone');
		$q1->DisplayAll();
		
		$country_list=array();
		$country_list=get_country_list();
		
		if(is_var_set_in_post('add_zone_country')):
			foreach ($_POST['add_country_id'] as $k=>$v):
		 			$Quer= new query('zone_country');
		 			$Quer->Data['zone_id']=$_POST['zone_id'];
		 			$Quer->Data['country_id']=$v;
		 			$Quer->Insert();
		 	endforeach;
		 	$admin_user->set_pass_msg('Countries have been added successfully.');
		 	Redirect(make_admin_url('zone_country', 'list', 'list'));
		 endif;
		
		 if(is_var_set_in_post('delete_zone_country')):
		 	foreach ($_POST['delete_country_id'] as $k=>$v):
		 			$Quer= new query('zone_country');
		 			$Quer->Where="where id=$v";
		 			$Quer->Delete_where();
		 	endforeach;
		 	$admin_user->set_pass_msg('Countries have been removed successfully.');
		 	Redirect(make_admin_url('zone_country', 'list', 'list'));
		 endif;
		 
		break;
	case'insert':
		break;
	case'update':
		break;
	case'delete':
		break;
	default:break;
endswitch;


/*function get_zone_head($zones)
{
	$total=count($zones);
	$width=round(100/$total);
	echo '<table width="100%"<tr>';
	foreach ($zones as $key=>$value)://print_r($zones);exit;
		echo '<td width="'.$width.'%" align="left" value="0"  style="color:white;">'.$value.' Zone<td>';
	endforeach;
	echo '</tr></table>';
}


function make_zone_box($country_id, $zones)
{
	$total=count($zones);
	$width=round(100/$total);
	echo '<table width="100%"<tr>';
	foreach ($zones as $key=>$value):
		if(is_zone_country($country_id, $key)):
			echo '<td width="'.$width.'%" align="center"><input type="checkbox" name="'.$key.'['.$country_id.']" value="1" checked><td>';
		else:
			echo '<td width="'.$width.'%" align="center"><input type="checkbox" name="'.$key.'['.$country_id.']" value="1" ><td>';
		endif;
	endforeach;
	echo '</tr></table>';
}

function get_zones()
{
	$q= new query('zone');
	$q->DisplayAll();
	$zones=array();
	while($o=$q->GetObjectFromRecord()):
		$zones[$o->id]=$o->name;
	endwhile;
	return $zones;
}

function is_zone_country($country_id, $zone_id)
{
	$q= new query('zone_country');
	$q->Where="where country_id='$country_id' and zone_id='$zone_id'";
	$obj=$q->DisplayOne();
	if(is_object($obj)):
		return  true;
	else:
		return  false;
	endif;
}

*/
?>
