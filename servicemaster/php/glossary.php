<?php
$alpha=isset($_GET['alpha'])?strtolower($_GET['alpha']):'a';
$alphabets=array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
$gquery= new query('glossary');
$gquery->Where="where caption like '$alpha%' order by position";
$gquery->DisplayAll();

?>