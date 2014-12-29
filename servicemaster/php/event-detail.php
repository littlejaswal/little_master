<?php 
$id=is_set($_GET, 'id', 1);
$events=new query('event');
$events->Where="where is_active='1' and id='$id'";
$object= $events->DisplayOne();
?>