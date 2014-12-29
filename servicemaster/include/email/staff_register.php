<?
$contents="\n\n";
$contents.="***This is an automated email, please do not reply*** \n\n";
$contents.="Hi ".$_POST[firstname].",\n\n";
$contents.="Please check the information below of your website account.\n\n ";
$contents.="Your Email Address is :".$_POST[username]."\n\n";
$contents.="Your Password is      :".$_POST[password]."\n\n";
$contents.="Regards,\n\n";
$contents.=SITE_NAME;
?>