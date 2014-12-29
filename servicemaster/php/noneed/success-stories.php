<?php 
$blog= new query('success_stories');
$blog->Where="where is_preview='0'";
$blog->PageNo=isset($_GET['p'])?$_GET['p']:1;
$blog->PageSize=3;
$blog->AllowPaging=true;
$blog->DisplayAll();
?>