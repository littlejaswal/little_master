<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body> <div class="page">
<?php 
$to = "support@pangaea.co.uk"; 
$subject = "Contact Us"; 
$email = $_REQUEST['email'] ;
$friendsemail = $_REQUEST['friendsemail'] ;
$message = $_REQUEST['message'] ; 
$headers = "From: $email"; 
$sent = mail("support @ pangaea.co.uk", "Forward to a Friend", "Forward to a Friend", "From: support @ pangaea.co.uk") ; 
if($sent) 
{print "Your mail was sent successfully"; }
else 
{print "We encountered an error sending your mail"; }
?> 

</div> </body>
</html>
