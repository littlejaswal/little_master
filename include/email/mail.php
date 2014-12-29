<?
$contents="\n\n";
$contents.="Name :".ucfirst($_POST['name'])."\n\n";
$contents.="Email Address : ".$_POST['email']."\n\n";
$contents.="Telephone : ".$_POST['telephone']."\n\n";
$contents.="Enquiry Details : ".$_POST['message']."\n\n";
$contents.="Regards,\n\n";
$contents.=SITE_NAME;
?>