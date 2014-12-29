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
include_once(DIR_FS_SITE_INCLUDE.'top.php');
//include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Events</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
<div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Events <a href="<?php echo make_url('add-event');?>" style="float:right; padding-right:20px;">Add new event</a></div>
    
	<div style="margin-bottom:5px;" ><a href="<?php echo make_url('event-calendar');?>"><img src="<?php echo DIR_Ws_SITE_GRAPHIC?>Events_on_calendar.png" border="0" /></a></div><br /><br /><br />
	<?php if($events->TotalPages >1):?>
		<div class="paging"><?php echo PageControl_front($events->PageNo, $events->TotalPages, $events->TotalRecords, 'events', '', 2, '', '', 'events');?>	</div>
	<?php endif;?>
	<div style="clear:both;"></div>
	<?php
		if($events->GetNumRows()):
			while($object=$events->GetObjectFromRecord()):
				include(DIR_FS_SITE.'template/events.php');
			endwhile;
		else:
			echo '<p>Sorry! no event listed yet.</p>';
		endif;
	?>
	<div style="clear:both;"></div>
	<?php if($events->TotalPages >1 && $events->TotalRecords>3):?>
		<div class="paging"> <?php echo PageControl_front($events->PageNo, $events->TotalPages, $events->TotalRecords, 'events', '', 2, '', '', 'events'); ?>  </div>
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