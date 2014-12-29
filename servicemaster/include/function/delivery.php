<?php
function get_zones_box($selected=0)
{
	$q= new query('zone');
	$q->DisplayAll();
	echo '<select name="zone" size="1">';
	while($obj=$q->GetObjectFromRecord()):
		if($selected=$obj->id):
			echo '<option value="'.$obj->id.'" selected>'.$obj->name.'</option>';
		else:
			echo '<option value="'.$obj->id.'">'.$obj->name.'</option>';
		endif;
	endwhile;
	echo '</select>';
}

function get_zone_list($zone_id)
{	
	$query=new query('zone_country');
	//$query->Field="country_id";
	$query->Where="where zone_id=$zone_id";
	$query->DisplayAll();//print_r($query);exit;
	$country_list=array();
	$country_name='';	
	while($object=$query->GetObjectFromRecord()):
		$country_name=get_category_name_by_id($object->country_id);
		$idd=$object->country_id;
		/*while($id=get_parent_cat_id($idd)):
			$product_name=get_category_name_by_id($id).'>>'.$product_name;
			$idd=$id;
		endwhile;*/
		array_push($country_list, array('id'=>$object->id, 'name'=>$country_name));
	endwhile;
	return $country_list;
}

function zone_drop_down($zone_id,$id,$s,$z)
{
	$query=new query('zone_country');
	$query->Where="where zone_id=$zone_id";
	$query->DisplayAll();
	$country_list=array();
	$country_name='';	
	while($object=$query->GetObjectFromRecord()):
		$country_name=get_country_name_by_id($object->country_id);
		$idd=$object->country_id;
		//$country_list('id'=>$object->id, 'name'=>$country_name));
		array_push($country_list, array('name'=>$country_name,'id'=>$object->id));
		//$country_list[$object->id]=$country_name;
	endwhile;
	$total_list=array();
	foreach ($country_list as $k=>$v):
		$total_list[]=$v['name'];
    endforeach;
	array_multisort($total_list, SORT_ASC, $country_list);
	//print_r($country_list);exit;
	echo '<select name="'.$id.'" size="10" style="width:200px;" multiple>';
	foreach ($country_list as $k=>$v):
		if(($z == $zone_id) && $s):
			echo '<option value="'.$v['id'].'" selected="selected">'.ucfirst($v['name']).'</option>';
		else:
			echo '<option value="'.$v['id'].'">'.ucfirst($v['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}

?>