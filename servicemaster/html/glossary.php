<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
	</head>
<?php 
#include the top portion of your website  here.
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Glossary</div>
      </div>
      <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
          <div id="restorationtext21">
<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Glossary</div>
<div class="paging" >
<?php 
	foreach ($alphabets as $k=>$v):
		if($v==$alpha):
			if($k==24):
				echo '<a href="'.make_url('glossary', 'alpha='.$v).'" class="match">'.strtoupper($v).'</a>';
			else:
				echo '<a href="'.make_url('glossary', 'alpha='.$v).'"  class="match">'.strtoupper($v).'</a> &nbsp;';
			endif;
		else:
			if($k==24):
				echo '<a href="'.make_url('glossary', 'alpha='.$v).'">'.strtoupper($v).'</a>';
			else:
				echo '<a href="'.make_url('glossary', 'alpha='.$v).'">'.strtoupper($v).'</a> &nbsp;';
			endif;
		endif;
	endforeach;
?>
</div>

<?php if($gquery->GetNumRows()):?>
<?php while ($object=$gquery->GetObjectFromRecord()) { ?>
	<div class="glossary">
		<strong><?php echo ucwords($object->caption);?>:</strong> <br/>
		<?php echo $object->description;?>
	</div>
<?php }?>
<?php else:?>
	<div class="glossary" style="height:60px;padding-top:40px;">Sorry, No record found!</div>
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