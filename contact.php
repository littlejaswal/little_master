<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo head(isset($content)?$content:'');?>
<?php css($array=array('reset','style'));?>
<?php js($array=array('jquery-1.4.2.min','inputClear','featured','jquery.cycle.all.min','jquery.validate.min'));?>

<script>
$(document).ready(function(){
    $("#contactForm").validate();
  });
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4167700-45']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'top.php');
?>
</div><!-- end headerContainer -->
<div id="container">
<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'left.php');
?>
<!--	main part -->
	<div id="content">	
	<h1 class="headerMargin"><?php echo $content->page_heading; ?></h1>		
	<font color="red"><?php display_form_error();?>		  
			  </font>
	<!--  content -->
			  <?php if($content->is_preview==0): echo html_entity_decode($content->page);
				 else: echo "<p>Information will be comming soon</p>"; endif; 
	?>		  

<hr>
 <form id="contactForm" name="contactForm" method="post" action="">
    	<label class="headerMargin" for="Name" >First Name:</label>
        <input name="first_name" class="required" />
		<label class="headerMargin" for="Last Name" >Last Name:</label>
        <input name="last_name" class="required" />
        <label class="headerMargin" for="Email" name="email">Email:</label>
        <input name="email" class="required email"/>
		<label class="headerMargin" for="Mobile Phone" name="phone">Mobile Phone:</label>
        <input name="phone" class="Textbox required phone"/>
        <label class="headerMargin" for="Message" name="message">Message:</label>
        <textarea name="message" class="required"></textarea>
		<label class="headerMargin" for="Name" >Company:</label>
        <input name="Company" class="required" />
        <input type="submit" name="submit" class="submitContact" value="Send" />
    </form>

    </div><!-- end content -->

    <div class="clear"></div>
    
	


    <div class="clear"></div>

</div><!-- end container -->

<?php
include_once(DIR_FS_SITE_TEMPLATE_INC.'footer.php');
?>



