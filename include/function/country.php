<?php
function get_country_name_by_id($id)
{
	if($id==0):
		return 'Root';
	else:
		$query= new query('country');
		$query->Where="where id='$id'";
		$obj=$query->DisplayOne();
		if(is_object($obj)):
			return $obj->name;
		else:
			return '';
		endif;
	endif;
}

function get_country_list()
{
	$query= new query('country');
	$query->Where="where is_active=1";
	$query->DisplayAll();
	$country_list=array();
	$country_name='';	
	while($object= $query->GetObjectFromRecord()):
		$country_name=$object->name;
		$idd=$object->id;
		$country_list[$object->id]=$country_name;
	endwhile;
	return $country_list;
}


function get_country_drop_down($name, $selected='')
{
	$query= new query('country');
	$query->Where="where is_active='1'";
	$query->DisplayAll();
	echo '<select name="'.$name.'"  style="width:200px;" class="contactfield">';
	 echo '<option value="United Kingdom">'.'United Kingdom'.'</option>';
	while ($value=$query->GetArrayFromRecord()):
		if(in_array($value['name'],$selected)):
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
?>