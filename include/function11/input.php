<?

function MakeDataArray($post, $not)
	{
		$data=array();
		foreach ($post as $key=>$value):
			if(!in_array($key, $not)):
				$data[$key]=$value;
			endif;
		endforeach;
		return $data;
	}

function is_var_set_in_post($var, $check_value=false)
{
	if(isset($_POST[$var])):
		if($check_value):
			if($_POST[$var]===$check_value):
				return true;
			else:
				return false;
			endif;
		endif;
		return true;
	else:
		return false;
	endif;
}

function category_drop_down($data, $name, $size=1, $type="mulitple", $selected=array())
{
	echo '<select name="'.$name.'" size="'.$size.'" style="width:600px;" '.$type.'>';
	foreach ($data as $value):
		if(in_array($value['id'], $selected)):
			echo '<option value="'.$value['id'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['id'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endforeach;
	echo'</select>';
}


function get_country_drop_down($name, $selected='United Kindom')
{
	$selected==''?$selected='United Kingdom':'';
	$query= new query('country');
	$query->Where="where is_active='1'";
	$query->DisplayAll();
	echo '<select name="'.$name.'" size="1" style="width:180px;">';
	while ($value=$query->GetArrayFromRecord()):
		if($value['name']==$selected):
			echo '<option value="'.$value['name'].'" selected="selected">'.ucfirst($value['name']).'</option>';
		else:
			echo '<option value="'.$value['name'].'">'.ucfirst($value['name']).'</option>';
		endif;
	endwhile;
	echo'</select>';
}


function country_drop_down($data, $name, $selected=array())
{	
	 $data1=array();
	 $data1=array_diff($data, $selected);
	 echo '<select name="'.$name.'" size="10" style="width:200px;" multiple>';
	 foreach ($data1 as $k=>$value):
		echo '<option value="'.$k.'">'.ucfirst($value).'</option>';
	 endforeach;
	 echo'</select>';
	
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