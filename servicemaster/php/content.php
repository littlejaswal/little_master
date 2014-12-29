<?php
$id=isset($_GET['id'])?$_GET['id']:1;
$content=get_object('content', $id);

$parent=array();
$parent=get_content($content->parent_id, array('name', 'id'));
?>