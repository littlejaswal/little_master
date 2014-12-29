<?php

$content=get_object('content','133');
$error1="";
if(isset($_POST['submit'])):
	#validate captcha
          if($_POST['captcha']==$_SESSION['captcha_sum']){
			$data=MakeDataArray($_POST, array('submit', 'submit_x', 'submit_y','captcha'));
			$header='Contact Request';
			$center_content='';
			$subject=SITE_NAME.': Contact Request';
			$footer='Best Regards, '."<br/>".SITE_NAME;				
			//$to="pawan@cwebconsultants.com";
			foreach ($data as $k=>$v):
				$center_content.=str_replace('_', ' ', ucfirst($k)).' := '.$v."<br/>";
			endforeach;
			include_once(DIR_FS_SITE.'include/email/general.php');
			$content=ob_get_contents();
			
			send_email($subject, ADMIN_EMAIL, ADMIN_EMAIL, SITE_NAME, $content, BCC_EMAIL, 'html');
			//send_email($subject, $to, $to, SITE_NAME, $content, $bc, 'html');			
			Redirect(make_url('contact','&msg=Your request has been submitted successfully.'));
				}else{
		 //echo 'Please enter the validation value ' ;
		 $error1="The entered code was not correct. Please try again.";
		} 
		      
endif;

$string="";
for ($i = 0; $i < 5; $i++) 
	{
	$string .= chr(rand(97, 122));
	}
$_SESSION['captcha_sum'] =$string;

?>
