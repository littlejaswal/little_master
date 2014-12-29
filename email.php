<?php
	function SendEnquiryMail($Name, $Email, $Enquiry)
	{
		$Subject = "$Name has submitted an enquiry on ".SITE_NAME;
		return SendEmail($Subject, ADMIN_EMAIL, $Email, $Name, $Enquiry, BCC_EMAIL);
	}
	
	function SendEmail($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
	{
		send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true);
	}

	function send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="text",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
{
		
	$mail = new PHPMailer();
	if($IS_SMTP)
	{
		$mail->IsSMTP();            // send via SMTP
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "rocky.developer002@gmail.com";  // GMAIL username
		$mail->Password   = "deve#002";    
		$mail->SMTPAuth = true;     // turn on SMTP authentication			
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
};

?>