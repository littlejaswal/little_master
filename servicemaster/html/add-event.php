<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style', 'layout'));?>
		<?php js($array=array('jquery-1.2.6.min', 'maxheight'));?>
        <?php css($array=array('style','themes/smoothness/jquery.ui.all'));?>
        	<?php js($array=array('jquery-1.2.6.min', 'jquery.validate', 'additional-methods', 'ui/jquery.ui.core', 'ui/jquery.ui.widget', 'ui/jquery.ui.datepicker'));?>
	<script type="text/javascript">
	$("document").ready(function() {
	 $("#appointment-form").validate();
		$("#event_date").datepicker();
	});
</script>
       <style type="text/css">
		#appointment label.error {
			width:200px;
			display:block;
			color:#FF1F28;
			float:right;
			text-align:left;
		}
		
		.label{
			display:block;
			float:left;
			width:150px;
			line-height:30px;
		}
		
		legend{font-weight:bold;}
		.submit{
			text-align:right;
			padding-right:130px;
		}
		</style>	
        </head>
<?php 
#include the top portion of your website  here.
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>

<form name="form1" method="post" action="<?php echo make_url('add-event')?>"  id="appointment-form">
	<div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Add Event</div>
      </div>
       <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
         <div id="restorationtext21">
         <div id="breadcrumb">
                <a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;<a href="<?php echo make_url('events');?>">Events</a>&nbsp;&raquo;&nbsp;Add event
            </div>
       <div id="add_event" >   
	<div >Event Title  
	<input type="text" name="name" id="name" value=""  style=" margin-left:80px; width:200px;" class="required alphanumeric"  />	</div>
	
	<div>Event Date 
	<input type="text" name="event_date" value=""  id="event_date" style="margin-left:80px;width:200px;" class="required alphanumeric"/>
	</div>
	<div >Entry Fee ($)  
	<input type="text" name="fee" value=""  style="margin-left:68px;width:200px;"/>
	</div>
	<div>Shot Description</div>
	<div><textarea name="short_description" cols="41" rows="5" tabindex="7" class="required alphanumeric"></textarea>
	</div>
	<div>Long Description</div>
	<div><textarea name="long_description" cols="41" rows="7" tabindex="7"></textarea>
	</div>

	<div><h2>Location</h2></div>

	<div>	Venue    
	<input type="text" name="venue" value="" style="margin-left:100px;width:200px;" class="required alphanumeric"/>
	</div>
	<div>	City	
	<input type="text" name="city" value="" style="margin-left:112px;width:200px;"/>
	</div>
	<div>State		
	<input type="text" name="state" value="" style="margin-left:107px;width:200px;"/>
	</div>
	<div>	Country	
	<input type="text" name="country" value="" style="margin-left:88px;width:200px;">
	</div>
	<div>Zipcode	
	<input type="text" name="zipcode" value="" style="margin-left:94px;width:200px;"/>
	</div>

	 <div><h2>Organiser Details</h2></div>
   	<div>Organiser Name
    <input type="text" name="organisers" size="24" align="middle" tabindex="8" style="margin-left:44px;width:200px;"/>
   </div>	
   <div> Country
    <input type="text" name="organisers_country" size="24" tabindex="8" style="margin-left:91px;width:200px;"/>
    </div>
    <div>  Telephone No
    <input type="text" name="telephone" size="24" tabindex="8" style="margin-left:62px;width:200px;"/>
     </div>
     <div>Email Address
     <input type="text" name="email" id="email" size="24" tabindex="8" style="margin-left:57px;width:200px;" />
      </div>
	<div><h2>Your Details</h2></div>
	<div> Your Name	
	<input type="text" name="user_name" value="" style="margin-left:75px;width:200px;"/>
	</div>
	<div>Email Address 
	<input type="text" name="user_email" id="user_email" value="" style="margin-left:58px;width:200px;" />
	</div>
	<div id="submitbutton">
	<input type="submit" name="submit" value="submit" tabindex="9" /> 
	<input type="submit" name="cancel" value="cancel" tabindex="9"  class="cancel"  /> </div>

	</div>
    </div>
</div>
  </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>
</form>

<?php
include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');
?>