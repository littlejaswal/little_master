<?php
$query= new query('gallery');
$query->Where="where is_active='1' order by position";
$query->DisplayAll();
$galleries=array();
if($query->GetNumRows()):
	while($object =$query->GetObjectFromRecord()):
		$galleries[]=$object;
	endwhile;
endif;
?>