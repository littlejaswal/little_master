<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
		<style>
			.title{height:25px;font-weight:bold;font-size:14px;padding-top:10px;}
			.text{padding:5px 5px 5px 0px;margin-bottom:10px;}
			.link{text-align:right;margin-bottom:10px;}
			.spacer{clear:both;text-align:right;}
		</style>
	</head>
<?php 
#include the top portion of your website  here.
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
		<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">News</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">

	<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;News</div>
	<?php if($list->TotalPages>1):?>
		<div class="paging"><?php echo PageControl_front($list->PageNo, $list->TotalPages, $list->TotalRecords, 'news', '', 2, '', '', 'news stories');?></div>
	<?php endif;?>
	<?php if($list->GetNumRows()):?>
		<?php while ($v=$list->GetObjectFromRecord()) { ?>
				<?php include(DIR_FS_SITE.'template/news.php');?>				
		<?php }	?>
	<?php endif;?>

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