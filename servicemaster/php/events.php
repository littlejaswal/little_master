<?php 
$events=new query('event');
$events->Where="where is_active='1' order by event_date";
$events->PageNo=isset($_GET['p'])?$_GET['p']:1;
$events->PageSize=6;
$events->AllowPaging=true;
$events->DisplayAll();
?>