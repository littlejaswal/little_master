<?php 
//$content=get_object('content','19');
$query= new query('team');
$query->Where="where is_active='1' order by position";
$query->DisplayAll();
$team=array();
if($query->GetNumRows()):
	while($object =$query->GetObjectFromRecord()):
		$team[]=$object;
	endwhile;
endif;
?>