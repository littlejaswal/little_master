<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pearlandpm > Property </title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<?php js($array=array('jquery-1.4.2.min','inputClear','featured','homeSlider'));?>
<!--[if IE 6]>
  <link rel="stylesheet" type="text/css" href="/css/ie6.css" />
  <script src="/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
  <script>
      DD_belatedPNG.fix('img, #featured, #sideNav a, #container, #homeSlider h1, #content h1, #footer');
  </script>
<![endif]-->
</head>
<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'top.php');
?>
</div><!-- end headerContainer -->
<div id="container">
<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'left.php');
?>
	<div id="content">
	<h1 class="headerMargin"><?php echo "Pearlandpm Properties" ?></h1>			
   <!--  content --> 
  <?php 
	  if($links->GetNumRows()):
	  
		 while($object=$links->GetObjectFromRecord()):
				//include(DIR_FS_SITE.'template/links_detail.php');
				include(DIR_FS_SITE_TEMPLATE.'links_detail.php');
		endwhile; 
	 else: ?>
				<div class="line_box">
					 <div class="link_logo">
			<?php	echo "No Record found"; ?>
					</div>
				</div>					
	<?php endif; ?>	 
   
		
	<!-- end content -->
	</div>
    <div class="clear"></div>

</div><!-- end container -->

<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'footer.php');
?>



