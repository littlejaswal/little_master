<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('galleria/jquery-1.4.2', 'galleria/galleria', 'galleria/themes/dots/galleria.dots'));?>
		<script>
			$("document").ready(function(){
				$("#galleria").galleria();
			});
		</script>
		
		
	</head>
<?php 
include_once(DIR_FS_SITE_INCLUDE.'top.php');
//include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Slide Show</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;<?php echo isset($gallery->name)?'<a href="'.make_url('photos', 'id='.$gallery->id).'">'.ucwords($gallery->name).'</a>'.'&nbsp;&raquo;&nbsp;':'';?>Slide Show</div>
<div id="galleria">
		<?php foreach ($photos as $k=>$object):?>
			<img src="<?php echo get_large('gallery', $object->image);?>"  title="<?php echo $object->caption?>" width="200px">
		<?php endforeach;?>

</div>
</div>
         
        </div>
    </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>
<?php
include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');
?>