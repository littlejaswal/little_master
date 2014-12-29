<?php
if(isset($_POST['submit'])):
	$QueryObj = new query('event');
	$not=array('submit');
	$QueryObj->Data=MakeDataArray($_POST, $not);
	$QueryObj->Insert();
	Redirect(make_url('events'));
	endif;
	?>