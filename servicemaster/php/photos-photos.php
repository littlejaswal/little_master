<?php
$id=isset($_GET['gallery_id'])?$_GET['gallery_id']:1;

#get gallery 
$gallery= get_object('gallery', $id);

#get all photos in the gallery
$query= new query('gimage');
$query->Where="where parent_id='$id' order by position";
$query->DisplayAll();
$photos=array();
if($query->GetNumRows()):
	while($object =$query->GetObjectFromRecord()):
		$photos[]=$object;
	endwhile;
endif;
?>