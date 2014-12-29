<?php

/**
 * @twitter integration with cWebconsultants CMS
 * Twitter Configuration File - config.php
 */
 
/* Include the CMS configuration file */
include "../../include/config/config.php";

/* Define Twitter Application Secrets */
define('CONSUMER_KEY', TWITTER_APP_KEY);
define('CONSUMER_SECRET', TWITTER_APP_SECRET);
define('OAUTH_CALLBACK', DIR_WS_SITE.'control/twitter/callback.php');


/* setup global variables */
	global $DBHostName;
	global $DBDataBase;
	global $DBUserName;
	global $DBPassword;
	
/* establish connection */
	$db_connection = mysql_connect($DBHostName, $DBUserName, $DBPassword) or die('can\'t connect to database');
	mysql_select_db($DBDataBase, $db_connection) or die('can\'t select database');
