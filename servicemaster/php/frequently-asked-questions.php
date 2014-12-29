<?php
	$faqquery= new query('faq');
	$faqquery->Where="where is_active='1'";
	$faqquery->DisplayAll();
?>