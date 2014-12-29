<?php
$query= new query('videos');
$query->Where="where is_active='1' order by position";
$query->PageNo=isset($_GET['p'])?$_GET['p']:1;
$query->PageSize=2;
$query->AllowPaging=true;
$query->DisplayAll();
$list=array();
if($query->GetNumRows()):
	while($object=$query->GetObjectFromRecord()):
		$list[]=$object;
	endwhile;
endif;
?>