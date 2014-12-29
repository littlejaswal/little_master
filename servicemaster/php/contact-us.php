<?php
$content=get_object('content','24');
if(isset($_POST['submit']) && $_POST['submit']=='Submit'):
	#validate captcha
		$data=MakeDataArray($_POST, array('recaptcha_response_field', 'recaptcha_challenge_field', 'submit'));
		$header='Appointment Request';
		$center_content='';
		$subject=SITE_NAME.': Appointment Request';
		$footer='Best Regards, '."<br/>".SITE_NAME;
		foreach ($data as $k=>$v):
			$center_content.=str_replace('_', ' ', ucfirst($k)).' := '.$v."<br/>";
		endforeach;
		ob_end_clean();
		include_once(DIR_FS_SITE.'include/email/general.php');
		$content=ob_get_contents();
		ob_start();
		send_email($subject, REPORTS_EMAIL, ADMIN_EMAIL, SITE_NAME, $content, BCC_EMAIL, 'html');
		Redirect(make_url('contact-us', '&msg=Appointment request has been submitted successfully.'));
	
endif;
?>