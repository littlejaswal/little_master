<?php
	function SendEmail($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="html",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
	{
		send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="html",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true);
	}

	function send_email($Subject, $ToEmail, $FromEmail, $FromName, $Message, $Bcc="",$Format="html",$FileAttachment=false,$AttachmentFileName="",$IS_SMTP=true)
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
					#$mail->Host     = "exchange.webcreationuk.com"; // SMTP servers
					$mail->SMTPAuth = true;     // turn on SMTP authentication	
					#$mail->Username = "testing@wcukdev.co.uk";  // SMTP username
					#$mail->Password = "development"; // SMTP password

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

        function send_db_email($email_id, $to_email=ADMIN_EMAIL, $array=array())
        {
            $object=get_object('email', $email_id);
            $content=$object->email_text;
            $subject=$object->email_subject;
            if(is_object($object)):
                if(count($array)):
                    foreach($array as $k=>$v):
                        $literal='{'.trim(strtoupper($k)).'}';
                        $content=html_entity_decode(str_replace($literal, $v, $content));
                        $subject=str_replace($literal, $v, $subject);
                    endforeach;
                endif;
               //print $content;exit;
               if(SendEmail($subject, $to_email, 'rocky@xtx.in', SITE_NAME, $content, BCC_EMAIL, 'html', false, '', true)):
                      return true;
               else:
                    return false;
               endif;
            else:
                return false;
            endif;
        }
      ?>