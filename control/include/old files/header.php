<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?=SITE_NAME.' | Website Control Panel'?></title>

            <!-- Template stylesheet -->
        <link href="css/green/screen.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/green/datepicker.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/tipsy.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/tipsy.css" rel="stylesheet" type="text/css" media="all">

        <!--[if IE]>
                <link href="css/ie.css" rel="stylesheet" type="text/css" media="all">
                <script type="text/javascript" src="js/excanvas.js"></script>
        <![endif]-->

        <!-- Jquery and plugins -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery.img.preload.js"></script>
        <script type="text/javascript" src="js/hint.js"></script>
        <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>
        <script type="text/javascript" src="js/ckeditor/adapters/jquery.js"></script>
        <script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
        <script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
        <script type="text/javascript" src="js/jquery.tipsy.js"></script>
        <script type="text/javascript" src="js/custom_green.js"></script>
</head>
<body>

<div class="content_wrapper">

    <!-- Begin header -->
    <div id="header">
            <div id="logo">
                <?php echo SITE_NAME ?>
            </div>
           <!-- <div id="search">
                    <form action="dashboard.html" id="search_form" name="search_form" method="get">
                            <input type="text" id="q" name="q" title="Search" class="search noshadow"/>
                    </form>
            </div> -->
            <div id="account_info">
                    <img src="images/icon_online.png" alt="Online" class="mid_align"/>
                    Hello <a href="#">Admin</a> | <a href="<?php echo make_admin_url('setting', 'list', 'list');?>">Setting</a> | <a href="<?php echo make_admin_url('logout');?>">Logout</a>
            </div>
    </div>
    <!-- End header -->

    <?php include_once(DIR_FS_SITE.'control/include/left.php');?>
    
    <!-- Begin content -->
	<div id="content">
		<div class="inner">
			<h1><?php echo get_section_heading($Page)?></h1>
