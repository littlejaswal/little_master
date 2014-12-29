<?php
# WEBSITE CONSTANTS 
$constants=new query('setting');
$constants->DisplayAll();
while($constant=$constants->GetObjectFromRecord()):
	define("$constant->key", $constant->value, true);
endwhile;

# Email subjects.
define("SUBJECT_ONLINE_ENQUIRY",SITE_NAME." : Online enquiry regarding ");

# PHP Validation types
define('VALIDATE_REQUIRED', "req", true);
define('VALIDATE_EMAIL',"email", true);
define("VALIDATE_MAX_LENGTH","maxlength");
define("VALIDATE_MIN_LENGTH","minlength");
define("VALIDATE_NUMERIC","num");
define("VALIDATE_ALPHA","alpha");
define("VALIDATE_ALPHANUM","alphanum");

define("TEMPLATE","default");

define("WEBSITE_DEVELOPED_BY_NAME","cWebConsultants.com");
define("WEBSITE_DEVELOPED_BY_LINK","http://www.cwebconsultants.com");
define("WEBSITE_DEVELOPED_BY_TITLE","Website Design & Website Development Company, India, Chandigarh");

define("ADMIN_FOLDER",'control');
$AllowedFileImageTypes=array('application/msword','application/pdf','application/txt','application/docx');
# new allowed photo mime type array.
$conf_allowed_photo_mime_type=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');
?>