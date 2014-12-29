<?php
function get_all_cities()
{
	$cities= new query('cities');
	$cities->Where="where is_active='1' order by position";
	$cities->DisplayAll();
	$city=array();
	if($cities->GetNumRows()):
		while($object=$cities->GetObjectFromRecord()):
			$city[]=$object;
		endwhile;
	endif;
	return $city;
}

function get_all_services()
{
	$cities= new query('services');
	$cities->Where="where is_active='1' order by position";
	$cities->DisplayAll();
	$city=array();
	if($cities->GetNumRows()):
		while($object=$cities->GetObjectFromRecord()):
			$city[]=$object;
		endwhile;
	endif;
	return $city;
}
?>