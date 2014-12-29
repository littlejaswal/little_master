<?
	function SendEnquiryMail($Name, $Email, $Enquiry)
	{
		$Subject = "$Name has submitted an enquiry on ".SITE_NAME;
		return SendEmail($Subject, ADMIN_EMAIL, $Email, $Name, $Enquiry, BCC_EMAIL);
	}
	
	function SendEmail($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
	{
		send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP);
	}

	function send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
	{
			
		$mail = new PHPMailer();
		if($IS_SMTP)
		{
			$mail->IsSMTP();                                   // send via SMTP
			$mail->Host     = "mail.pomdesign.com"; // SMTP servers
			$mail->SMTPAuth = true;     // turn on SMTP authentication     
			$mail->Username = "test@pomdesign.com";  // SMTP username
			$mail->Password = "password2009"; // SMTP password 		
		}
		$mail->From     = $FromEmail;
		$mail->FromName = $FromName;
		$mail->AddAddress(trim($ToEmail),trim($ToEmail)); 
		$MyBccArray = explode(",",$Bcc);
		foreach($MyBccArray as $Key=>$Value)
		{
			if(trim($Value) !="")
			 $mail->AddBCC("$Value"); 
		}
		if($Format=="html")
			$mail->IsHTML(true);                               // send as HTML
		else 
			$mail->IsHTML(false);                               // send as Plain
		
		$mail->Subject  =  $Subject;
		$mail->Body     =  $Message;
		//$mail->AltBody  =  $Message;
		if($FileAttachment)
		$mail->AddAttachment($AttachmentFileName,basename($AttachmentFileName));
		
		if(!$mail->Send())
		{
		   //echo "Message was not sent <p>";
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		   //exit;
		}
		return true;
	}
//	
//	function send_account_details_mail($username, $password, $sendto)
//	{
//		$contents="\n\n";
//		$contents.="***This is an automated email, please do not reply*** \n\n";
//		$contents.="Hi ".$username.",\n\n";
//		$contents.="Your login details for your website account are:\n\n";
//		$contents.="Username:"."      "."$username\n";
//		$contents.="Password:"."      "."$password\n\n";
//		$contents.="***Please keep your account details safe and secure***\n\n";
//		$contents.="Best of luck! \n\n";
//		$contents.=SITE_NAME;
//		send_email(SUBJECT_CONFIRM_EMAIL, $sendto, SITE_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
//		return true;
//	}
//	
//	function send_registration_confirm_email($url, $username, $sendto)
//	{
//		$contents="\n\n";
//		$contents.="***This is an automated email, please do not reply*** \n\n";
//		$contents.="Hi ".$username.",\n\n";
//		$contents.="Please click the link below to activate your website account. If the link is not clickable then copy and paste the link into the address bar in your browser. \n\n";
//		$contents.="<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>> \n\n";
//		$contents.=$url. "\n\n";
//		$contents.="<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<>>>>>>>>>>>>>>>>>>>>>>>>> \n\n";
//		$contents.="If you did not setup this account please email us at ".SUPPORT_EMAIL."\n\n\n";
//		$contents.="Regards,\n\n";
//		$contents.=SITE_NAME;
//		send_email(SUBJECT_CONFIRM_EMAIL, $sendto, SITE_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
//		return true;
//	}
//	
//	function send_change_password_email($name, $username, $password, $sendto)
//	{
//		$contents="\n\n";
//		$contents.="***This is an automated email, please do not reply*** \n\n";
//		$contents.="Hi ".$name.",\n\n";
//		$contents.="Your new login details for your website account are:\n\n";
//		$contents.="Username:"."      "."$username\n";
//		$contents.="Password:"."      "."$password\n\n";
//		$contents.="***Please keep your account details safe and secure***\n\n";
//		$contents.="Regards,\n\n";
//		$contents.=SITE_NAME;
//		send_email(SUBJECT_CONFIRM_EMAIL, $sendto, SITE_EMAIL, SITE_NAME, $contents, BCC_EMAIL);
//		return true;
//	}
//	
//	function send_forgot_password_email($name, $username, $password, $sendto)
//	{
//		$contents="\n\n";
//		$contents.="***This is an automated email, please do not reply*** \n\n";
//		$contents.="Hi ".$name.",\n\n";
//		$contents.="Your login details for your website account are:\n\n";
//		$contents.="Username:"."      "."$username\n";
//		$contents.="Password:"."      "."$password\n\n";
//		$contents.="Once logged into your account you may change the password or keep this one..\n\n";
//		$contents.="***Please keep your account details safe and secure***\n\n";
//		$contents.="Regards,\n\n";
//		$contents.=SITE_NAME;
//	}
//	
//	function send_order_email($order_id, $sendto)
//	{
//		
//	}
	
	
	
	
?>