<?php
        require_once("../include/config/config.php");

        $function=array('url_rewrite','url', 'cart','input', 'admin', 'users', 'gallery','database');
	include_functions($function);
        
        /* check if already logged in */
        if($admin_user->is_logged_in()){
            redirect(make_admin_url('home', 'list', 'list'));
        }

        /* check cookie */
        if(isset($_COOKIE['admin'])){
            $object= get_object('admin_user', $_COOKIE['admin']);
            if(is_object($object)){
                if($user=validate_user('admin_user', array('username'=>$object->username, 'password'=>$object->password))){
                    $admin_user->set_admin_user_from_object($object);
                    update_last_access($user->id, 1);
		    re_direct(DIR_WS_SITE_CONTROL."control.php");
                }
            }
        }

        /* login user */
        if(is_var_set_in_post('login')):
		if($user=validate_user('admin_user', $_POST)):
                        if(isset($_POST['remember'])){
                            setcookie('admin', $user->id, 3600*60, '/', SITE_NAME);
                        }
			$admin_user->set_admin_user_from_object($user);
			update_last_access($user->id, 1);
			re_direct(DIR_WS_SITE_CONTROL."control.php");
		else:
			$admin_user->set_pass_msg(MSG_LOGIN_INVALID_USERNAME_PASSWORD);
			re_direct(DIR_WS_SITE_CONTROL.'index.php');
		endif;
	endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title><?=SITE_NAME?> :: Website Control Panel</title>
	<!-- Meta data for SEO -->
        <meta name="description" content="">
        <meta name="keywords" content="">

        <!-- Template stylesheet -->
        <link href="css/green/screen.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/green/datepicker.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" media="all">
        <link href="js/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" media="all">

        <!--[if IE]>
                <link href="css/ie.css" rel="stylesheet" type="text/css" media="all">
                <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <![endif]-->

        <!-- Jquery and plugins -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery.img.preload.js"></script>
        <script type="text/javascript" src="js/hint.js"></script>
        <script type="text/javascript" src="js/visualize/jquery.visualize.js"></script>
        <script type="text/javascript" src="js/jwysiwyg/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.0.js"></script>
        <script type="text/javascript" charset="utf-8">
        $(function(){
            // find all the input elements with title attributes
            $('input[title!=""]').hint();
            $('#login_info').click(function(){
                        $(this).fadeOut('fast');
                });
        });
        </script>
</head>
<body class="login">
	<!-- Begin login window -->
	<div id="login_wrapper">
		<br class="clear"/>
		<div id="login_top_window">
			<img src="images/green/top_login_window.png" alt="top window"/>
		</div>

		<!-- Begin content -->
		<div id="login_body_window">
			<div class="inner">
                            <h1><?php echo strtoupper(SITE_NAME)?></h1>
				<form method="post" id="form_login" name="form_login">
					<p>
					     <input type="text" id="username" name="username" style="width:285px" title="Username"/>
					</p>
					<p>
					     <input type="password" id="password" name="password" style="width:285px" title="******"/>
					</p>
					<p style="margin-top:50px">
					     <input type="submit" id="submit" name="login" value="Login" class="Login" style="margin-right:5px"/>
					     <input type="checkbox" id="remember" name="remember"/>Remember my password
					</p>
				</form>
			</div>
		</div>
		<!-- End content -->
		<div id="login_footer_window">
			<img src="images/green/footer_login_window.png" alt="footer window"/>
		</div>
		<div id="login_reflect">
			<img src="images/green/reflect.png" alt="window reflect"/>
		</div>
	</div>
	<!-- End login window -->
</body>
</html>