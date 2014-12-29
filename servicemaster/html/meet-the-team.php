<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
        		
		<?php css($array=array('style','themes/smoothness/jquery.ui.all'));?>
		<?php js($array=array('jquery-1.2.6.min', 'jquery.validate', 'additional-methods', 'ui/jquery.ui.core', 'ui/jquery.ui.widget', 'ui/jquery.ui.datepicker'));?>
		<script type="text/javascript">
			$("document").ready(function() {
				$("#appointment-form").validate();
				$("#date").datepicker();
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
        <div id="ourservicestext21">Meet the team</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
            
                    <div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Meet the team</div>
              <div style="height:auto; border:5px;">    
 <?php if(count($team)):?>
		<?php foreach ($team as $k=>$v):?>
				<?php include(DIR_FS_SITE.'template/meet-the-team.php');?>
    	<?php endforeach;?>
	<?php endif;?>                 
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