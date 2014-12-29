<?php
# WEBSITE CONSTANTS 
$constants=new query('setting');
$constants->DisplayAll();
while($constant=$constants->GetObjectFromRecord()):
	define("$constant->key", $constant->value, false);
endwhile;

# PHP Validation types
define('VALIDATE_REQUIRED', "req", true);
define('VALIDATE_EMAIL',"email", true);
define("VALIDATE_MAX_LENGTH","maxlength");
define("VALIDATE_MIN_LENGTH","minlength");
define("VALIDATE_NUMERIC","num");
define("VALIDATE_ALPHA","alpha");
define("VALIDATE_ALPHANUM","alphanum");

define("TEMPLATE","default");
define("CURRENCY_SYMBOL", "$");

define("ADMIN_FOLDER",'control');

define("ADD_ATTRIBUTE_PRICE_TO_PRODUCT_PRICE", true);
define("ATTRIBUTE_PRICE_OVERLAP", false);

define('VERIFY_EMAIL_ON_REGISTER', true);
define('ERROR_EMAIL', 'rocky.developer004@gmail.com', true);

$conf_shipping_type=array('quantity', 'subtotal');

define('SHIPPING_TYPE', 'Quantity');

$AllowedImageTypes=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');
$AllowedFileTypes=array('application/vnd.ms-excel');

# new allowed photo mime type array.
$conf_allowed_file_mime_type=array('application/vnd.ms-excel', 'application/msexcel','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document');
$conf_allowed_photo_mime_type=array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/jpg', 'image/png');
$conf_order_status=array('Received', 'Processing', 'Shipped', 'Delivered');

define("DOC_TYPE", '<!DOCTYPE html>', true);
define("DOC_LANGUAGE", "en", true);
define("DOC_CHAR_SET", 'utf-8', true);

$conf_rewrite_url=array(
	'visit'=>'visit',
	'relocate'=>'relocate',
	'residents'=>'residents',
	'business'=>'business',
        'conventions'=>'conventions',
	'living'=>'living',
	'age_friendly'=>'age-friendly',
	'content'=>'content',
	'news'=>'news',
	'news-detail'=>'news',
	'event'=>'events',
        'event-detail'=>'events',
        'events-calendar'=>'events-calendar',
        'category'=>'business-directory',
        'directory'=>'business-directory',
        'directory_detail'=>'business-directory',
        'submit_business'=>'submit-your-business',
        'links'=>'links',
        'team'=>'contact-the-town',
	'council_videos'=>'council-videos',
        'video-detail'=>'council-videos',
        'photos'=>'gallery',
        'photos-photos'=>'gallery',
        'faqs'=>'website-faq',
	'virtual_tour'=>'virtual-tour',
        'contact-us'=>'contact-us',
        'jobposting'=>'job-postings',
        'job_detail'=>'job-postings',
        'interactive-map'=>'interactive-town-map',
	'home'=>''
);

?>