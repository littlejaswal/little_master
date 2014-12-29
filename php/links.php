<?php
$fune=array();
$links=new query('links');
$links->Where="where is_active='1' order by id";
//$links->PageNo=isset($_GET['p'])?$_GET['p']:0;
//$links->PageSize=4;
//$links->AllowPaging=true;
//$links->print=1;
$links->DisplayAll();

/*
if($links->GetNumRows()):
while($object =$links->GetObjectFromRecord()):
		$fune[]=$object;
endwhile;
endif; 
*/
	?> 




