<?php
function get_testimonials($limit=0, $fields=array(), $order='asc')
{
	$query= new query('testimonials');
	if(is_array($fields) && count($fields)):
		$field=implode(',', $fields);
		$query->Field=$field;
	endif;
	if($limit):
		$query->Where="where is_active='1' order by position $order limit 0, $limit";
	else:
		$query->Where="where is_active='1' order by position $order";
	endif;
	$query->DisplayAll();
//	$list=array();
//	if($query->GetNumRows()):
//		while($object=$query->GetObjectFromRecord()):
//			$list[]=$object;
//		endwhile;
//	endif;
	return $query;
}


function get_random_testimonial(){
	
	$query= new query('testimonials');
	$query->Where="ORDER BY RAND() LIMIT 0,1";
	if($object=$query->DisplayOne()):
		return $object;		
	else:
		return false;
	endif;
}
?>