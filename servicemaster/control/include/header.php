<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?=SITE_NAME.' | Website Control Panel'?></title>
	<link href="<?=DIR_WS_SITE_CONTROL_CSS.'style.css'?>" media="screen" rel="stylesheet" type="text/css">
	<link href="<?=DIR_WS_SITE_CONTROL_CSS.'themes/smoothness/jquery.ui.all.css'?>" media="screen" rel="stylesheet" type="text/css">
	<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/jquery-1.2.6.min.js"></script>
	<script src="<?php echo DIR_WS_SITE.ADMIN_FOLDER?>/js/javascript.js"></script>
	<script src="<?php echo DIR_WS_SITE?>control/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo DIR_WS_SITE?>control/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo DIR_WS_SITE?>control/js/ui/jquery.ui.datepicker.js"></script>
</head>
<body>
<div id="container">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="toparea"><img src="image/top_left_corner.jpg" alt="" align="left" />
          <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="50" class="logo"><?php echo SITE_NAME?> | Website Control Panel</td>
              <td align="right" class="topnav"><a href="<?php echo DIR_WS_SITE;?>" target="_blank">View Site</a>&nbsp;|&nbsp;<a href="<?php echo make_admin_url('home');?>">dashboard</a> | <a href="<?php echo make_admin_url('logout');?>">logout</a> </td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="contentRC"><img src="image/content_top_left_corner.jpg" alt="" width="14" height="17" /></td>
      </tr>
      <tr>
        <td height="66" align="center" valign="top" class="contentarea"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="250" align="left" valign="top">
				<div><img src="image/nav_top_corner.gif" alt="" width="250" height="7" /></div>
				<div class="navarea">
					<?php include_once(DIR_FS_SITE.'control/include/left.php');?>
				</div>
				<div><img src="image/nav_bottom_corner.gif" alt="" width="250" height="7" /></div>			
			</td>
				<td align="left" valign="top" class="contentRA">
				<div class="Block_RTRC"><img src="image/Block_RLC.gif" alt="" width="7" height="7" /></div>
				<div class="BlockContentArea">
				<h4><?php echo get_section_heading($Page)?></h4>
