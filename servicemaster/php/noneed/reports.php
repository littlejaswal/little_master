<?php
$id=isset($_GET['id'])?$_GET['id']:18;
$content=get_object('content', $id);

$parent=array();
$parent=get_content($content->parent_id, array('name', 'id'));

if(isset($_POST['submit']) && $_POST['submit']=='Submit'):
	#validate captcha
	if(validate_captcha()):
		$data=MakeDataArray($_POST, array('recaptcha_response_field', 'recaptcha_challenge_field', 'submit', 'report_id'));
		$header='Report Request';
		$center_content='';
		$subject=SITE_NAME.': Report Request';
		$footer='Best Regards, '."<br/>".SITE_NAME;
		foreach ($data as $k=>$v):
			$center_content.=str_replace('_', ' ', ucfirst($k)).' := '.$v."<br/>";
		endforeach;
		ob_end_clean();
		include_once(DIR_FS_SITE.'include/email/general.php');
		$content=ob_get_contents();
		ob_start();
		send_email($subject, REPORTS_EMAIL, ADMIN_EMAIL, SITE_NAME, $content, BCC_EMAIL, 'html');
		Redirect(make_url('reports', 'id='.$_POST['report_id'].'&msg=Report request has been submitted successfully.'));
	else:
		$_GET['msg']='Security code could not be validated. Please try again';
	endif;
endif;
?>