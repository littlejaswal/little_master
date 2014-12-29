<?php
include('../../include/config/config.php');
isset($_GET['id'])?$id=$_GET['id']:$id='0';
isset($_GET['table'])?$table=$_GET['table']:$table='';
$QueryObj = new query($table);
$QueryObj->Data['id']=$id;
$QueryObj->Data['is_active']='1';
$QueryObj->Update();

?>

