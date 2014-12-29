<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style','themes/smoothness/jquery.ui.all'));?>
		<?php js($array=array('jquery-1.2.6.min', 'jquery.validate', 'additional-methods', 'ui/jquery.ui.core', 'ui/jquery.ui.widget', 'ui/jquery.ui.datepicker'));?>
		<script type="text/javascript">
			$("document").ready(function() {
				$("#appointment-form").validate();
				$("#date1").datepicker();
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
		.address1{ line-height:20px;}
		</style>	
	</head>
<?php 
include_once(DIR_FS_SITE_INCLUDE.'top.php');
//include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
 <div id="leftpanel21">
    <div id="ourservicepanel21">
      <div id="ourservicetop21">
        <div id="ourservicestext21">Contact us</div>
      </div>
      <div id="ourservicesmiddle21">
        <div id="restorationpanel21">
          <div id="restorationtext21">
		  <div id="breadcrumb"><a href="<?php echo make_url('home');?>">Home</a>&nbsp;&raquo;&nbsp;Contact us</div>
		  <?php echo html_entity_decode($content->page);?></div>
		<div id="restorationtext21">
		<p class="address1"><strong>Address:</strong><br />
     	Company Name &nbsp;&nbsp;<?php echo COMPANY_NAME ?><br />
       City   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo CITY ?><br />
       state   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo STATE ?>
       &nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo ZIP_CODE ?><br />
       Fax    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo FAX ?><br />
       Phone No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo PHONE_NUMBER ?><br />
       Address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php echo ADDRESS_LINE_1 ?><br />
		</p>
		<br/>
		<div style="clear:both;"></div>
		
		
			<div id="contact_form" class="form" style=" width:680px;">
			<?php display_form_error();?>
		<h4 rel="appointment">Request an Appointment</h4>
				<form action="<?php echo make_url('contact-us')?>" method="POST" id="appointment-form" >
                        <table align="left" width="100%" cellspacing="2" cellpadding="2">
                        <tr>
                        <td width="200px;">Name</td>
                        <td>
                          <input tabindex="1" type="text" name="name" id="name" size="35" class="required alphanumeric">
                          </td>
                       </tr>
                       <tr>
                       <td>Email Address</td>
                       <td>
                          <input tabindex="2" type="text" name="email" id="email" size="35" class="required email">
                          </td>
                          </tr>
                          <tr>
                          <td>Appointment Date</td>
						<td><input tabindex="4" type="text" name="date" id="date1" size="35" class="required alphanumeric"></td>
                          <tr>
                          <td>Phone Number</td>
                          <td>
                          <input tabindex="3" type="text" name="phone" id="phone" size="35" class="required alphanumeric">
                          </td>
                          </tr>
                          <tr>
                          <td valign="top">Comment</td>
                          <td>
                           <textarea name="comments" id="comments" rows="3" cols="23" tabindex="5" ></textarea>
                           </td>
                           </tr>
                           <tr>
                           <td colspan="2" style="padding-left:345px;">
                           
                          <input tabindex="6" type="submit" name="submit" value="Submit"/>
                           </td>
                           </tr>
                           </table>
                      
                    </form>
				<div style="clear:both;"></div></div>
			</div>
			
		
      </div>
    </div>
      <div id="ourservicesbottom21"></div>
    </div>
  </div>
      					
					
						<!-- main content area -->		
<?php
include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');
?>