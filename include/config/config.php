<?php

ob_start();
error_reporting(E_ALL);
#session reassigning using cookie here.
session_start();
###############################################################################################
############################     Website developed by: cWebConsultants
############################     Website name: Grand Falls Windsor
###############################################################################################

define("DIR_FS", $_SERVER['DOCUMENT_ROOT'],true);

#Set Website Filesystem
define("DIR_FS_SITE", DIR_FS.'/pearlandpm/',true);
# Server path.
define("HTTP_SERVER", "http://localhost/",true);
# Set website
define("DIR_WS_SITE", HTTP_SERVER."pearlandpm/",true);
# Database 
$DBHostName = "localhost";
$DBDataBase = "pearlandpm";
$DBUserName = "root";
$DBPassword = "cwebco";

# include sub-configuration files here.
require_once(DIR_FS_SITE."include/config/url.php");

# include the database class files.
require_once(DIR_FS_SITE_INCLUDE_CLASS."mysql.php");

require_once(DIR_FS_SITE_INCLUDE_CLASS."query.php");
require_once(DIR_FS_SITE_INCLUDE_CLASS."validation_u.php");
require_once(DIR_FS_SITE_INCLUDE_CLASS."validation_p.php");
# include session files here.

# include the utitlity files here
require_once(DIR_FS_SITE_INCLUDE_CLASS."phpmailer.php");
require_once(DIR_FS_SITE_INCLUDE_CONFIG."constant.php");
require_once(DIR_FS_SITE_INCLUDE_CONFIG."message.php");

# custom files
include_once(DIR_FS_SITE_INCLUDE_CLASS.'login_session.php');
include_once(DIR_FS_SITE_INCLUDE_CLASS.'admin_session.php');

# include functions here.
include_once(DIR_FS_SITE_INCLUDE_FUNCTION.'date.php');
//require_once(DIR_FS_SITE_INCLUDE_FUNCTION."dBug.php");

# include function files here.
include_once(DIR_FS_SITE.'include/function/basic.php');

#date_default_timezone_set('Asia/Calcutta');

# fix for stripslashes issues in php
if(get_magic_quotes_gpc()):
	$_POST=array_map_recursive('stripslashes', $_POST);
	$_GET=array_map_recursive('stripslashes', $_GET);
	$_REQUEST=array_map_recursive('stripslashes', $_REQUEST);
endif;
$publickey = "6LcWw7kSAAAAADZv_vEtAK2oEHvk3XcHuEoThrbN";
$privatekey = "6LcWw7kSAAAAACgQDdDBBIei-rxYTOPlgI02lDG9";
?>
