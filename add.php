<?php
 
include('include/config/config.php');

    
   $link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('newpearlandpm');

/* this should return the correct numbers of deleted records */
mysql_query("INSERT INTO `newpearlandpm`.`setting` (
`id` ,
`key` ,
`value` ,
`name` ,
`title` ,
`type`
)
VALUES (
NULL , 'PHONE_NUMBER1', '946', 'address', 'Another Phone Number', 'text'
)");
printf("Records alter: %d\n", mysql_affected_rows());
 ?>
