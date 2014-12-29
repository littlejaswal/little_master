<?
$QueryObj= new query();
$QueryObj->TableName='emails';
$QueryObj->id=$_GET['id'];
$email=$QueryObj->DisplayOne();

$QueryObj->InitilizeSQL();
$QueryObj->TableName='lists';
$QueryObj->DisplayAll();

while($QueryObj1= $QueryObj->GetObjectFromRecord()):
	SendEmail(SUBJECT_NEWSLETTER.': '.$email->Name, $QueryObj1->emailaddress, ADMIN_EMAIL, SITE_NAME, $email->Content, BCC_EMAIL, 'html');
endwhile;

$QueryObj= new query();
$QueryObj->TableName='emails';
$QueryObj->Data['id']=$_GET['id'];
$QueryObj->Data['LastSent']=date("Y-m-d H:i:s");
$QueryObj->Update();

//$admin_sess_obj->set_msg(MSG_NEWSLETTER_SENT);
header("location:".DIR_WS_SITE.ADMIN_FOLDER.'/control.php?Page=letters');
exit;
?>