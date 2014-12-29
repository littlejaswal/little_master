<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
     	<?php css($array=array('style', 'jquery.lightbox-0.5'));?>
		<?php js($array=array('jquery-1.2.6.min', 'lightbox/jquery.lightbox-0.5'));?>
		<script>
			 $(function() {
       			 $('.photo a').lightBox();
   			 });
		</script>
	</head>
<?php 
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Photo Galleries</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;
<?php echo isset($gallery->name)?'<a href="'.make_url('photos', 'id='.$gallery->id).'">'.ucwords($gallery->name).'</a>'.'&nbsp;&raquo;&nbsp;':'';?><?php echo $gallery->description ?> 
	<div style="float:right; padding-right:45px;">
		<a href="<?php echo make_url('slide-show', 'gallery_id='.$gallery->id);?>">View Slide Show</a>
		</div>
	</div>
<?php if(count($photos)): $sr=1;?>
	<?php foreach ($photos as $k=>$v):?>
		<?php $image=$v->image;?>
		<?php $pid=$v->id;?>
		<?php include(DIR_FS_SITE.'template/photo.php');?>
        <?php echo ($sr++%3==0)?'<div style="clear:both;"></div>':'';?>
	<?php endforeach;?>
<?php endif;?>
</div>
         
        </div>
    </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>
<?php include_once(DIR_FS_SITE_INCLUDE.'right.php'); ?>
<?php include_once(DIR_FS_SITE_INCLUDE.'bottom.php'); ?>