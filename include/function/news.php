<?php
function get_news($limit=0, $fields=array(), $order='asc')
{
	$query= new query('news');
	if(is_array($fields) && count($fields)):
		$field=implode(',', $fields);
		$query->Field=$field;
	endif;
	if($limit):
		$query->Where="where is_active='1' order by news_date $order limit 0, $limit";
	else:
		$query->Where="where is_active='1' order by news_date $order";
	endif;
	$query->DisplayAll();
	$list=array();
	if($query->GetNumRows()):
		while($object=$query->GetObjectFromRecord()):
			$list[]=$object;
		endwhile;
	endif;
	return $list;
}




?>